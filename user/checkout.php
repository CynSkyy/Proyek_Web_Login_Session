<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'user') {
    header("Location: ../auth/login.php");
    exit;
}

if (!isset($_SESSION['keranjang']) || empty($_SESSION['keranjang'])) {
    header("Location: keranjang.php");
    exit;
}

$id_user = $_SESSION['user_id'];
mysqli_query($conn, "INSERT INTO pesanan (id_user, tanggal) VALUES ('$id_user', CURDATE())");
$id_pesanan = mysqli_insert_id($conn);

foreach ($_SESSION['keranjang'] as $id_menu => $qty) {
    mysqli_query($conn, "
        INSERT INTO detail_pesanan (id_pesanan, id_menu, qty)
        VALUES ('$id_pesanan', '$id_menu', '$qty')
    ");
}

unset($_SESSION['keranjang']);

header("Location: sukses.php");
exit;
