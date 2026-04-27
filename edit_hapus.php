<?php
include 'koneksi.php';

// cek id
if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan!";
    exit;
}

$id = intval($_GET['id']);

// ambil data
$data = mysqli_query($koneksi, "SELECT * FROM stok_barang WHERE id=$id");
$d = mysqli_fetch_assoc($data);

// proses update
if (isset($_POST['update'])) {
    $nama = $_POST['nama_barang'];
    $stok = $_POST['stok'];

    $update = mysqli_query($koneksi, "UPDATE stok_barang SET 
        nama_barang='$nama',
        stok='$stok'
        WHERE id=$id
    ");

    if ($update) {
        header("Location: stok.php");
        exit;
    } else {
        echo "Gagal update: " . mysqli_error($koneksi);
    }
}

// proses hapus
if (isset($_POST['hapus'])) {
    $hapus = mysqli_query($koneksi, "DELETE FROM stok_barang WHERE id=$id");

    if ($hapus) {
        header("Location: stok.php");
        exit;
    } else {
        echo "Gagal hapus: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit & Hapus</title>
</head>
<body>

<h2>Edit Barang</h2>

<form method="POST">
    <label>Nama Barang</label><br>
    <input type="text" name="nama_barang" value="<?= $d['nama_barang']; ?>"><br><br>

    <label>Stok</label><br>
    <input type="number" name="stok" value="<?= $d['stok']; ?>"><br><br>

    <button type="submit" name="update">Update</button>
    <button type="submit" name="hapus" onclick="return confirm('Yakin mau hapus?')">Hapus</button>
</form>

</body>
</html>