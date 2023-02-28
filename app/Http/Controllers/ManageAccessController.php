<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Role;
use Event;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use OwenIt\Auditing\Events\AuditCustom;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class ManageAccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $role = Role::query();
            return DataTables::eloquent($role)
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('roles.edit', $row->id ?? 0) . '" class="btn btn-primary btn-sm mx-1 my-1">View/Update</a>';
                    $btn .= '<button data-url="' . route('roles.destroy', $row->id ?? 0) . '" class="btn btn-danger btn-sm mx-1 my-1 delete_role">Delete</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('manage-access.index-role');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('manage-access.create-update-role');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProfileUpdateRequest $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'role_name' => 'required|max:150'
        ]);
        if (Role::where([['name', $request->role_name], ['guard_name', 'web']])->first()) {
            return Redirect::route('roles.index')->with('warning', $request->role_name . 'role already exist with guard web.');
        }
        $role = Role::create([
            'name' => $request->role_name,
        ]);

        $permissionName = array_values($request->permissions ?? []);

        $permissions = Permission::whereIn('name', $permissionName)->pluck('id', 'id');
        $role->syncPermissions($permissions);

        $role->auditEvent = 'created';
        $role->isCustomEvent = true;
        $role->getAllPermissions();
        $role->auditCustomOld = [];
        $role->auditCustomNew = array_merge($role->toArray(),
            ['permission' => json_encode($permissionName, JSON_UNESCAPED_SLASHES)]);
        Event::dispatch(AuditCustom::class, [$role]);
        return Redirect::route('roles.index')->with('success', 'User Created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $user
     * @return Application|Factory|View
     */
    public function edit(Role $role)
    {
        return view('manage-access.create-update-role', ['role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Role $role
     * @return RedirectResponse
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'role_name' => 'required|max:150'
        ]);

        $data = $role->permissions()->get(['name'])->map(function ($value) {
            return $value->name;
        });
        $oldData = array_merge(['permission' => json_encode($data->toArray(), JSON_UNESCAPED_SLASHES)], $role->toArray());
        $permissionsName = array_values($request->permissions ?? []);

        $permissions = Permission::whereIn('name', $permissionsName)->pluck('id', 'id');

        $role->syncPermissions($permissions);
        $role->update([
            'name' => $request->role_name,
        ]);

        $role->auditEvent = 'updated';
        $role->isCustomEvent = true;
        $role->getAllPermissions();
        $role->auditCustomOld = $oldData;
        $role->auditCustomNew = [
            'name'       => $request->role_name,
            'permission' => json_encode($permissionsName, JSON_UNESCAPED_SLASHES)
        ];
        Event::dispatch(AuditCustom::class, [$role]);
        return Redirect::route('roles.index')->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id)
    {
        $role = Role::findOrFail($id);
        if ($role->permissions()->count() > 0) {
            return Redirect::route('roles.index')->with('error', 'Remove all permissions to delete this role.');
        }
        $role->delete();
        return Redirect::route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
