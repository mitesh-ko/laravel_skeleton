<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
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
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = User::query()->select(['id', 'name', 'email', DB::raw("DATE_FORMAT(created_at, '%d/%b/%Y') as joined_on")]);
            return DataTables::eloquent($user)
                ->filter(function ($query) use ($request) {
                    if ($request->name) {
                        $query->where('name', 'like', "%" . $request->name . "%");
                    }

                    if ($request->email) {
                        $query->where('email', 'like', "%" . $request->email . "%");
                    }
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('users.edit', $row->id) . '" class="btn btn-primary btn-sm mx-1 my-1">View/Update</a>';
                    $btn .= '<button data-url="' . route('users.destroy', $row->id) . '" class="btn btn-danger btn-sm mx-1 my-1 delete-user">Delete</button>';
                    $btn .= '<a href="javascript:void(0)" class="btn btn-warning btn-sm mx-1 my-1">Send password reset link</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('user.index-user',);
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

        return Redirect::route('users.index')->with('success', 'User Created successfully.');
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

        return Redirect::route('users.index')->with('success', 'User updated successfully.');
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
        return Redirect::route('users.index')->with('success', 'User deleted successfully.');
    }
}
