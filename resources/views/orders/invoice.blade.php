@extends('layouts.app')
@section('title') Fatura @endsection
@section('page_level_styles_head')
    <link href="{{URL::asset('assets/pages/css/invoice-2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="page-content">
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="invoice-content-2 bordered" id="print_area">
            <div class="row invoice-head">
                <div class="col-md-5 col-xs-6">
                    <div class="invoice-logo">
                        <img src="{{asset('assets/pages/img/logos/logo2.jpg')}}" width="200" class="img-responsive" alt="" />
                    </div>
                </div>
                <div class="col-md-2 col-xs-6">
                    <h5 class="uppercase">Fature Jo Tatimore</h5>
                </div>
                <div class="col-md-5 col-xs-6">
                    <div class="company-address">
                        <span class="bold uppercase">Mat Star Albania</span>
                        <br/> <span class="bold">Rr :</span> Ferit Xhajko
                        <br/> 40 m Poshte Kryqezimit
                        <br/> Tek Farmacia 10
                        <br/>
                        <span class="bold">Tel :</span> +355 069 2622 147
                        <br/> Tirane, AL
                    </div>
                </div>
            </div>
            <div class="row invoice-cust-add">
                <div class="col-xs-6">
                    <h2 class="invoice-title uppercase">Klienti</h2>
                    <p>Emer: <strong>{{$order->client->name}}</strong> <br>NIPT: <strong>{{$order->client->nipt}}</strong>  <br>Tel: <strong>{{$order->client->phone}}</strong> <br>Qyteti: <strong>{{$order->client->city}}</strong> </p>
                </div>
                <div class="col-xs-6">
                    <h2 class="invoice-title uppercase">Data e Faturimit</h2>
                    <p class="invoice-desc">{{Jenssegers\Date\Date::parse($order->created_at)->format('H:i , j M Y')}} &nbsp;&nbsp;&nbsp;({{Jenssegers\Date\Date::parse($order->created_at)->format('d.m.Y')}})</p>
                </div>
            </div>
            <div class="row invoice-body">
                <div class="col-xs-12 table-responsive">
                    {{--{{dump($order->orderItems)}}--}}
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th class="invoice-title uppercase">Produkti (Kodi)</th>
                            <th class="invoice-title uppercase text-center">Cmim /Cope</th>
                            <th class="invoice-title uppercase text-center">Sasia</th>
                            <th class="invoice-title uppercase text-center">Totali</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->orderItems as $order_item)
                        <tr>
                            <td>
                                <h3>{{$order_item->variation->product->code}} ({{$order_item->variation->product->name}})</h3>
                                <p> <strong> Kateogoria : </strong> <u>{{$order_item->variation->product->category->name}}</u> <br> <strong>Numer : </strong> <u>{{$order_item->variation->size}}</u> &nbsp;&nbsp;  <strong>Ngjyra : </strong> <u>{{$order_item->variation->color->name}}</u></p>
                            </td>
                            <td class="text-center sbold">{{$order_item->price_sold}} LEK</td>
                            <td class="text-center sbold">{{$order_item->quantity}}</td>
                            <td class="text-center sbold">{{$order_item->price_total}} LEK</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row invoice-subtotal">
                <div class="col-xs-3">
                    <h2 class="invoice-title uppercase">U paguan</h2>
                    <p class="invoice-desc">{{$order->client_paid}} LEK</p>
                </div>
                <div class="col-xs-3">
                    <h2 class="invoice-title uppercase">Resto</h2>
                    <p class="invoice-desc">@if($order->order_total < $order->client_paid) {{$rest}}@else 0 @endif LEK</p>
                </div>
                <div class="col-xs-3">
                    <h2 class="invoice-title uppercase">Debit</h2>
                    <p class="invoice-desc">@if($order->order_total > $order->client_paid) {{$debt}} @else 0 @endif LEK</p>
                </div>
                <div class="col-xs-3">
                    <h2 class="invoice-title uppercase">Total</h2>
                    <p class="invoice-desc grand-total">{{$order->order_total}} LEK</p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <a class="btn btn-lg green-haze hidden-print uppercase print-btn" onclick="javascript:window.print();">Printo Faturen</a>
                </div>
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
@endsection
@section('page_level_plugins_foot')
    <script src="{{URL::asset('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}" type="text/javascript"></script>
@endsection
@section('page_level_scripts_foot')
@endsection