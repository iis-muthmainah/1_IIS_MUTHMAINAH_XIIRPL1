<?php include '../assets/header.php'; ?>

<h3>Daftar Alat</h3>

<table class="table table-bordered">
<tr>
<th>No</th><th>Nama</th><th>Kategori</th><th>Stok</th><th>Aksi</th>
</tr>

<?php
$no=1;
$data = mysqli_query($conn,"SELECT alat.*, kategori.nama_kategori 
FROM alat JOIN kategori ON alat.id_kategori=kategori.id_kategori");

while($d=mysqli_fetch_assoc($data)){
?>

<tr>
<td><?= $no++ ?></td>
<td><?= $d['nama_alat'] ?></td>
<td><?= $d['nama_kategori'] ?></td>
<td><?= $d['stok'] ?></td>
<td>
<a href="pinjam.php?id=<?= $d['id_alat'] ?>" class="btn btn-primary btn-sm">Pinjam</a>
</td>
</tr>

<?php } ?>
</table>

<?php include '../assets/footer.php'; ?>