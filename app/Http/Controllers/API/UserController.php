<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Support\Str;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        //        dd(auth()->guard('api')->user());
        $users = User::paginate(4);
        //        $users =  User::all();
        return response()->json($users, 200);
    }



    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:100',
            'mobile' => 'required|string|min:11|max:11',
            'type' => 'required',
            'city' => 'required|string|min:2|max:50',
            'address' => 'required|string|min:2',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|max:50',
            'avatar' => 'nullable',

        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {

            $user = User::create([
                'name' => $request->name,
                'mobile' => $request->mobile,
                'type' => $request->type,
                'city' => $request->city,
                'address' => $request->address,
                'email' => $request->email,
                'avatar' => $request->avatar,
                'password' => bcrypt($request->password),
                'api_token' => Str::random(100),
            ]);
        }

        if ($user) {
            return response()->json([
                'status' => 201,
                'message' => 'User Created Successfully'
            ], 201);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'خطا در سرور رخ داده'
            ], 500);
        }
        // return response($user, 201);
    }



    public function show($id)
    {
        try {
            $user =  User::findOrFail($id);
            $data = [
                'id' => $user->id,
                'name' => $user->name,
                'mobile' => $user->mobile,
                'type' => $user->type,
                'city' => $user->city,
                'address' => $user->address,
                'email' => $user->email,
                'products' => $user->products,
            ];
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response(['message' => $e->getMessage()], 404);
        }
    }


    public function edit($id)
    {
        //
    }
    public function update(UpdateRequest $request, $id)
    {
        $user =  User::findOrFail($id);
        $data = $request->only(['name', 'city', 'password']);
        $user->update($data);
        return response($user, 202);
    }



    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response(null, 204);
    }
}
