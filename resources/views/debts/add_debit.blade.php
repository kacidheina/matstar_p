@extends('layouts.app')
@section('title') Shto Debit @endsection
@section('page_level_plugins_head')
    <link href="{{URL::asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{url('/')}}">Faqja Kryesore</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{url('products')}}">Debitet e Dyqanit</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="">Shto Debit</a>
                </li>
            </ul>
            <div class="page-toolbar"></div>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Shto Debit
            <small>Shto te ri</small>
        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet light portlet-fit portlet-form bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-plus font-black"></i>
                            <span class="caption-subject font-black sbold uppercase"> Shto Debit</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form action="{{url('add_debit')}}" id="add_debit_form" method="post" class="form-horizontal">
                            {{csrf_field()}}
                            <div class="form-body">

                                <div class="form-group">
                                    <label class="control-label col-md-3">Shuma
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-5">
                                        <input type="text" name="sum"  data-required="1" class="form-control" placeholder="Vendos shumen e borxhit" /> </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Klienti Kreditor
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-5">
                                        <input type="text" name="creditor_client"  data-required="1" class="form-control" placeholder="Vendos emrin e klientit kreditor" /> </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Data Borxhit</label>
                                    <div class="col-md-5">
                                        <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                            <input type="text" class="form-control" readonly name="dateDebt">
                                            <span class="input-group-btn">
                                                            <button class="btn default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                        </div>
                                        <!-- /input-group -->
                                        <span class="help-inline"> Zgjidh daten e borxhit </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Data Pageses Borxhit</label>
                                    <div class="col-md-5">
                                        <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                            <input type="text" class="form-control" readonly name="datePaymentClient">
                                            <span class="input-group-btn">
                                                            <button class="btn default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                        </div>
                                        <!-- /input-group -->
                                        <span class="help-inline"> Zgjidh daten e pageses se borxhit</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Shenim
                                    </label>
                                    <div class="col-md-5">
                                        <textarea class="wysihtml5 form-control" rows="6" name="description" data-error-container="#editor1_error"></textarea>
                                        <div id="editor1_error"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">Shto</button>
                                        <button type="button" class="btn grey-salsa btn-outline">Mbyll</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                </div>
                <!-- END VALIDATION STATES-->
            </div>
        </div>
    </div>
@endsection
@section('page_level_plugins_foot')
    <script src="{{URL::asset('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/bootstrap-markdown/lib/markdown.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('/assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js')}}" type="text/javascript"></script>
@endsection
@section('page_level_scripts_foot')
    <script>

    </script>
@endsection