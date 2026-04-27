<?php
$host = "localhost";
$username = "root";
$password = "";    
$database = "investaris";

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
    die("koneksi gagal: " . mysqli_connect_error());
}

// default kosong
$id = "";
$nama_barang = "";

// ================= EDIT =================
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = mysqli_query($koneksi, "SELECT * FROM stok_barang WHERE id='$id'");

    if (!$query) {
        die("Query error: " . mysqli_error($koneksi));
    }

    $data = mysqli_fetch_assoc($query);

    if ($data) {
        $nama_barang = $data['nama_barang'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Data Barang</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body { background:#f4f6f9; }
.container-custom { max-width:800px; margin:30px auto; }
.card { border:none; border-radius:15px; box-shadow:0 4px 15px rgba(0,0,0,0.1); }
.card-header { background:#0d6efd; color:white; }
</style>
</head>

<body>

<div class="container-custom">

<!-- FORM -->
<div class="card mb-4">
<div class="card-header">
<?= $id ? 'Edit Data Barang' : 'Tambah Data Barang'; ?>
</div>

<div class="card-body">
<form method="POST" action="proses_edit.php">

<input type="hidden" name="id" value="<?= $id; ?>">

<div class="mb-3">
<label>Nama Barang</label>
<input type="text" name="nama_barang" class="form-control"
value="<?= $nama_barang; ?>" required>
</div>

<button type="submit" class="btn btn-primary w-100">
<?= $id ? 'Update' : 'Simpan'; ?>
</button>

</form>
</div>
</div>

<!-- TABEL -->
<div class="card">
<div class="card-header">Data Barang</div>

<div class="card-body">
<table class="table table-bordered text-center">
<tr>
<th>No</th>
<th>Nama Barang</th>
<th>Stok</th>
<th>Aksi</th>
</tr>

<?php
$no = 1;
$result = mysqli_query($koneksi, "SELECT * FROM stok_barang");

if (!$result) {
    die("Query error: " . mysqli_error($koneksi));
}

while ($row = mysqli_fetch_assoc($result)) {
?>
<tr>
<td><?= $no++; ?></td>
<td><?= $row['nama_barang']; ?></td>
<td><?= $row['stok']; ?></td>
<td>
<a href="?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
<a href="hapus.php?id=<?= $row['id']; ?>" 
class="btn btn-danger btn-sm"
onclick="return confirm('Yakin hapus?')">Hapus</a>
</td>
</tr>
<?php } ?>

</table>
</div>
</div>

</div>

</body>
</html>