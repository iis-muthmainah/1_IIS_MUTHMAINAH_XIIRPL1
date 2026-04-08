<div class="sidebar">
<h3>Menu</h3>

<a href="dashboard.php">Dashboard</a>

<?php if($_SESSION['role']=='admin'){ ?>
<a href="user.php">Kelola User</a>
<?php } ?>

<?php if($_SESSION['role']=='peminjam'){ ?>
<a href="pinjam.php">Peminjaman</a>
<?php } ?>

<?php if($_SESSION['role']=='petugas'){ ?>
<a href="kembali.php">Pengembalian</a>
<?php } ?>

<a href="logout.php">Logout</a>
</div>