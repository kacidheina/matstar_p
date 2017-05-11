@extends('layouts.app')
@section('title') Shpenzimet @endsection
@section('page_level_plugins_head')
    <link href="{{URL::asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
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
                                    <td>{{$expense->date}}</td>
                                    <td>@if($expense->status == 'done')<button class="btn btn-success">I shpenzuar</button> @else <button class="btn btn-danger">I planifikuar</button>@endif</td>
                                    <td><p hidden>{{$expense->created_at}}</p> Nga: <b>{{$expense->creator->name}}</b> <br> Me: <b>{{date('g:i a, F j, Y',strtotime($expense->created_at))}}</b> </td>
                                    <td><p hidden>{{$expense->updated_at}}</p> Nga: <b>@if($expense->user_modify_id != 0){{$expense->modifier->name}} @else I pa modifikuar @endif</b> <br> Me: <b>@if($expense->updated_at == '0000-00-00 00:00:00'){{date('g:i a, F j, Y',strtotime($expense->updated_at))}} @else I pa modifikuar  @endif</b> </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Veprime<span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li><a class="show_descr_debt" data-href-descr="{{url('view_expenses',$expense->id)}}" data-id-get = {{ $expense->id }}  ><i class="fa fa-eye"></i>Shiko Shenim</a></li>
                                                <li><a data-get-id="{{$expense->id}}" data-href="{{url('edit_expenses',$expense->id)}}" class="modify_debt"><i class="fa fa-edit"></i>Ndrysho</a></li>
                                                <li><a class="delete_expense" data-id = {{ $expense->id }}  ><i class="fa fa-trash"></i>Fshij</a></li>
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

    <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Shenim.</h4>
                </div>
                <div class="modal-body" id="modalBody"> </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Mbyll</button>
                    {{--<button type="button" class="btn green">Save changes</button>--}}
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
@endsection

@section('page_level_scripts_foot')
    <script src="{{URL::asset('assets/pages/scripts/table-datatables-scroller.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        $('.delete_expense').click(function () {
            $('#basic').modal('show');
        });

        $("#sample_editable_1_new").click(function () {
            window.location = $(this).attr('data-href');
        });

    </script>
@endsection