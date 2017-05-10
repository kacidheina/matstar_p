@extends('layouts.app')
@section('title') Shiko Artikullin @endsection
@section('page_level_plugins_head')
    <link href="{{URL::asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{URL::asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/global/plugins/clockface/css/clockface.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/global/plugins/jquery-minicolors/jquery.minicolors.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
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
                    <a href="">Shiko Artikullin</a>
                </li>
            </ul>
            <div class="page-toolbar"></div>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> {{$product->name}}
            <small>Detajet</small>
        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <div class="tabbable tabbable-tabdrop">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab1" data-toggle="tab">Detaje</a>
                        </li>
                        <li>
                            <a href="#tab2" data-toggle="tab">Raporte</a>
                        </li>
                        <li>
                            <a href="#tab3" data-toggle="tab">Hyrje</a>
                        </li>
                        <li>
                            <a href="#tab4" data-toggle="tab">Variacione</a>
                        </li>
                        <li>
                            <a href="#tab5" data-toggle="tab">Imazhe</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            <div class="col-md-5">
                                <p>
                                    <strong>Kategoria :</strong> {{$product->category->name}} <br><br>
                                    <strong>Emertimi :</strong> {{$product->name}} <br><br>
                                    <strong>Kodi :</strong> {{$product->code}} <br><br>
                                    <strong>Krijuar nga :</strong> {{$product->creator->name}} <br><br>
                                    <strong>Data e Krijimit:</strong> {{Jenssegers\Date\Date::parse($product->created_at)->format(' H:i j M Y')}} <br><br>
                                    <strong>Ndryshuar nga:</strong> @if ($product->modifier != null) {{$product->modifier->name}} @else Ipandryshuar. @endif <br><br>
                                    <strong>Data e Ndryshimit:</strong> @if ($product->modifier != null) {{Jenssegers\Date\Date::parse($product->uppdated_at)->format(' H:i j M Y')}} @else I pandryshuar. @endif <br><br>
                                </p>
                            </div>
                            <div class="col-md-7">
                                <p>
                                    <strong>Pershkrim:</strong> @if($product->description != '')  {{$product->description}}  @else Nuk ka. @endif <br><br>
                                    <strong>Shenim :</strong> @if($product->note != '')  {{$product->note}}  @else Nuk ka. @endif <br><br>
                                </p>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <p> Howdy, I'm in Section 2. </p>
                        </div>
                        <div class="tab-pane" id="tab3">
                            <a class="btn btn-info sbold" style="margin-bottom: 10px;float: right;" id="create_entry_btn"><i class="fa fa-plus"></i> Shto Hyrje</a>
                            <table class="table table-striped table-bordered table-hover" id="entries_table" style="width:100%">
                                <thead>
                                <tr>
                                    <th> Nr. </th>
                                    <th> Data e Hyrjes</th>
                                    <th> Krijuar Nga</th>
                                    <th> Data e Ndryshimit </th>
                                    <th> Ndryshuar Nga </th>
                                    <th> Veprime </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($product->entries as $key=>$entry)
                                    <tr id="idRow{{$entry->id}}">
                                        <td> {{$key+1}} </td>
                                        <td> <p hidden>{{$entry->entry_date}}</p>{{Jenssegers\Date\Date::parse($entry->entry_date)->format('j M Y')}}</td>
                                        <td> {{$entry->creator->name}}</td>
                                        <td> @if($entry->modifier != null) <p hidden>{{$entry->updated_at}}</p> {{Jenssegers\Date\Date::parse($entry->updated_at)->format('j M Y')}}  @else E pandryshuar. @endif</td>
                                        <td> @if($entry->modifier != null)  {{$entry->modifier->name}}  @else E pandryshuar. @endif</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Veprime<span class="caret"></span></button>
                                                <ul class="dropdown-menu">
                                                    <li><a href=""><i class="fa fa-eye"></i>Shiko Profil</a></li>
                                                    <li><a href=""><i class="fa fa-edit"></i>Ndrysho</a></li>
                                                    <li><a class="delete_client" ><i class="fa fa-trash"></i>Fshij</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="tab4">
                            <a class="btn btn-info sbold" style="margin-bottom: 10px;float: right;" id="create_variation_btn"><i class="fa fa-plus"></i> Shto Variacion</a>
                            <table class="table table-striped table-bordered table-hover"  style="width:100%"  id="variations_table">
                                <thead>
                                <tr>
                                    <th> ID </th>
                                    <th> Hyrja</th>
                                    <th> Ngjyra</th>
                                    <th> Nr.</th>
                                    <th> Sasia</th>
                                    <th> Totali</th>
                                    <th> Shtuar </th>
                                    <th> Veprime </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($product->variations as $key=>$variation)
                                    <tr id="idRow{{$variation->id}}">
                                        <td> {{$variation->id}} </td>
                                        <td> <p hidden>{{$variation->entry->entry_date}}</p>{{Jenssegers\Date\Date::parse($variation->entry->entry_date)->format('j M Y')}} </td>
                                        <td> <div style="border: 15px solid {{$variation->color->code}};padding: 3px;width: 100%;"><p style="text-align: center;margin: 0;">{{$variation->color->name}}</p></div></td>
                                        <td> <h2><strong>{{$variation->size}}</strong></h2></td>
                                        <td> @if($variation->stock > 0) Mbetur : <strong style="float: right;">{{$variation->stock}}</strong><br>Hyre : <strong style="float: right;">{{$variation->quantity}}</strong> @else <span class="label label-danger"> Mbaruar </span> @endif</td>
                                        <td> {{$variation->price_total}}</td>
                                        <td> <p hidden>{{$variation->created_at}}</p> Nga: <b>{{$variation->creator->name}}</b>  <br> Me: <b>{{Jenssegers\Date\Date::parse($variation->created_at)->format('j M Y')}}</b>  </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Veprime<span class="caret"></span></button>
                                                <ul class="dropdown-menu">
                                                    <li><a href=""><i class="fa fa-eye"></i>Shiko Profil</a></li>
                                                    <li><a href=""><i class="fa fa-edit"></i>Ndrysho</a></li>
                                                    <li><a class="delete_client" ><i class="fa fa-trash"></i>Fshij</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="tab5">
                            <p> Howdy, I'm in Section 5. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade draggable-modal" id="add_entry_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Shto hyrje te re per kete produkt.</h4>
                </div>
                <div class="modal-body">
                    <form action="" id="add_entry_form" method="post" class="form-horizontal">
                        {{csrf_field()}}
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Data e hyrjes</label>
                                <div class="col-md-3">
                                    <div class="input-group input-medium date date-picker" data-date="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                        <input type="text" class="form-control" name="date" readonly>
                                        <span class="input-group-btn"><button class="btn default" type="button"><i class="fa fa-calendar"></i></button></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green">Ruaj</button>
                                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Mbyll</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade draggable-modal" id="add_variation_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Shto variacion te ri per kete produkt.</h4>
                </div>
                <div class="modal-body">
                    <form action="" id="add_variation_form" method="post" class="form-horizontal">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label class="control-label col-md-3">Datea e Hyrjes
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-9">
                                <select class="form-control" name="entry">
                                    <option value="">Zgjidh Daten e Hyrjes</option>
                                    @foreach($product->entries as $key=>$entry)
                                        <option value="{{$entry->id}}">{{Jenssegers\Date\Date::parse($entry->entry_date)->format('j M Y')}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="color_dropdown" class="control-label col-md-3">Ngjyra
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-9">
                                <div class="col-md-10" style="padding-left: 0px;padding-right: 0px; ">
                                    <select id="color_dropdown" name="color" class="bs-select form-control" data-show-subtext="true">
                                        <option value="">Zgjidh Ngjyren</option>
                                        @foreach($colors as $color)
                                            <option value="{{$color->id}}" data-content="{{$color->name}} <span class='label color_dd' style='background-color:{{$color->code}};color:{{$color->code}}'>.</span>"> </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2" style="padding-left: 0px;padding-right: 0px; ">
                                    <button class="btn btn-info btn-block" type="button" title="Shto nje ngjyre te re." id="add_new_color" >
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Numri
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="size"  data-required="1" class="form-control" placeholder="Vendos masen e artikullit"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Sasia
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="quantity"  data-required="1" class="form-control" placeholder="Vendos sasine e artikullit"/> </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Cmimi i Blerjes (LEV)
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="price_bought" id="price_bought" data-required="1" class="form-control" placeholder="Vendos cmimin me te cilin u ble artikulli"/> </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Dogana (LEK)
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="price_customs" id="price_customs" data-required="1" class="form-control" placeholder="Vendos tarifen doganore per artikullin"/> </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Cmimi Total (LEK)
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="price_total" id="price_total" readonly data-required="1" class="form-control" placeholder="Cmimi total i artikullit"/> </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Shenim
                            </label>
                            <div class="col-md-9">
                                <textarea class="wysihtml5 form-control" rows="6" name="note" data-error-container="#editor2_error" placeholder="Shenim per produktin"></textarea>
                                <div id="editor2_error"> </div>
                            </div>
                        </div>
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green">Ruaj</button>
                                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Mbyll</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="add_color_modal" tabindex="-1"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Shto Ngjyre</h4>
                </div>
                <div class="modal-body">
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
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('page_level_plugins_foot')
    <script src="{{URL::asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>    <script src="{{URL::asset('assets/global/plugins/jquery-ui/jquery-ui.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/moment.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/clockface/js/clockface.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/jquery-minicolors/jquery.minicolors.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js')}}" type="text/javascript"></script>
@endsection
@section('page_level_scripts_foot')
    <script src="{{URL::asset('assets/pages/scripts/ui-modals.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/pages/scripts/components-date-time-pickers.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/pages/scripts/table-datatables-colreorder.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/pages/scripts/components-color-pickers.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/pages/scripts/components-bootstrap-select.min.js')}}" type="text/javascript"></script>

    <script>
        $('#create_entry_btn').click(function () {
            $('#add_entry_modal').modal('show');
        });

        $("#add_entry_form").submit(function(e){
            var error;
            e.preventDefault();
            $.ajax(
                {
                    url: '{{url('add_entry',$product->id)}}',
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: $(this).serialize(),
                    success: function (data) {
                        if (data['error'] === true){error = 'error'}
                        else{
                            error = 'success';
                            $('#entries_table').DataTable().row.add(data['row']).draw();
                            $('#entries_table tr:last').attr('id','idRow'+data['id']);
                            $('#add_entry_modal').modal('hide');
                        }
                        notification_handler(error, data['message']);
                    },
                    error:function () {
                        notification_handler('error', 'Dicka shkoi gabim. Ju lutem provoni perseri.');
                    }
                });
        });


        $('#create_variation_btn').click(function () {
            $('#add_variation_modal').modal('show');
        });

        $("#add_variation_form").submit(function(e){
            var error;
            e.preventDefault();
            $.ajax(
                {
                    url: '{{url('add_variation',$product->id)}}',
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: $(this).serialize(),
                    success: function (data) {
                        if (data['error'] === true){error = 'error'}else{
                            error = 'success';
                            $('#variations_table').DataTable().row.add(data['row']).draw();
                            $('#variations_table').find('tr:last').attr('id','idRow'+data['id']);
                            $('#add_variation_modal').modal('hide');
                        }
                        notification_handler(error, data['message']);
                    },
                    error:function () {
                        notification_handler('error', 'Dicka shkoi gabim. Ju lutem provoni perseri.');
                    }
                });
        });

        $('#price_bought').keyup(function ()
            {
                if ($('#price_customs').val() != ''){
                    var total_price = ($('#price_bought').val() * course_lek / course_lev ) ;
                    total_price = total_price + Number($('#price_customs').val());
                    $('#price_total').val(total_price.toFixed(2));
                }
            }
        );

        $('#price_customs').keyup(function ()
            {
                if ($('#price_bought').val() != ''){
                    var total_price = ($('#price_bought').val() * course_lek / course_lev ) ;
                    total_price = total_price + Number($('#price_customs').val());
                    $('#price_total').val(total_price.toFixed(2));
                }
            }
        );


        $('#add_new_color').click(function () {
            $('#add_color_modal').modal('show');
        });

        $("#add_color_form").submit(function(e){
            var error;
            e.preventDefault();
            $.ajax(
                {
                    url: '{{url('add_color')}}',
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: $(this).serialize(),
                    success: function (data) {
                        if (data['error'] === true){error = 'error'}else{
                            error = 'success';
                            console.log(data);
                            $("#color_dropdown").append(' <option value="'+data.data.id+'" selected="" data-content="'+data.data.name+' <span class=\'label color_dd\' style=\'background-color:'+data.data.code+';color:'+data.data.code+'\'>.</span>"> </option>');
                            $("#color_dropdown").selectpicker("refresh");
                            $('#add_color_modal').modal('hide');
                        }
                        notification_handler(error, data['message']);
                    },
                    error:function () {
                        notification_handler('error', 'Dicka shkoi gabim. Ju lutem provoni perseri.');
                    }
                });
        });

    </script>
@endsection