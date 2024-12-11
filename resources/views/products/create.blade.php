<x-template title="Create">
    <div class="form-container">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateInput()">
            @csrf

            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>

            <br><br>

            <label for="gender">Gender</label>
            <div class="gender-options">
                <div class="radio">
                    <input type="radio" id="male" name="gender" value="m" checked required>
                    <label for="male">Men</label>
                </div>
                <div class="radio">
                    <input type="radio" id="female" name="gender" value="f" required>
                    <label for="female">Women</label>
                </div>
                <div class="radio">
                    <input type="radio" id="unisex" name="gender" value="u" required>
                    <label for="unisex">Unisex</label>
                </div>
                <div class="radio">
                    <input type="radio" id="kids" name="gender" value="k" required>
                    <label for="kids">Kids</label>
                </div>
            </div>

            <br>

            <div class="mb-3">
                <label for="description" class="form-label">Category</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    <option value="" disabled selected>Select category</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if(isset($product) && $product->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <br>

            <label for="subcategory">Subcategory</label>
            <input type="text" id="subcategory" name="subcategory" required>

            <br><br>

            <label for="price">Price</label>
            <input type="number" id="price" name="price" step="0.01" required>

            <br><br>

            <label for="discount">Discount (%)</label>
            <input type="number" id="discount" name="discount" min="0" max="100" step="0.1" required>

            <br><br>

            <!-- Gambar pertama (required) -->
            <label for="image1">Upload Image 1</label>
            <input type="file" id="image1" name="image1" accept="image/*" required>

            <br><br>

            <!-- Gambar kedua (opsional) -->
            <label for="image2">Upload Image 2</label>
            <input type="file" id="image2" name="image2" accept="image/*">

            <br><br>

            <!-- Gambar ketiga (opsional) -->
            <label for="image3">Upload Image 3</label>
            <input type="file" id="image3" name="image3" accept="image/*">

            <br><br>

            <label for="description">Description</label>
            <input type="text" id="description" name="description">

            <br><br><br>

            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>

    <script>
        function validateInput() {
            // Discount Checker
            var discount = document.getElementById("discount").value;
            if (discount < 0 || discount > 100) {
                alert("Discount must be between 0 and 100.");
                return false; // Prevent form submission
            }

            // Name Checker
            var name = document.getElementById("name").value.trim();
            if (name === "") {
                alert("Name cannot be empty.");
                return false; // Prevent form submission
            }

            return true; // Allow form submission if validation passes
        }
    </script>

    <style>
        .form-container {
            width: 600px; /* Lebar form lebih besar */
            margin: 0 auto;
            padding: 20px;
            border: 2px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            position: relative; /* Untuk meletakkan tombol submit di kanan bawah */
            font-size: 10pt; /* Ukuran font menjadi 10pt */
        }

        .form-container label {
            font-weight: bold;
        }

        .form-container input, .form-container select {
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

        /* CSS untuk mengatur tata letak pilihan radio di satu baris */
        .gender-options {
            display: flex;
            justify-content: flex-start;
            gap: 20px; /* Jarak antar pilihan radio */
            flex-wrap: wrap; /* Agar tetap responsif */
        }

        .gender-options input[type="radio"] {
            margin-right: 8px; /* Jarak antara input dan label */
        }

        .gender-options label {
            margin-right: 10px; /* Jarak antar label */
        }
    </style>
</x-template>
