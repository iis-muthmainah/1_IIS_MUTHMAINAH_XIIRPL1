<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/peminjaman_alat/koneksi.php';

if(!isset($_SESSION['id'])){
    header("location:/peminjaman_alat/login.php");
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/peminjaman_alat/assets/style.css">

<div class="sidebar">
    <h4>MENU</h4>

    <?php if($_SESSION['role']=='admin'){ ?>
        <a href="/peminjaman_alat/dashboard.php">Dashboard</a>
        <a href="/peminjaman_alat/admin/user.php">User</a>
        <a href="/peminjaman_alat/admin/kategori.php">Kategori</a>
        <a href="/peminjaman_alat/admin/alat.php">Alat</a>
        <a href="/peminjaman_alat/admin/log.php">Log</a>
    <?php } ?>

    <?php if($_SESSION['role']=='petugas'){ ?>
        <a href="/peminjaman_alat/dashboard.php">Dashboard</a>
        <a href="/peminjaman_alat/petugas/peminjaman.php">ACC Peminjaman</a>
        <a href="/peminjaman_alat/petugas/pengembalian.php">Pengembalian</a>
        <a href="/peminjaman_alat/petugas/laporan.php">Laporan</a>
    <?php } ?>

    <?php if($_SESSION['role']=='peminjam'){ ?>
        <a href="/peminjaman_alat/dashboard.php">Dashboard</a>
        <a href="/peminjaman_alat/user/alat.php">Lihat Alat</a>
        <a href="/peminjaman_alat/user/pinjam.php">Pinjam</a>
        <a href="/peminjaman_alat/user/kembali.php">Pengembalian</a>
    <?php } ?>

    <a href="/peminjaman_alat/logout.php">Logout</a>
</div>

<div class="content">