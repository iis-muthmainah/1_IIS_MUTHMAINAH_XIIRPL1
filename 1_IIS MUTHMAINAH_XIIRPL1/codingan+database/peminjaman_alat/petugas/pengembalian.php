<?php include '../assets/header.php'; ?>

<?php
// PROSES KEMBALIKAN
if(isset($_GET['kembali'])){
    $id = $_GET['id'];

    // ambil data peminjaman
    $pinjam = mysqli_fetch_assoc(mysqli_query($conn,"
    SELECT * FROM peminjaman WHERE id_peminjaman='$id'
    "));

    $tgl_kembali = $pinjam['tanggal_kembali'];
    $hari_ini = date('Y-m-d');

    // HITUNG DENDA (misal 1000/hari telat)
    $denda = 0;
    if($hari_ini > $tgl_kembali){
        $telat = (strtotime($hari_ini) - strtotime($tgl_kembali)) / (60*60*24);
        $denda = $telat * 1000;
    }

    // simpan ke tabel pengembalian
    mysqli_query($conn,"
    INSERT INTO pengembalian (id_peminjaman,tanggal_dikembalikan,denda)
    VALUES ('$id','$hari_ini','$denda')
    ");

    // update status
    mysqli_query($conn,"
    UPDATE peminjaman SET status='selesai'
    WHERE id_peminjaman='$id'
    ");

    // ambil detail alat
    $detail = mysqli_fetch_assoc(mysqli_query($conn,"
    SELECT * FROM detail_peminjaman WHERE id_peminjaman='$id'
    "));

    // kembalikan stok
    mysqli_query($conn,"
    UPDATE alat SET stok = stok + $detail[jumlah]
    WHERE id_alat='$detail[id_alat]'
    ");

    // LOG
    mysqli_query($conn,"
    INSERT INTO log_aktivitas (id_user,aktivitas)
    VALUES ('".$_SESSION['id']."','Menerima pengembalian')
    ");

    echo "<div class='alert alert-success'>
Alat berhasil dikembalikan! Denda: Rp ".number_format($denda)."
</div>";
}
?>

<h3>Pengembalian</h3>

<table class="table table-bordered">
<tr>
<th>No</th><th>User</th><th>Tanggal Pinjam</th><th>Kembali</th><th>Status</th><th>Aksi</th>
</tr>

<?php
$no=1;
$data = mysqli_query($conn,"
SELECT peminjaman.*, user.nama 
FROM peminjaman 
JOIN user ON peminjaman.id_user=user.id_user
WHERE status='dipinjam'
");

while($d=mysqli_fetch_assoc($data)){
?>

<tr>
<td><?= $no++ ?></td>
<td><?= $d['nama'] ?></td>
<td><?= $d['tanggal_pinjam'] ?></td>
<td><?= $d['tanggal_kembali'] ?></td>
<td><?= $d['status'] ?></td>
<td>
<a href="?kembali&id=<?= $d['id_peminjaman'] ?>" 
class="btn btn-primary btn-sm"
onclick="return confirm('Yakin mau kembalikan alat ini?')">
Kembalikan
</a>
</td>
</tr>

<?php } ?>
</table>

<?php include '../assets/footer.php'; ?>