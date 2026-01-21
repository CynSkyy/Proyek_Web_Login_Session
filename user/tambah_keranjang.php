<?php
session_start();

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id_menu = $_GET['id'];

if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

if (isset($_SESSION['keranjang'][$id_menu])) {
    $_SESSION['keranjang'][$id_menu] += 1;
} else {
    $_SESSION['keranjang'][$id_menu] = 1;
}

header("Location: index.php");
exit;
