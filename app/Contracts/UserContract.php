<?php

namespace App\Contracts;

use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

interface UserContract
{
    /**
     * Display a listing of users.
     *
     * @param Request $request
     * @return Application|Factory|View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request): View|Factory|JsonResponse|Application;

    /**
     * Show the form for creating a new user.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application;

    /**
     * Store a newly created user in database.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse;

    /**
     * Show the form for editing the specified user id.
     *
     * @param User $user
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit(User $user): View|Factory|RedirectResponse|Application;

    /**
     * Update the specified user in database.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user): RedirectResponse;

    /**
     * Remove the specified resource from database.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse;
}
