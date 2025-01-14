<x-template title="Create" >
    <div class="form-container">
        <form action="{{ isset($category->id) ? route('categories.update', ['id' => $category->id]) : route('categories.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateInput()">
            @csrf

            <!-- Name Field -->
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ $category->name ?? '' }}" required>

            <br><br>

            <!-- Order Number Field -->
            <label for="order_no">Order no</label>
            <input type="number" id="order_no" name="order_no" value="{{ $category->order_no ?? '' }}" required>

            <br><br>

            <div class="form-actions">
                <a href="{{ route('categories.list') }}" class="btn btn-secondary">Back</a>
                <button type="submit" class="submit-btn">Submit</button>
            </div>
        </form>
    </div>

    <script>
        function validateInput() {
            // Order Number Checker
            var orderNo = document.getElementById("order_no").value;
            if (orderNo < 1) {
                alert("Order number must be greater than 0.");
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
