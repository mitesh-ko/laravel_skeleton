<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    private array $validationRule;

    function __construct()
    {
        $this->validationRule = [
            'type'         => 'required|in:expense,income',
            'amount'       => 'required|numeric|max:99999',
            'payment_date' => 'required|date',
            'desc'         => 'nullable|string|max:255',
            'status'       => 'required|in:paid,unpaid',
        ];
        $this->middleware('permission:' . config('permission-name.transaction-list'), ['only' => ['index']]);
        $this->middleware('permission:' . config('permission-name.transaction-create'), ['only' => ['create', 'store']]);
        $this->middleware('permission:' . config('permission-name.transaction-update'), ['only' => ['edit', 'update']]);
        $this->middleware('permission:' . config('permission-name.transaction-delete'), ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $accessToModify = auth()->user()->hasPermissionTo(config('permission-name.transaction-update'));
            $accessToDelete = auth()->user()->hasPermissionTo(config('permission-name.transaction-delete'));

            $transaction = Transaction::orderByDesc('id')->select(['id', 'type', 'amount', 'payment_date', 'desc', 'status']);
            return DataTables::eloquent($transaction)
                ->filterColumn('amount', function ($row) use ($request) {

                })
                ->addColumn('action', function ($row) use ($accessToModify, $accessToDelete) {

                    $btn = '<div class="d-flex">';
                    $btn .= $accessToModify ? '<a href="' . route('transactions.edit', $row->id) . '" class="btn btn-primary btn-sm mx-1 my-1">View/Update</a>' :
                        '<div class="d-flex"></div><span class="badge bg-label-gray mx-1 my-1">No Access</span>';

                    $btn .= $accessToDelete ? '<button data-url="' . route('transactions.destroy', $row->id) . '" class="btn btn-danger btn-sm mx-1 my-1 delete-transaction">Delete</button>' :
                        '<span class="badge bg-label-gray mx-1 my-1">No Access</span>';
                    return $btn;
                })
                ->editColumn('payment_date', function ($row){
                    return $row->payment_date->date;
                })
                ->editColumn('amount', function ($row) {
                    return '₹ ' . $row->amount;
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('transaction.index-transaction');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transaction.create-update-transaction');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validData = $request->validate($this->validationRule);
        $validData['payment_date'] = Carbon::parse($request->payment_date, \Cookie::get('timezone'))
            ->setTimezone(config('app.timezone'))->format('Y-m-d');
        Transaction::create($validData);
        return Redirect::route('transactions.index')->with(['toastStatus' => 'success', 'message' => 'Transaction added successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        return view('transaction.create-update-transaction', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validData = $request->validate($this->validationRule);
        $transaction->update($validData);
        return Redirect::route('transactions.index')->with(['toastStatus' => 'success', 'message' => 'Transaction updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return Redirect::route('transactions.index')->with(['toastStatus' => 'success', 'message' => 'Transaction deleted successfully.']);
    }
}
