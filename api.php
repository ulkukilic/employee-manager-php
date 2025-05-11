
<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
require_once 'classes/Employee.php';
$list = $_SESSION['employees'] ?? [];
$out = [];
foreach ($list as $e) {
    $out[] = [
        'name'   => $e->name,
        'email'  => $e->email,
        'salary' => $e->salary,
        'hired'  => $e->hiredDate->format(DateTime::ATOM)
    ];
}
echo json_encode(['employees' => $out], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>