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


class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::paginate(4);
            //    $users =  User::all();
        return response()->json($users, 200);
    }



    public function create()
    {
        //
    }
    public function store(StoreRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'type' => $request->type,
            'city' => $request->city,
            'address' => $request->address,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            // 'avatar' => $request->avatar ? $request->avatar->name : "",
            'api_token' => Str::random(100),
        ]);
            $file = $request->file('avatar');
            $name = $file->getClientOriginalName();
            $dot = strpos($name,'.');
            $nameImage = $user->id . substr($name,$dot);
            $file->move('user_avatar',$nameImage);
            $user->avatar= $nameImage;
            $user->save();


        return response($user, 201);
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
