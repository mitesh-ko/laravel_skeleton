<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;
use Yajra\DataTables\Facades\DataTables;

class AuditLogController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:' . config('constants.permissions.Audit Logs.List audit logs.name'), ['only' => ['index']]);
        $this->middleware('permission:' . config('constants.permissions.Audit Logs.Check log details.name'), ['only' => ['show']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $seeDetails = auth()->user()->hasPermissionTo(config('constants.permissions.Audit Logs.Check log details.name'));
            $audits = Audit::with('user')->select(['created_at', 'user_id', 'event', 'ip_address', 'id', 'user_type', 'auditable_type'])->latest();
            return DataTables::eloquent($audits)
                ->filter(function ($query) use ($request) {
                    if ($request->name) {
                        $query->where('name', 'like', "%" . $request->name . "%");
                    }

                    if ($request->email) {
                        $query->where('email', 'like', "%" . $request->email . "%");
                    }
                })
                ->addColumn('view', function ($row) use($seeDetails){
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
        return view('audit-log.index-audit-log');
    }

    public function show(Audit $audit)
    {
        return view('audit-log.show-audit-log', ['audit' => $audit]);
    }
}
