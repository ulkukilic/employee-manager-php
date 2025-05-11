
<?php
session_start();
require_once 'classes/Employee.php';
$list = $_SESSION['employees'] ?? [];
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Çalışan Listesi</title>
</head>
<body>
<?php if (empty($list)): ?>
  <p>Kayıtlı çalışan yok.</p>
<?php else: ?>
  <ul>
    <?php foreach ($list as $emp): ?>
      <li><?= htmlspecialchars($emp->getInfo()) ?></li>
    <?php endforeach; ?>
  </ul>
  <?php
    $salaries = array_map(fn($e) => $e->salary, $list);
    $total = array_sum($salaries);
    $count = count($salaries);
    $avg   = $total / $count;
    $max   = max($salaries);
    $min   = min($salaries);
  ?>
  <p>Toplam Çalışan: <?= $count ?></p>
  <p>Ortalama Maaş: <?= number_format($avg,2) ?>₺</p>
  <p>En Yüksek Maaş: <?= number_format($max,2) ?>₺</p>
  <p>En Düşük Maaş: <?= number_format($min,2) ?>₺</p>
  <?php $now = new DateTime('now', new DateTimeZone('Europe/Istanbul')); ?>
  <p>Son güncelleme: <?= $now->format('Y-m-d H:i:s') ?></p>
<?php endif; ?>
</body>
</html>