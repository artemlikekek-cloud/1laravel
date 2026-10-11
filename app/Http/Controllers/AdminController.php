<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin');
    }

    public function updateUserRole(Request $request, User $user)
    {
        if (Auth::id() === $user->id) {
            return back()->with('error', 'Нельзя менять собственную роль');
        }

        $user->update(['role_id' => $request->role]);

        return back()->with('success', 'Роль обновлена');
    }

    public function deleteUser(User $user)
    {
        if (Auth::id() === $user->id) {
            return back()->with('error', 'Нельзя удалять собственный аккаунт');
        }

        $user->delete();

        return back()->with('success', 'Пользователь удалён');
    }
}
