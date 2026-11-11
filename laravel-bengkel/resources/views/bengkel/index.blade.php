<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Bengkel Maintenance - Laravel</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <header>
        <div class="logo">
            <h1>BENGKEL</h1>
            <p>SISTEM RENTAL MOBIL (LARAVEL)</p>
        </div>
        <div style="float: right; padding: 20px; color: white;">
            Login sebagai: <b>{{ ucfirst(auth()->user()->role) }}</b> 
            <form action="{{ route('logout') }}" method="POST" style="display:inline; margin-left: 10px;">
                @csrf
                <button type="submit" class="btn btn-delete" style="padding: 5px 10px;">Logout</button>
            </form>
        </div>
    </header>

    <div class="container">
        <!-- Notifikasi Pesan Sukses -->
        @if(session('success'))
            <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <!-- HANYA ADMIN YANG BISA MELIHAT FORM INPUT / EDIT -->
        @if(auth()->user()->role == 'admin')
            <h2>{{ isset($item) ? 'Form Edit Layanan Maintenance' : 'Form Input Layanan Maintenance' }}</h2>
            
            <form action="{{ isset($item) ? route('bengkel.update', $item->id) : route('bengkel.store') }}" method="POST" style="margin-bottom: 30px;">
                @csrf
                @if(isset($item))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="nama_bengkel">Nama Bengkel</label>
                    <input type="text" id="nama_bengkel" name="nama_bengkel" value="{{ $item->nama_bengkel ?? old('nama_bengkel') }}" placeholder="Contoh: Auto Sejahtera" required>
                </div>

                <div class="form-group">
                    <label for="jenis_layanan">Jenis Layanan</label>
                    <select id="jenis_layanan" name="jenis_layanan" required>
                        <option value="" disabled {{ !isset($item) ? 'selected' : '' }}>-- Pilih Jenis Layanan --</option>
                        <option value="Servis kendaraan berkala" {{ (isset($item) && $item->jenis_layanan == 'Servis kendaraan berkala') ? 'selected' : '' }}>Servis kendaraan berkala</option>
                        <option value="Perbaikan mesin" {{ (isset($item) && $item->jenis_layanan == 'Perbaikan mesin') ? 'selected' : '' }}>Perbaikan mesin</option>
                        <option value="Pemeriksaan komponen" {{ (isset($item) && $item->jenis_layanan == 'Pemeriksaan komponen') ? 'selected' : '' }}>Pemeriksaan komponen</option>
                        <option value="Perawatan armada rental" {{ (isset($item) && $item->jenis_layanan == 'Perawatan armada rental') ? 'selected' : '' }}>Perawatan armada rental</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="catatan">Catatan / Detail Maintenance</label>
                    <textarea id="catatan" name="catatan" rows="3" placeholder="Masukkan catatan perawatan...">{{ $item->catatan ?? old('catatan') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">{{ isset($item) ? 'Perbarui Layanan' : 'Simpan Layanan' }}</button>
                @if(isset($item))
                    <a href="{{ route('bengkel.index') }}" class="btn btn-back">Batal</a>
                @endif
            </form>
        @else
            <!-- Tampilan khusus jika yang login Petugas -->
            <div style="background-color: #e2f0d9; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                <p>ℹ️ Anda masuk sebagai <b>Petugas</b>. Anda hanya memiliki hak akses untuk melihat data (Read-Only).</p>
            </div>
        @endif

        <h2>Daftar Layanan Maintenance Tersimpan</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Bengkel</th>
                    <th>Jenis Layanan</th>
                    <th>Catatan</th>
                    <th>Tanggal Input</th>
                    @if(auth()->user()->role == 'admin')
                        <th>Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($layanan as $index => $row)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $row->nama_bengkel }}</td>
                        <td>{{ $row->jenis_layanan }}</td>
                        <td>{{ $row->catatan }}</td>
                        <td>{{ $row->created_at }}</td>
                        
                        <!-- TOMBOL AKSI HANYA MUNCUL UNTUK ADMIN -->
                        @if(auth()->user()->role == 'admin')
                            <td>
                                <a href="{{ route('bengkel.edit', $row->id) }}" class="btn btn-edit">Edit</a>
                                <form action="{{ route('bengkel.destroy', $row->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete">Hapus</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ auth()->user()->role == 'admin' ? 6 : 5 }}" style="text-align:center;">Belum ada data layanan tersimpan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>