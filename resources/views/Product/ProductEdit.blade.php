<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Insert</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h2 class="mb-5 mt-5">Edit Product</h2>
        <form action="/product/{{ $product['id'] }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $product['name'] }}">
            </div>
            {{-- @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror --}}
            <div class="form-group">
                <label for="category">Choose product category:</label>
                <select id="category" name="category">
                    @foreach($productCategory as $productCategoryRow)
                        @if($productCategoryRow['id'] == $product['categoryId'])
                            <option value="{{ $productCategoryRow['id'] }}" selected>{{ $productCategoryRow['name'] }}</option>
                        @else
                            <option value="{{ $productCategoryRow['id'] }}">{{ $productCategoryRow['name'] }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="name">Product Price</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="Product Price" value={{ $product['price'] }}>
            </div>
            <div class="form-group">
                @if($product['show'] == 1)
                    <input type="radio" id="true" name="show" value="1" checked>
                    <label for="html">Show</label><br>
                    <input type="radio" id="false" name="show" value="0">
                    <label for="css">Hide</label><br>
                @else
                    <input type="radio" id="true" name="show" value="1">
                    <label for="html">Show</label><br>
                    <input type="radio" id="false" name="show" value="0" checked>
                    <label for="css">Hide</label><br>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
    </div>
</body>
</html>