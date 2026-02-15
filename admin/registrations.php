<?php
$db = DatabaseConfig::getConnection();
$stmt = $db->query("SELECT * FROM tabor2026 ORDER BY created_at DESC");
$registrations = $stmt->fetchAll();
?>

<div class="content-header">
    <h2>📋 Jelentkezések - Pásztortűz 2026</h2>
   <a href="../admin/export-pdf.php" class="btn-export" target="_blank">📥 PDF Export</a>
</div>

<?php if (empty($registrations)): ?>
    <p style="text-align: center; padding: 3rem; color: #999;">Még nincsenek jelentkezések.</p>
<?php else: ?>
    <div class="table-container">
        <table class="admin-table">
         <thead>
    <tr>
        <th>ID</th>
        <th>Név</th>
        <th>Lakcím</th>
        <th>Telefonszám</th>
        <th>Szülő tel.</th>
        <th>Email</th>
        <th>Születési dátum</th>
        <th>TAJ szám</th>
        <th>Hozzájárulás</th>
        <th>Jelentkezés dátuma</th>
    </tr>
</thead>
            <tbody>
                <?php foreach ($registrations as $reg): ?>
                <tr>
    <td><?php echo $reg['id']; ?></td>
    <td><?php echo htmlspecialchars($reg['firstname']); ?></td>
    <td><?php echo htmlspecialchars($reg['lakcim']); ?></td>
    <td><?php echo htmlspecialchars($reg['phonenumber'] ?? '-'); ?></td>
    <td><?php echo htmlspecialchars($reg['parentsnumber']); ?></td>
    <td><?php echo htmlspecialchars($reg['email'] ?? '-'); ?></td>
    <td><?php echo $reg['birthdate'] ?? '-'; ?></td>
    <td><?php echo htmlspecialchars($reg['idnumber'] ?? '-'); ?></td>
    <td><?php echo $reg['agreement'] ? '✅ Igen' : '❌ Nem'; ?></td>
    <td><?php echo date('Y-m-d H:i', strtotime($reg['created_at'])); ?></td>
</tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="stats-box">
        <strong>Összes jelentkező:</strong> <?php echo count($registrations); ?> fő
    </div>
<?php endif; ?>