<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/database.php';
require_once __DIR__ . '/../vendor/autoload.php';

// Adatok lekérése
$db = DatabaseConfig::getConnection();

// Összes jelentkező
$stmtAll = $db->query("SELECT * FROM tabor2026 ORDER BY created_at DESC");
$allRegistrations = $stmtAll->fetchAll();

// Heti új jelentkezők (utolsó 7 nap)
$stmtWeek = $db->query("SELECT * FROM tabor2026 WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY) ORDER BY created_at DESC");
$weeklyRegistrations = $stmtWeek->fetchAll();

// ============================================
// 1. PDF GENERÁLÁS
// ============================================

$pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8');
$pdf->SetCreator('Magyarország Felfedezői Szövetség');
$pdf->SetAuthor('Admin Rendszer');
$pdf->SetTitle('Heti jelentkezések - ' . date('Y-m-d'));

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(true, 10);
$pdf->AddPage();

// Cím
$pdf->SetFont('dejavusans', 'B', 16);
$pdf->Cell(0, 10, 'Pásztortűz Tábor 2026 - Heti Jelentés', 0, 1, 'C');
$pdf->Ln(3);

// Összesítő
$pdf->SetFont('dejavusans', '', 10);
$pdf->Cell(0, 6, 'Jelentés dátuma: ' . date('Y-m-d H:i'), 0, 1, 'C');
$pdf->Cell(0, 6, 'Heti új jelentkezők: ' . count($weeklyRegistrations) . ' fő', 0, 1, 'C');
$pdf->Cell(0, 6, 'Összes jelentkező: ' . count($allRegistrations) . ' fő', 0, 1, 'C');
$pdf->Ln(5);

// Táblázat fejléc
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->SetFillColor(196, 30, 58);
$pdf->SetTextColor(255, 255, 255);

$pdf->Cell(10, 7, 'ID', 1, 0, 'C', true);
$pdf->Cell(35, 7, 'Név', 1, 0, 'C', true);
$pdf->Cell(50, 7, 'Lakcím', 1, 0, 'C', true);
$pdf->Cell(25, 7, 'Telefon', 1, 0, 'C', true);
$pdf->Cell(25, 7, 'Szülő tel.', 1, 0, 'C', true);
$pdf->Cell(40, 7, 'Email', 1, 0, 'C', true);
$pdf->Cell(22, 7, 'Szül. dátum', 1, 0, 'C', true);
$pdf->Cell(25, 7, 'TAJ', 1, 0, 'C', true);
$pdf->Cell(35, 7, 'Jelentkezés', 1, 1, 'C', true);

// Adatok - ÖSSZES jelentkező
$pdf->SetFont('dejavusans', '', 7);
$pdf->SetTextColor(0, 0, 0);

foreach ($allRegistrations as $reg) {
    $pdf->Cell(10, 6, $reg['id'], 1, 0, 'C');
    $pdf->Cell(35, 6, substr($reg['firstname'], 0, 25), 1, 0, 'L');
    $pdf->Cell(50, 6, substr($reg['lakcim'], 0, 35), 1, 0, 'L');
    $pdf->Cell(25, 6, $reg['phonenumber'] ?? '-', 1, 0, 'L');
    $pdf->Cell(25, 6, $reg['parentsnumber'], 1, 0, 'L');
    $pdf->Cell(40, 6, substr($reg['email'] ?? '-', 0, 28), 1, 0, 'L');
    $pdf->Cell(22, 6, $reg['birthdate'] ?? '-', 1, 0, 'C');
    $pdf->Cell(25, 6, $reg['idnumber'] ?? '-', 1, 0, 'L');
    $pdf->Cell(35, 6, date('Y-m-d H:i', strtotime($reg['created_at'])), 1, 1, 'C');
}

// PDF mentése fájlba
$pdfFileName = __DIR__ . '/../temp/heti_jelentes_' . date('Y-m-d') . '.pdf';
if (!is_dir(__DIR__ . '/../temp')) {
    mkdir(__DIR__ . '/../temp', 0755, true);
}
$pdf->Output($pdfFileName, 'F');

// ============================================
// 2. EMAIL KÜLDÉS
// ============================================

$to = 'morvai.richard@gmail.com';
$subject = 'Heti Tábori Jelentés - ' . date('Y.m.d');

$message = "
Üdvözlöm!

Mellékletben megtalálja a Pásztortűz Tábor 2026 heti jelentését.

HETI ÖSSZESÍTŐ (utolsó 7 nap):
- Új jelentkezők: " . count($weeklyRegistrations) . " fő
- Összes jelentkező eddig: " . count($allRegistrations) . " fő

";

if (count($weeklyRegistrations) > 0) {
    $message .= "ÚJ JELENTKEZŐKEZEN A HÉTEN:\n";
    foreach ($weeklyRegistrations as $new) {
        $message .= "- " . $new['firstname'] . " (" . date('Y-m-d', strtotime($new['created_at'])) . ")\n";
    }
}

$message .= "

Részletek a mellékelt PDF-ben.

Üdvözlettel,
Automatikus Rendszer
";

// Email headers + PDF csatolmány
$boundary = md5(time());

$headers = "From: info@magyarorszagfelfedezoi.hu\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: multipart/mixed; boundary=\"{$boundary}\"\r\n";

$emailBody = "--{$boundary}\r\n";
$emailBody .= "Content-Type: text/plain; charset=UTF-8\r\n";
$emailBody .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
$emailBody .= $message . "\r\n";

// PDF csatolmány
$pdfContent = chunk_split(base64_encode(file_get_contents($pdfFileName)));
$emailBody .= "--{$boundary}\r\n";
$emailBody .= "Content-Type: application/pdf; name=\"heti_jelentes_" . date('Y-m-d') . ".pdf\"\r\n";
$emailBody .= "Content-Transfer-Encoding: base64\r\n";
$emailBody .= "Content-Disposition: attachment; filename=\"heti_jelentes_" . date('Y-m-d') . ".pdf\"\r\n\r\n";
$emailBody .= $pdfContent . "\r\n";
$emailBody .= "--{$boundary}--";

// Email küldés
$mailSent = mail($to, $subject, $emailBody, $headers);

// Temp fájl törlése
if (file_exists($pdfFileName)) {
    unlink($pdfFileName);
}

// ============================================
// DEBUG kimenet
// ============================================
echo "<!DOCTYPE html><html><head><meta charset='UTF-8'></head><body>";
echo "<h2>✅ Script lefutott</h2>";
echo "<p><strong>PDF generálva:</strong> " . (file_exists($pdfFileName) ? "Igen" : "Törlődött") . "</p>";
echo "<p><strong>Email küldés:</strong> " . ($mailSent ? "✅ Sikeres" : "❌ Sikertelen") . "</p>";
echo "<p><strong>Címzett:</strong> $to</p>";
echo "<p><strong>Tárgy:</strong> $subject</p>";
echo "<p><strong>Összes jelentkező:</strong> " . count($allRegistrations) . " fő</p>";
echo "<p><strong>Heti új:</strong> " . count($weeklyRegistrations) . " fő</p>";

if (!$mailSent) {
    echo "<p style='color:red;'><strong>⚠️ Az email NEM ment el!</strong></p>";
    echo "<p>Lehetséges okok: SMTP konfiguráció, spam szűrő, szerver beállítás</p>";
}

echo "</body></html>";

// Log
error_log('Heti email próbálkozás: ' . date('Y-m-d H:i:s') . ' - Siker: ' . ($mailSent ? 'IGEN' : 'NEM'));


https://magyarorszagfelfedezoi.hu/config/send-weekly-report.php
?>