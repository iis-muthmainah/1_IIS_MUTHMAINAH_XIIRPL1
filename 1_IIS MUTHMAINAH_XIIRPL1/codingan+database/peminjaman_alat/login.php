<?php
session_start();
include 'koneksi.php';

if(isset($_POST['login'])){
    $u = $_POST['username'];
    $p = ($_POST['password']);

    $q = mysqli_query($conn,"SELECT * FROM user WHERE username='$u' AND password='$p'");
    $d = mysqli_fetch_assoc($q);

    if($d){
        $_SESSION['id'] = $d['id_user'];
        $_SESSION['role'] = $d['role'];
        header("location:dashboard.php");
    } else {
        echo "Login gagal!";
    }
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <form method="post" class="card p-4 col-md-4 mx-auto">
        <h3 class="text-center">Login</h3>
        <input name="username" class="form-control mb-2" placeholder="Username">
        <input name="password" type="password" class="form-control mb-2" placeholder="Password">
        <button name="login" class="btn btn-primary w-100">Login</button>
    </form>
</div>