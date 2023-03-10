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
        $this->middleware('permission:' . config('constants.permissions.Setting.Email template list.name'), ['only' => ['index']]);
        $this->middleware('permission:' . config('constants.permissions.Setting.Email template update.name'), ['only' => ['edit', 'update']]);
    }
    public function index(Request $request)
    {

    }


}
