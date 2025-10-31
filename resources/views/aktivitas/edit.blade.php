<form action="{{ route('aktivitas.update', $aktivitas->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama Aktivitas</label>
        <input type="text" name="nama_aktivitas" class="form-control" value="{{ $aktivitas->nama_aktivitas }}">
    </div>

    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control">{{ $aktivitas->deskripsi }}</textarea>
    </div>

    <div class="mb-3">
        <label>Tanggal</label>
        <input type="date" name="tanggal" class="form-control" value="{{ $aktivitas->tanggal }}">
    </div>

    <div class="mb-3">
        <label>Status</label>
        <input type="checkbox" name="status" value="1" {{ $aktivitas->status ? 'checked' : '' }}>
        <span>{{ $aktivitas->status ? 'Selesai' : 'Belum Selesai' }}</span>
    </div>

    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
</form>
