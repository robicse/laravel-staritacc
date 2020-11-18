@extends('backend._partial.dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class=""></i> All Due Sale</h1>
            </div>
            {{--            <ul class="app-breadcrumb breadcrumb">--}}
            {{--                <li class="breadcrumb-item"> <a href="{!! route('productSales.create') !!}" class="btn btn-sm btn-primary" type="button">Add Product Sales</a></li>--}}
            {{--            </ul>--}}
        </div>
        <div class="col-md-12">
            <div class="tile">

                <h3 class="tile-title">Customer Due</h3>
                <table id="example1" class="table table-bordered table-striped">

                    <thead>
                    <tr>
                        <th width="5%">#Id</th>
                        <th>Customer Name</th>
                        <th>Date</th>
                        <th>Total Amount</th>
                        <th>Paid Amount</th>
                        <th>Due Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($serviceSales as $key => $serviceSale)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $serviceSale->customer->name}}</td>
                            <td>{{ $serviceSale->date}}</td>
                            <td>{{ $serviceSale->total_amount}}</td>
                            <td>{{ $serviceSale->paid_amount}}</td>
                            <td>{{ $serviceSale->due_amount}}
                                @if($serviceSale->total_amount != $serviceSale->paid_amount)
                                    <a href="" class="btn btn-warning btn-sm mx-1" data-toggle="modal" data-target="#exampleModal-<?= $serviceSale->id;?>"> Pay Due</a>
                                @endif
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal-{{$serviceSale->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Pay Due</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('pay.due')}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="due">Enter Due Amount</label>
                                                <input type="hidden" class="form-control" name="service_sale_id" value="{{$serviceSale->id}}">
                                                <input type="number" class="form-control" id="due" aria-describedby="emailHelp" name="new_paid" min="" max="{{$serviceSale->due_amount}}" placeholder="Enter Amount">
                                            </div>
                                            <div class="form-group">
                                                <label for="payment_type">Payment Type</label>
                                                <select name="payment_type" id="payment_type" class="form-control" required>
                                                    <option value="cash" selected>cash</option>
                                                    <option value="check">check</option>
                                                </select>
                                                <span>&nbsp;</span>
                                                <input type="text" name="check_number" id="check_number" class="form-control" placeholder="Check Number">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @push('js')
                                    <script>
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
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
                <div class="tile-footer">
                </div>
                {{--                {{ $parties->links() }}--}}
            </div>

        </div>
    </main>
@endsection


