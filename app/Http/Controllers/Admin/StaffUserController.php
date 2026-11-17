<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

/**
 * Staff accounts only. Super admin accounts never appear here and can't be
 * edited, disabled or deleted from this screen, and accounts created here are
 * always role = 'staff', so nobody can promote themselves to super admin.
 */
class StaffUserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            ->where('role', 'staff')
            ->with('staffRole')
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->where(fn($w) => $w->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%'));
            })
            ->when($request->filled('role_id'), fn($q) => $q->where('role_id', $request->role_id))
            ->when($request->filled('status'), fn($q) => $q->where('is_active', $request->status))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $roles = Role::orderBy('name')->get();

        return view('admin.users.index', compact('users', 'roles'));
    }

    public function create()
    {
        return view('admin.users.form', [
            'staff' => null,
            'roles' => Role::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request, null);

        $user = new User();
        $user->forceFill([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => 'staff',
            'role_id' => $data['role_id'],
            'is_active' => (bool) $data['is_active'],
        ])->save();

        Log::info('Staff user created', ['user_id' => $user->id, 'email' => $user->email, 'role_id' => $user->role_id, 'by' => auth()->id()]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $this->ensureStaff($user);

        return view('admin.users.form', [
            'staff' => $user,
            'roles' => Role::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, User $user)
    {
        $this->ensureStaff($user);
        $data = $this->validated($request, $user);

        $user->forceFill([
            'name' => $data['name'],
            'email' => $data['email'],
            'role_id' => $data['role_id'],
            'is_active' => (bool) $data['is_active'],
        ]);

        if (!empty($data['password'])) {
            // New password: the auth.session middleware signs out their open sessions,
            // and a fresh remember token kills any "remember me" cookie
            $user->password = $data['password'];
            $user->setRememberToken(Str::random(60));
        }

        if (!$user->is_active) {
            $user->setRememberToken(Str::random(60));
        }

        $user->save();

        Log::info('Staff user updated', [
            'user_id' => $user->id,
            'email' => $user->email,
            'role_id' => $user->role_id,
            'is_active' => $user->is_active,
            'password_changed' => !empty($data['password']),
            'by' => auth()->id(),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function toggle(User $user)
    {
        $this->ensureStaff($user);

        $user->is_active = !$user->is_active;
        if (!$user->is_active) {
            $user->setRememberToken(Str::random(60));
        }
        $user->save();

        Log::info('Staff user status toggled', ['user_id' => $user->id, 'is_active' => $user->is_active, 'by' => auth()->id()]);

        return back()->with('success', 'Access ' . ($user->is_active ? 'enabled' : 'disabled') . ' for ' . $user->name . '.');
    }

    public function destroy(User $user)
    {
        $this->ensureStaff($user);

        Log::info('Staff user deleted', ['user_id' => $user->id, 'email' => $user->email, 'by' => auth()->id()]);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    private function ensureStaff(User $user): void
    {
        abort_unless($user->isStaff(), 404);
    }

    private function validated(Request $request, ?User $user): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:150', Rule::unique('users', 'email')->ignore($user?->id)],
            'password' => [
                $user ? 'nullable' : 'required',
                'confirmed',
                Password::min(8)->letters()->mixedCase()->numbers()->symbols(),
            ],
            'role_id' => ['required', 'integer', Rule::exists('roles', 'id')],
            'is_active' => ['required', 'in:0,1'],
        ], [
            'role_id.required' => 'Select a role for this user.',
        ]);
    }
}
