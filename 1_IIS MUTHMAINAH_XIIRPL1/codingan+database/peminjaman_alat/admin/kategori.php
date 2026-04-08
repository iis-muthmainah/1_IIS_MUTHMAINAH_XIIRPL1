<?php include '../assets/header.php'; ?>

<?php
if(isset($_POST['simpan'])){
    if($_POST['id']==""){
        mysqli_query($conn,"INSERT INTO kategori VALUES(NULL,'$_POST[nama]','$_POST[deskripsi]')");
    } else {
        mysqli_query($conn,"UPDATE kategori SET 
        nama_kategori='$_POST[nama]',
        deskripsi='$_POST[deskripsi]'
        WHERE id_kategori='$_POST[id]'");
    }
}

if(isset($_GET['hapus'])){
    mysqli_query($conn,"DELETE FROM kategori WHERE id_kategori='$_GET[id]'");
}

$edit = null;
if(isset($_GET['edit'])){
    $edit = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM kategori WHERE id_kategori='$_GET[id]'"));
}
?>

<h3>Kelola Kategori</h3>

<form method="post" class="card p-3 mb-3">
<input type="hidden" name="id" value="<?= $edit['id_kategori'] ?? '' ?>">

<input name="nama" class="form-control mb-2" placeholder="Nama Kategori" value="<?= $edit['nama_kategori'] ?? '' ?>">
<input name="deskripsi" class="form-control mb-2" placeholder="Deskripsi" value="<?= $edit['deskripsi'] ?? '' ?>">

<button name="simpan" class="btn btn-success">Simpan</button>
</form>

<table class="table table-bordered">
<tr>
<th>No</th><th>Nama</th><th>Deskripsi</th><th>Aksi</th>
</tr>

<?php
$no=1;
$data = mysqli_query($conn,"SELECT * FROM kategori");
while($d=mysqli_fetch_assoc($data)){
?>

<tr>
<td><?= $no++ ?></td>
<td><?= $d['nama_kategori'] ?></td>
<td><?= $d['deskripsi'] ?></td>
<td>
<a href="?edit&id=<?= $d['id_kategori'] ?>" class="btn btn-warning btn-sm">Edit</a>
<a href="?hapus&id=<?= $d['id_kategori'] ?>" class="btn btn-danger btn-sm">Hapus</a>
</td>
</tr>

<?php } ?>
</table>

<?php include '../assets/footer.php'; ?>