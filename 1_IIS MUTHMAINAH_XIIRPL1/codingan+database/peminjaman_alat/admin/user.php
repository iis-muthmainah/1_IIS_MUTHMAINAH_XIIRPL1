<?php include '../assets/header.php'; ?>

<?php
// TAMBAH & EDIT
if(isset($_POST['simpan'])){
    if($_POST['id']==""){
        mysqli_query($conn,"INSERT INTO user VALUES(NULL,'$_POST[nama]','$_POST[username]',md5('$_POST[password]'),'$_POST[role]')");
    } else {
        mysqli_query($conn,"UPDATE user SET 
        nama='$_POST[nama]',
        username='$_POST[username]',
        role='$_POST[role]'
        WHERE id_user='$_POST[id]'");
    }
}

// HAPUS
if(isset($_GET['hapus'])){
    mysqli_query($conn,"DELETE FROM user WHERE id_user='$_GET[id]'");
}

// EDIT AMBIL DATA
$edit = null;
if(isset($_GET['edit'])){
    $edit = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM user WHERE id_user='$_GET[id]'"));
}
?>

<h3>Kelola User</h3>

<form method="post" class="card p-3 mb-3">
<input type="hidden" name="id" value="<?= $edit['id_user'] ?? '' ?>">

<input name="nama" class="form-control mb-2" placeholder="Nama" value="<?= $edit['nama'] ?? '' ?>">
<input name="username" class="form-control mb-2" placeholder="Username" value="<?= $edit['username'] ?? '' ?>">

<?php if(!$edit){ ?>
<input name="password" class="form-control mb-2" placeholder="Password">
<?php } ?>

<select name="role" class="form-control mb-2">
<option>admin</option>
<option>petugas</option>
<option>peminjam</option>
</select>

<button name="simpan" class="btn btn-primary">Simpan</button>
</form>

<table class="table table-bordered">
<tr>
<th>No</th><th>Nama</th><th>Username</th><th>Role</th><th>Aksi</th>
</tr>

<?php
$no=1;
$data = mysqli_query($conn,"SELECT * FROM user");
while($d=mysqli_fetch_assoc($data)){
?>

<tr>
<td><?= $no++ ?></td>
<td><?= $d['nama'] ?></td>
<td><?= $d['username'] ?></td>
<td><?= $d['role'] ?></td>
<td>
<a href="?edit&id=<?= $d['id_user'] ?>" class="btn btn-warning btn-sm">Edit</a>
<a href="?hapus&id=<?= $d['id_user'] ?>" class="btn btn-danger btn-sm">Hapus</a>
</td>
</tr>

<?php } ?>
</table>

<?php include '../assets/footer.php'; ?>