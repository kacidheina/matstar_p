@extends('layouts.app')
@section('title') Categories @endsection
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
                    <a href="">Kategorite e Artikujve</a>
                </li>
            </ul>
            <div class="page-toolbar"></div>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Kategorite e Artikujve
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
                            <span class="caption-subject bold uppercase">Kategorite</span>
                        </div>
                        <div class="tools"> </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="categories_table">
                            <thead>
                            <tr>
                                <th> Nr. </th>
                                <th> Emer </th>
                                <th> Krijuar</th>
                                <th> Ndryshuar </th>
                                <th> Veprime </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $key=>$category)
                            <tr>
                                <td> {{$key+1}} </td>
                                <td> {{$category->name}}</td>
                                <td><p hidden>{{$category->created_at}}</p> Nga: <b>{{$category->creator}}</b> <br> Me: <b>{{date('g:i a, F j, Y',strtotime($category->created_at))}}</b> </td>
                                <td>@if($category->modifier != null) <p hidden>{{$category->updated_at}}</p> Nga: <b>{{$category->modifier}}</b> <br> Me: <b>{{date('g:i a, F j, Y',strtotime($category->updated_at))}}</b>@else E pandryshuar. @endif</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Veprime<span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{url('edit_category',$category->id)}}"><i class="fa fa-edit"></i>Ndrysho</a></li>
                                            <li><a href="{{url('delete_category',$category->id)}}" class="delete_category" onclick="myFunction()"><i class="fa fa-trash"></i>Fshij</a></li>
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
        function myFunction() {
            confirm("Kujdes!!! Te gjithe produktet e kesaj kategorie do te fshihen. Jeni te sigurte qe doni te vazhdoni ? ");
        }
    </script>
@endsection