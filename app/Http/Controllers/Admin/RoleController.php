<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::query()
            ->withCount('users')
            ->when($request->filled('search'), fn($q) => $q->where('name', 'like', '%' . $request->search . '%'))
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        $permissions = config('admin_permissions');

        return view('admin.roles.index', compact('roles', 'permissions'));
    }

    public function create()
    {
        return view('admin.roles.form', [
            'role' => null,
            'permissionGroups' => $this->permissionGroups(),
        ]);
    }

    public function store(Request $request)
    {
        $role = Role::create($this->validated($request));

        Log::info('Role created', ['role_id' => $role->id, 'name' => $role->name, 'permissions' => $role->permissions, 'by' => auth()->id()]);

        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
    }

    public function edit(Role $role)
    {
        return view('admin.roles.form', [
            'role' => $role,
            'permissionGroups' => $this->permissionGroups(),
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $role->update($this->validated($request, $role));

        Log::info('Role updated', ['role_id' => $role->id, 'name' => $role->name, 'permissions' => $role->permissions, 'is_active' => $role->is_active, 'by' => auth()->id()]);

        return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully.');
    }

    public function toggle(Role $role)
    {
        $role->update(['is_active' => !$role->is_active]);

        Log::info('Role status toggled', ['role_id' => $role->id, 'is_active' => $role->is_active, 'by' => auth()->id()]);

        return back()->with('success', 'Role ' . ($role->is_active ? 'enabled' : 'disabled') . ' successfully.');
    }

    public function destroy(Role $role)
    {
        if ($role->users()->exists()) {
            return back()->with('error', 'This role is assigned to users. Move them to another role first, or disable the role instead.');
        }

        Log::info('Role deleted', ['role_id' => $role->id, 'name' => $role->name, 'by' => auth()->id()]);
        $role->delete();

        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully.');
    }

    private function validated(Request $request, ?Role $role = null): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', Rule::unique('roles', 'name')->ignore($role?->id)],
            'description' => ['nullable', 'string', 'max:255'],
            'permissions' => ['required', 'array', 'min:1'],
            // Only known keys — a tampered form can't store an arbitrary permission
            'permissions.*' => ['string', 'distinct', Rule::in(array_keys(config('admin_permissions')))],
            'is_active' => ['required', 'in:0,1'],
        ], [
            'permissions.required' => 'Select at least one permission for this role.',
        ]);

        $data['permissions'] = array_values($data['permissions']);
        $data['is_active'] = (bool) $data['is_active'];

        return $data;
    }

    /** Permissions grouped by their "group" label, for the checkbox form. */
    private function permissionGroups(): array
    {
        $groups = [];
        foreach (config('admin_permissions') as $key => $permission) {
            $groups[$permission['group']][$key] = $permission;
        }

        return $groups;
    }
}
