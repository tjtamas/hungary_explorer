<?php


/**
 * Database Connection Test - MFS 2025
 * 
 * Teszteli:
 * - Nethely.hu kapcsolódást
 * - Tábla létezését
 * - Adatok írását/olvasását
 */


require_once __DIR__ . '/../config/database.php';

// HTML sablon kezdése
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adatbázis Kapcsolat Teszt</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            min-height: 100vh;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            padding: 30px;
        }
        
        h1 {
            color: #2c3e50;
            margin-bottom: 10px;
            font-size: 28px;
        }
        
        .subtitle {
            color: #7f8c8d;
            margin-bottom: 30px;
            font-size: 14px;
        }
        
        .test-section {
            margin-bottom: 25px;
            padding: 20px;
            border-radius: 8px;
            border: 2px solid #ecf0f1;
        }
        
        .test-section h2 {
            font-size: 18px;
            margin-bottom: 15px;
            color: #34495e;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .status {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 12px;
            text-transform: uppercase;
        }
        
        .status.success {
            background: #d4edda;
            color: #155724;
        }
        
        .status.error {
            background: #f8d7da;
            color: #721c24;
        }
        
        .status.warning {
            background: #fff3cd;
            color: #856404;
        }
        
        .info-box {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 6px;
            margin-top: 10px;
            font-family: 'Courier New', monospace;
            font-size: 13px;
        }
        
        .info-box strong {
            color: #495057;
        }
        
        .error-message {
            background: #fff5f5;
            border-left: 4px solid #e74c3c;
            padding: 15px;
            margin-top: 10px;
            border-radius: 4px;
            color: #c0392b;
        }
        
        .success-message {
            background: #f0fff4;
            border-left: 4px solid #27ae60;
            padding: 15px;
            margin-top: 10px;
            border-radius: 4px;
            color: #229954;
        }
        
        .icon {
            font-size: 24px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 13px;
        }
        
        table th {
            background: #ecf0f1;
            padding: 10px;
            text-align: left;
            font-weight: 600;
            color: #2c3e50;
        }
        
        table td {
            padding: 10px;
            border-bottom: 1px solid #ecf0f1;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            margin-top: 20px;
            transition: background 0.3s;
        }
        
        .btn:hover {
            background: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔌 Adatbázis Kapcsolat Teszt</h1>
        <p class="subtitle">Nethely.hu MySQL kapcsolat ellenőrzése</p>
        
        <?php
        $allTestsPassed = true;
        
        // ====================================
        // TEST 1: Kapcsolódás
        // ====================================
        echo '<div class="test-section">';
        echo '<h2><span class="icon">🔗</span> 1. Adatbázis Kapcsolat</h2>';
        
        try {
            $db = DatabaseConfig::getConnection();
            echo '<span class="status success">✓ Sikeres</span>';
            echo '<div class="success-message">';
            echo '<strong>Kapcsolódva a nethely.hu MySQL szerveréhez!</strong><br>';
            echo 'Host: <code>mysql.nethely.hu:3306</code><br>';
            echo 'Database: <code>mfe_db</code>';
            echo '</div>';
            
            // Szerver információk
            $version = $db->query('SELECT VERSION()')->fetchColumn();
            echo '<div class="info-box">';
            echo '<strong>MySQL verzió:</strong> ' . htmlspecialchars($version);
            echo '</div>';
            
        } catch (Exception $e) {
            $allTestsPassed = false;
            echo '<span class="status error">✗ Hiba</span>';
            echo '<div class="error-message">';
            echo '<strong>Kapcsolódási hiba!</strong><br>';
            echo htmlspecialchars($e->getMessage());
            echo '</div>';
        }
        echo '</div>';
        
        // ====================================
        // TEST 2: Tábla létezése
        // ====================================
        if (isset($db)) {
            echo '<div class="test-section">';
            echo '<h2><span class="icon">📋</span> 2. Tábla Ellenőrzés</h2>';
            
            try {
                $stmt = $db->query("SHOW TABLES LIKE 'tabor2026'");
                $tableExists = $stmt->rowCount() > 0;
                
                if ($tableExists) {
                    echo '<span class="status success">✓ Létezik</span>';
                    echo '<div class="success-message">';
                    echo '<strong>A <code>tabor2026</code> tábla megtalálható az adatbázisban!</strong>';
                    echo '</div>';
                    
                    // Tábla struktúra
                    $columns = $db->query("DESCRIBE tabor2026")->fetchAll();
                    echo '<div class="info-box">';
                    echo '<strong>Tábla struktúra:</strong>';
                    echo '<table>';
                    echo '<tr><th>Mező</th><th>Típus</th><th>Null</th><th>Kulcs</th></tr>';
                    foreach ($columns as $col) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($col['Field']) . '</td>';
                        echo '<td>' . htmlspecialchars($col['Type']) . '</td>';
                        echo '<td>' . htmlspecialchars($col['Null']) . '</td>';
                        echo '<td>' . htmlspecialchars($col['Key']) . '</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                    echo '</div>';
                    
                } else {
                    $allTestsPassed = false;
                    echo '<span class="status warning">⚠ Nem létezik</span>';
                    echo '<div class="error-message">';
                    echo '<strong>A <code>tabor2026</code> tábla még nem létezik!</strong><br>';
                    echo 'Futtasd le a tábla létrehozó SQL scriptet.';
                    echo '</div>';
                }
                
            } catch (Exception $e) {
                $allTestsPassed = false;
                echo '<span class="status error">✗ Hiba</span>';
                echo '<div class="error-message">' . htmlspecialchars($e->getMessage()) . '</div>';
            }
            echo '</div>';
            
            // ====================================
            // TEST 3: Írás/Olvasás teszt
            // ====================================
            if ($tableExists) {
                echo '<div class="test-section">';
                echo '<h2><span class="icon">✍️</span> 3. Írás/Olvasás Teszt</h2>';
                
                try {
                    // Teszt adat beszúrása
                    $testData = [
                        'firstname' => 'Teszt János',
                        'lakcim' => 'Budapest, Teszt utca 1.',
                        'phonenumber' => '+36301234567',
                        'parentsnumber' => '+36301234568',
                        'idnumber' => '123456789',
                        'birthdate' => '2010-05-15',
                        'agreement' => 1,
                        'email' => 'teszt@example.com'
                    ];
                    
                    $stmt = $db->prepare("
                        INSERT INTO tabor2026 
                        (firstname, lakcim, phonenumber, parentsnumber, idnumber, birthdate, agreement, email, created_at) 
                        VALUES 
                        (:firstname, :lakcim, :phonenumber, :parentsnumber, :idnumber, :birthdate, :agreement, :email, NOW())
                    ");
                    
                    $stmt->execute($testData);
                    $testId = $db->lastInsertId();
                    
                    // Visszaolvasás
                    $stmt = $db->prepare("SELECT * FROM tabor2026 WHERE id = :id");
                    $stmt->execute(['id' => $testId]);
                    $result = $stmt->fetch();
                    
                    if ($result) {
                        echo '<span class="status success">✓ Sikeres</span>';
                        echo '<div class="success-message">';
                        echo '<strong>Teszt adat sikeresen mentve és visszaolvasva!</strong><br>';
                        echo 'Beszúrt rekord ID: <code>' . $testId . '</code>';
                        echo '</div>';
                        
                        // Teszt adat törlése
                        $db->prepare("DELETE FROM tabor2026 WHERE id = :id")->execute(['id' => $testId]);
                        echo '<div class="info-box">';
                        echo '✓ Teszt adat törölve (cleanup)';
                        echo '</div>';
                    }
                    
                } catch (Exception $e) {
                    $allTestsPassed = false;
                    echo '<span class="status error">✗ Hiba</span>';
                    echo '<div class="error-message">' . htmlspecialchars($e->getMessage()) . '</div>';
                }
                echo '</div>';
                
                // ====================================
                // TEST 4: Statisztikák
                // ====================================
                echo '<div class="test-section">';
                echo '<h2><span class="icon">📊</span> 4. Adatbázis Statisztikák</h2>';
                
                try {
                    $stats = $db->query("
                        SELECT 
                            COUNT(*) as total,
                            COUNT(CASE WHEN email IS NOT NULL THEN 1 END) as with_email,
                            COUNT(CASE WHEN agreement = 1 THEN 1 END) as with_consent
                        FROM tabor2026
                    ")->fetch();
                    
                    echo '<div class="info-box">';
                    echo '<strong>Jelenlegi jelentkezések:</strong> ' . $stats['total'] . ' db<br>';
                    echo '<strong>Email címmel:</strong> ' . $stats['with_email'] . ' db<br>';
                    echo '<strong>Média hozzájárulással:</strong> ' . $stats['with_consent'] . ' db';
                    echo '</div>';
                    
                } catch (Exception $e) {
                    echo '<div class="error-message">' . htmlspecialchars($e->getMessage()) . '</div>';
                }
                echo '</div>';
            }
        }
        
        // ====================================
        // Összesítés
        // ====================================
        echo '<div class="test-section" style="border-color: ' . ($allTestsPassed ? '#27ae60' : '#e74c3c') . ';">';
        if ($allTestsPassed) {
            echo '<h2><span class="icon">🎉</span> Minden teszt sikeres!</h2>';
            echo '<p style="color: #27ae60; margin-top: 10px;">A localhost sikeresen kapcsolódik a nethely.hu adatbázishoz. Kezdheted a fejlesztést!</p>';
        } else {
            echo '<h2><span class="icon">⚠️</span> Vannak hibák</h2>';
            echo '<p style="color: #e74c3c; margin-top: 10px;">Javítsd a fenti hibákat a folytatás előtt.</p>';
        }
        echo '</div>';
        ?>

         <?php
        // ====================================
        // TEST ADAT BESZÚRÁS (manuális gomb)
        // ====================================
        if (isset($_POST['insert_test_data']) && isset($db)) {
            echo '<div class="test-section">';
            echo '<h2><span class="icon">🧪</span> Teszt Adat Beszúrása</h2>';
            
            try {
                $testData = [
                    'firstname' => 'Kovács János',
                    'lakcim' => 'Budapest, Teszt utca 42.',
                    'phonenumber' => '+36301234567',
                    'parentsnumber' => '+36309876543',
                    'idnumber' => '123456789',
                    'birthdate' => '2012-03-15',
                    'agreement' => 1,
                    'email' => 'kovacs.janos@example.com'
                ];
                
                $stmt = $db->prepare("
                    INSERT INTO tabor2026 
                    (firstname, lakcim, phonenumber, parentsnumber, idnumber, birthdate, agreement, email, created_at) 
                    VALUES 
                    (:firstname, :lakcim, :phonenumber, :parentsnumber, :idnumber, :birthdate, :agreement, :email, NOW())
                ");
                
                $stmt->execute($testData);
                $insertedId = $db->lastInsertId();
                
                echo '<span class="status success">✓ Beszúrva!</span>';
                echo '<div class="success-message">';
                echo '<strong>Teszt jelentkezés sikeresen beszúrva!</strong><br>';
                echo 'ID: <code>' . $insertedId . '</code><br>';
                echo 'Név: <strong>' . htmlspecialchars($testData['firstname']) . '</strong>';
                echo '</div>';
                
            } catch (Exception $e) {
                echo '<span class="status error">✗ Hiba</span>';
                echo '<div class="error-message">' . htmlspecialchars($e->getMessage()) . '</div>';
            }
            echo '</div>';
        }
        ?>
        
        <!-- Gomb a teszt adat beszúrásához -->
        <form method="POST" style="margin-top: 20px;">
            <button type="submit" name="insert_test_data" class="btn" style="background: #27ae60;">
                ➕ Teszt Jelentkezés Beszúrása
            </button>
        </form>
        
        <a href="index.php" class="btn">← Vissza a főoldalra</a>
    </div>
</body>
</html>