<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(4);
//        $users =  User::all();
        return response()->json($users,200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
                'email' => $user->email,
                'products' => $user->products,
            ];
            return response()->json($data,200);
        }
        catch (\Exception $e){
            return response(['message' => $e->getMessage()],404);
        }
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
