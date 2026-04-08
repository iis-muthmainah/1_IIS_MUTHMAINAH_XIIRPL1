<?php include '../assets/header.php'; include '../koneksi.php';

$data=mysqli_query($conn,"
SELECT * FROM peminjaman 
WHERE id_user='".$_SESSION['id']."' AND status='dipinjam'
");

if(isset($_GET['k'])){
mysqli_query($conn,"UPDATE peminjaman SET status='selesai' WHERE id_peminjaman=$_GET[k]");
}
?>

<h3>Pengembalian</h3>

<table class="table">
<?php while($d=mysqli_fetch_assoc($data)){ ?>
<tr>
<td><?= $d['id_peminjaman'] ?></td>
<td>
<a href="?k=<?= $d['id_peminjaman'] ?>" class="btn btn-danger">Kembalikan</a>
</td>
</tr>
<?php } ?>
</table>

<?php include '../assets/footer.php'; ?>