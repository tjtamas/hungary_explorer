<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: ../index.php');
    exit;
}

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../vendor/autoload.php';

// Adatok lekérése
$db = DatabaseConfig::getConnection();
$stmt = $db->query("SELECT * FROM tabor2026 ORDER BY created_at DESC");
$registrations = $stmt->fetchAll();

// PDF létrehozása
$pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8');

$pdf->SetCreator('Magyarország Felfedezői Szövetség');
$pdf->SetAuthor('Admin');
$pdf->SetTitle('Tábori jelentkezések - ' . date('Y-m-d'));

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(true, 10);
$pdf->AddPage();

// Cím
$pdf->SetFont('dejavusans', 'B', 16);
$pdf->Cell(0, 10, 'Pásztortűz Tábor 2026 - Jelentkezések', 0, 1, 'C');
$pdf->Ln(3);

// Dátum
$pdf->SetFont('dejavusans', '', 10);
$pdf->Cell(0, 6, 'Exportálva: ' . date('Y-m-d H:i'), 0, 1, 'C');
$pdf->Cell(0, 6, 'Összes jelentkező: ' . count($registrations) . ' fő', 0, 1, 'C');
$pdf->Ln(5);

// Táblázat - Fix cellaszélességek mm-ben
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->SetFillColor(196, 30, 58);
$pdf->SetTextColor(255, 255, 255);

// Fejléc
$pdf->Cell(10, 7, 'ID', 1, 0, 'C', true);
$pdf->Cell(35, 7, 'Név', 1, 0, 'C', true);
$pdf->Cell(50, 7, 'Lakcím', 1, 0, 'C', true);
$pdf->Cell(25, 7, 'Telefon', 1, 0, 'C', true);
$pdf->Cell(25, 7, 'Szülő tel.', 1, 0, 'C', true);
$pdf->Cell(40, 7, 'Email', 1, 0, 'C', true);
$pdf->Cell(22, 7, 'Szül. dátum', 1, 0, 'C', true);
$pdf->Cell(25, 7, 'TAJ', 1, 0, 'C', true);
$pdf->Cell(35, 7, 'Jelentkezés', 1, 1, 'C', true);

// Adatok
$pdf->SetFont('dejavusans', '', 7);
$pdf->SetTextColor(0, 0, 0);

foreach ($registrations as $reg) {
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

// PDF letöltés
$pdf->Output('tabor_jelentkezesek_' . date('Y-m-d') . '.pdf', 'D');