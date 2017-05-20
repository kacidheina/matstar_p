@extends('layouts.app')
@section('title') Debitet e Dyqanit @endsection
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
                    <a href="">Debitet e Dyqanit</a>
                </li>
            </ul>
            <div class="page-toolbar"></div>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Debitet
            <small>e Dyqanit</small>
        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->


        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="fa fa-cubes font-dark"></i>
                            <span class="caption-subject bold uppercase">Debitet e Dyqanit</span>
                        </div>
                        <div class="tools">
                            <button id="sample_editable" data-href="{{url('create_debit')}}" class="btn sbold green"> Shto Debit
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="debts_table">
                            <thead>
                            <tr>
                                <th> Nr </th>
                                <th> Shuma </th>
                                <th> Subjekti </th>
                                <th> Statusi </th>
                                <th> Data </th>
                                <th> Krijuar </th>
                                <th> Modifikuar </th>
                                <th> Veprime </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($company_debts as $key => $company_debt)
                                <tr id="idRow{{$company_debt->id}}">
                                    <td> {{$key+1}}</td>
                                    <td> {{$company_debt->sum}}</td>
                                    <td> {{$company_debt->creditor_client}}</td>
                                    <td id="status{{$company_debt->id}}"> @if($company_debt->status == 'unpaid') <button class="btn btn-danger">PaPaguar</button> @else @if($company_debt->datePaymentClient != '0000-00-00 00:00:00')<button class="btn btn-success">I Paguar <br> Me :{{ $company_debt->datePaymentClient }}</button> @endif @endif</td>
                                    <td> {{$company_debt->dateDebt}} </td>
                                    <td><p hidden>{{$company_debt->created_at}}</p> Nga: <b>{{$company_debt->creator->name}}</b> <br> Me: <b>{{date('g:i a, F j, Y',strtotime($company_debt->created_at))}}</b> </td>
                                    <td>
                                        <p hidden>{{$company_debt->updated_at}}</p>
                                        Nga:
                                        @if($company_debt->modifier != null or $company_debt->modifier != 0)
                                            <b>{{$company_debt->modifier->name}}</b>
                                        @else
                                            <b>Pa Modifikuar</b>
                                        @endif

                                        <br> Me:
                                        @if($company_debt->updated_at != null or $company_debt->updated_at != "0000-00-00 00:00:00")
                                            <b>{{date('g:i a, F j, Y',strtotime($company_debt->updated_at))}}</b>
                                        @else
                                            <b>Pa Modifikuar</b>
                                        @endif

                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Veprime<span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li><a class="show_descr_debt" data-href-descr="{{url('view_debit',$company_debt->id)}}" data-id-get = {{ $company_debt->id }}  ><i class="fa fa-eye"></i>Shiko Shenim</a></li>
                                                <li><a data-get-id="{{$company_debt->id}}" data-href="{{url('update_debit',$company_debt->id)}}" class="modify_debt"><i class="fa fa-edit"></i>Ndrysho</a></li>
                                                <li><a class="delete_debt" data-id = {{ $company_debt->id }}  ><i class="fa fa-trash"></i>Fshij</a></li>
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

    <div class="modal fade bs-modal-lg" id="confirm" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Kujdes!</h4>
                </div>
                <div class="modal-body">Ju jeni duke fshire te dhena te rendesishme. A jeni te sigurte qe doni te vazhdoni? </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Jo</button>
                    <button type="button" class="btn green" id="delete">Po</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Modifiko Te Dhenat</h4>
                    </div>
                    <div class="modal-body">
                        <form id="add_payment_form_modal" class="form-horizontal">
                            <div class="form-body">

                                <div class="form-group">
                                    <label class="control-label col-md-3">Status
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-8">
                                        <select id="status" name="status" class="form-control select2">
                                            <option value="">Zgjidh...</option>
                                            <option value="paid">I Paguar</option>
                                            <option value="unpaid">Pa Paguar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Data Pageses</label>
                                    <div class="col-md-8">
                                        <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                            <input type="text" class="form-control" readonly name="datepicker">
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

    <div class="modal fade" id="showDescr" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Shenim.</h4>
                </div>
                <div class="modal-body" id="modalBody"> </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Mbyll</button>
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
    <script src="{{URL::asset('assets/pages/scripts/table-datatables-colreorder.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/pages/scripts/form-validation.min.js')}}" type="text/javascript"></script>
    <script>


        $("#sample_editable").click(function () {
            window.location = $(this).attr('data-href');
        });

        $('.delete_debt').on('click', function () {

            var id = $(this).attr('data-id');
           $('#confirm').modal({show:true}).on('click', '#delete', function (e) {
                $.ajax(
                    {
                        url:'{{ url('delete_debit') }}' + '/' + id,
                        type: 'GET',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {
                            "id": id
                        },
                        success: function (data)
                        {
                            console.log(data);
                            if(data.error === 'false'){

                                $('#idRow'+id).remove();
                                $('#confirm').modal('hide')
                            }

                        }
                    });
           });

        });

        var path,id;
        $('.modify_debt').on('click', function () {
             path = $(this).attr('data-href');
             id = $(this).attr('data-get-id');
            $('#basic').modal({show:true});

        });

             $("#add_payment_form_modal").submit( function (event) {
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
                        console.log(data);
//                        notification_handler(false,data['message']);
                        if (data.type === "success") {

                        $('#basic').modal('hide');
                        if(data.data['status'] === 'unpaid'){ var status = '<button class="btn btn-danger">PaPaguar</button>'}else{ status = '<button class="btn btn-success">I Paguar<br> Me : '+data.data['datePaymentClient']+' </button>'}
                        $('#status'+id).html(status);
                        document.getElementById("add_payment_form_modal").reset();
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


        $('.show_descr_debt').click(function()  {
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
                    $("#modalBody").text(data.description);
                    $("#showDescr").modal('show');

                },
                error: function (data) {
//                        notification_handler(true,data['message']);
                    console.log(data);
                }
            });

        });

    </script>
@endsection