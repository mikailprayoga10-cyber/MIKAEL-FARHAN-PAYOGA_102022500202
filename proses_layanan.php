<?php
require_once 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_bengkel  = mysqli_real_escape_string($conn, $_POST['nama_bengkel']);
    $jenis_layanan = mysqli_real_escape_string($conn, $_POST['jenis_layanan']);
    $catatan       = mysqli_real_escape_string($conn, $_POST['catatan']);

    $stmt = $conn->prepare("INSERT INTO layanan_maintenance (nama_bengkel, jenis_layanan, catatan) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nama_bengkel, $jenis_layanan, $catatan);

    if ($stmt->execute()) {
        echo "<script>
                alert('Data layanan maintenance berhasil disimpan!');
                window.location.href = 'bengkel.php';
              </script>";
    } else {
        echo "Gagal menyimpan data: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: bengkel.php");
    exit();
}
?>