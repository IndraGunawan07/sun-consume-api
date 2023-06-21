<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\ClientException;

class Auth extends Controller
{
  function __construct(){
    $this->client = new \GuzzleHttp\Client();
  }

  function register(Request $request){
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
    echo "<script>localStorage.setItem('token', \"$token\")</script>";

    // $endpoint = "localhost:8000/api/product-category";
    // $response = $this->client->request('GET', $endpoint);
    return redirect('/dashboard');
    return view('auth/dashboard')->with('data', json_decode($response->getBody(), true));
  }

  function dashboard(){
    $endpoint = "localhost:8000/api/product-category";
    $response = $this->client->request('GET', $endpoint);
    return view('auth/dashboard')->with('data', json_decode($response->getBody(), true));
  }
}
