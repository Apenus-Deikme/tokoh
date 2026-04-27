<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $hapus = mysqli_query($koneksi, "DELETE FROM stok_barang WHERE id=$id");

    if ($hapus) {
        header("Location: stok.php");
        exit;
    } else {
        echo "Gagal hapus data: " . mysqli_error($koneksi);
    }
} else {
    echo "ID tidak ditemukan!";
}