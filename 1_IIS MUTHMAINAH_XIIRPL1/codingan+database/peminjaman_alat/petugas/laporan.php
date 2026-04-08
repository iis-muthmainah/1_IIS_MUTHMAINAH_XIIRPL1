<?php include '../assets/header.php'; ?>

<h3>Laporan Peminjaman</h3>

<a href="cetak.php" target="_blank" class="btn btn-success mb-3">Cetak Laporan</a>

<table class="table table-bordered">
<tr>
<th>No</th><th>User</th><th>Alat</th><th>Pinjam</th><th>Kembali</th><th>Status</th>
</tr>

<?php
$no=1;
$data = mysqli_query($conn,"
SELECT p.*, u.nama, a.nama_alat
FROM peminjaman p
JOIN user u ON p.id_user=u.id_user
JOIN detail_peminjaman d ON p.id_peminjaman=d.id_peminjaman
JOIN alat a ON d.id_alat=a.id_alat
");

while($d=mysqli_fetch_assoc($data)){
?>

<tr>
<td><?= $no++ ?></td>
<td><?= $d['nama'] ?></td>
<td><?= $d['nama_alat'] ?></td>
<td><?= $d['tanggal_pinjam'] ?></td>
<td><?= $d['tanggal_kembali'] ?></td>
<td><?= $d['status'] ?></td>
</tr>

<?php } ?>
</table>

<?php include '../assets/footer.php'; ?>