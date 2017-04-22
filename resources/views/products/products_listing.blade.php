@extends('layouts.app')
@section('title') Artikujt @endsection
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
                    <a href="">Artikujt</a>
                </li>
            </ul>
            <div class="page-toolbar"></div>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Artikujt
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
                            <span class="caption-subject bold uppercase">Artikujt</span>
                        </div>
                        <div class="tools"> </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="categories_table">
                            <thead>
                            <tr>
                                <th> Kodi </th>
                                <th> Ngjyra </th>
                                <th> Numeracioni </th>
                                <th> Cmim Blerje</th>
                                <th> Cmim Dogane</th>
                                <th> Cmim Shumice</th>
                                <th> Cmim Klienti</th>
                                <th> Sasia </th>
                                <th> Kategoria </th>
                                <th> Veprime </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $key=>$product)
                                <tr>
                                    <td> {{$product->code}}</td>
                                    <td> {{$product->color}}</td>
                                    <td> {{$product->numbering}}</td>
                                    <td> {{$product->price_bought}}</td>
                                    <td> {{$product->price_with_customs}}</td>
                                    <td> {{$product->price_wholesale}}</td>
                                    <td> {{$product->price_customer}}</td>
                                    <td> {{$product->quantity}}</td>
                                    <td> {{$product->category}}</td><td>
                                        <div class="dropdown">
                                            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Veprime<span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{url('edit_product',$product->id)}}"><i class="fa fa-edit"></i>Ndrysho</a></li>
                                                <li><a href="{{url('delete_product',$product->id)}}" class="delete_category" onclick="myFunction()"><i class="fa fa-trash"></i>Fshij</a></li>
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
            confirm("Ky artikull do te fshihet , jeni te sigurt qe doni te vazhdoni? ");
        }
    </script>
@endsection