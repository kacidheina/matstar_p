@extends('layouts.app')
@section('title') Shiko Artikullin @endsection
@section('page_level_plugins_head')
    <link href="{{URL::asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{URL::asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css')}}" rel="stylesheet" type="text/css"/>
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
                            <table class="table table-striped table-bordered table-hover" id="categories_table">
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
                                        <td> <p hidden>{{$entry->created_at}}</p>{{Jenssegers\Date\Date::parse($entry->created_at)->format('j M Y')}}</td>
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
                            <table class="table table-striped table-bordered table-hover" id="categories_table">
                                <thead>
                                <tr>
                                    <th> ID </th>
                                    <th> Data e Hyrjes</th>
                                    <th> Ngjyra</th>
                                    <th> Numri</th>
                                    <th> Sasia</th>
                                    <th> Blere (LEV)</th>
                                    <th> Dogana (LEK)</th>
                                    <th> Totali (LEK)</th>
                                    <th> Shtuar </th>
                                    <th> Ndryshuar</th>
                                    <th> Veprime </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($product->variations as $key=>$variation)
                                    <tr id="idRow{{$variation->id}}">
                                        <td> {{$variation->id}} </td>
                                        <td> <p hidden>{{$variation->entry->created_at}}</p>{{Jenssegers\Date\Date::parse($variation->entry->created_at)->format('j M Y')}} </td>
                                        <td> {{$variation->color->name}} <button type="button" class="btn " style="background-color: {{$variation->color->code}};height: 34px;"></button></td>
                                        <td> {{$variation->size}}</td>
                                        <td> {{$variation->quantity}}</td>
                                        <td> {{$variation->price_bought}}</td>
                                        <td> {{$variation->price_customs}}</td>
                                        <td> {{$variation->price_total}}</td>
                                        <td> <p hidden>{{$variation->created_at}}</p> <b>Nga:</b> {{$variation->creator->name}}  <br> <b>Me:</b> {{Jenssegers\Date\Date::parse($variation->created_at)->format('j M Y')}}  </td>
                                        <td> @if($variation->modifier != null) <p hidden>{{$variation->updated_at}}</p> <b>Nga:</b> {{$variation->modifier->name}} <br> <b>Me:</b>  {{Jenssegers\Date\Date::parse($variation->updated_at)->format('j M Y')}}   @else E pandryshuar. @endif</td>
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
@endsection
@section('page_level_plugins_foot')
    <script src="{{URL::asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/pages/scripts/components-bootstrap-select.min.js')}}" type="text/javascript"></script>
@endsection
@section('page_level_scripts_foot')
    <script src="{{URL::asset('assets/pages/scripts/components-bootstrap-select.min.js')}}" type="text/javascript"></script>
@endsection