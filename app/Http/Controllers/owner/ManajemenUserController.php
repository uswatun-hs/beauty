<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class ManajemenUserController extends Controller
{
    public function index()
    {
        $data = [
            'no' => 1,
            'users' => User::all()
        ];
        return view('owner.manajemen_user.index', $data);
    }
    public function destroy(User $manajemen_user)
    {
        $manajemen_user->delete();
        return redirect()->route('manajemen_user.index')->with('success', 'User berhasil dihapus.');
    }
}
