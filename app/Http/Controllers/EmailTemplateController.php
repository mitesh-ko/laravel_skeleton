<?php

namespace App\Http\Controllers;

use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmailTemplateController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $emailTemplate = EmailTemplate::query()->select(['name', 'body']);
            return DataTables::eloquent($emailTemplate)
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('roles.edit', $row->id ?? 0) . '" class="btn btn-primary btn-sm mx-1 my-1">View/Update</a>';
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('email-template.index-email-template');
    }

    public function edit(Request $request)
    {

    }

    public function update(Request $request)
    {

    }
}
