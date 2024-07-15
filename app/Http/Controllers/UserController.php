<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Jobs\FetchUsersJob;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }

        $users = $query->get();
        return view('users.index', compact('users'));
    }

    public function destroy($uuid)
    {
        $user = User::find($uuid);
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User not found.');
        }

        $gender = $user->gender;
        $user->delete();

        Redis::decr($gender === 'male' ? 'male_count' : 'female_count');

        return redirect()->route('users.index')->with('success', 'User deleted.');
    }

    public function fetchUsers()
    {
        FetchUsersJob::dispatch();
        return response()->json(['message' => 'Job dispatched!']);
    }

    public function count()
    {
        $count = User::count();
        return response()->json(['total_users' => $count]);
    }
}
