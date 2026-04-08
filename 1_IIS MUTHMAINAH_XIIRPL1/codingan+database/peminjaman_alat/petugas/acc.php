<?php include '../assets/header.php'; include '../koneksi.php'; ?>

<h3>ACC Peminjaman</h3>

<table class="table">
<tr><th>User</th><th>Status</th><th>Aksi</th></tr>

<?php 
$data=mysqli_query($conn,"
SELECT peminjaman.*, user.nama 
FROM peminjaman 
JOIN user ON peminjaman.id_user=user.id_user
WHERE status='dipinjam'
");

while($d=mysqli_fetch_assoc($data)){
?>
<tr>
<td><?= $d['nama'] ?></td>
<td><?= $d['status'] ?></td>
<td><button class="btn btn-success btn-sm">ACC</button></td>
</tr>
<?php } ?>
</table>

<?php include '../assets/footer.php'; ?>