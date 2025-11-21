<body>
@include('layouts.header') <!-- Menyertakan file header -->
<div class="container mt-5">            
    <h2>Detail Aktivitas</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $aktivitas->nama_aktivitas }}</h5>
            <p class="card-text"><strong>Deskripsi:</strong> {{ $aktivitas->deskripsi }}</p>
            <p class="card-text"><strong>Tanggal:</strong> {{ $aktivitas->tanggal }}</p>
            <p class="card-text"><strong>Status:</strong> {{ $aktivitas->status ? 'Selesai' : 'Belum Selesai' }}</p>
            <a href="{{ route('aktivitas.index') }}" class="btn btn-primary">Kembali</a>
        </div>
    </div>