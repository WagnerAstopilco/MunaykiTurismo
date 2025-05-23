<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users=User::with(['reservations','payments'])->get();
        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['password'] = Hash::make($request->password);

        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('imagenes/usuarios', 'public');
            $validatedData['profile_photo'] = $path;
        }

        $user = User::create($validatedData);
        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load(['reservations','payments']);
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {

        $validatedData = $request->validated();

        if ($request->has('password')) {
            $validatedData['password'] = Hash::make($request->password);
        }
    
        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }
            $path = $request->file('profile_photo')->store('image/usuarios', 'public');
            $validatedData['profile_photo'] = $path;
        }else {
            $validatedData['profile_photo'] = $user->profile_photo;
        }
    
        $user->update($validatedData);
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'Usuario eliminado correctamente'], 200);
    }
}
