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
                                <form role="form">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label for="single" class="control-label">Produktet</label>
                                            <select id="product_dorpdown" class="form-control select2">
                                                <option value="">Zgjidh Produtin</option>
                                                @foreach($products as $product)
                                                    <option value="{{$product->id}}" data-content="{{json_encode(['id'=> $product->id,'code'=> $product->code, 'price_wholesale'=> $product->price_wholesale, 'price_customer'=> $product->price_customer])}}">{{$product->code}} </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="client_dropdown" class="control-label">Klienti</label>
                                            <div class="input-group select2-bootstrap-append">
                                                <select id="client_dropdown" class="form-control select2">
                                                    <option value="">Zgjidh Klientin</option>
                                                    @foreach($clients as $client)
                                                        <option value="{{$client->id}}">{{$client->name}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="input-group-btn">
                                                <button class="btn btn-default" type="button" title="Shto nje klient te ri." id="add_new_client" >
                                                    <span class="glyphicon glyphicon-plus"></span>
                                                </button>
                                            </span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Lloji i Fatures</label>
                                            <div class="radio-list">
                                                <label class="radio-inline">
                                                    <input type="radio" name="optionsRadios" id="optionsRadios4"
                                                           value="option1"> Tatimore </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="optionsRadios" id="optionsRadios5"
                                                           value="option2" checked> Jo Tatimore </label>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label>Debit</label>
                                            <div class="checkbox-list"><label class="checkbox-inline"><input type="checkbox" id="inlineCheckbox1" value="option1">Llogarit si Debit </label></div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label class="control-label">Detaje Per Faturen</label>
                                            <div>
                                                <textarea class="form-control" rows="3" name="oreder_description"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-7">
                                <div class="table-responsive" style="margin-top: 25px;">
                                    <table class="table table-hover table-bordered table-striped" id="shopping_cart_table" style="margin-bottom: 0px;">
                                        <thead>
                                        <tr>
                                            <th class="col-md-3"> Kodi i Artikullit </th>
                                            <th class="col-md-2"> Cmimi</th>
                                            <th class="col-md-3"> Sasia</th>
                                            <th class="col-md-2W"> Totali</th>
                                            <th class="col-md-2"> Veprime</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="well">
                                            <div class="row static-info align-reverse">
                                                <div class="col-md-8 name"> Cmimit Total:</div>
                                                <div class="col-md-3 value" id="cart_total_price"> 0</div>
                                            </div>
                                            <div class="row static-info align-reverse">
                                                <div class="col-md-8 name"> Klienti Pagoi:</div>
                                                <div class="col-md-3 value" id="cart_client_paid"> 0</div>
                                            </div>
                                            <div class="row static-info align-reverse">
                                                <div class="col-md-8 name"> Resto:</div>
                                                <div class="col-md-3 value" id="cart_rest"> 0</div>
                                            </div>
                                            <div class="row static-info align-reverse">
                                                <div class="col-md-8 name"> Debit:</div>
                                                <div class="col-md-3 value" id="cart_debit"> 0</div>
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
                            <button type="button" class="btn dark btn-outline" data-dismiss="modal"id="close_add_client_modal">Mbyll</button>
                            <button type="submit" class="btn green" id="save_client">Ruaj</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade bs-modal-sm" id="small" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                        <h4 class="modal-title">Zgjidhni Cmimin</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="radio-list sel_price">
                            <label class="radio-inline">
                                <input type="radio" name="optionsRadios" id="wholesale" value="option1"> Shumice </label>
                            <label class="radio-inline">
                                <input type="radio" name="optionsRadios" id="client" value="option2"> Pakice </label>
                        </div>
                    </div>
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
@endsection

@section('page_level_scripts_foot')
    <script src="{{URL::asset('assets/pages/scripts/form-icheck.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/pages/scripts/components-bootstrap-touchspin.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/pages/scripts/ecommerce-orders-view.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/custom/shopping_cart.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/pages/scripts/components-select2.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/pages/scripts/form-validation.js')}}" type="text/javascript"></script>
@endsection