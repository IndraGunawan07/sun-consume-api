<?php

namespace App\Http\Controllers;
session_start();

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\ClientException;

class Auth extends Controller
{
  function __construct(){
    $this->client = new \GuzzleHttp\Client();
  }

  function register(Request $request){
    if(isset($_COOKIE['token'])){
      return redirect('/dashboard');
    }

    $endpoint = "localhost:8000/api/user/register";
    try {
        $response = $this->client->request('POST', $endpoint, ['query' => [
          'email' => $request->email,
          'password' => $request->password,
          'name' => $request->name,
          'passwordConfirmation' => $request->passwordConfirmation
        ]]);    
    }
    catch (ClientException $e) {
        $response = $e->getResponse();
        $statusCode = $response->getStatusCode();
        $responseBodyAsString = json_decode($response->getBody()->getContents(), true);
        if($statusCode >= 400){
          if(isset($responseBodyAsString['messages'])){
            $messages = $responseBodyAsString['messages'];
          }else{
            foreach($responseBodyAsString as $key => $value){
              $messages[$key] = $value[0];
            }
          }
        }
        return view('auth/register')->with('messages', $messages);
    }
    return view('auth/login')->with('success', 'Register Success');
  }

  function login(Request $request){
    if(isset($_COOKIE['token'])){
      return redirect('/dashboard');
    }

    $endpoint = "localhost:8000/api/user/login";
    try{
      $response = $this->client->request('POST', $endpoint, ['query' => [
        'email' => $request->email,
        'password' => $request->password
      ]]);
    }catch (ClientException $e) {
      $response = $e->getResponse();
      $statusCode = $response->getStatusCode();
      $responseBodyAsString = json_decode($response->getBody()->getContents(), true);
      if($statusCode >= 400){
        if(isset($responseBodyAsString['messages'])){
          $messages = $responseBodyAsString['messages'];
        }else{
          foreach($responseBodyAsString as $key => $value){
            $messages[$key] = $value[0];
          }
        }
      }
      return view('auth/login')->with('messages', $messages);
    }
    $data = json_decode($response->getBody(), true);
    $token = $data['token'];
    // return view('auth/login')->with('token', $token);
    // echo "<script>localStorage.setItem('token', \"$token\")</script>";

    setcookie('token', $token);
    return redirect('/dashboard');
  }

  function dashboard(){
    $endpoint = "localhost:8000/api/product-category";
    if(!isset($_COOKIE['token'])){
      return redirect('/login');
    }
    $response = $this->client->request('GET', $endpoint, ['headers' => [
      'Authorization' => 'Bearer ' . $_COOKIE['token']
    ]]);
    return view('auth/dashboard')->with('data', json_decode($response->getBody(), true));
  }

  function logout(){
    if(!isset($_COOKIE['token'])){
      return redirect('/login');
    }
    $endpoint = "localhost:8000/api/user/logout";
    $response = $this->client->request('GET', $endpoint, ['headers' => [
      'Authorization' => 'Bearer ' . $_COOKIE['token']
    ]]);
    setcookie('token', '', time() - 3600);
    return redirect('/login');
  }
}
