<body>
    @include('layouts.header') <!-- Menyertakan file header -->
    <div class="container mt-5">
        <h2>Data Aktivitas</h2>
        <a href ="{{ route('aktivitas.create') }}" class="btn btn-primary mb-3">+Tambah Aktivitas</a>
        <table class="table table-bordered" border=1>
            <thead>
                <tr>
                    <th>Nama Aktivitas</th>
                    <th>Deskripsi</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $aktivitas)
                <tr>
                    <td>{{ $aktivitas->nama_aktivitas }}</td>
                    <td>{{ $aktivitas->deskripsi }}</td>
                    <td>{{ $aktivitas->tanggal }}</td>
                    <td>{{ $aktivitas->status ? 'Selesai' : 'Belum Selesai' }}</td>
                    <td>
                        <a href="{{ route('aktivitas.show', $aktivitas->id) }}" class="btn btn-warning btn-sm">Lihat</a>
                        <a href="{{ route('aktivitas.edit', $aktivitas->id) }}" class="btn btn-info btn-sm">Edit</a>
                        <form action="{{ route('aktivitas.destroy', $aktivitas->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus aktivitas ini?')">Hapus</button>
                        </form>
                </tr>
                @endforeach
            </tbody>
        </table>

    @include('layouts.footer') <!-- Menyertakan file footer -->
</body>