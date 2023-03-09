<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use DB;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Str;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:' . config('constants.permissions.User management.List.name'), ['only' => ['index']]);
        $this->middleware('permission:' . config('constants.permissions.User management.Create.name'), ['only' => ['create', 'store']]);
        $this->middleware('permission:' . config('constants.permissions.User management.Update.name'), ['only' => ['edit', 'update']]);
        $this->middleware('permission:' . config('constants.permissions.User management.Delete.name'), ['only' => ['destroy']]);
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
            $accessToModify = auth()->user()->hasPermissionTo(config('constants.permissions.User management.Update.name'));
            $accessToDelete = auth()->user()->hasPermissionTo(config('constants.permissions.User management.Delete.name'));
            $accessToSeeAudit = auth()->user()->hasPermissionTo(config('constants.permissions.Logs.List audit logs.name'));
            $accessToSeeAuthLog = auth()->user()->hasPermissionTo(config('constants.permissions.Logs.List authentication logs.name'));

            $user = User::query()->select(['id', 'name', 'email', DB::raw("DATE_FORMAT(created_at, '%d/%b/%Y') as joined_on")]);
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
     * @param ProfileUpdateRequest $request
     * @return RedirectResponse
     */
    public function store(ProfileUpdateRequest $request)
    {
        $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make(Str::random(5)),
        ]);

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
     * @return Application|Factory|View
     */
    public function edit(User $user)
    {
        return view('user.create-update-user', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $validData = $request->validate([
            'name'  => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        ]);

        if ($user->isDirty('email')) {
            $validData['email_verified_at'] = null;
        }

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
