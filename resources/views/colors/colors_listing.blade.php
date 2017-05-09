@extends('layouts.app')
@section('title') Ngjyrat @endsection
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
                    <a href="">Ngjyrat</a>
                </li>
            </ul>
            <div class="page-toolbar"></div>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Ngjyrat
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
                            <i class="fa fa-cubes font-dark"></i>
                            <span class="caption-subject bold uppercase">Ngjyrat</span>
                        </div>
                        <div class="tools"> </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="categories_table">
                            <thead>
                            <tr>
                                <th> Emertimi </th>
                                <th> Kodi </th>
                                <th> Ngjrya </th>
                                <th> Kijuar </th>
                                <th> Veprime </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($colors as $color)
                                <tr id="idRow{{$color->id}}">
                                    <td> {{$color->name}}</td>
                                    <td> {{$color->code}}</td>
                                    <td> <button type="button" class="btn btn-block" style="background-color: {{$color->code}};height: 34px;"></button></td>
                                    <td><p hidden>{{$color->created_at}}</p> Nga: <b>{{$color->creator->name}}</b> <br> Me: <b>{{date('g:i a, F j, Y',strtotime($color->created_at))}}</b> </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Veprime<span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{url('edit_color',$color->id)}}"><i class="fa fa-edit"></i>Ndrysho</a></li>
                                                <li><a data-id = {{ $color->id }} class="delete_category" ><i class="fa fa-trash"></i>Fshij</a></li>
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
        $('.delete_category').on('click', function () {
            if(confirm("Ky artikull do te fshihet , jeni te sigurt qe doni te vazhdoni? ")){
                var id = $(this).attr('data-id');
                $.ajax(
                    {
                        url:'{{ url('delete_color') }}' + '/' + id,
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