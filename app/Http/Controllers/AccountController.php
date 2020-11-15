<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:coa-print', ['only' => ['coa_print']]);
        $this->middleware('permission:cash-book-list', ['only' => ['cash_book_form']]);

        $this->middleware('permission:debit-voucher-list', ['only' => ['debit_voucher_form','view_debit_voucher']]);
        $this->middleware('permission:credit-voucher-list', ['only' => ['credit_voucher_form','view_credit_voucher']]);


    }


    public function coa_print(){

        return  view('backend.account.coa_print');
    }
    public function cash_book_form(Request $request)
    {
        $PreBalance=0;
        $preDebCre = 'De/Cr';
        $cash_data_results = '';

        if ($request->isMethod('post')) {

            $cash_prevalance_data = DB::table('transactions')
                ->select('account_no', DB::raw('SUM(debit) as debit, SUM(credit) as credit'))
                ->where('date', '<',$request->date_from)
                ->where('account_no','10101')
                ->where('is_approved','pending')
                ->groupBy('account_no')
                ->first();


            if(!empty($cash_prevalance_data))
            {
                //echo 'ok';exit;
                $debit = $cash_prevalance_data->debit;
                $credit = $cash_prevalance_data->credit;
                if($debit > $credit)
                {
                    $PreBalance = $debit - $credit;
                    $preDebCre = 'De';
                }else{
                    $PreBalance = $credit - $debit;
                    $preDebCre = 'Cr';
                }
            }

            if( (!empty($request->date_from)) && (!empty($request->date_to)) )
            {
                $cash_data_results = DB::table('transactions')
                    ->where('is_approved','approved')
                    ->whereBetween('date', [$request->date_from, $request->date_to])
                    ->where(function ($query) {
                        $query->where('account_no','=','10101')  // cash
                        ->orWhere('account_no','LIKE','10201%') // bank
                        ->Where('bank_user','=','Inventories'); // bank
                    })
                    ->get();
            }else{
                $cash_data_results = DB::table('transactions')
                    ->where('is_approved','approved')
                    ->where(function ($query) {
                        $query->where('account_no','=','10101')  // cash
                        ->orWhere('account_no','LIKE','10201%') // bank
                        ->Where('bank_user','=','Inventories'); // bank
                    })
                    ->get();
            }
        }

        $date_from = '';
        $date_to = '';

        if($request->date_from)
        {
            $date_from = $request->date_from;
        }
        if($request->date_to)
        {
            $date_to = $request->date_to;
        }
//dd($cash_prevalance_data);
        return view('backend.account.cashbook', compact('cash_data_results', 'PreBalance', 'preDebCre','date_from','date_to'));
    }

    public function cash_book_print($date_from,$date_to)
    {
        $PreBalance=0;
        $preDebCre = 'De/Cr';
        $cash_data_results = '';



        $cash_prevalance_data = DB::table('transactions')
            ->select('account_no', DB::raw('SUM(debit) as debit, SUM(credit) as credit'))
            ->where('date', '<',$date_from)
            ->where('account_no','10101')
            ->where('is_approved','approved')
            ->groupBy('account_no')
            ->first();


        if(!empty($cash_prevalance_data))
        {
            //echo 'ok';exit;
            $debit = $cash_prevalance_data->debit;
            $credit = $cash_prevalance_data->credit;
            if($debit > $credit)
            {
                $PreBalance = $debit - $credit;
                $preDebCre = 'De';
            }else{
                $PreBalance = $credit - $debit;
                $preDebCre = 'Cr';
            }
        }

        if( (!empty($date_from)) && (!empty($date_to)) )
        {
            $cash_data_results = DB::table('transactions')
                ->where('account_no','10101')
                ->where('is_approved','approved')
                ->whereBetween('date', [$date_from, $date_to])
                ->get();
        }else{
            $cash_data_results = DB::table('transactions')
                ->where('account_no','10101')
                ->where('is_approved','approved')
                ->get();
        }

        return view('backend.account.cashbook_print', compact('cash_data_results', 'PreBalance', 'preDebCre','date_from','date_to'));
    }


    public function debit_voucher_form(){
        $general_ledger_account_nos = DB::table('accounts')->where('HeadCode','LIKE','501%')->Orderby('HeadName', 'asc')->get();
        //dd($accounts);

        return view('backend.account.debit_voucher_form', compact('general_ledger_account_nos'));
    }

    public function view_debit_voucher(Request $request)
    {
        $general_ledger = $request->general_ledger;
        $date_from = $request->date_from;
        $date_to = $request->date_to;

        $acc_name = Account::where('HeadCode',$request->general_ledger)->pluck('HeadName')->first();


        if( (!empty($general_ledger)) && (!empty($date_from)) && (!empty($date_to)) )
        {
            //echo 'okk';exit;
            $general_ledger_infos = DB::table('transactions')
                //->join('accounts', 'transactions.id', '=', 'accounts.user_id')
                ->leftJoin('accounts', 'transactions.account_no', '=', 'accounts.HeadCode')
                ->where('transactions.account_no',$general_ledger)
                ->where('transactions.debit','>',0)
                ->whereBetween('transactions.date', [$date_from, $date_to])
                ->select('transactions.voucher_no', 'transactions.date', 'transactions.account_no', 'transactions.transaction_description', 'transactions.debit', 'transactions.credit', 'accounts.HeadName', 'accounts.PHeadName', 'accounts.HeadType')
                ->get();
        }else{
            //echo 'noo';exit;
            $general_ledger_infos = DB::table('transactions')
                //->join('accounts', 'transactions.id', '=', 'accounts.user_id')
                ->leftJoin('accounts', 'transactions.account_no', '=', 'accounts.HeadCode')
                ->where('transactions.debit','>',0)
                ->whereBetween('transactions.date', [$date_from, $date_to])
                ->select('transactions.voucher_no', 'transactions.date', 'transactions.account_no', 'transactions.transaction_description', 'transactions.debit', 'transactions.credit', 'accounts.HeadName', 'accounts.PHeadName', 'accounts.HeadType')
                ->get();
        }

        //dd($general_ledger_infos);

        return view('backend.account.debit_voucher_view', compact('general_ledger_infos', 'general_ledger', 'date_from', 'date_to','acc_name'));
    }


    public function debit_voucher_print($transaction_head,$date_from,$date_to)
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

        return view('backend.account.debit_voucher_print', compact('general_ledger_infos','PreBalance', 'preDebCre', 'transaction_head', 'date_from', 'date_to'));
    }


    public function credit_voucher_form(){
        $general_ledger_account_nos = DB::table('accounts')->where('HeadCode','LIKE','10103%')->Orderby('HeadName', 'asc')->get();
        //dd($accounts);

        return view('backend.account.credit_voucher_form', compact('general_ledger_account_nos'));
    }
    public function view_credit_voucher(Request $request)
    {
        $general_ledger = $request->general_ledger;
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        $acc_name = Account::where('HeadCode',$request->general_ledger)->pluck('HeadName')->first();

        if( (!empty($general_ledger)) && (!empty($date_from)) && (!empty($date_to)) )
        {
            //echo 'okk';exit;
            $general_ledger_infos = DB::table('transactions')
                //->join('accounts', 'transactions.id', '=', 'accounts.user_id')
                ->leftJoin('accounts', 'transactions.account_no', '=', 'accounts.HeadCode')
                ->where('transactions.account_no',$general_ledger)
                ->where('transactions.credit','>',0)
                ->whereBetween('transactions.date', [$date_from, $date_to])
                ->select('transactions.voucher_no', 'transactions.date', 'transactions.account_no', 'transactions.transaction_description', 'transactions.debit', 'transactions.credit', 'accounts.HeadName', 'accounts.PHeadName', 'accounts.HeadType')
                ->get();
        }else{
            //echo 'noo';exit;
            $general_ledger_infos = DB::table('transactions')
                //->join('accounts', 'transactions.id', '=', 'accounts.user_id')
                ->leftJoin('accounts', 'transactions.account_no', '=', 'accounts.HeadCode')
                ->where('transactions.credit','>',0)
                ->whereBetween('transactions.date', [$date_from, $date_to])
                ->select('transactions.voucher_no', 'transactions.date', 'transactions.account_no', 'transactions.transaction_description', 'transactions.debit', 'transactions.credit', 'accounts.HeadName', 'accounts.PHeadName', 'accounts.HeadType')
                ->get();
        }

        //dd($general_ledger_infos);

        return view('backend.account.credit_voucher_view', compact('general_ledger_infos', 'general_ledger', 'date_from', 'date_to','acc_name'));
    }
    public function credit_voucher_print($transaction_head,$date_from,$date_to)
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

        return view('backend.account.credit_voucher_print', compact('general_ledger_infos','PreBalance', 'preDebCre', 'transaction_head', 'date_from', 'date_to'));
    }
}
