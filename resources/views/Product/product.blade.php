<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <a href="/product/create"><button type="button" class="btn btn-primary mt-5 mr-5 mb-5">+ Add Product</button></a>
    </div>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Category</th>
                <th scope="col">Price</th>
                <th scope="col">Show</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($product as $index => $products)
                <tr>
                    <th scope="row">{{ $index + 1 }}</th>
                    <td>{{ $products['name'] }}</td>
                    <td>{{ $products['category']}}</td>
                    <td>{{ $products['priceLabel'] }}</td>
                    @if($products['show'] == 0)
                        <td><button class="btn btn-danger btn-sm">Hidden</button></td>
                    @else
                        <td><button class="btn btn-success btn-sm">Show</button></td>

                    @endif
                    <td>
                        <div class="row">
                            <a href="/product/{{ $products['id'] }}/pay"><button type="button" class="btn btn-primary mr-2">Pay</button></a>
                            <a href="/product/{{ $products['id'] }}"><button type="button" class="btn btn-success mr-2">Edit</button></a>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal" id="deleteBtn" data-id={{ $products['id'] }}>Delete</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
                    <p>Are you sure you want to delete?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <form method="POST" enctype="multipart/form-data" class="formBtn">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
                </div>

            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        $(document).on("click", "#deleteBtn", function () {
            var id = $(this).data('id');
            $(".formBtn").attr("action", "/product/"+id);
        });
    </script>
</body>
</html>