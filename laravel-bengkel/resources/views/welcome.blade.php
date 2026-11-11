<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Bengkel Maintenance</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f8f9fa; color: #333; }
        
        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 50px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .logo { font-size: 24px; font-weight: 800; color: #ffc107; }
        .user-info { font-size: 14px; color: #555; }

        /* Container */
        .container {
            padding: 40px 50px;
            background-color: #fff;
            margin: 20px 50px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }
        .container h2 {
            color: #0b132b;
            border-bottom: 3px solid #ffc107;
            display: inline-block;
            padding-bottom: 5px;
            margin-bottom: 20px;
        }

        /* Tombol */
        .btn {
            padding: 8px 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            font-size: 13px;
        }
        .btn-primary { background-color: #ffc107; color: #000; margin-bottom: 15px; }
        .btn-edit { background-color: #4CAF50; color: white; }
        .btn-delete { background-color: #f44336; color: white; }

        /* Tabel */
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table th, table td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        table th { background-color: #0b132b; color: #fff; }
        table tr:hover { background-color: #f1f1f1; }
    </style>
</head>
<body>

    <!-- NAVBAR: Menampilkan Nama dan Role (Sesuai instruksi gambar tugas) -->
    <nav class="navbar">
        <div class="logo">BENGKEL MAINTENANCE</div>
        <div class="user-info">
            @auth
                Halo, <b>{{ Auth::user()->name }}</b> | Role: <span style="text-transform: uppercase; color: #0b132b;">{{ Auth::user()->role }}</span>
            @endauth
        </div>
    </nav>

    <div class="container">
        <h2>Data Bengkel Mitra</h2>
        
        <!-- Tombol Tambah: Hanya muncul untuk Admin & Petugas -->
        @if(Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'petugas'))
            <a href="{{ route('bengkel.create') }}" class="btn btn-primary">+ Tambah Bengkel Baru</a>
        @endif
        
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Bengkel</th>
                    <th>Lokasi</th>
                    <th>Kontak</th>
                    <th>Jenis Layanan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bengkels as $index => $bengkel)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $bengkel->nama_bengkel }}</td>
                    <td>{{ $bengkel->lokasi }}</td>
                    <td>{{ $bengkel->kontak }}</td>
                    <td>{{ $bengkel->jenis_layanan }}</td>
                    <td>
                        <!-- Tombol Edit: Muncul untuk Admin & Petugas -->
                        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
                            <a href="{{ route('bengkel.edit', $bengkel->id) }}" class="btn btn-edit">Edit</a>
                        @endif

                        <!-- Tombol Hapus: KHUSUS ADMIN SAJA (Petugas tidak bisa melihat tombol ini) -->
                        @if(Auth::user()->role == 'admin')
                            <form action="{{ route('bengkel.destroy', $bengkel->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>