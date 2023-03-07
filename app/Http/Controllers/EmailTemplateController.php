<?php

namespace App\Http\Controllers;

use App\Models\EmailTemplate;
use App\Models\User;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PharIo\Manifest\Email;
use Redirect;
use Yajra\DataTables\Facades\DataTables;

class EmailTemplateController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:' . config('constants.permissions.Email Template Management.List.name'), ['only' => ['index']]);
        $this->middleware('permission:' . config('constants.permissions.Email Template Management.Update.name'), ['only' => ['edit', 'update']]);
    }
    public function index(Request $request)
    {
        $accessToModify = auth()->user()->hasPermissionTo(config('constants.permissions.Email Template Management.Update.name'));
        if ($request->ajax()) {
            $emailTemplate = EmailTemplate::query()->select(['name', 'subject', 'id']);
            return DataTables::eloquent($emailTemplate)
                ->addColumn('action', function ($row) use($accessToModify) {
                    return $accessToModify ? '<a href="' . route('emailTemplate.edit', $row->id ?? 0) . '" class="btn btn-primary btn-sm mx-1 my-1">View/Update</a>' :
                        '<span class="badge bg-label-gray">No Access</span>';
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('email-template.index-email-template');
    }

    public function edit(EmailTemplate $emailTemplate)
    {
        return view('email-template.update-email-template', ['emailTemplate' => $emailTemplate]);
    }

    public function update(Request $request, EmailTemplate $emailTemplate)
    {
        $validData = $request->validate([
            'name'    => ['required', 'max:255'],
            'subject' => ['required', 'max:255'],
            'body.*'    => ['required'],
        ]);
        $validData['body'] = json_encode($request->body);
        if ($emailTemplate->update($validData)) {
            Cache::delete('emailTemplate');
            return Redirect::route('emailTemplate.index')->with(['toastStatus' => 'success', 'message' => 'Email template updated successfully.']);
        }
    }
}
