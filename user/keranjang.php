<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'user') {
    header("Location: ../auth/login.php");
    exit;
}

$total = 0;
?>

<link rel="stylesheet" href="../assets/user.css">
<div class="keranjang-container">
    <h2>Keranjang Pesanan</h2>

    <?php if (!isset($_SESSION['keranjang']) || empty($_SESSION['keranjang'])): ?>
        <p style="text-align:center;">Keranjang masih kosong.</p>
        <div class="keranjang-buttons">
            <a href="index.php" class="btn-kembali">⬅ Kembali ke Menu</a>
        </div>
    <?php else: ?>
        <table>
            <tr>
                <th>Menu</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>

            <?php
            foreach ($_SESSION['keranjang'] as $id_menu => $qty) {
                $menu = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM menu WHERE id='$id_menu'"));
                $subtotal = $menu['harga'] * $qty;
                $total += $subtotal;
            ?>
            <tr>
                <td><?= $menu['nama_menu'] ?></td>
                <td>Rp <?= number_format($menu['harga']) ?></td>
                <td><?= $qty ?></td>
                <td>Rp <?= number_format($subtotal) ?></td>
            </tr>
            <?php } ?>

            <tr>
                <td colspan="3"><b>Total</b></td>
                <td><b>Rp <?= number_format($total) ?></b></td>
            </tr>
        </table>

        <div class="keranjang-buttons">
            <a href="index.php" class="btn-kembali">⬅ Kembali ke Menu</a>
            <a href="checkout.php" class="btn-checkout">Checkout ✅</a>
        </div>
    <?php endif; ?>
</div>
