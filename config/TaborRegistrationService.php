<?php
declare(strict_types=1);

/**
 * Tábor Jelentkezési Service - MFS 2025
 * 
 * SOLID principles alapján készült modern backend
 * 
 * @package MagyarorszagFelfedezoi
 * @version 2.0.0
 */

require_once __DIR__ . '/database.php';

class TaborRegistrationService
{
    private PDO $db;
    private string $adminEmail;
    private string $tableName = 'tabor2026';
    
    public function __construct(string $adminEmail = 'tothjanostamas@gmail.com')
    {
        $this->db = DatabaseConfig::getConnection();
        $this->adminEmail = $adminEmail;
    }
    
    /**
     * Új jelentkezés feldolgozása
     */
    public function processRegistration(array $data): array
    {
        try {
            // Adatok validálása
            $validatedData = $this->validateRegistrationData($data);
            
            // Adatbázisba mentés
            $registrationId = $this->saveRegistration($validatedData);
            
            // Email küldés
            $this->sendNotificationEmail($validatedData, $registrationId);
            
            return [
                'success' => true,
                'message' => 'Sikeres jelentkezés!',
                'registration_id' => $registrationId
            ];
            
        } catch (InvalidArgumentException $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'code' => 'VALIDATION_ERROR'
            ];
            
        } catch (Exception $e) {
            error_log('Registration error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Rendszerhiba történt. Kérjük, próbálja újra később.',
                'code' => 'SYSTEM_ERROR'
            ];
        }
    }
    
    /**
     * Adatok validálása
     */
    private function validateRegistrationData(array $data): array
    {
        $errors = [];
        $validated = [];
        
        // Kötelező mezők
        $required = [
            'firstname' => 'Név',
            'lakcim' => 'Cím',
            'parentsnumber' => 'Szülő telefonszáma'
        ];
        
        foreach ($required as $field => $label) {
            if (empty(trim($data[$field] ?? ''))) {
                $errors[] = "{$label} megadása kötelező";
            } else {
                $validated[$field] = trim($data[$field]);
            }
        }
        
        // Opcionális mezők
        $validated['phonenumber'] = $this->sanitizePhone($data['phonenumber'] ?? '');
        $validated['idnumber'] = $this->sanitizeTAJ($data['idnumber'] ?? '');
        $validated['birthdate'] = $this->validateDate($data['birthdate'] ?? '');
        $validated['agreement'] = isset($data['agreement']) && $data['agreement'] ? 1 : 0;

        // Email validáció ha van
        if (!empty($data['email'])) {
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Érvénytelen email cím';
            } else {
                $validated['email'] = trim($data['email']);
            }
        }
        
        if (!empty($errors)) {
            throw new InvalidArgumentException(implode(', ', $errors));
        }
        
        return $validated;
    }
    
    /**
     * Telefonszám sanitizálás
     */
    private function sanitizePhone(string $phone): ?string
    {
        if (empty($phone)) return null;
        
        $phone = preg_replace('/[^\d\+\-\(\)\s]/', '', $phone);
        return !empty($phone) ? $phone : null;
    }
    
    /**
     * TAJ szám validáció
     */
    private function sanitizeTAJ(string $taj): ?string
    {
        if (empty($taj)) return null;
        
        $taj = preg_replace('/[^\d]/', '', $taj);
        
        // TAJ szám 9 számjegy
        if (strlen($taj) === 9) {
            return $taj;
        }
        
        return !empty($taj) ? $taj : null;
    }
    
    /**
     * Dátum validáció
     */
    private function validateDate(string $date): ?string
    {
        if (empty($date)) return null;
        
        $timestamp = strtotime($date);
        if ($timestamp === false) return null;
        
        return date('Y-m-d', $timestamp);
    }
    
    /**
     * Adatbázisba mentés
     */
    private function saveRegistration(array $data): int
    {
        $sql = "INSERT INTO {$this->tableName} (
            firstname, lakcim, phonenumber, parentsnumber, 
            idnumber, birthdate, agreement, email, created_at
        ) VALUES (
            :firstname, :lakcim, :phonenumber, :parentsnumber,
            :idnumber, :birthdate, :agreement, :email, NOW()
        )";
        
        $stmt = $this->db->prepare($sql);
        
        $stmt->execute([
            'firstname' => $data['firstname'],
            'lakcim' => $data['lakcim'],
            'phonenumber' => $data['phonenumber'],
            'parentsnumber' => $data['parentsnumber'],
            'idnumber' => $data['idnumber'],
            'birthdate' => $data['birthdate'],
            'agreement' => $data['agreement'] ? 1 : 0,
            'email' => $data['email'] ?? null
        ]);
        
        return (int)$this->db->lastInsertId();
    }
    
    /**
     * Email küldés
     */
    private function sendNotificationEmail(array $data, int $id): void
    {
   // ✅ FEJLESZTÉSI KÖRNYEZETBEN NE KÜLDJÖN EMAILT
    if (defined('DEBUG_MODE') && DEBUG_MODE === true) {
        error_log("Email would be sent to: {$this->adminEmail} (Registration ID: {$id})");
        return; // Kilép, nem küld emailt
    }

        $subject = "Új tábori jelentkezés érkezett (#{$id})";
        
        $message = $this->buildEmailMessage($data, $id);
        
        $headers = [
            'From: no-reply@magyarorszagfelfedezoi.hu',
            'Reply-To: ' . ($data['email'] ?? 'no-reply@magyarorszagfelfedezoi.hu'),
            'Content-Type: text/plain; charset=UTF-8'
        ];
        
        @mail($this->adminEmail, $subject, $message, implode("\r\n", $headers));
    }
    
    /**
     * Email üzenet összeállítása
     */
    private function buildEmailMessage(array $data, int $id): string
    {
        $message = "Új jelentkezés érkezett a 2026-os nyári táborra!\n\n";
        $message .= "Jelentkezési szám: #{$id}\n";
        $message .= "Időpont: " . date('Y-m-d H:i:s') . "\n\n";
        $message .= "=== JELENTKEZŐ ADATAI ===\n";
        $message .= "Név: {$data['firstname']}\n";
        $message .= "Cím: {$data['lakcim']}\n";
        $message .= "Telefonszám: " . ($data['phonenumber'] ?? 'Nincs megadva') . "\n";
        $message .= "Szülő telefonszáma: {$data['parentsnumber']}\n";
        
        if (!empty($data['email'])) {
            $message .= "Email: {$data['email']}\n";
        }
        
        $message .= "TAJ szám: " . ($data['idnumber'] ?? 'Nincs megadva') . "\n";
        $message .= "Születési dátum: " . ($data['birthdate'] ?? 'Nincs megadva') . "\n";
        $message .= "Kép/videó hozzájárulás: " . ($data['agreement'] ? 'Igen' : 'Nem') . "\n\n";
        $message .= "=== ADMINISZTRÁCIÓS LINK ===\n";
        $message .= "Jelentkezések kezelése: https://magyarorszagfelfedezoi.hu/admin/registrations\n\n";
        $message .= "Ez egy automatikus üzenet.";
        
        return $message;
    }
    
    /**
     * Jelentkezések lekérdezése (admin funkció)
     */
    public function getRegistrations(int $limit = 50, int $offset = 0): array
    {
        $sql = "SELECT * FROM {$this->tableName} 
                ORDER BY created_at DESC 
                LIMIT :limit OFFSET :offset";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    /**
     * Összesített statisztikák
     */
    public function getStatistics(): array
    {
        $sql = "SELECT 
                    COUNT(*) as total_registrations,
                    COUNT(CASE WHEN agreement = 1 THEN 1 END) as with_media_consent,
                    COUNT(CASE WHEN email IS NOT NULL THEN 1 END) as with_email,
                    MIN(created_at) as first_registration,
                    MAX(created_at) as last_registration
                FROM {$this->tableName}";
        
        $stmt = $this->db->query($sql);
        return $stmt->fetch();
    }
}