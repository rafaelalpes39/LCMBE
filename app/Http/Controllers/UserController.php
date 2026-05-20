<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function listOfUser()
    {
        $users = User::orderBy('updated_at', 'desc')->get();

        return response()->json([
            'users' => $users
        ]);
    }

    public function deleteUser($id)
    {
        User::findOrFail($id)->delete();

        return response()->json([
            'message' => 'User deleted successfully'
        ]);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . $id],
            'cp_number' => ['required', 'string', 'max:20'],
            'role' => ['required', 'string'],
            'team' => ['nullable', 'string'],
            'status' => ['required', 'in:active,inactive'],
            'membership_expiration' => ['nullable', 'date'],
        ]);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->cp_number = $data['cp_number'];
        $user->role = $data['role'];
        $user->team = $data['team'] ?? null;
        $user->status = $data['status'];
        $user->membership_expiration = !empty($data['membership_expiration'])? $data['membership_expiration']: null;
        $user->syncRoles([$data['role']]);
        $user->save();

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user,
            'roles' => $user->getRoleNames(),
            'permissions' => $user->getAllPermissions()->pluck('name'),
        ]);
    }

    public function resetPassword(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        $user->update([
            'password' => Hash::make($data['password']),
        ]);

        return response()->json([
            'message' => 'Password reset successfully.',
        ]);
    }
}
