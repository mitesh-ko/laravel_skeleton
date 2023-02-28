<?php

namespace App\Http\Controllers;

use App\Models\EmailTemplate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PharIo\Manifest\Email;
use Redirect;
use Yajra\DataTables\Facades\DataTables;

class EmailTemplateController extends Controller
{
    function __construct()
    {
//        $this->middleware('permission:email-template-list|email-template-edit|email-template-delete', ['only' => ['index', 'store']]);
//        $this->middleware('permission:email-template-create', ['only' => ['create', 'store']]);
//        $this->middleware('permission:email-template-edit', ['only' => ['edit', 'update']]);
//        $this->middleware('permission:email-template-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $emailTemplate = EmailTemplate::query()->select(['name', 'subject', 'id']);
            return DataTables::eloquent($emailTemplate)
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('emailTemplate.edit', $row->id ?? 0) . '" class="btn btn-primary btn-sm mx-1 my-1">View/Update</a>';
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
            'body'    => ['required'],
        ]);
        if ($emailTemplate->update($validData)) {
            return Redirect::route('emailTemplate.index')->with('success', 'Email template updated successfully.');
        }
    }
}
