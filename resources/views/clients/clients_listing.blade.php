@extends('layouts.app')
@section('title') Klientet @endsection
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
                    <a href="">Klientet</a>
                </li>
            </ul>
            <div class="page-toolbar"></div>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Klientet
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
                            <span class="caption-subject bold uppercase">Klientet</span>
                        </div>
                        <div class="tools"> </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="categories_table">
                            <thead>
                            <tr>
                                <th> Nr. </th>
                                <th> Emer & Mbiemer</th>
                                <th> Nipt</th>
                                <th> Qyteti </th>
                                <th> Debiti </th>
                                <th> Nr. Telefoni </th>
                                <th> Krijuar</th>
                                <th> Veprime </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clients as $key=>$client)
                                <tr id="idRow{{$client->id}}">
                                    <td> {{$key+1}} </td>
                                    <td> {{$client->name}}</td>
                                    <td> {{$client->nipt}}</td>
                                    <td> {{$client->city}}</td>
                                    <td> @if($client->debt == 0) <span class="label label-sm label-success"> Jo Debitor </span> @else  <span class="label label-sm label-danger"> {{$client->debt}} </span> @endif</td>
                                    <td> {{$client->phone}}</td>
                                    <td><p hidden>{{$client->created_at}}</p> By: <b>{{$client->creator}}</b> <br> By: <b>{{date('g:i a, F j, Y',strtotime($client->created_at))}}</b> </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Veprime<span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{url('view_client',$client->id)}}"><i class="fa fa-eye"></i>Shiko Profil</a></li>
                                                <li><a href="{{url('edit_client',$client->id)}}"><i class="fa fa-edit"></i>Ndrysho</a></li>
                                                <li><a data-id = {{ $client->id }} data-href="{{url('delete_client',$client->id)}}" class="delete_client" ><i class="fa fa-trash"></i>Fshij</a></li>
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
        $('.delete_client').on('click', function () {
            if(confirm("Ky klient do te fshihet , jeni te sigurt qe doni te vazhdoni? ")){
                var id = $(this).attr('data-id');
                var path = $(this).attr('data-href');
                $.ajax(
                    {
                        url:path,
                        type: 'GET',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {
                            "id": id
                        },
                        success: function (data)
                        {
                            console.log(data.error);
                            if(data.error){

                                $('#idRow'+id).remove();
                            }

                        }
                    });
            }
            else{
                return false;
            }
        });

    </script>
@endsection