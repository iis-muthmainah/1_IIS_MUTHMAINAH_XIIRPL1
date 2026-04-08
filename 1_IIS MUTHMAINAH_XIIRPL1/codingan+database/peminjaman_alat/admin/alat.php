<?php include '../assets/header.php'; ?>

<?php
if(isset($_POST['simpan'])){
    if($_POST['id']==""){
        mysqli_query($conn,"INSERT INTO alat VALUES(NULL,'$_POST[nama]','$_POST[kategori]','$_POST[stok]','$_POST[kondisi]','tersedia')");
    } else {
        mysqli_query($conn,"UPDATE alat SET 
        nama_alat='$_POST[nama]',
        id_kategori='$_POST[kategori]',
        stok='$_POST[stok]',
        kondisi='$_POST[kondisi]'
        WHERE id_alat='$_POST[id]'");
    }
}

if(isset($_GET['hapus'])){
    mysqli_query($conn,"DELETE FROM alat WHERE id_alat='$_GET[id]'");
}

$edit = null;
if(isset($_GET['edit'])){
    $edit = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM alat WHERE id_alat='$_GET[id]'"));
}
?>

<h3>Kelola Alat</h3>

<form method="post" class="card p-3 mb-3">
<input type="hidden" name="id" value="<?= $edit['id_alat'] ?? '' ?>">

<input name="nama" class="form-control mb-2" placeholder="Nama Alat" value="<?= $edit['nama_alat'] ?? '' ?>">

<select name="kategori" class="form-control mb-2">
<?php
$kat = mysqli_query($conn,"SELECT * FROM kategori");
while($k=mysqli_fetch_assoc($kat)){
?>
<option value="<?= $k['id_kategori'] ?>"><?= $k['nama_kategori'] ?></option>
<?php } ?>
</select>

<input name="stok" class="form-control mb-2" placeholder="Stok" value="<?= $edit['stok'] ?? '' ?>">

<select name="kondisi" class="form-control mb-2">
<option>baik</option>
<option>rusak</option>
</select>

<button name="simpan" class="btn btn-success">Simpan</button>
</form>

<table class="table table-bordered">
<tr>
<th>No</th><th>Nama</th><th>Kategori</th><th>Stok</th><th>Kondisi</th><th>Aksi</th>
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
<td><?= $d['kondisi'] ?></td>
<td>
<a href="?edit&id=<?= $d['id_alat'] ?>" class="btn btn-warning btn-sm">Edit</a>
<a href="?hapus&id=<?= $d['id_alat'] ?>" class="btn btn-danger btn-sm">Hapus</a>
</td>
</tr>

<?php } ?>
</table>

<?php include '../assets/footer.php'; ?>