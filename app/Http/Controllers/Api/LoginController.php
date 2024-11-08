<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Login;
use App\Http\Controllers\Controller;
use App\Http\Resources\Login\LoginResource;
use App\Http\Resources\Login\LoginCollection;
use App\Http\Requests\Login\StoreLoginRequest;
use App\Http\Requests\Login\UpdateLoginRequest;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        return new LoginCollection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLoginRequest $request)
    {
        $data = $request->validated();
        $login = User::create($data);
        return new LoginResource($login);
    }

    /**
     * Display the specified resource.
     */
    public function show(Login $id)
    {
        return new LoginResource($login);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLoginRequest $request, Login $id)
    {
        $data = $request->validated();

        $login->update($data);
        return new LoginResource($login);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
