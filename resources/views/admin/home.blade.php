<x-template title='Welcome, Admin'>

    <h1>Welcome, Admin <span style='color:blue'>{{ auth()->user()->name }}</span></h1>
    <br><br>
    <h3 class="ms-3">Products</h3>
    <div class="ms-3">
        <a class="btn btn-success ms-3" href="{{ route('products.form') }}">Create +</a>
    </div>
    <br><br>
    <h3 class="ms-3">Categories</h3>
    <div class="ms-3">
        <a class="btn btn-success ms-3" href="{{ route('categories.create') }}">Create +</a>
        <a class="btn btn-success ms-3" href="{{ route('categories.list') }}">List of Categories</a>
    </div>
    <br><br>
    <h3 class="ms-3">Main Banner</h3>
    <div class="ms-3">
        <a class="btn btn-success ms-3" href="{{ route('landing.edit') }}">Edit</a>
    </div>
</x-template>
