<?php
declare(strict_types=1);
header('Content-Type: application/json; charset=UTF-8');


/**
 * Modern API Endpoint - Tábor Jelentkezés Feldolgozás
 * 
 * RESTful API endpoint SOLID elvekkel
 * 
 * @package MagyarorszagFelfedezoi
 * @version 2.0.0
 */

// CORS és security headers
header('Content-Type: application/json; charset=UTF-8');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');

// Csak POST engedélyezése
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Rate limiting egyszerű implementáció
session_start();
$currentTime = time();
$sessionKey = 'last_registration_attempt';

if (isset($_SESSION[$sessionKey]) && ($currentTime - $_SESSION[$sessionKey]) < 30) {
    http_response_code(429);
    echo json_encode([
        'success' => false, 
        'message' => 'Túl gyakori próbálkozás. Kérjük, várjon 30 másodpercet.',
        'code' => 'RATE_LIMITED'
    ]);
    exit;
}

try {
    // Config és service betöltése
    require_once __DIR__ . '/../../config/config.php';
   require_once __DIR__ . '/../../config/TaborRegistrationService.php';
    
    // Service inicializálás
    $registrationService = new TaborRegistrationService(CONTACT_EMAIL);
    
    // Input validáció és sanitization
$input = filter_input_array(INPUT_POST, [
    'firstname' => FILTER_UNSAFE_RAW,
    'lakcim' => FILTER_UNSAFE_RAW,
    'phonenumber' => FILTER_UNSAFE_RAW,
    'parentsnumber' => FILTER_UNSAFE_RAW,
    'idnumber' => FILTER_UNSAFE_RAW,
    'birthdate' => FILTER_UNSAFE_RAW,
    'email' => FILTER_SANITIZE_EMAIL,
    'agreement' => FILTER_VALIDATE_BOOLEAN
], true);

// ✅ Checkbox-ok kézi beállítása
$input['agreement'] = isset($_POST['agreement']) ? 1 : 0;

foreach (['firstname', 'lakcim', 'phonenumber', 'parentsnumber', 'idnumber', 'birthdate'] as $field) {
    if (isset($input[$field])) {
        $input[$field] = strip_tags($input[$field]); // HTML tagek eltávolítása
    }
}

    if ($input === false || $input === null) {
        throw new InvalidArgumentException('Érvénytelen bemeneti adatok');
    }

    if (empty($input['email']) && !empty($_POST['parentsemail'])) {
    $input['email'] = filter_var($_POST['parentsemail'], FILTER_SANITIZE_EMAIL);
}
    
    // Üres értékek null-lá alakítása
    $input = array_map(function($value) {
        return (is_string($value) && trim($value) === '') ? null : $value;
    }, $input);
    
    // Jelentkezés feldolgozása
    $result = $registrationService->processRegistration($input);
    
    if ($result['success']) {
        // Sikeres regisztráció esetén rate limiting beállítás
        $_SESSION[$sessionKey] = $currentTime;
        http_response_code(200);
    } else {
        // Hiba esetén megfelelő HTTP status
        $statusCode = match($result['code'] ?? '') {
            'VALIDATION_ERROR' => 400,
            'RATE_LIMITED' => 429,
            default => 500
        };
        http_response_code($statusCode);
    }
    
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    
} catch (InvalidArgumentException $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
        'code' => 'VALIDATION_ERROR'
    ], JSON_UNESCAPED_UNICODE);
    
} catch (Exception $e) {
    // Log a hiba részleteit, de ne küldjük el a kliensnek
    error_log('Registration API Error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine());
    
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Rendszerhiba történt. Kérjük, próbálja újra később.',
        'code' => 'SYSTEM_ERROR'
    ], JSON_UNESCAPED_UNICODE);
}