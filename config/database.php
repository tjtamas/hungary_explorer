<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

/**
 * Database Connection Manager
 * 
 * Single Responsibility: CSAK az adatbázis kapcsolatért felelős
 * 
 * @package MagyarorszagFelfedezoi
 */
class DatabaseConfig
{
    private static ?PDO $connection = null;
    
    /**
     * Singleton PDO connection
     * Dependency Inversion: PDO interface-t ad vissza
     */
    public static function getConnection(): PDO
    {
        if (self::$connection === null) {
            self::$connection = self::createConnection();
        }
        
        return self::$connection;
    }
    
    /**
     * Factory method - könnyű tesztelni és mockölni
     */
    private static function createConnection(): PDO
    {
        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;charset=utf8mb4;port=3306',
            DB_HOST,
            DB_NAME
        );
        
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"  // ← ÚJ SOR!

        ];
        
        try {
            return new PDO($dsn, DB_USER, DB_PASSWORD, $options);
        } catch (PDOException $e) {
            error_log('Database connection failed: ' . $e->getMessage());
            throw new RuntimeException('Adatbázis kapcsolódási hiba');
        }
    }
    
    /**
     * Kapcsolat bezárása (testing purposes)
     */
    public static function closeConnection(): void
    {
        self::$connection = null;
    }
}