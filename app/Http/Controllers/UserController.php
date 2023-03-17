<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Str;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:' . config('permission-name.user_management-list'), ['only' => ['index']]);
        $this->middleware('permission:' . config('permission-name.user_management-create'), ['only' => ['create', 'store']]);
        $this->middleware('permission:' . config('permission-name.user_management-update'), ['only' => ['edit', 'update']]);
        $this->middleware('permission:' . config('permission-name.user_management-delete'), ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $accessToModify = auth()->user()->hasPermissionTo(config('permission-name.user_management-update'));
            $accessToDelete = auth()->user()->hasPermissionTo(config('permission-name.user_management-delete'));
            $accessToSeeAudit = auth()->user()->hasPermissionTo(config('permission-name.logs-list_audit_logs'));
            $accessToSeeAuthLog = auth()->user()->hasPermissionTo(config('permission-name.logs-list_authentication_logs'));

            $user = User::orderByDesc('id')->whereNotIn('id', [1, Auth::user()->id])->select(['id', 'name', 'email', 'created_at']);
            return DataTables::eloquent($user)
                ->addColumn('action', function ($row) use ($accessToModify, $accessToDelete, $accessToSeeAudit, $accessToSeeAuthLog) {

                    $btn = '<div class="d-flex">';
                    $btn .= $accessToModify ? '<a href="' . route('users.edit', $row->id) . '" class="btn btn-primary btn-sm mx-1 my-1">View/Update</a>' :
                        '<div class="d-flex"></div><span class="badge bg-label-gray mx-1 my-1">No Access</span>';

                    $btn .= $accessToDelete ? '<button data-url="' . route('users.destroy', $row->id) . '" class="btn btn-danger btn-sm mx-1 my-1 delete-user">Delete</button>' :
                        '<span class="badge bg-label-gray mx-1 my-1">No Access</span>';

                    if ($accessToSeeAudit || $accessToSeeAuthLog) {
                        $audit = $accessToSeeAudit ? '<a class="dropdown-item" target="_blank" href="' . route('audits.show.user', ['user_id' => $row->id]) . '">Audit Logs</a>' : '';
                        $authentication = $accessToSeeAuthLog ? '<a class="dropdown-item" target="_blank" href="' . route('authenticationLogs.show.user', $row->id) . '">Authentication Logs</a>' : '';
                        $btn .= "<div class='align-items-center mb-0 mb-md-2'>
                                    <div class='dropdown'>
                                      <i class='ti ti-dots-vertical cursor-pointer'
                                        data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                      </i>
                                      <div class='dropdown-menu dropdown-menu-end' aria-labelledby='emailsActions'>
                                            $audit
                                            $authentication
                                      </div>
                                    </div>
                                </div>";
                    }
                    $btn .= '</div>';
                    return $btn;
                })
                ->addColumn('joined_on', function ($row) use($request){
                    return Carbon::parse($row->created_at)->timezone($request->cookie('timezone'))->format('d/M/Y');
                })
                ->removeColumn('created_at')
                ->rawColumns(['action'])
                ->make();
        }
        return view('user.index-user');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('user.create-update-user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'role'  => ['required'],
            'phone' => 'nullable'
        ]);
        $validData['username'] = \Faker\Factory::create()->userName();
        $validData['password'] = Hash::make(Str::random(5));
        if ($request->profile) {
            $validData['profile'] = Storage::disk('public')->put('user_profile', $request->profile);
        }
        $user = User::create($validData);
        $role = Role::where('name', $request->role)->first();
        $user->syncRoles($role);
        event(new Registered($user));
        return Redirect::route('users.index')->with(['toastStatus' => 'success', 'message' => 'User Created successfully.']);
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
     * @param User $user
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit(User $user)
    {
        if ($user->id == 1) {
            return Redirect::route('users.index');
        }
        return view('user.create-update-user', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $validData = $request->validate([
            'name'  => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'role'  => ['required'],
            'phone' => ['nullable']
        ]);
        if ($user->isDirty('email')) {
            $validData['email_verified_at'] = null;
        }

        if ($request->profile) {
            if ($user->profile)
                $request->profile->storeAs('public', $user->getRawOriginal('profile'));
            else
                $validData['profile'] = Storage::disk('public')->put('user_profile', $request->profile);
        }

        $role = Role::where('name', $request->role)->first();
        $user->syncRoles($role);
        $user->update($validData);

        return Redirect::route('users.index')->with(['toastStatus' => 'success', 'message' => 'User updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id)
    {
        $user = User::findOrFail($id);
        // delete user associated data from other tables.
        $user->delete();
        return Redirect::route('users.index')->with(['toastStatus' => 'success', 'message' => 'User deleted successfully.']);
    }
}
