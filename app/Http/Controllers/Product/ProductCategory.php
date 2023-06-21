<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\ClientException;

class ProductCategory extends Controller
{

  function __construct(){
    $this->client = new \GuzzleHttp\Client();
  }

  function index(Request $request){
    $endpoint = "localhost:8000/api/product-category";
    $response = $this->client->request('GET', $endpoint);
    return view('productCategory/productCategory')->with('productCategory', json_decode($response->getBody(), true));
  } 

  function insert(Request $request){
    $endpoint = "localhost:8000/api/product-category";

    $response = $this->client->request('POST', $endpoint, ['query' => [
      'name' => $request->name,
      'show' => $request->show
    ]]);
    return redirect('/product-category');
  }

  function detail($id = ''){
    $endpoint = "localhost:8000/api/product-category/" . $id;
    $productCategory = $this->client->request('GET', $endpoint);

    return view('productCategory/productCategoryEdit')->with('productCategory', json_decode($productCategory->getBody(), true));
  }

  function update(Request $request, $id = ''){
    $endpoint = "localhost:8000/api/product-category/" . $id;

    $response = $this->client->request('PUT', $endpoint, ['query' => [
      'name' => $request->name,
      'show' => $request->show
    ]]);
    return redirect('/product-category');
  }

  function delete($id = ''){
    $endpoint = "localhost:8000/api/product-category/" . $id;
    $messages = '';

    try {
        $response = $this->client->request('DELETE', $endpoint);    
    }
    catch (ClientException $e) {
        $response = $e->getResponse();
        $responseBodyAsString = json_decode($response->getBody()->getContents(), true);
        $messages = $responseBodyAsString['messages'];
    }
    $endpoint = "localhost:8000/api/product-category";
    $response = $this->client->request('GET', $endpoint);
    if($messages != ''){
        return redirect('/product-category')->with('messages', $messages);
    }
    return redirect('/product-category');
  }
}