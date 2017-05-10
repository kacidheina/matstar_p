@extends('layouts.app')
@section('title') Shto Ngjyre @endsection
@section('page_level_plugins_head')
    <link href="{{URL::asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/global/plugins/jquery-minicolors/jquery.minicolors.css')}}" rel="stylesheet" type="text/css" />
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
                    <a href="{{url('colors')}}">Ngjyrat</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="">Shto Ngjyre</a>
                </li>
            </ul>
            <div class="page-toolbar"></div>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Ngjyrat
            <small>Shto te Re</small>
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
                            <span class="caption-subject font-black sbold uppercase">Shto Ngjyre</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form action="{{url('add_color')}}" id="add_color_form" method="post" class="form-horizontal">
                            {{csrf_field()}}
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Emertimi
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-5">
                                        <input type="text" name="name"  data-required="1" class="form-control" placeholder="Vendos emertimin e ngjyres"/> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Ngjyra (Kodi)
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-3">
                                        <input type="text" name="code" id="hue-demo"  data-required="1"  class="form-control demo" data-control="hue" value="#ff6161"> </div>
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">Ruaj</button>
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
    <script src="{{URL::asset('assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/jquery-minicolors/jquery.minicolors.min.js')}}" type="text/javascript"></script>
@endsection
@section('page_level_scripts_foot')
    <script src="{{URL::asset('assets/pages/scripts/components-color-pickers.min.js')}}" type="text/javascript"></script>
@endsection