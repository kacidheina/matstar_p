@extends('layouts.app')
@section('title') Add New Product @endsection
@section('page_level_plugins_head')
    <link href="{{URL::asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css')}}" rel="stylesheet" type="text/css" />
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
                    <a href="{{url('products')}}">Artikujt</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="">Shto Artikull</a>
                </li>
            </ul>
            <div class="page-toolbar"></div>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Artikujt
            <small>Shto te Ri</small>
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
                            <span class="caption-subject font-black sbold uppercase">Shto Artikull</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form action="{{url('add_product')}}" id="add_product_form" method="post" class="form-horizontal">
                            {{csrf_field()}}
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Kategoria
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-5">
                                        <select class="form-control" name="category">
                                            <option value="">Zgjidh...</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Kodi
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-5">
                                        <input type="text" name="code"  data-required="1" class="form-control" placeholder="Vendos kodin e artikullit" /> </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Ngjyra
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-5">
                                        <input type="text" name="color"  data-required="1" class="form-control" placeholder="Vendos ngjyren e artikullit"/> </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Numeracioni
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-3">
                                        <input type="text" name="numbering_from"  data-required="1" class="form-control" placeholder="Numri me i vogel"/>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="numbering_to"  data-required="1" class="form-control" placeholder="Numri me i madh"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Sasia
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" name="quantity"  data-required="1" class="form-control" placeholder="Vendos sasine e artikullit"/> </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Cmimi i Blerjes (LEV)
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" name="price_bought"  data-required="1" class="form-control" placeholder="Vendos cmimin me te cilin u ble artikulli"/> </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Dogana (LEK)
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" name="price_customs"  data-required="1" class="form-control" placeholder="Vendos tarifen doganore per artikullin"/> </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Cmimi Total (LEK)
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" name="price_wholesale"  readonly data-required="1" class="form-control" placeholder="Cmimi total i artikullit"/> </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Pershkrim
                                    </label>
                                    <div class="col-md-9">
                                        <textarea class="wysihtml5 form-control" rows="6" name="description" data-error-container="#editor1_error" placeholder="Pershkrim per produktin"></textarea>
                                        <div id="editor1_error"> </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Shenim
                                    </label>
                                    <div class="col-md-9">
                                        <textarea class="wysihtml5 form-control" rows="6" name="note" data-error-container="#editor2_error" placeholder="Shenim per produktin"></textarea>
                                        <div id="editor2_error"> </div>
                                    </div>
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
@endsection
@section('page_level_scripts_foot')

@endsection