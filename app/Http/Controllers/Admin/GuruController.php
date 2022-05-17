<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User AS Guru;
use App\Http\Controllers\Controller;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $keywords = $request->keywords;
            $collection = Guru::where('role','=','g')
            ->where('name','like','%'.$keywords.'%')
            ->paginate(10);
            return view('pages.admin.guru.list', compact('collection'));
        }
        return view('pages.admin.guru.main');
    }
    public function create()
    {
        return view('pages.admin.guru.input', ['guru' => new Guru]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'nip' => 'required',
            'date_birth' => 'required',
            'place_birth' => 'required',
            'address' => 'required',
            'religion' => 'required',
            'gender' => 'required',
            'email' => 'required|unique:users|max:255',
            'phone' => 'required|unique:users|min:9|max:15',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('name')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('name'),
                ]);
            }elseif ($errors->has('email')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('email'),
                ]);
            }elseif ($errors->has('phone')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('phone'),
                ]);
            }elseif ($errors->has('nip')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('nip'),
                ]);
            }elseif ($errors->has('date_birth')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('date_birth'),
                ]);
            }elseif ($errors->has('place_birth')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('place_birth'),
                ]);
            }elseif ($errors->has('address')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('address'),
                ]);
            }elseif ($errors->has('religion')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('religion'),
                ]);
            }elseif ($errors->has('gender')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('gender'),
                ]);
            }elseif ($errors->has('password')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('password'),
                ]);
            }
        }
        $user = new Guru;
        $user->nip = $request->nip;
        $user->name = Str::title($request->name);
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->role = 'g';
        $user->date_birth = $request->date_birth;
        $user->place_birth = $request->place_birth;
        $user->address = $request->address;
        $user->religion = $request->religion;
        $user->gender = $request->gender;
        $user->save();
        return response()->json([
            'alert' => 'success',
            'message' => 'Guru '. $request->name . ' tersimpan',
        ]);
    }
    public function show(Guru $guru)
    {
        //
    }
    public function edit(Guru $guru)
    {
        return view('pages.admin.guru.input', compact('guru'));
    }
    public function update(Request $request, Guru $guru)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'nip' => 'required',
            'date_birth' => 'required',
            'place_birth' => 'required',
            'address' => 'required',
            'religion' => 'required',
            'gender' => 'required',
            'email' => 'required|max:255',
            'phone' => 'required|min:9|max:15',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('name')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('name'),
                ]);
            }elseif ($errors->has('email')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('email'),
                ]);
            }elseif ($errors->has('nip')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('nip'),
                ]);
            }elseif ($errors->has('date_birth')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('date_birth'),
                ]);
            }elseif ($errors->has('place_birth')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('place_birth'),
                ]);
            }elseif ($errors->has('address')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('address'),
                ]);
            }elseif ($errors->has('religion')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('religion'),
                ]);
            }elseif ($errors->has('gender')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('gender'),
                ]);
            }else{
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('phone'),
                ]);
            }
        }
        if($guru->phone != $request->phone){
            $guru->phone = $request->phone;
        }
        $guru->nip = $request->nip;
        $guru->name = Str::title($request->name);
        $guru->email = $request->email;
        $guru->date_birth = $request->date_birth;
        $guru->place_birth = $request->place_birth;
        $guru->address = $request->address;
        $guru->religion = $request->religion;
        $guru->gender = $request->gender;
        if($request->password){
            $guru->password = Hash::make($request->password);
        }
        $guru->update();
        return response()->json([
            'alert' => 'success',
            'message' => 'Guru '. $request->name . ' terupdate',
        ]);
    }
    public function destroy(Guru $guru)
    {
        Storage::delete($guru->photo);
        $guru->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Guru '. $guru->name . ' terhapus',
        ]);
    }
}
