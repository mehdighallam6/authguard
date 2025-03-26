<?php

namespace App\Http\Controllers\AdminUser;

use App\Enums\RolesEnum;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::latest()
            ->when($request->has('search'), fn($query) => $query->where('email', 'like', "%{$request->search}%"))
            ->when(
                $request->has('role'),
                fn($query) =>
                $query->whereHas('roles', fn($q) => $q->where('name', $request->role))
            )
            ->with('roles:name')
            ->withCount(['tags', 'authenticators'])
            ->paginate(10)
            ->withQueryString();
        return Inertia::render('AdminUser/Users/Index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('AdminUser/Users/Create', [
            'roles' => RolesEnum::cases(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|string|exists:roles,name',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        return to_route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return Inertia::render('AdminUser/Users/Edit', [
            'user' => $user->load('roles:name'),
            'roles' => RolesEnum::cases(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
            'role' => 'required|string|exists:roles,name',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);
        $user->syncRoles($request->role);

        return to_route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return to_route('users.index');
    }
}
