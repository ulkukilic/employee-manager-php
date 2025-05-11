<?php
session_start();
require_once 'classes/Employee.php';

// 1) Form verilerini al ve sanitize et
$nameRaw      = $_POST['name'] ?? '';
$emailRaw     = $_POST['email'] ?? '';
$salaryRaw    = $_POST['salary'] ?? '0';
$hiredRaw     = $_POST['hired_date'] ?? '';

$name    = trim($nameRaw);
$email   = trim($emailRaw);
$salary  = (float) $salaryRaw;

$errors = [];
if ($name === '') {
    $errors[] = 'İsim boş olamaz.';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Geçerli bir e-posta girin.';
}
if ($salary <= 0) {
    $errors[] = 'Maaş sıfırdan büyük olmalı.';
}

try {
    $hiredDate = new DateTime($hiredRaw);
} catch (Exception $e) {
    $errors[] = 'Tarih formatı hatalı.';
}

// 2) Hata varsa geri dön
if (!empty($errors)) {
    foreach ($errors as $err) {
        echo "<p style='color:red;'>$err</p>";
    }
    echo "<p><a href='index.html'>Geri dön</a></p>";
    exit;
}

// 3) Yeni Employee nesnesini ekle ve yönlendir
$_SESSION['employees'][] = new Employee($name, $email, $salary, $hiredDate);
header('Location: employees.php');
exit;
process.php