<?php include '../assets/header.php'; ?>

<?php
// ACC
if(isset($_GET['acc'])){
    $id = $_GET['id'];

    mysqli_query($conn,"UPDATE peminjaman SET status='dipinjam' WHERE id_peminjaman='$id'");

    // ambil detail
    $d = mysqli_fetch_assoc(mysqli_query($conn,"
    SELECT * FROM detail_peminjaman WHERE id_peminjaman='$id'
    "));

    // kurangi stok
    mysqli_query($conn,"
    UPDATE alat SET stok = stok - $d[jumlah]
    WHERE id_alat='$d[id_alat]'
    ");

    // LOG
    mysqli_query($conn,"
    INSERT INTO log_aktivitas (id_user,aktivitas)
    VALUES ('".$_SESSION['id']."','ACC peminjaman')
    ");
}
?>

<h3>ACC Peminjaman</h3>

<table class="table table-bordered">
<tr>
<th>No</th><th>User</th><th>Tanggal</th><th>Status</th><th>Aksi</th>
</tr>

<?php
$no=1;
$data = mysqli_query($conn,"
SELECT peminjaman.*, user.nama 
FROM peminjaman 
JOIN user ON peminjaman.id_user=user.id_user
WHERE status='menunggu'
");

while($d=mysqli_fetch_assoc($data)){
?>

<tr>
<td><?= $no++ ?></td>
<td><?= $d['nama'] ?></td>
<td><?= $d['tanggal_pinjam'] ?></td>
<td><?= $d['status'] ?></td>
<td>
<a href="?acc&id=<?= $d['id_peminjaman'] ?>" class="btn btn-success btn-sm">ACC</a>
</td>
</tr>

<?php } ?>
</table>

<?php include '../assets/footer.php'; ?>