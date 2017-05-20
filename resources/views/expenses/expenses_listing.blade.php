@extends('layouts.app')
@section('title') Shpenzimet @endsection
@section('page_level_plugins_head')
    <link href="{{URL::asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
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
                    <a href="">Shpenzimet</a>
                </li>
            </ul>
            <div class="page-toolbar"></div>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Shpenzimet
            <small>Listimi</small>
        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase">Shpenzimet</span>
                        </div>
                        <div class="tools"> </div>
                    </div>
                    <div class="portlet-body">
                        <br>
                        <div class="btn-group">
                            <button id="sample_editable_1_new" data-href="{{url('create_expenses')}}" class="btn sbold green"> Shto Shpenzim
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <table class="table table-striped table-bordered table-hover order-column" id="sample_1">
                            <thead>
                            <tr>
                                <th>Shuma</th>
                                <th>Subjekti</th>
                                <th>Data</th>
                                <th>Statusi</th>
                                <th>Krijuar</th>
                                <th>Modifikuar</th>
                                <th>Veprime</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($expenses as $expense)
                                <tr id="idRow{{$expense->id}}">
                                    <td>{{$expense->sum}}</td>
                                    <td>{{$expense->subject}}</td>
                                    <td>
                                        @if($expense->date == \Carbon\Carbon::today()->format('Y-m-d'))
                                            <button data-toggle="popover" data-trigger="hover" data-placement="top" title="Kujtese" data-content="Shpenzimi duhet kryer sot" class="btn btn-danger">{{$expense->date}}</button>
                                        @else
                                            {{$expense->date}}
                                        @endif
                                       </td>
                                    <td>@if($expense->status == 'done')
                                            <button class="btn btn-success">I shpenzuar</button> @else
                                            <button class="btn btn-danger">I planifikuar</button>@endif</td>
                                    <td><p hidden>{{$expense->created_at}}</p> Nga: <b>{{$expense->creator->name}}</b>
                                        <br> Me: <b>{{date('g:i a, F j, Y',strtotime($expense->created_at))}}</b></td>
                                    <td><p hidden>{{$expense->updated_at}}</p> Nga:
                                        <b>@if($expense->user_modify_id != 0){{$expense->modifier->name}} @else I pa
                                            modifikuar @endif</b> <br> Me:
                                        <b>@if($expense->updated_at == '-0001-11-30 00:00:00')I pa
                                            modifikuar @else {{date('g:i a, F j, Y',strtotime($expense->updated_at))}}  @endif</b>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-default dropdown-toggle" type="button"
                                                    data-toggle="dropdown">Veprime<span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li><a class="show_descr_exp"
                                                       data-href-descr="{{url('view_expenses',$expense->id)}}"
                                                       data-id-get= {{ $expense->id }} ><i class="fa fa-eye"></i>Shiko
                                                        Shenim</a></li>
                                                <li><a data-get-id="{{$expense->id}}"
                                                       data-href="{{url('update_expenses',$expense->id)}}"
                                                       class="modify_exp"><i class="fa fa-edit"></i>Ndrysho</a></li>
                                                <li><a class="delete_expense" data-id= {{ $expense->id }} ><i
                                                                class="fa fa-trash"></i>Fshij</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
             </div>
         </div>
    </div>

    <div class="modal fade" id="opendeleteAction" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body" id="modalDeleteAction"> Ju jeni duke fshire kete shpenzim, nese doni te vazhdoni me kete veprim klikoni Fshij </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Mbyll</button>
                    <button type="button" class="btn green deleteAction">Fshij</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="showDescr" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Shenim.</h4>
                </div>
                <div class="modal-body" id="modalNote"> </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Mbyll</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modifyExpenseModal" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Modifiko Te Dhenat</h4>
                </div>
                <div class="modal-body">
                    <form id="add_expense_form_modal" class="form-horizontal">
                        <div class="form-body">

                            <div class="form-group">
                                <label class="control-label col-md-3">Status
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-8">
                                    <select id="status" name="status" class="form-control select2">
                                        <option value="">Zgjidh...</option>
                                        <option value="undone">I Planifikuar</option>
                                        <option value="done">I Shpenzuar</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Data</label>
                                <div class="col-md-8">
                                    <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                        <input type="text" class="form-control" readonly name="date">
                                        <span class="input-group-btn">
                                                            <button class="btn default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                    </div>
                                    <!-- /input-group -->
                                    <span class="help-block"> zgjidh daten </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Shenim
                                </label>
                                <div class="col-md-9">
                                    <textarea class="form-control" rows="6" id="statusDescr" name="description" data-error-container="#editor1_error"></textarea>
                                    <div id="editor1_error"> </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn dark btn-outline" data-dismiss="modal">Mbyll</button>
                            <button type="submit" class="btn green">Ruaj</button>
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
    <script src="{{URL::asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/bootstrap-markdown/lib/markdown.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('/assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js')}}" type="text/javascript"></script>
@endsection

@section('page_level_scripts_foot')
    <script src="{{URL::asset('assets/pages/scripts/table-datatables-scroller.min.js')}}" type="text/javascript"></script>

    <script type="text/javascript">

        $('.delete_expense').on('click', function () {
            var id = $(this).attr('data-id');
            $('#opendeleteAction').modal({show:true}).on('click', '.deleteAction',function (e) {
                $.get("{{ url('delete_expenses') }}"+'/'+id).then(function(data){
                    if(data.error === 'false'){

                    $('#idRow'+id).remove();
                    $('#opendeleteAction').modal('hide')
                    }
                    else{
                        e.preventDefault();
                    }
                });
            });

        });

        $("#sample_editable_1_new").click(function () {
            window.location = $(this).attr('data-href');
        });

        var path,id;
        $('.modify_exp').on('click', function () {
            path = $(this).attr('data-href');
            id = $(this).attr('data-get-id');
            $('#modifyExpenseModal').modal({show:true});

        });

        $("#add_expense_form_modal").submit( function (event) {
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: path,
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr("content")
                },
                success: function (data)
                {
//                        notification_handler(false,data['message']);
                    if (data.type === "success") {

                        $('#modifyExpenseModal').modal('hide');
                        if (data.data['status'] === 'undone') {
                            var status = '<button class="btn btn-danger">I planifikuar</button>'
                        }
                        else {
                            status = '<button class="btn btn-success">I Shpenzuar<br> Me : ' + data.data['date'] + ' </button>'
                        }
                        $('#status' + id).html(status);
                        document.getElementById("add_expense_form_modal").reset();
                    }
                    else{
                        event.preventDefault();
                    }
                },
                error: function (event) {
                    event.preventDefault();
//                        notification_handler(true,data['message']);
                }
            });
        });

        $('.show_descr_exp').click(function()  {
            var url = $(this).attr('data-href-descr');
            var id = $(this).attr('data-id-get');
            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr("content")
                },
                success: function (data)
                {
                    console.log(data);
                    $("#modalNote").text(data.description);
                    $("#showDescr").modal('show');

                },
                error: function (data) {
//                        notification_handler(true,data['message']);
                    console.log(data);
                }
            });

        });


            $('[data-toggle="popover"]').popover();

    </script>
@endsection