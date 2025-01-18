<x-template title="Log In">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-0 mb-0" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="row justify-content-center py-3">
        <div class="col-md-4">
            <h1>Edit Main Home Image</h1>
            <form id="uploadForm" class="was-validated" enctype="multipart/form-data" method="post" action="{{ route('landing.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" name="image" id="image" accept="image/*" required>
                </div>
                <p id="errorMessage" style="color: red; display: none;">Dimensi gambar harus 1080x500 piksel.</p>
                <div class="mb-3">
                    <a href="{{ route('home') }}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const form = document.getElementById('uploadForm');
        const fileInput = document.getElementById('image');
        const errorMessage = document.getElementById('errorMessage');

        // Event listener untuk memeriksa file sebelum pengiriman formulir
        form.addEventListener('submit', (event) => {
        const file = fileInput.files[0]; // Ambil file yang dipilih
        if (file) {
            const img = new Image();
            img.src = URL.createObjectURL(file); // Buat URL sementara untuk membaca gambar

            img.onload = () => {
            const { width, height } = img;

            // Validasi ukuran gambar
            if (width !== 1080 || height !== 500) {
                errorMessage.textContent = 'Image dimension need to be 1080x500 px';
                errorMessage.style.display = 'block';
                event.preventDefault(); // Batalkan pengiriman formulir
            } else {
                errorMessage.style.display = 'none';
                form.submit(); // Kirim formulir jika validasi lolos
            }
            };

            img.onerror = () => {
            errorMessage.textContent = 'File yang diunggah bukan gambar.';
            errorMessage.style.display = 'block';
            event.preventDefault();
            };

            // Batalkan pengiriman agar JavaScript sempat memuat gambar
            event.preventDefault();
        } else {
            errorMessage.textContent = 'Harap pilih file gambar.';
            errorMessage.style.display = 'block';
            event.preventDefault(); // Batalkan pengiriman formulir
        }
        });

    </script>

</x-template>
