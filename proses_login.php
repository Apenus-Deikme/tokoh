<?php
session_start();
include 'koneksi.php';

if (isset($_POST['username']) && isset($_POST['password'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // ambil data user
    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");

    if (!$query) {
        die("Query error: " . mysqli_error($koneksi));
    }

    if (mysqli_num_rows($query) > 0) {

        $data = mysqli_fetch_assoc($query);

        // cek password
        if (password_verify($password, $data['password'])) {

            $_SESSION['login'] = true;
            $_SESSION['username'] = $data['username'];

            header("Location: /tokoh/index.php");
            exit;

        } else {
            echo "<script>alert('Password salah!'); window.location='/tokoh/login.php';</script>";
        }

    } else {
        echo "<script>alert('Username tidak ditemukan!'); window.location='/tokoh/login.php';</script>";
    }

} else {
    header("Location: /tokoh/login.php");
    exit;
}
?>