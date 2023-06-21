<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h3 class="mb-4 mt-4">Dashboard</h3>
        <div class="mb-5">
            <a href="/product"><button class="btn btn-info">Product</button></a>
            <a href="/product-category"><button class="btn btn-info">Product Category</button></a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Category Name</th>
                <th scope="col">Total Price</th>
                <th scope="col">Total Product</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $index => $dataRow)
                <tr>
                    <th scope="row">{{ $index + 1 }}</th>
                    <td>{{ $dataRow['name'] }}</td>
                    <td>{{ $dataRow['totalPriceLabel'] }}</td>
                    <td>{{ $dataRow['totalProduct'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
</body>
</html>