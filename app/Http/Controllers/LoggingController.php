<?php

namespace App\Http\Controllers;

use App\Models\User;
use Cache;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use OwenIt\Auditing\Models\Audit;
use Rappasoft\LaravelAuthenticationLog\Models\AuthenticationLog;
use Yajra\DataTables\Facades\DataTables;

class LoggingController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:' . config('constants.permissions.Logs.List audit logs.name'), ['only' => ['auditList']]);
        $this->middleware('permission:' . config('constants.permissions.Logs.Audit log details.name'), ['only' => ['showAudit']]);
        $this->middleware('permission:' . config('constants.permissions.Logs.List authentication logs.name'), ['only' => ['authenticationList']]);
        $this->middleware('permission:' . config('constants.permissions.Logs.Authentication log details.name'), ['only' => ['showAuthentication']]);
    }

    public function index(Request $request)
    {
        if ($request->getClientIp() != config('constants.debug_ip')) {
            abort('404');
        }
        $pathFile = storage_path('logs/laravel.log');

        if ($request->filled('date')) {
            $pathFile = storage_path('logs/laravel-' . $request->date . '.log');
        }

        if (File::exists($pathFile)) {
            if ($request->clear) {
                file_put_contents($pathFile, "Logs cleared.\n");
            }
            return response(File::get($pathFile))->header('Content-Type', 'text/plain');
        }
    }

    public function auditList(Request $request)
    {
        if ($request->ajax()) {
            $seeDetails = auth()->user()->hasPermissionTo(config('constants.permissions.Logs.Audit log details.name'));
            $audits = Audit::with('user')->select(['created_at', 'user_id', 'event', 'ip_address', 'id', 'user_type', 'auditable_type'])->latest();
            return DataTables::eloquent($audits)
                ->addColumn('view', function ($row) use ($seeDetails) {
                    return $seeDetails ? '<a href="' . route('audits.show', $row->id) . '" class="btn btn-primary btn-sm mx-1 my-1">View</a>' :
                        '<span class="badge bg-label-gray">No Access</span>';
                })
                ->addColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->timezone(config('site.timezone'));
                })
                ->addColumn('user', function ($row) {
                    return $row->user->name ?? 'N/A';
                })
                ->rawColumns(['view', 'user'])
                ->make();
        }
        return view('logs.index-audit-log');
    }

    public function showAudit(Audit $audit)
    {
        return view('logs.show-audit-log', ['audit' => $audit]);
    }

    public function authenticationList(Request $request)
    {
        $users = Cache::remember('users', 36000, function () {
            return User::pluck('name', 'id');
        });
        if ($request->ajax()) {
            $audits = AuthenticationLog::select('*');
            return DataTables::eloquent($audits)
                ->addColumn('login_at', function ($row) {
                    return $row->login_at ? Carbon::parse($row->login_at)->format('d/M/Y') : 'N/A';
                })
                ->addColumn('logout_at', function ($row) {
                    return $row->logout_at ? Carbon::parse($row->logout_at)->format('d/M/Y') : 'N/A';
                })
                ->addColumn('authenticatable_id', function ($row) use($users){
                    return $users[$row->authenticatable_id];
                })
                ->rawColumns(['login_at', 'logout_at'])
                ->make();
        }
        return view('logs.index-authentication-log', ['users' => $users]);
    }
}
