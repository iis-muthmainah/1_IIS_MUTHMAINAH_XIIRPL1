<?php include '../assets/header.php'; ?>

<?php
if(isset($_POST['pinjam'])){

    $id_alat = $_POST['alat'];

    // ambil data alat
    $alat = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM alat WHERE id_alat='$id_alat'"));

    if($_POST['j'] > $alat['stok']){
        echo "<div class='alert alert-danger'>Stok tidak cukup!</div>";
    } else {

        mysqli_query($conn,"
        INSERT INTO peminjaman (id_user,tanggal_pinjam,tanggal_kembali,status)
        VALUES ('".$_SESSION['id']."','$_POST[t1]','$_POST[t2]','menunggu')
        ");

        $id = mysqli_insert_id($conn);

        mysqli_query($conn,"
        INSERT INTO detail_peminjaman (id_peminjaman,id_alat,jumlah)
        VALUES ('$id','$id_alat','$_POST[j]')
        ");

        // LOG
        mysqli_query($conn,"
        INSERT INTO log_aktivitas (id_user,aktivitas)
        VALUES ('".$_SESSION['id']."','Mengajukan peminjaman')
        ");

        echo "<div class='alert alert-success'>Berhasil ajukan pinjam!</div>";
    }
}
?>

<h3>Form Pinjam</h3>

<form method="post" class="card p-3">

<select name="alat" class="form-control mb-2" required>
<option value="">-- Pilih Alat --</option>
<?php
$data = mysqli_query($conn,"SELECT * FROM alat WHERE stok > 0");
while($d=mysqli_fetch_assoc($data)){
?>
<option value="<?= $d['id_alat'] ?>">
<?= $d['nama_alat'] ?> (Stok: <?= $d['stok'] ?>)
</option>
<?php } ?>
</select>

<input type="date" name="t1" class="form-control mb-2" required>
<input type="date" name="t2" class="form-control mb-2" required>
<input type="number" name="j" class="form-control mb-2" placeholder="Jumlah" required>

<button name="pinjam" class="btn btn-primary">Pinjam</button>
</form>

<?php include '../assets/footer.php'; ?>