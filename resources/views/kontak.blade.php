<body>
    @include('layouts.header')
    section('content')
        <div class="container mt-5">
           <h2>Form Kontak</h2>
              <form action="/submit-kontak" method="POST">

                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama:</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="whatsapp" class="form-label">WhatsApp:</label>
                    <input type="text" class="form-control" id="whatsapp" name="whatsapp" required>
                </div>
                <div class="mb-3">
                    <label for="pesan" class="form-label">Pesan:</label>
                    <textarea class="form-control" id="pesan" name="pesan" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim</button>
              </form>   
        </div>

    @include('layouts.footer')
</body>