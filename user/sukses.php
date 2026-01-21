<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'user') {
    header("Location: ../auth/login.php");
    exit;
}
?>
<div style="text-align:center; margin-top:50px;">
    <h2>✅ Pesanan Berhasil!</h2>
    <p>Terima kasih, pesanan kamu sudah diterima dan sedang diproses.</p>
    <a href="index.php" style="padding:10px 20px; background:#28a745; color:#fff; border-radius:8px; text-decoration:none;">Kembali ke Menu</a>
</div>
