<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: /tokoh/login.php");
    exit;
}
?>

<?php include 'koneksi.php'; ?>

<?php
$total_barang = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM stok_barang"))['total'];
$total_masuk = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(jumlah) as total FROM barang_masuk"))['total'];
$total_keluar = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(jumlah) as total FROM barang_keluar"))['total'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard investaris</title>
<link 	https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css

<style>
</style>
</head>

<body>

<div class="container">

<h3 class="mb-4">📊 Dashboard investaris</h3>

<div class="row text-center mb-4">

<div class="col-md-4">
<div class="card p-3">
<h5>Total Barang</h5>
<h3><?= $total_barang ?? 0; ?></h3>
</div>
</div>

<div class="col-md-4">
<div class="card p-3">
<h5>Barang Masuk</h5>
<h3><?= $total_masuk ?? 0; ?></h3>
</div>
</div>

<div class="col-md-4">
<div class="card p-3">
<h5>Barang Keluar</h5>
<h3><?= $total_keluar ?? 0; ?></h3>
</div>
</div>

</div>

<a href="barang_masuk.php" class="btn btn-success mb-3">+ Barang Masuk</a>

<h4>📦 Stok Barang</h4>

<table class="table table-bordered table-striped text-center">
<tr>
<th>No</th>
<th>Nama Barang</th>
<th>Stok</th>
</tr>

<?php
$no = 1;
$data = mysqli_query($koneksi, "SELECT * FROM stok_barang");

if (!$data) {
    die("Query error: " . mysqli_error($koneksi));
}

while($d = mysqli_fetch_assoc($data)){
?>
<tr>
<td><?= $no++; ?></td>
<td><?= $d['nama_barang']; ?></td>
<td><?= $d['stok']; ?></td>
</tr>
<?php } ?>

</table>

</div>
</body>
</html>