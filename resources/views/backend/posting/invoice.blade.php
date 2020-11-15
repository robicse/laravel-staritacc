@extends('backend._partial.dashboard')

@section('content')
    <div id="printArea">
        <style>
            /* Styles go here */

            .page-header, .page-header-space {
                height: 150px;
            }

            .page-footer, .page-footer-space {
                height: 100px;

            }

            .page-footer {
                position: fixed;
                bottom: 0;
                left: 0;
                width: 100%;
                border-top: 1px solid black; /* for demo */
                /*background: yellow;*/ /* for demo */
                /*padding: 5px 20px;*/
            }

            .page-header {
                position: fixed;
                top: 0mm;
                left: 0;
                width: 100%;
                /*height: 100px;*/
                border-bottom: 1px solid black; /* for demo */
                /*background: yellow;*/ /* for demo */
            }

            .page {
                page-break-after: always;
            }

            @page {
                /*margin: 20mm;*/
                /*size: A4;
                margin: 11mm 17mm 17mm 17mm;*/
            }

            @media screen {
                .page-header {display: none;}
                .page-footer {display: none;}
            }

            @media print {
                table { page-break-inside:auto }
                tr    { page-break-inside:auto; page-break-after:auto }
                thead { display:table-header-group }
                tfoot { display:table-footer-group }

                button {display: none;}

                body {margin: 0;}
            }

            /*custom part start*/
            .invoice {
                border-collapse: collapse;
                /*width: 100%;*/
                width: 280mm;
                text-align: center
            }
            .invoice th, .invoice td {
                border: 1px solid #000;
            }
            /*custom part end*/


        </style>
        <main class="app-content">
            <div class="row">
                <div class="col-md-12">

                    <div class="page-header" style="text-align: center">
                        <img src="{{ asset('header.png') }}" width="100%" height="150px" alt="header img">
                    </div>

                    <div class="page-footer">
                        <img src="{{ asset('footer.png') }}" width="100%" height="auto" alt="footer img">
                    </div>

                    <table>

                        <thead>
                        <tr>
                            <td>
                                <!--place holder for the fixed-position header-->
                                <div class="page-header-space"></div>
                            </td>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td>
                                <!--*** CONTENT GOES HERE ***-->
                                <div class="page" style="padding: 10px;">
                                    <h3 style="text-align: center;"><strong>Payment Voucher Invoice</strong></h3>
                                    <div style="clear: both">&nbsp;</div>
                                    <div style="clear: both">&nbsp;</div>
                                    <div class="row">
                                        <div class="col-md-4"><strong>Payment Voucher NO:</strong> {{ $credited_infos->voucher_no }}</div>
                                        <div class="col-md-4"><strong>Date:</strong> {{ $credited_infos->date }}</div>
                                        <div class="col-md-4"><strong>Remarks:</strong> {{ $credited_infos->transaction_description }}</div>
                                    </div>
                                    <div style="clear: both">&nbsp;</div>
                                    <div style="clear: both">&nbsp;</div>
                                    <table class="invoice">
                                        <tr>
                                            <th>Credit Account Name</th>
                                            <th>Credit Amount</th>
                                        </tr>
                                        <tr>
                                            <td>{{ \App\Account::where('HeadCode', $credited_infos->account_no)->pluck('HeadName')->first() }}</td>
                                            <td> {{ $credited_infos->credit }}</td>
                                        </tr>
                                    </table>
                                    <div style="clear: both">&nbsp;</div>
                                    <div style="clear: both">&nbsp;</div>
                                    <table class="invoice">
                                        <tr>
                                            <th>Debit Account Name</th>
                                            <th>Debit Amount</th>
                                        </tr>
{{--                                        @if ($count_debited_row > 0)--}}
{{--                                            @foreach ($debited_infos as $debited_info)--}}
{{--                                                <tr>--}}
{{--                                                    <td>{{ \App\Account::where('HeadCode', $debited_info->account_no)->pluck('HeadName')->first() }}</td>--}}
{{--                                                    <td>{{ $debited_info->debit }}</td>--}}
{{--                                                </tr>--}}
{{--                                            @endforeach--}}
{{--                                        @endif--}}
                                    </table>
                                </div>
                            </td>
                        </tr>
                        </tbody>

                        <tfoot>
                        <tr>
                            <td>
                                <!--place holder for the fixed-position footer-->
                                <div class="page-footer-space"></div>
                            </td>
                        </tr>
                        </tfoot>

                    </table>

                </div>
            </div>
        </main>
    </div>
    <div class="text-center" id="print" style="margin: 20px">
        <input type="button" class="btn btn-warning" name="btnPrint" id="btnPrint" value="Print" onclick="printDiv();"/>
    </div>

    <script type="text/javascript">
        function printDiv() {
            var divName = "printArea";
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            // document.body.style.marginTop="-45px";
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>

@endsection



