@extends('layouts.app')
@section('title') Krijo Porosi @endsection
@section('page_level_plugins_head')
    <link href="{{URL::asset('assets/global/plugins/icheck/skins/all.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{URL::asset('assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{URL::asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{URL::asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{URL::asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{URL::asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/pages/css/invoice-2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{url('home')}}">Faqja Kryesore</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{url('home')}}">Porosite</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="">Krijo Porosi te Re </a>
                </li>
            </ul>
            <div class="page-toolbar"></div>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Porosite
            <small>Krijo te Re</small>
        </h3>
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN ACCORDION PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-shopping-cart"></i>Porosite
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-5">
                                <form role="form" action="{{url('add_order')}}" id="add_order_form" method="post" class="form-horizontal">
                                    {{csrf_field()}}
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label for="single" class="control-label">Produktet</label>
                                            <select id="product_dorpdown" class="form-control select2">
                                                <option value="">Zgjidh Produtin</option>
                                                @foreach($products as $product)
                                                    <option value="{{$product->id}}" data-content="{{$product}}">{{$product->code}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Variacionet</label>
                                            <select id="color_dropdown" name="color" class="bs-select form-control" data-show-subtext="true">
                                                    <option value="" data-content="Color Name <span class='label color_dd' style='background-color:green;color:green'>.</span>"> </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="client_dropdown" class="control-label">Klienti</label>
                                            <div>
                                                <div class="col-md-9" style="padding-left: 0px;padding-right: 0px; ">
                                                    <select id="client_dropdown" name="client" class="form-control select2">
                                                        <option value="">Zgjidh Klientin</option>
                                                        @foreach($clients as $client)
                                                            <option value="{{$client->id}}">{{$client->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3" style="padding-left: 0px;padding-right: 0px; ">
                                                    <button class="btn btn-info btn-block" type="button" title="Shto nje klient te ri." id="add_new_client" >
                                                        <span class="glyphicon glyphicon-plus"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Lloji i Fatures</label>
                                            <div class="radio-list">
                                                <label class="radio-inline">
                                                    <input type="radio" name="bill_type" id="optionsRadios4"
                                                           value="option1"> Tatimore </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="bill_type" id="optionsRadios5"
                                                           value="option2" checked> Jo Tatimore </label>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="form-group">
                                            <label class="control-label">Detaje Per Faturen</label>
                                            <div>
                                                <textarea class="form-control" rows="3" name="order_description"></textarea>
                                            </div>
                                        </div>
                                        <input type="hidden" name="cart_details" id="cart_details">
                                        <input type="hidden" name="client_paid_final_form" id="client_paid_final_form">
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-7">
                                <div class="table-responsive" style="margin-top: 25px;" id="table_container">
                                    <table class="table table-hover table-bordered table-striped" id="shopping_cart_table" style="margin-bottom: 0px;">
                                        <thead>
                                        <tr>
                                            <th class="col-md-3"> Kodi i Artikullit </th>
                                            <th class="col-md-3"> Cmimi</th>
                                            <th class="col-md-2"> Sasia</th>
                                            <th class="col-md-2"> Totali</th>
                                            <th class="col-md-2"> Veprime</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                    <div class="empty_row"><b>Nuk ka produkte.</b></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="well">
                                            <div class="row static-info align-reverse">
                                                <div class="col-md-8 name"> Cmimit Total:</div>
                                                <div class="col-md-3 value" id="cart_total_price" style="text-align: center"> 0.00</div>
                                            </div>
                                            <div class="row static-info align-reverse">
                                                <div class="col-md-8 name"> Klienti Pagoi:</div>
                                                <div class="col-md-3 value" id="cart_client_paid">
                                                    <input type="text" class="col-md-12" id="client_paid_input"  value="0" onkeyup="get_rest_debt($(this))" style="text-align: center" data-id="'+id+'"  onkeypress="return isNumber(event)" >
                                                </div>
                                            </div>
                                            <div class="row static-info align-reverse">
                                                <div class="col-md-8 name"> Resto:</div>
                                                <div class="col-md-3 value"><span id="cart_rest" class="btn green-jungle btn-block"> 0 </span></div>
                                            </div>
                                            <div class="row static-info align-reverse">
                                                <div class="col-md-8 name"> Debit:</div>
                                                <div class="col-md-3 value"><span id="cart_debit" class="btn btn-danger btn-block"> 0 </span></div>
                                            </div>
                                            <br><br><br>
                                            <div class="row static-info align-reverse">
                                                <div class="col-md-3 name"></div>
                                                <div class="col-md-4 value"> <a class="btn btn-default" data-toggle="modal" href="#large"> Shiko Faturen </a></div>
                                                <div class="col-md-4 value"> <button id="submit_order" style="text-align: right" class="btn btn-success"> Mbyll Porosine </button></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END ACCORDION PORTLET-->
            </div>
        </div>
    </div>
    <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Shto Klient te Ri</h4>
                </div>
                <div class="modal-body">
                    <form  id="add_client_form_modal" class="form-horizontal">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Emer & Mbiemer
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-8">
                                    <input type="text" name="name"  data-required="1" class="form-control" /> </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Numer Telefoni
                                </label>
                                <div class="col-md-8">
                                    <input type="text" name="phone"  data-required="1" class="form-control" /> </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Qyteti
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-8">
                                    <input type="text" name="city"  data-required="1" class="form-control" /> </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Nipt.
                                </label>
                                <div class="col-md-8">
                                    <input type="text" name="nipt"  data-required="1" class="form-control" /> </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn dark btn-outline" data-dismiss="modal" id="close_add_client_modal">Mbyll</button>
                            <button type="submit" class="btn green" id="save_client">Ruaj</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade bs-modal-lg" id="large" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-content">
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
                                <p class="invoice-desc">Lorem Tech Co.</p>
                            </div>
                            <div class="col-xs-6">
                                <h2 class="invoice-title uppercase">Data e Faturimit</h2>
                                <p class="invoice-desc">{{\Jenssegers\Date\Date::now()->format('H:i , j M Y')}} &nbsp;&nbsp;&nbsp;({{\Jenssegers\Date\Date::now()->format('d.m.Y')}})</p>
                            </div>
                        </div>
                        <div class="row invoice-body">
                            <div class="col-xs-12 table-responsive">
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
                                    <tr>
                                        <td>
                                            <h3>Web Design & Development</h3>
                                            <p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet et dolore siat magna aliquam erat volutpat. </p>
                                        </td>
                                        <td class="text-center sbold">200</td>
                                        <td class="text-center sbold">80$</td>
                                        <td class="text-center sbold">16,000$</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3>Branding</h3>
                                            <p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod. </p>
                                        </td>
                                        <td class="text-center sbold">130</td>
                                        <td class="text-center sbold">60$</td>
                                        <td class="text-center sbold">7,800$</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row invoice-subtotal">
                            <div class="col-xs-3">
                                <h2 class="invoice-title uppercase">U paguan</h2>
                                <p class="invoice-desc">23,800$</p>
                            </div>
                            <div class="col-xs-3">
                                <h2 class="invoice-title uppercase">Resto</h2>
                                <p class="invoice-desc">0$</p>
                            </div>
                            <div class="col-xs-3">
                                <h2 class="invoice-title uppercase">Debit</h2>
                                <p class="invoice-desc">0$</p>
                            </div>
                            <div class="col-xs-3">
                                <h2 class="invoice-title uppercase">Total</h2>
                                <p class="invoice-desc grand-total">23,800$</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <a class="btn btn-lg green-haze hidden-print uppercase print-btn" onclick="print_bill();">Print</a>
                            </div>
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('page_level_plugins_foot')
    <script src="{{URL::asset('assets/global/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/icheck/icheck.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/fuelux/js/spinner.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js')}}" type="text/javascript"></script>
@endsection

@section('page_level_scripts_foot')
    <script src="{{URL::asset('assets/pages/scripts/form-icheck.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/pages/scripts/components-bootstrap-touchspin.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/pages/scripts/ecommerce-orders-view.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/custom/shopping_cart.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/pages/scripts/components-select2.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/pages/scripts/form-validation.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/custom/printThis.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/pages/scripts/components-bootstrap-select.min.js')}}" type="text/javascript"></script>
@endsection