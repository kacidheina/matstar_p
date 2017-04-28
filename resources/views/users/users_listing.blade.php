@extends('layouts.app')
@section('title') Perdoruesit @endsection
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
                    <a href="">Perdoruesit</a>
                </li>
            </ul>
            <div class="page-toolbar"></div>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Perdoruesit
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
                            <i class="fa fa-tags font-dark"></i>
                            <span class="caption-subject bold uppercase">Perdoruesit</span>
                        </div>
                        <div class="tools"> </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="categories_table">
                            <thead>
                            <tr>
                                <th> Nr. </th>
                                <th> Emer & Mbiemer</th>
                                <th> Email </th>
                                <th> Status </th>
                                <th> Krijuar</th>
                                <th> Veprime </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $key=>$user)
                                <tr id="idRow{{ $user->id }}">
                                    <td> {{$key+1}} </td>
                                    <td> {{$user->name}}</td>
                                    <td> {{$user->email}}</td>
                                    <td align="center"> @if($user->status == 'active') <span class="label label-sm label-success"> Aktiv </span> @else  <span class="label label-sm label-danger"> Inaktiv </span> @endif</td>
                                    <td><p hidden>{{$user->created_at}}</p> By: <b>{{$user->creator}}</b> <br> By: <b>{{date('g:i a, F j, Y',strtotime($user->created_at))}}</b> </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Veprime<span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{url('edit_user',$user->id)}}"><i class="fa fa-edit"></i>Ndrysho</a></li>
                                                <li><a data-userName = {{ $user->name }} class="delete_user" onclick="deleteFunction(this)"  data-id = {{ $user->id }}>
                                                    <i class="fa fa-trash"></i>Fshij
                                                    </a>
                                                </li>
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
@endsection
@section('page_level_plugins_foot')
    <script src="{{URL::asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
@endsection

@section('page_level_scripts_foot')
    <script src="{{URL::asset('assets/pages/scripts/table-datatables-colreorder.js')}}" type="text/javascript"></script>
    <script>
        function deleteFunction(t) {
            var name = $(t).attr('data-userName');
            var id = $(t).attr('data-id');
            if(confirm("Ju po fshini kete " + name + ",jeni te sigurte qe doni te vazhdoni? ")){

                $.ajax(
                    {
                        url:'{{ url('delete_user') }}' + '/' + id,
                        type: 'GET',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {
                            "id": id
                        },
                        success: function (data)
                        {
                            console.log(data.error);
                            if(data.error){
                               alert(data.message);
                               $('#idRow'+id).remove();
                            }

                        }
                    });

            }
        }
    </script>
@endsection