<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/reset-admin-password', function () {
    $user = User::find(1);

    $user->password = Hash::make('Admin123');
    $user->save();

    return 'Password berhasil direset.';
});