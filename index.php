<?php
require_once 'Database.php';
require_once 'Gudang.php';

$database = new Database();
$db = $database->getConnection();

$gudang = new Gudang($db);

// Tambah Gudang
if (isset($_POST['create'])) {
    $gudang->name = $_POST['name'];
    $gudang->location = $_POST['location'];
    $gudang->capacity = $_POST['capacity'];
    $gudang->status = $_POST['status'];
    $gudang->opening_hour = $_POST['opening_hour'];
    $gudang->closing_hour = $_POST['closing_hour'];

    if ($gudang->create()) {
        echo "Gudang berhasil ditambahkan.";
    } else {
        echo "Gagal menambahkan gudang.";
    }
}

// Tampilkan Gudang
$stmt = $gudang->read();
$num = $stmt->rowCount();

if ($num > 0) {
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Nama</th>";
    echo "<th>Lokasi</th>";
    echo "<th>Kapasitas</th>";
    echo "<th>Status</th>";
    echo "<th>Waktu Buka</th>";
    echo "<th>Waktu Tutup</th>";
    echo "<th>Aksi</th>";
    echo "</tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        echo "<tr>";
        echo "<td>{$id}</td>";
        echo "<td>{$name}</td>";
        echo "<td>{$location}</td>";
        echo "<td>{$capacity}</td>";
        echo "<td>{$status}</td>";
        echo "<td>{$opening_hour}</td>";
        echo "<td>{$closing_hour}</td>";
        echo "<td>";
        echo "<form action='index.php' method='post'>";
        echo "<input type='hidden' name='id' value='{$id}'>";
        echo "<input type='submit' name='edit' value='Edit'>";
        echo "<input type='submit' name='delete' value='Delete'>";
        echo "<input type='submit' name='deactivate' value='Deactivate'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Tidak ada gudang ditemukan.";
}

// Update Gudang
if (isset($_POST['edit'])) {
    $gudang->id = $_POST['id'];
    $gudang->name = $_POST['name'];
    $gudang->location = $_POST['location'];
    $gudang->capacity = $_POST['capacity'];
    $gudang->status = $_POST['status'];
    $gudang->opening_hour = $_POST['opening_hour'];
    $gudang->closing_hour = $_POST['closing_hour'];

    if ($gudang->update()) {
        echo "Gudang berhasil diupdate.";
    } else {
        echo "Gagal mengupdate gudang.";
    }
}

// Hapus Gudang
if (isset($_POST['delete'])) {
    $gudang->id = $_POST['id'];

    if ($gudang->delete()) {
        echo "Gudang berhasil dihapus.";
    } else {
        echo "Gagal menghapus gudang.";
    }
}

// Nonaktifkan Gudang
if (isset($_POST['deactivate'])) {
    $gudang->id = $_POST['id'];

    if ($gudang->deactivate()) {
        echo "Gudang berhasil dinonaktifkan.";
    } else {
        echo "Gagal menonaktifkan gudang.";
    }
}
?>

<!-- Form Tambah dan Edit Gudang -->
<form action="index.php" method="post">
    <input type="hidden" name="id" value="">
    Nama: <input type="text" name="name"><br>
    Lokasi: <input type="text" name="location"><br>
    Kapasitas: <input type="number" name="capacity"><br>
    Status: <select name="status">
        <option value="aktif">Aktif</option>
        <option value="tidak_aktif">Tidak Aktif</option>
    </select><br>
    Waktu Buka: <input type="time" name="opening_hour"><br>
    Waktu Tutup: <input type="time" name="closing_hour"><br>
    <input type="submit" name="create" value="Tambah Gudang">
    <input type="submit" name="update" value="Update Gudang">
</form>
