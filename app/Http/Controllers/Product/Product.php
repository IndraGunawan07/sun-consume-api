<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Product extends Controller
{

  function __construct()
  {
    $this->client = new \GuzzleHttp\Client();
  }

  function index(){
    if(!isset($_COOKIE['token'])){
      return redirect('/login');
    }

    $endpoint = "localhost:8000/api/product";
    $response = $this->client->request('GET', $endpoint, ['headers' => [
      'Authorization' => 'Bearer ' . $_COOKIE['token']
    ]]);
    return view('product/product')->with('product', json_decode($response->getBody(), true));
  }   

  function productCategoryList(){
    if(!isset($_COOKIE['token'])){
      return redirect('/login');
    }

    $endpoint = "localhost:8000/api/product-category";
    $response = $this->client->request('GET', $endpoint, ['headers' => [
      'Authorization' => 'Bearer ' . $_COOKIE['token']
    ]]);
    return view('product/productInsert')->with('productCategory', json_decode($response->getBody(), true));
  }

  function insert(Request $request){
    if(!isset($_COOKIE['token'])){
      return redirect('/login');
    }

    $endpoint = "localhost:8000/api/product";
    $response = $this->client->request('POST', $endpoint, ['query' => [
      'name' => $request->name,
      'productCategoryId' => $request->category,
      'price' => $request->price,
      'show' => $request->show
    ]], ['headers' => [
      'Authorization' => 'Bearer ' . $_COOKIE['token']
    ]]);
    return redirect('/product');
  }

  function detail($id = ''){
    if(!isset($_COOKIE['token'])){
      return redirect('/login');
    }

    $endpoint = "localhost:8000/api/product/" . $id;
    $product = $this->client->request('GET', $endpoint, ['headers' => [
      'Authorization' => 'Bearer ' . $_COOKIE['token']
    ]]);

    // Product Category
    $endpoint = "localhost:8000/api/product-category";
    $productCategory = $this->client->request('GET', $endpoint, ['headers' => [
      'Authorization' => 'Bearer ' . $_COOKIE['token']
    ]]);

    return view('product/productEdit')
      ->with('product', json_decode($product->getBody(), true))
      ->with('productCategory', json_decode($productCategory->getBody(), true));
  }

  function update(Request $request, $id = ''){
    if(!isset($_COOKIE['token'])){
      return redirect('/login');
    }

    $endpoint = "localhost:8000/api/product/" . $id;
    $response = $this->client->request('PUT', $endpoint, ['query' => [
      'name' => $request->name,
      'productCategoryId' => $request->category,
      'price' => $request->price,
      'show' => $request->show
    ]], ['headers' => [
      'Authorization' => 'Bearer ' . $_COOKIE['token']
    ]]);
    return redirect('/product');
  }

  function delete($id = ''){
    if(!isset($_COOKIE['token'])){
      return redirect('/login');
    }

    $endpoint = "localhost:8000/api/product/" . $id;
    $response = $this->client->request('DELETE', $endpoint, ['headers' => [
      'Authorization' => 'Bearer ' . $_COOKIE['token']
    ]]);
    return redirect('/product');
  }

  function pay($id = ''){
    if(!isset($_COOKIE['token'])){
      return redirect('/login');
    }

    $endpoint = "localhost:8000/api/product/" . $id . '/pay';
    $response = $this->client->request('GET', $endpoint, ['headers' => [
      'Authorization' => 'Bearer ' . $_COOKIE['token']
    ]]);

    $data = json_decode($response->getBody(), true);
    $url = $data['redirect_url'];
    return redirect($url);
  }
}