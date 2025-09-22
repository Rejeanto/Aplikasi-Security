<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
  public function index()
  {
    return view('login');
  }

  public function login(Request $request)
  {
    $request->validate([
      'username'  => 'required',
      'password'  => 'required',
    ], $this->validationErrors, [
      'username'  => 'Username',
      'password'  => 'Password'
    ]);

    $check = Admin::where('username', $request->username)->first();
    if (isset($check) && Hash::check($request->password, $check->password)) {
      Auth::login($check);
      $this->response['success'] = true;
      $this->response['msg'] = 'Login Berhasil';
      return response()->json($this->response, 200);
    } else {
      return response()->json([
        'errors'  => ['username' => 'Username/Password Salah.'],
        'message' => 'The given data was invalid.'
      ], 422);
    }
  }

  public function logout(Request $request)
  {
    $request->session()->flush();
    Auth::logout();
    return redirect('login');
  }
}
