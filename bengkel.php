<?php
require_once 'koneksi.php';

// Ambil data layanan dari database
$query = "SELECT * FROM layanan_maintenance ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Bengkel Maintenance</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">
            <h1>BENGKEL</h1>
            <p>SISTEM RENTAL MOBIL</p>
        </div>
    </header>

    <div class="container">
        <h2>Form Input Layanan Maintenance</h2>
        
        <!-- Form Pengisian Layanan -->
        <form action="proses_layanan.php" method="POST" style="margin-bottom: 30px;">
            <div class="form-group">
                <label for="nama_bengkel">Nama Bengkel</label>
                <input type="text" id="nama_bengkel" name="nama_bengkel" placeholder="Contoh: Auto Sejahtera" required>
            </div>

            <div class="form-group">
                <label for="jenis_layanan">Jenis Layanan</label>
                <select id="jenis_layanan" name="jenis_layanan" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;" required>
                    <option value="" disabled selected>-- Pilih Jenis Layanan --</option>
                    <option value="Servis kendaraan berkala">Servis kendaraan berkala</option>
                    <option value="Perbaikan mesin">Perbaikan mesin</option>
                    <option value="Pemeriksaan komponen">Pemeriksaan komponen</option>
                    <option value="Perawatan armada rental">Perawatan armada rental</option>
                </select>
            </div>

            <div class="form-group">
                <label for="catatan">Catatan / Detail Maintenance</label>
                <textarea id="catatan" name="catatan" rows="3" placeholder="Masukkan catatan perawatan..."></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Layanan</button>
        </form>

        <h2>Daftar Layanan Maintenance Tersimpan</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Bengkel</th>
                    <th>Jenis Layanan</th>
                    <th>Catatan</th>
                    <th>Tanggal Input</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                if (mysqli_num_rows($result) > 0): 
                    while($row = mysqli_fetch_assoc($result)): 
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row['nama_bengkel']); ?></td>
                        <td><?= htmlspecialchars($row['jenis_layanan']); ?></td>
                        <td><?= htmlspecialchars($row['catatan']); ?></td>
                        <td><?= $row['created_at']; ?></td>
                    </tr>
                <?php 
                    endwhile; 
                else: 
                ?>
                    <tr>
                        <td colspan="5" style="text-align:center;">Belum ada data layanan tersimpan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
