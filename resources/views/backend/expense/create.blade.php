@extends('backend._partial.dashboard')
<style>
    .requiredCustom{
        font-size: 20px;
        color: red;
        margin-top: 20px;
    }
</style>
@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class=""></i> Add Sales Product</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('expenses.index') }}" class="btn btn-sm btn-primary col-sm" type="button">Expenses</a>
                </li>
            </ul>
        </div>
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Add Expenses</h3>
                <div class="tile-body tile-footer">
                    @if(session('response'))
                        <div class="alert alert-success">
                            {{ session('response') }}
                        </div>
                    @endif
                    <form method="post" action="{{ route('expenses.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right">Expense Category  <small class="requiredCustom">*</small></label>
                            <div class="col-md-5">
                                <select name="expense_category_id" id="expense_category_id" class="form-control select2" required>
                                    <option value="">Select One</option>
                                    @foreach($officeCostingCategories as $officeCostingCategory)
                                        <option value="{{$officeCostingCategory->id}}">{{$officeCostingCategory->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right">Payment Type  <small class="requiredCustom">*</small></label>
                            <div class="col-md-8">
                                <select name="payment_type" id="payment_type" class="form-control" required>
                                    <option value="">Select One</option>
                                    <option value="cash">cash</option>
                                    <option value="check">check</option>
                                </select>
                                <span>&nbsp;</span>
                                <input type="text" name="check_number" id="check_number" class="form-control" placeholder="Check Number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right">Amount  <small class="requiredCustom">*</small></label>
                            <div class="col-md-8">
                                <input type="text" name="amount" id="amount" class="form-control" placeholder="Amount">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right">Date  <small class="requiredCustom">*</small></label>
                            <div class="col-md-8">
                                <input type="text" name="date" class="datepicker form-control" value="{{date('Y-m-d')}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-3"></label>
                            <div class="col-md-8">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Expense</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tile-footer">
                </div>
            </div>
        </div>
    </main>

@endsection

@push('js')
    <script>

        function modal_customer(){
            $('#category_modal').modal('show');
        }

        //new customer insert
        $("#customer_insert").submit(function(e){
            e.preventDefault();
            //var customerMess    = $("#customerMess3");
            //var customerErrr    = $("#customerErrr3");
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                dataType: 'json',
                data: $(this).serialize(),
                beforeSend: function()
                {
                    //customerMess.removeClass('hide');
                    //customerErrr.removeClass('hide');
                },
                success: function(data)
                {
                    console.log(data);
                    if (data.exception) {
                        customerErrr.addClass('alert-danger').removeClass('alert-success').html(data.exception);
                    }else{
                        $('#customer').append('<option value = "' + data.id + '"  selected> '+ data.name + ' </option>');
                        console.log(data.id);
                        $("#category_modal").modal('hide');
                    }
                },
                error: function(xhr)
                {
                    alert('failed!');
                }
            });
        });

        function hidemodal() {
            var x = document.getElementById("category_modal");
            x.style.display = "none";
        }

        $(function() {
            $('#check_number').hide();
            $('#payment_type').change(function(){
                if($('#payment_type').val() == 'check') {
                    $('#check_number').show();
                } else {
                    $('#check_number').val('');
                    $('#check_number').hide();
                }
            });
        });
    </script>
@endpush


