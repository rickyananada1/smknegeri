<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('do_logout');
    }
    public function index()
    {
        return view('pages.auth.main');
    }
    // public function do_register(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|unique:users',
    //         'email' => 'required|email|max:255',
    //         'password' => 'required|min:8',
    //     ]);
        
    //     if ($validator->fails()) {
    //         $errors = $validator->errors();
    //         if ($errors->has('email')) {
    //             return response()->json([
    //                 'alert' => 'error',
    //                 'message' => $errors->first('email'),
    //             ]);
    //         }elseif ($errors->has('email')) {
    //             return response()->json([
    //                 'alert' => 'error',
    //                 'message' => $errors->first('email'),
    //             ]);
    //         }elseif ($errors->has('password')) {
    //             return response()->json([
    //                 'alert' => 'error',
    //                 'message' => $errors->first('password'),
    //             ]);
    //         }
    //     }

    //     $user = new User;
    //     $user->email = $request->username;
    //     $user->email = $request->email;
    //     // $user->role = 'h';
    //     $user->password = Hash::make($request->password);
    //     $user->save();
    //     return response()->json([
    //         'alert' => 'success',
    //         'message' => 'Registrasi Berhasil',
    //         'callback' => 'reload',
    //     ]);
    // }
    public function do_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:255',
            'password' => 'required|min:8',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('email')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('email'),
                ]);
            }else{
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('password'),
                ]);
            }
        }
        $admin = User::where('email', $request->email)->where('role','=','a')->first();
        $guru = User::where('email', $request->email)->where('role','=','g')->first();
        $siswa = User::where('email', $request->email)->where('role','=','s')->first();
        if($admin){
            if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember))
            {
                return response()->json([
                    'alert' => 'success',
                    'message' => 'Welcome back '. Auth::guard('admin')->user()->name,
                    'callback' => route('admin.dashboard'),
                ]);
            }else{
                return response()->json([
                    'alert' => 'error',
                    'message' => 'Maaf, password anda salah.',
                ]);
            }
        }elseif ($guru) {
            if(Auth::guard('guru')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember))
            {
                return response()->json([
                    'alert' => 'success',
                    'message' => 'Welcome back '. Auth::guard('guru')->user()->name,
                    'callback' => route('guru.dashboard'),
                ]);
            }else{
                return response()->json([
                    'alert' => 'error',
                    'message' => 'Maaf, password anda salah.',
                ]);
            }
        } elseif ($siswa) {
            if(Auth::guard('siswa')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember))
            {
                return response()->json([
                    'alert' => 'success',
                    'message' => 'Welcome back '. Auth::guard('siswa')->user()->name,
                    'callback' => route('siswa.dashboard'),
                ]);
            }else{
                return response()->json([
                    'alert' => 'error',
                    'message' => 'Maaf, password anda salah.',
                ]);
            }
        }else{
            return response()->json([
                'alert' => 'error',
                'message' => 'Maaf, email anda tidak terdaftar.',
            ]);
        }
    }
    public function do_logout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }elseif (Auth::guard('guru')->check()) {
            Auth::guard('guru')->logout();
        }elseif (Auth::guard('siswa')->check()) {
            Auth::guard('siswa')->logout();
        }
        return redirect('/');
    }
}
