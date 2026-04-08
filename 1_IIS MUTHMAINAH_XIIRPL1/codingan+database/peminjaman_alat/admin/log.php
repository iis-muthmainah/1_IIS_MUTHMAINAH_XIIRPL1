<?php include '../assets/header.php'; include '../koneksi.php';

$data=mysqli_query($conn,"
SELECT user.nama, log_aktivitas.aktivitas, log_aktivitas.waktu
FROM log_aktivitas
JOIN user ON log_aktivitas.id_user=user.id_user
ORDER BY log_aktivitas.waktu DESC
");
?>

<h3>Log Aktivitas</h3>

<table class="table table-bordered">
<tr><th>User</th><th>Aktivitas</th><th>Waktu</th></tr>

<?php while($d=mysqli_fetch_assoc($data)){ ?>
<tr>
<td><?= $d['nama'] ?></td>
<td><?= $d['aktivitas'] ?></td>
<td><?= $d['waktu'] ?></td>
</tr>
<?php } ?>
</table>

<?php include '../assets/footer.php'; ?>