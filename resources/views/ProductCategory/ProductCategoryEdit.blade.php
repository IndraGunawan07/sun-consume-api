<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Insert</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h2 class="mb-5 mt-5">Edit Product Category</h2>
        <form action="/product-category/{{ $productCategory['id'] }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">Product Category Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $productCategory['name'] }}">
            </div>
            <div class="form-group">
                @if($productCategory['show'] == 1)
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
            <button type="button" class="btn btn-danger" id="cancelBtn" data-toggle="modal" data-target="#myModal">Cancel</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    <!-- Modal -->
    <div class="container">
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Confirmation</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to discard?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="/product-category"><button type="button" class="btn btn-danger">Discard</button></a>
                </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>