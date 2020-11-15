<?php

namespace App\Http\Controllers;

use App\Account;
use App\Transaction;
use App\VoucherType;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:transaction-list|transaction-create|transaction-edit|transaction-delete', ['only' => ['index','show','voucher_invoice']]);
        $this->middleware('permission:transaction-create', ['only' => ['create','store']]);
        $this->middleware('permission:transaction-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:transaction-delete', ['only' => ['destroy']]);
        $this->middleware('permission:general-ledger-list', ['only' => ['general_ledger_form','view_general_ledger']]);
        $this->middleware('permission:trial-balance-list', ['only' => ['trial_balance_form','view_trial_balance']]);
        $this->middleware('permission:balance-sheet-list', ['only' => ['balance_sheet']]);
    }

    public function index()
    {
        $transactions = Transaction::latest()->get();
        //dd($transactions);
        return view('backend.posting.index',compact('transactions'));
    }


    public function create(Request $request)
    {
        $voucherTypes=VoucherType::all();
        $accounts = Account::all();
        $transactions = Transaction::latest()->get();
        if (empty($transactions->voucher_no)){
            $transactions->voucher_no = $request->voucher_no+2000 ;
        }
        elseif ($transactions->voucher_no == $request->voucher_no){
            $transactions->voucher_no+=1;
        }elseif( $transactions->voucher_no)
        {
            Toastr::warning('voucher no already exists ');
//                return back();

        }
        //dd($transactions);
        return view('backend.posting.create',compact('voucherTypes','accounts','transactions'));
    }


    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'account_id'=> 'required',
        ]);

        $check_voucher_no_exists = Transaction::where('voucher_no',$request->voucher_no)->latest()->pluck('voucher_no')->first();
        if($check_voucher_no_exists){
            Toastr::warning('Voucher NO Already Exists!', 'Warning');
            return redirect()->route('transaction.create');
        }

        $row_count = count($request->account_id);
        $total_amount = 0;
        for($i=0; $i<$row_count;$i++)
        {
            $total_amount += $request->amount[$i];
        }
        //dd($request->all());
        for ($i = 0; $i < $row_count; $i++) {
            $debit = NULL;
            $credit = NULL;
            $debit_or_credit = $request->debit_or_credit[$i];
            if($debit_or_credit == 'debit'){
                $debit = $request->amount[$i];
            }
            if($debit_or_credit == 'credit'){
                $credit = $request->amount[$i];
            }

            $account_id = $request->account_id[$i];
            $accounts = Account::where('id',$account_id)->first();
            //dd($accounts);
            // Transaction
            $transactions = new Transaction();
            $transactions->voucher_type_id = $request->voucher_type_id;
            $transactions->voucher_no = $request->voucher_no ;


            //dd($transactions->voucher_no);
//            if(($total_amount += $request->voucher_no))
//            {
//                Toastr::warning('voucher no already exists ', 'Warning');
//                return back();
//            }

            $transactions->date = $request->date;
            $transactions->account_id = $account_id;
            $transactions->account_name = $accounts->HeadName;
            $transactions->parent_account_name = $accounts->PHeadName;
            $transactions->account_no = $accounts->HeadCode;
            $transactions->account_type = $accounts->HeadType;
            $transactions->debit = $debit;
            $transactions->credit = $credit;
            $transactions->transaction_description = $request->transaction_description[$i];

           // dd($transactions);
            $transactions->save();


        }
        Toastr::success('Posting Created Successfully', 'Success');
        return redirect()->route('transaction.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $voucherTypes=VoucherType::all();
        $accounts = Account::all();
        $transactions = Transaction::find($id);
        //dd($transactions);
        return view('backend.posting.edit',compact('voucherTypes','accounts','transactions'));
    }


    public function update(Request $request, $id)
    {
        //dd($request->all());
        $this->validate($request, [
            'account_id'=> 'required',
        ]);

        $row_count = count($request->account_id);
        $total_amount = 0;
        for($i=0; $i<$row_count;$i++)
        {
            $total_amount += $request->amount[$i];
        }
        //dd($request->all());
        for ($i = 0; $i < $row_count; $i++) {
            $debit = NULL;
            $credit = NULL;
            $debit_or_credit = $request->debit_or_credit[$i];
            if($debit_or_credit == 'debit'){
                $debit = $request->amount[$i];
            }
            if($debit_or_credit == 'credit'){
                $credit = $request->amount[$i];
            }

            $account_id = $request->account_id[$i];
            $accounts = Account::where('id',$account_id)->first();
            //dd($accounts);
            // Transaction
            $transactions = Transaction::find($id);
            $transactions->voucher_type_id = $request->voucher_type_id;
            $transactions->voucher_no = $request->voucher_no;
            if ($request->voucher_no +2000)
            {
                Toastr::warning('voucher no already exists Successfully', 'Success');
                return back();
            }
            $transactions->date = $request->date;
            $transactions->account_id = $account_id;
            $transactions->account_name = $accounts->HeadName;
            $transactions->parent_account_name = $accounts->PHeadName;
            $transactions->account_no = $accounts->HeadCode;
            $transactions->account_type = $accounts->HeadType;
            $transactions->debit = $debit;
            $transactions->credit = $credit;
            $transactions->transaction_description = $request->transaction_description[$i];
            //dd($serviceSaleDetails);
            $transactions->save();


        }
        Toastr::success('Posting Created Successfully', 'Success');
        return redirect()->route('transaction.index');
    }

    public function destroy($id)
    {
        $transactions = Transaction::find($id);
        $transactions->delete();
        Toastr::success('Posting Deleted Successfully', 'Success');
        return redirect()->route('transaction.index');
    }

    public function voucher_invoice($voucher_no,$transaction_date)
    {

        //echo $voucher_no;
        //echo $transaction_date;
        //exit;
    $debited_info = Transaction::where('voucher_no',$voucher_no)->where('date',$transaction_date)->first();
    $credited_infos = Transaction::where('voucher_no',$voucher_no)->where('date',$transaction_date)->skip(1)->take(50)->first();
    //dd($credited_infos);
    //$count_credited_row = count($credited_infos);
    return view('backend.posting.invoice', compact('debited_info', 'credited_infos','count_credited_row'));

    }
    public function general_ledger_form()
    {

       // $account_id = $request->account_id[$i];
       // $accounts = Account::where('id',$account_id)->first();
        //$general_ledger_account_nos = DB::table('transactions')->where('account_id', '$accounts')->Orderby('account_no', 'asc')->get();
        //$general_ledger_account_nos =Transaction::Orderby('account_no', 'asc')->get();
        $general_ledger_account_nos = DB::table('accounts')->where('IsGL', '1')->Orderby('HeadName', 'asc')->get();
        //dd($accounts);

        return view('backend.account.general_ledger_form', compact('general_ledger_account_nos'));
    }
    public function view_general_ledger(Request $request)
    {
        //dd($request->all());
//        echo '<pre>';
//        print_r($request->all());
//        echo '</pre>';

        $general_ledger = $request->general_ledger;
        $date_from = $request->date_from;
        $date_to = $request->date_to;

        if( (!empty($general_ledger)) && (!empty($date_from)) && (!empty($date_to)) )
        {
            $gl_pre_valance_data = DB::table('transactions')
                ->select('account_no', DB::raw('SUM(debit) as debit, SUM(credit) as credit'))
                ->where('date', '<',$date_from)
                ->where('account_no',$general_ledger)
                ->groupBy('account_no')
                ->first();
        }else{
            $gl_pre_valance_data = DB::table('transactions')
                ->select('account_no', DB::raw('SUM(debit) as debit, SUM(credit) as credit'))
                ->where('date', '<',$date_from)
                ->groupBy('account_no')
                ->first();
        }
        //dd($gl_pre_valance_data);

        $PreBalance=0;
        $preDebCre = 'De/Cr';
        if(!empty($gl_pre_valance_data))
        {
            //echo 'ok';exit;
            $debit = $gl_pre_valance_data->debit;
            $credit = $gl_pre_valance_data->credit;
            if($debit > $credit)
            {
                $PreBalance = $debit - $credit;
                $preDebCre = 'De';
            }else{
                $PreBalance = $credit - $debit;
                $preDebCre = 'Cr';
            }
        }


        if( (!empty($general_ledger)) && (!empty($date_from)) && (!empty($date_to)) )
        {
            //echo 'okk';exit;
            $general_ledger_infos = DB::table('transactions')
                //->join('accounts', 'transactions.id', '=', 'accounts.user_id')
                ->leftJoin('accounts', 'transactions.account_no', '=', 'accounts.HeadCode')
                ->where('transactions.account_no',$general_ledger)
                ->whereBetween('transactions.date', [$date_from, $date_to])
                ->select('transactions.voucher_no', 'transactions.date', 'transactions.account_no', 'transactions.transaction_description', 'transactions.debit', 'transactions.credit', 'accounts.HeadName', 'accounts.PHeadName', 'accounts.HeadType')
                ->get();
        }else{
            //echo 'noo';exit;
            $general_ledger_infos = DB::table('transactions')
                //->join('accounts', 'transactions.id', '=', 'accounts.user_id')
                ->leftJoin('accounts', 'transactions.account_no', '=', 'accounts.HeadCode')
                ->whereBetween('transactions.date', [$date_from, $date_to])
                ->select('transactions.voucher_no', 'transactions.date', 'transactions.account_no', 'transactions.transaction_description', 'transactions.debit', 'transactions.credit', 'accounts.HeadName', 'accounts.PHeadName', 'accounts.HeadType')
                ->get();
        }

        //dd($general_ledger_infos);

        return view('backend.account.general_ledger_view', compact('general_ledger_infos','PreBalance', 'preDebCre', 'general_ledger', 'date_from', 'date_to'));
    }
    public function general_ledger_print($transaction_head,$date_from,$date_to)
    {
//echo ($transaction_head->account_no);
//exit;
        if( (!empty($transaction_head)) && (!empty($date_from)) && (!empty($date_to)) )
        {
            $gl_prevalance_data = DB::table('transactions')
                ->select('account_no', DB::raw('SUM(debit) as debit, SUM(credit) as credit'))
                ->where('date', '<',$date_from)
                ->where('account_no',$transaction_head)
                ->groupBy('account_no')
                ->first();
        }else{
            $gl_prevalance_data = DB::table('transactions')
                ->select('account_no', DB::raw('SUM(debit) as debit, SUM(credit) as credit'))
                ->where('date', '<',$date_from)
                ->groupBy('account_no')
                ->first();
        }

        $PreBalance=0;
        $preDebCre = 'De/Cr';
        if(!empty($gl_prevalance_data))
        {
            //echo 'ok';exit;
            $debit = $gl_prevalance_data->debit;
            $credit = $gl_prevalance_data->credit;
            if($debit > $credit)
            {
                $PreBalance = $debit - $credit;
                $preDebCre = 'De';
            }else{
                $PreBalance = $credit - $debit;
                $preDebCre = 'Cr';
            }
        }


        if( (!empty($transaction_head)) && (!empty($date_from)) && (!empty($date_to)) )
        {
            //echo 'okk';exit;
            $general_ledger_infos = DB::table('transactions')
                //->join('accounts', 'transactions.id', '=', 'accounts.user_id')
                ->leftJoin('accounts', 'transactions.account_no', '=', 'accounts.HeadCode')
                ->where('transactions.account_no',$transaction_head)
                ->whereBetween('transactions.date', [$date_from, $date_to])
                ->select('transactions.voucher_no', 'transactions.date', 'transactions.account_no', 'transactions.transaction_description', 'transactions.debit', 'transactions.credit', 'accounts.HeadName', 'accounts.PHeadName', 'accounts.HeadType')
                ->get();
        }else{
            //echo 'noo';exit;
            $general_ledger_infos = DB::table('transactions')
                //->join('accounts', 'transactions.id', '=', 'accounts.user_id')
                ->leftJoin('accounts', 'transactions.account_no', '=', 'accounts.HeadCode')
                ->whereBetween('transactions.date', [$date_from, $date_to])
                ->select('transactions.voucher_no',  'transactions.date', 'transactions.account_no', 'transactions.transaction_description', 'transactions.debit', 'transactions.credit', 'accounts.HeadName', 'accounts.PHeadName', 'accounts.HeadType')
                ->get();
        }

        //dd($general_ledger_infos);

        return view('backend.account.general_ledger_print', compact('general_ledger_infos','PreBalance', 'preDebCre', 'transaction_head', 'date_from', 'date_to'));
    }

    public function trial_balance_form()
    {
        return view('backend.account.trial_balance_form');
    }

    public function view_trial_balance(Request $request)
    {
        $date_from = date('Y-m-01');
        $date_to = date('Y-m-d');

        $PreBalance=0;
        $preDebCre = 'De/Cr';
        $PreResultAssets = '';
        $PreResultIncomes = '';
        $PreResultExpenses = '';
        $PreResultLiabilities = '';

        $oResultAssets = '';
        $oResultIncomes = '';
        $oResultExpenses = '';
        $oResultLiabilities = '';

        if ($request->isMethod('post') && $request->date_from && $request->date_to) {
            $date_from = $request->date_from;
            $date_to = $request->date_to;

            $pre_sum_assets_debit = 0;
            $pre_sum_assets_credit = 0;

            $PreResultAssets = DB::table('transactions')
                ->join('accounts', 'transactions.account_no', '=', 'accounts.HeadCode')
                //->select('transactions.debit', 'transactions.credit', 'transactions.transaction_description', 'accounts.HeadName')
                ->select('transactions.account_no','accounts.HeadName', DB::raw('SUM(transactions.debit) as debit, SUM(transactions.credit) as credit'))
                ->where('transactions.is_approved','approved')
                ->where('transactions.account_type','A')
                ->where('transactions.date','<', $date_from)
                ->groupBy('transactions.account_no')
                ->groupBy('accounts.HeadName')
                ->get();

            if(count($PreResultAssets) > 0)
            {
                foreach($PreResultAssets as $PreResultAsset)
                {
                    $pre_sum_assets_debit += $PreResultAsset->debit;
                    $pre_sum_assets_credit += $PreResultAsset->credit;
                }
            }

            //dd($PreResultAssets);

            $pre_sum_income_debit = 0;
            $pre_sum_income_credit = 0;

            $PreResultIncomes = DB::table('transactions')
                ->join('accounts', 'transactions.account_no', '=', 'accounts.HeadCode')
                //->select('transactions.debit', 'transactions.credit', 'transactions.transaction_description', 'accounts.HeadName')
                ->select('transactions.account_no','accounts.HeadName', DB::raw('SUM(transactions.debit) as debit, SUM(transactions.credit) as credit'))
                ->where('transactions.is_approved','approved')
                ->where('transactions.account_type','I')
                ->where('transactions.date','<', $date_from)
                ->groupBy('transactions.account_no')
                ->groupBy('accounts.HeadName')
                ->get();

            if(count($PreResultIncomes) > 0)
            {
                foreach($PreResultIncomes as $PreResultIncome)
                {
                    $pre_sum_income_debit += $PreResultIncome->debit;
                    $pre_sum_income_credit += $PreResultIncome->credit;
                }
            }

            $pre_sum_expense_debit = 0;
            $pre_sum_expense_credit = 0;

            $PreResultExpenses = DB::table('transactions')
                ->join('accounts', 'transactions.account_no', '=', 'accounts.HeadCode')
                //->select('transactions.debit', 'transactions.credit', 'transactions.transaction_description', 'accounts.HeadName')
                ->select('transactions.account_no','accounts.HeadName', DB::raw('SUM(transactions.debit) as debit, SUM(transactions.credit) as credit'))
                ->where('transactions.is_approved','approved')
                ->where('transactions.account_type','E')
                ->where('transactions.date','<', $date_from)
                ->groupBy('transactions.account_no')
                ->groupBy('accounts.HeadName')
                ->get();

            if(count($PreResultExpenses) > 0)
            {
                foreach($PreResultExpenses as $PreResultExpense)
                {
                    $pre_sum_expense_debit += $PreResultExpense->debit;
                    $pre_sum_expense_credit += $PreResultExpense->credit;
                }
            }

            $pre_sum_liability_debit = 0;
            $pre_sum_liability_credit = 0;

            $PreResultLiabilities = DB::table('transactions')
                ->join('accounts', 'transactions.account_no', '=', 'accounts.HeadCode')
                //->select('transactions.debit', 'transactions.credit', 'transactions.transaction_description', 'accounts.HeadName')
                ->select('transactions.account_no','accounts.HeadName', DB::raw('SUM(transactions.debit) as debit, SUM(transactions.credit) as credit'))
                ->where('transactions.is_approved','approved')
                ->where('transactions.account_type','L')
                ->where('transactions.date','<', $date_from)
                ->groupBy('transactions.account_no')
                ->groupBy('accounts.HeadName')
                ->get();

            if(count($PreResultLiabilities) > 0)
            {
                foreach($PreResultLiabilities as $PreResultLiabilitie)
                {
                    $pre_sum_liability_debit += $PreResultLiabilitie->debit;
                    $pre_sum_liability_credit += $PreResultLiabilitie->credit;
                }
            }

            $final_pre_sum_debit = $pre_sum_assets_debit + $pre_sum_income_debit + $pre_sum_expense_debit + $pre_sum_liability_debit;
            $final_pre_sum_credit = $pre_sum_assets_credit + $pre_sum_income_credit + $pre_sum_expense_credit + $pre_sum_liability_credit;
            if($final_pre_sum_debit > $final_pre_sum_credit)
            {
                $PreBalance = $final_pre_sum_debit - $final_pre_sum_credit;
                $preDebCre = 'De';
            }else{
                $PreBalance = $final_pre_sum_credit - $final_pre_sum_debit;
                $preDebCre = 'Cr';
            }




            $oResultAssets = DB::table('transactions')
                ->join('accounts', 'transactions.account_no', '=', 'accounts.HeadCode')
                //->select('transactions.debit', 'transactions.credit', 'transactions.transaction_description', 'accounts.HeadName')
                ->select('transactions.account_no','accounts.HeadName', DB::raw('SUM(transactions.debit) as debit, SUM(transactions.credit) as credit'))
                ->where('transactions.is_approved','approved')
                ->where('transactions.account_type','A')
                ->whereBetween('transactions.date', [$date_from, $date_to])
                ->groupBy('transactions.account_no')
                ->groupBy('accounts.HeadName')
                ->get();

            $oResultIncomes = DB::table('transactions')
                ->join('accounts', 'transactions.account_no', '=', 'accounts.HeadCode')
                //->select('transactions.debit', 'transactions.credit', 'transactions.transaction_description', 'accounts.HeadName')
                ->select('transactions.account_no','accounts.HeadName', DB::raw('SUM(transactions.debit) as debit, SUM(transactions.credit) as credit'))
                ->where('transactions.is_approved','approved')
                ->where('transactions.account_type','I')
                ->whereBetween('transactions.date', [$date_from, $date_to])
                ->groupBy('transactions.account_no')
                ->groupBy('accounts.HeadName')
                ->get();

            $oResultExpenses = DB::table('transactions')
                ->join('accounts', 'transactions.account_no', '=', 'accounts.HeadCode')
                //->select('transactions.debit', 'transactions.credit', 'transactions.transaction_description', 'accounts.HeadName')
                ->select('transactions.account_no','accounts.HeadName', DB::raw('SUM(transactions.debit) as debit, SUM(transactions.credit) as credit'))
                ->where('transactions.is_approved','approved')
                ->where('transactions.account_type','E')
                ->whereBetween('transactions.date', [$date_from, $date_to])
                ->groupBy('transactions.account_no')
                ->groupBy('accounts.HeadName')
                ->get();

            $oResultLiabilities = DB::table('transactions')
                ->join('accounts', 'transactions.account_no', '=', 'accounts.HeadCode')
                //->select('transactions.debit', 'transactions.credit', 'transactions.transaction_description', 'accounts.HeadName')
                ->select('transactions.account_no','accounts.HeadName', DB::raw('SUM(transactions.debit) as debit, SUM(transactions.credit) as credit'))
                ->where('transactions.is_approved','approved')
                ->where('transactions.account_type','L')
                ->whereBetween('transactions.date', [$date_from, $date_to])
                ->groupBy('transactions.account_no')
                ->groupBy('accounts.HeadName')
                ->get();
        }


        //dd($oResultAssets);


        return view('backend.account.trial_balance_view', compact('date_from','date_to','oResultAssets','oResultIncomes','oResultExpenses','oResultLiabilities','PreBalance','preDebCre'));
    }


    public function balance_sheet()
    {
        return view('backend.account.balance_sheet_view');
    }

    public function getVoucherNo(Request $request){

//        $option = 'hello';

        $current_voucher_type_id = $request->current_voucher_type_id;
        $current_voucher_no = DB::table('transactions')
//            ->where('voucher_type_id',$current_voucher_type_id)
            ->latest()
            ->pluck('voucher_no')
            ->first();
        if(!empty($current_voucher_no)){
            $voucher_no = $current_voucher_no + 1;
        }else{
            $voucher_no = 1000;
        }

        return response()->json(['success'=>true,'data'=>$voucher_no]);
    }
}
