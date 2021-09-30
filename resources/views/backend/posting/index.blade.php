@extends('backend._partial.dashboard')
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class=""></i> All Posting </h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"> <a href="{!! route('transaction.create') !!}" class="btn btn-sm btn-primary" type="button">Add Posting </a></li>
            </ul>
        </div>
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Posting Table</h3>
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th width="5%">#Id</th>
                        <th>Date</th>
                        <th width="10%">Voucher Type</th>
                        <th width="10%">Voucher No</th>
                        <th width="45%">Description</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($transactions as $key => $transaction)

                        @php
                            $current_transactions = \Illuminate\Support\Facades\DB::table('transactions')
                                                ->where('voucher_type_id',$transaction->voucher_type_id)
                                                ->where('voucher_no',$transaction->voucher_no)
                                                ->first();
//dd($current_transactions)
                        @endphp
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $current_transactions->date}}</td>
                        <td>
                            @php
                                echo \App\VoucherType::where('id',$transaction->voucher_type_id)->pluck('name')->first();
                            @endphp
                        </td>
                        <td> @php
                                echo \App\VoucherType::where('id',$transaction->voucher_type_id)->pluck('name')->first();
                            @endphp -{{ $current_transactions->voucher_no}}
                        </td>
                        <td> {{ $transaction->transaction_description}} </td>
{{--                        <td>--}}
{{--                            <div class="form-group col-md-2">--}}
{{--                                <label class="switch" style="margin-top:40px;">--}}
{{--                                    <input onchange="update_authorized(this)" value="{{ $current_transactions->id }}" {{$current_transactions->authorized == 1? 'checked':''}} type="checkbox" >--}}
{{--                                    <span class="slider round"></span>--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            <div class="form-group col-md-2">--}}
{{--                                <label class="switch" style="margin-top:40px;">--}}
{{--                                    <input onchange="update_approved(this)" value="{{ $current_transactions->id }}" {{$current_transactions->approved == 1? 'checked':''}} type="checkbox" >--}}
{{--                                    <span class="slider round"></span>--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                        </td>--}}

                        <td>
                            <a href="{{ url('account/voucher-invoice/'.$transaction->voucher_type_id.'/'.$transaction->voucher_no) }}" class="btn btn-sm btn-primary float-left" style="margin-left: 5px">view</a>
                            <a href="{{ url('account/transaction-edit/'.$transaction->voucher_type_id.'/'.$transaction->voucher_no) }}" class="btn btn-sm btn-primary float-left" style="margin-left: 5px"><i class="fa fa-edit"></i></a>
                            <form method="post" action="{{ url('account/transaction-delete/'.$transaction->voucher_type_id.'/'.$transaction->voucher_no) }}">
                                @csrf
                                <button class="btn btn-sm btn-danger" style="margin-left: 5px" type="submit" onclick="return confirm('You Are Sure This Delete !')"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
                    <div class="tile-footer">
                    </div>
                </div>

            </div>

        </div>
    </main>
@endsection

@push('js')
    <script>
        function update_authorized(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }

            $.post('{{ route('update_authorized') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){

                    toastr.success('success', 'Authorization updated successfully');
                }
                else{
                    toastr.error('danger', 'Something went wrong');
                }
            });
        }
        function update_approved(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }

            $.post('{{ route('update_approved') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){

                    toastr.success('success', 'Approval updated successfully');
                }
                else{
                    toastr.error('danger', 'Something went wrong');
                }
            });
        }
    </script>
@endpush

