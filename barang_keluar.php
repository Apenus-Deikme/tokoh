<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html>
<head>
<title>Data Barang Keluar</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body { background:#f4f6f9; }
.container { max-width:900px; margin-top:30px; }
.card { border:none; border-radius:15px; box-shadow:0 4px 10px rgba(0,0,0,0.1); }
</style>
</head>

<body>

<div class="container">

<div class="card">
<div class="card-header bg-primary text-white">
    Data Barang Keluar
</div>

<div class="card-body">

<table class="table table-bordered table-striped text-center">
<thead class="table-dark">
<tr>
    <th>No</th>
    <th>Nama Barang</th>
    <th>Jumlah</th>
    <th>Tanggal</th>
</tr>
</thead>

<tbody>
<?php
$no = 1;
$data = mysqli_query($koneksi, "SELECT * FROM barang_keluar ORDER BY id DESC");

if(mysqli_num_rows($data) > 0){
    while($d = mysqli_fetch_assoc($data)){
?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= htmlspecialchars($d['nama_barang']); ?></td>
    <td><?= $d['jumlah']; ?></td>
    <td><?= $d['tanggal']; ?></td>
</tr>
<?php 
    }
} else {
?>
<tr>
    <td colspan="4">Data belum tersedia</td>
</tr>
<?php } ?>
</tbody>

</table>

</div>
</div>

</div>

</body>
</html>