<x-template title="Create">
    <div class="form-container">
        <form id="uploadForm"
              action="{{ isset($category->id) ? route('categories.update', ['id' => $category->id]) : route('categories.store') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            <!-- Name Field -->
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ $category->name ?? '' }}" required>

            <br><br>

            <!-- Order Number Field -->
            <label for="order_no">Order no</label>
            <input type="number" id="order_no" name="order_no" value="{{ $category->order_no ?? '' }}" required>

            <br><br>

            <!-- Image Field -->
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" name="image" id="image" accept="image/*" required>
            </div>
            <p id="errorMessage" style="color: red; display: none;">Dimensi gambar harus 1080x500 piksel.</p>

            <!-- Form Actions -->
            <div class="form-actions">
                <a href="{{ route('categories.list') }}" class="btn btn-secondary">Back</a>
                <button type="submit" class="submit-btn">Submit</button>
            </div>
        </form>
    </div>

    <script>
        const form = document.getElementById('uploadForm');
        const fileInput = document.getElementById('image');
        const errorMessage = document.getElementById('errorMessage');

        // Event listener untuk validasi file sebelum pengiriman
        form.addEventListener('submit', (event) => {
            const file = fileInput.files[0]; // Ambil file yang dipilih
            if (file) {
                const img = new Image();
                img.src = URL.createObjectURL(file); // Buat URL sementara untuk membaca gambar

                // Periksa dimensi gambar setelah gambar dimuat
                img.onload = () => {
                    const { width, height } = img;

                    if (width !== 1080 || height !== 500) {
                        errorMessage.textContent = 'Dimensi gambar harus 1080x500 piksel.';
                        errorMessage.style.display = 'block';
                        return; // Batalkan pengiriman, karena validasi gagal
                    } else {
                        errorMessage.style.display = 'none';
                        form.submit(); // Kirim formulir jika validasi lolos
                    }
                };

                // Jika gambar gagal dimuat, tampilkan error
                img.onerror = () => {
                    errorMessage.textContent = 'File yang diunggah bukan gambar.';
                    errorMessage.style.display = 'block';
                    return; // Batalkan pengiriman
                };

                // Mencegah pengiriman formulir sampai gambar selesai divalidasi
                event.preventDefault();
            } else {
                errorMessage.textContent = 'Harap pilih file gambar.';
                errorMessage.style.display = 'block';
                event.preventDefault(); // Batalkan pengiriman formulir
            }
        });
    </script>

    <style>
        .form-container {
            width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 2px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            position: relative;
            font-size: 10pt;
        }

        .form-container label {
            font-weight: bold;
        }

        .form-container input {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-container input:invalid {
            border-color: red;
        }

        .form-container input:valid {
            border-color: green;
        }

        .submit-btn {
            width: auto;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            position: absolute;
            right: 10px;
            bottom: 10px;
        }

        .submit-btn:hover {
            background-color: #45a049;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
        }
    </style>
</x-template>
