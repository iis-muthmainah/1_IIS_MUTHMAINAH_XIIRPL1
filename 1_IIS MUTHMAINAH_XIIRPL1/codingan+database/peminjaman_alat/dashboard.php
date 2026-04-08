<?php include 'assets/header.php'; ?>

<h3>Dashboard</h3>

<div class="row">

<?php if($_SESSION['role']=='admin'){ ?>

<?php
$user = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM user"));
$alat = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM alat"));
$kategori = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM kategori"));
?>

<div class="col-md-4">
<div class="card p-3 bg-primary text-white">
<h5>Total User</h5>
<h2><?= $user ?></h2>
</div>
</div>

<div class="col-md-4">
<div class="card p-3 bg-success text-white">
<h5>Total Alat</h5>
<h2><?= $alat ?></h2>
</div>
</div>

<div class="col-md-4">
<div class="card p-3 bg-warning text-white">
<h5>Kategori</h5>
<h2><?= $kategori ?></h2>
</div>
</div>

<?php } ?>


<?php if($_SESSION['role']=='petugas'){ ?>

<?php
$pinjam = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM peminjaman WHERE status='dipinjam'"));
$kembali = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM peminjaman WHERE status='selesai'"));
?>

<div class="col-md-6">
<div class="card p-3 bg-info text-white">
<h5>Sedang Dipinjam</h5>
<h2><?= $pinjam ?></h2>
</div>
</div>

<div class="col-md-6">
<div class="card p-3 bg-secondary text-white">
<h5>Sudah Kembali</h5>
<h2><?= $kembali ?></h2>
</div>
</div>

<?php } ?>


<?php if($_SESSION['role']=='peminjam'){ ?>

<?php
$saya = $_SESSION['id'];

$data = mysqli_num_rows(mysqli_query($conn,"
SELECT * FROM peminjaman WHERE id_user='$saya'
"));
?>

<div class="col-md-12">
<div class="card p-3 bg-success text-white">
<h5>Total Pinjaman Saya</h5>
<h2><?= $data ?></h2>
</div>
</div>

<?php } ?>

</div>

<?php include 'assets/footer.php'; ?>