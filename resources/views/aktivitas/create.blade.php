<body>
@include('layouts.header') <!-- Menyertakan file header -->
<div class="container mt-5">
    <h2>Form Tambah Aktivitas</h2>
    <form action="{{ route('aktivitas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_aktivitas" class="form-label">Nama Aktivitas:</label>
            <input type="text" class="form-control" id="nama_aktivitas" name="nama_aktivitas" required> <!-- Input untuk nama aktivitas -->
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi:</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea> <!-- Textarea untuk deskripsi aktivitas -->            
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal:</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required> <!-- Input untuk tanggal aktivitas -->
        </div>
        <button type="submit" class="btn btn-primary">Tambah Aktivitas</button> <!-- Tombol untuk mengirim form -->
    </form>
</div>
@include('layouts.footer') 
</body>
