<?php
declare(strict_types=1);

/**
 * Configuration File - Magyarország Felfedezői Szövetség
 * 
 * Central configuration for the entire application
 * Single source of truth for all settings
 * 
 * @package MagyarorszagFelfedezoi
 * @version 2.0.0
 */

// ============================================
// ERROR REPORTING (Development vs Production)
// ============================================

// Development mode - show all errors
if ($_SERVER['HTTP_HOST'] === 'localhost' || strpos($_SERVER['HTTP_HOST'], '127.0.0.1') !== false) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    define('DEBUG_MODE', true);
} else {
    // Production mode - hide errors, log them
    error_reporting(0);
    ini_set('display_errors', '0');
    define('DEBUG_MODE', false);
}

// ============================================
// PATH CONSTANTS
// ============================================

define('BASE_PATH', dirname(__DIR__)); // Project root
define('CONFIG_PATH', BASE_PATH . '/config');
define('TEMPLATES_PATH', BASE_PATH . '/templates');
define('ASSETS_PATH', BASE_PATH . '/assets');
define('IMAGES_PATH', BASE_PATH . '/images');
define('NEWS_PATH', BASE_PATH . '/news');

// ============================================
// URL CONSTANTS
// ============================================

// Auto-detect base URL
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';

// Fixed base URL - ne a script path-ot használjuk, hanem fix értéket

$basePath = '/Webpage';  // <-- Ha gyökérben van, legyen ''
$baseUrl = $protocol . $host . $basePath;

define('BASE_URL', rtrim($baseUrl, '/'));
define('ASSETS_URL', BASE_URL . '/assets');
define('IMAGES_URL', BASE_URL . '/images');

// ============================================
// SITE INFORMATION
// ============================================

define('SITE_NAME', 'Magyarország Felfedezői Szövetség');
define('SITE_TAGLINE', '"Őseim országot szereztek, én Szülőföldemet teszem hazámmá"');
define('SITE_DESCRIPTION', 'Gyermekek, fiatalok és felnőttek közössége 1989 óta');
define('CONTACT_EMAIL', 'info@magyarorszagfelfedezoi.hu');
define('FACEBOOK_PAGE', 'https://www.facebook.com/Magyarország-Felfedezői-Szövetség-176863082418183/');
define('SZJA_TAX_NUMBER', '19624772-1-05');

// ============================================
// DATABASE CONFIGURATION (Ha később kell)
// ============================================

define('DB_HOST', 'localhost');
define('DB_NAME', 'felfedezok_db');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// ============================================
// DATE & TIME
// ============================================

date_default_timezone_set('Europe/Budapest');
define('DATE_FORMAT', 'Y.m.d.');
define('DATETIME_FORMAT', 'Y.m.d. H:i');

// ============================================
// THEME COLORS (Magyar zászló színek)
// ============================================

define('COLOR_PRIMARY', '#c41e3a');      // Piros
define('COLOR_SECONDARY', '#436f4d');    // Zöld
define('COLOR_ACCENT', '#ffffff');       // Fehér
define('COLOR_TEXT_DARK', '#2c3e50');
define('COLOR_TEXT_LIGHT', '#7f888f');

// ============================================
// FEATURE FLAGS
// ============================================

define('ENABLE_CACHE', false);           // Cache engedélyezése
define('ENABLE_ANALYTICS', true);        // Google Analytics
define('ENABLE_FACEBOOK_SDK', true);     // Facebook widget
define('MAINTENANCE_MODE', false);       // Karbantartás mód

// ============================================
// UPLOAD SETTINGS (Ha kell file upload)
// ============================================

define('UPLOAD_PATH', BASE_PATH . '/uploads');
define('MAX_UPLOAD_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'gif', 'pdf']);

// ============================================
// PAGINATION
// ============================================

define('NEWS_PER_PAGE', 9);
define('GALLERY_IMAGES_PER_PAGE', 12);

// ============================================
// AUTOLOAD CLASSES
// ============================================

spl_autoload_register(function ($class) {
    $file = CONFIG_PATH . '/' . $class . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// ============================================
// GLOBAL FUNCTIONS
// ============================================

/**
 * Get base URL with optional path
 * 
 * @param string $path Optional path to append
 * @return string Full URL
 */
function url(string $path = ''): string
{
    return BASE_URL . '/' . ltrim($path, '/');
}

/**
 * Get asset URL
 * 
 * @param string $path Asset path (css/style.css)
 * @return string Full asset URL
 */
function asset(string $path): string
{
    return ASSETS_URL . '/' . ltrim($path, '/');
}

/**
 * Get image URL
 * 
 * @param string $path Image path
 * @return string Full image URL
 */
function img(string $path): string
{
    return IMAGES_URL . '/' . ltrim($path, '/');
}

/**
 * Debug helper - only works in debug mode
 * 
 * @param mixed $data Data to dump
 * @param bool $die Stop execution after dump
 * @return void
 */
function dd(mixed $data, bool $die = true): void
{
    if (DEBUG_MODE) {
        echo '<pre style="background:#1e1e1e;color:#dcdcdc;padding:1em;border-radius:8px;margin:1em;font-family:monospace;font-size:14px;">';
        var_dump($data);
        echo '</pre>';
        if ($die) {
            die();
        }
    }
}

/**
 * Sanitize string for safe output
 * 
 * @param string $str String to sanitize
 * @return string Sanitized string
 */
function clean(string $str): string
{
    return htmlspecialchars($str, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

/**
 * Format date in Hungarian format
 * 
 * @param string|int $date Date string or timestamp
 * @return string Formatted date
 */
function formatDate(string|int $date): string
{
    $timestamp = is_numeric($date) ? $date : strtotime($date);
    return date(DATE_FORMAT, $timestamp);
}

/**
 * Redirect to URL
 * 
 * @param string $url URL to redirect to
 * @param int $code HTTP status code
 * @return never
 */
function redirect(string $url, int $code = 302): never
{
    header("Location: $url", true, $code);
    exit;
}

/**
 * Check if in maintenance mode
 * 
 * @return bool
 */
function isMaintenanceMode(): bool
{
    return MAINTENANCE_MODE;
}

// ============================================
// SECURITY HEADERS
// ============================================

if (!DEBUG_MODE) {
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('X-XSS-Protection: 1; mode=block');
    header('Referrer-Policy: strict-origin-when-cross-origin');
}

// ============================================
// SESSION START
// ============================================

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ============================================
// MAINTENANCE MODE CHECK
// ============================================

if (MAINTENANCE_MODE && !DEBUG_MODE) {
    http_response_code(503);
    echo '<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karbantartás - ' . SITE_NAME . '</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding: 50px; background: #f5f6f7; }
        h1 { color: ' . COLOR_PRIMARY . '; }
    </style>
</head>
<body>
    <h1>🔧 Karbantartás alatt</h1>
    <p>Weboldalunk jelenleg karbantartás alatt áll. Hamarosan visszatérünk!</p>
</body>
</html>';
    exit;
}