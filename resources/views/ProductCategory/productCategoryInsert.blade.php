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
        <h2 class="mb-5 mt-5">Insert Product Category</h2>
        <form action="/product-category" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Product Category Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Product Category Name">
            </div>
            <div class="form-group">
                <input type="radio" id="true" name="show" value="1">
                <label for="html">Show</label><br>
                <input type="radio" id="false" name="show" value="0">
                <label for="css">Hide</label><br>
            </div>
            <button type="submit" class="btn btn-primary">Insert</button>
        </form>
    </div>
</body>
</html>