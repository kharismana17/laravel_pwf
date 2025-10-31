<body>
    @include('layouts.header')
    <div class="container mt-5">
        <h1 class="mb-4">Selamat Datang di Halaman Data Diri</h1>
        <p>Berikut adalah informasi tentang diri saya:</p>

        <div class="text-center mb-4"> <!-- Membuat wadah untuk gambar profil dengan teks rata tengah dan margin bawah. -->
            <img src="{{ asset('images/profil.JPG') }}" alt="Foto Profil" 
                 style="width:200px; height:200px; object-fit:cover; border-radius:50%; border: 3px solid #72deffff;">
        </div>

        <table>
                <tr><td>Nama</td><td>: Kharisma Nur Aulia</td></tr>
                <tr><td>Status</td><td>: Mahasiswa Semester 5</td></tr>
                <tr><td>Program Studi</td><td>: Informatika</td></tr>
                <tr><td>Universitas</td><td>: Universitas Sains Al-Qur'an(UNSIQ)</td></tr>
                <tr><td>Hobi</td><td>: Memasak, Desain</td></tr>
        </table>
    </div>

    @include('layouts.footer')
</body>