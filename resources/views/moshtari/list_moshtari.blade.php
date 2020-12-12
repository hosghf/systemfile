@extends('layouts.app')

@section('title2', 'جستجوی مشتری')

@section('pagetitle', $pagetitle)

@section('css')
    <link rel="stylesheet" href="/dashbord/dist/css/persian-datepicker.min.css">
    <link rel="stylesheet" href="/dashbord/dist/css/select2.min.css">
    <style>
        .tooltip2 {
            position: relative;
            display: inline-block;
            border-bottom: 1px dotted black;
        }
        .tooltip2 .tooltiptext {
            visibility: hidden;
            width: 300px;
            background-color: black;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;
            /* Position the tooltip */
            position: absolute;
            z-index: 1;
        }
        .tooltip2:hover .tooltiptext {
            visibility: visible;
        }

        @media screen and ( max-width: 570px ){
            li.page-item {

                display: none;
            }
            .page-item:first-child,
            .page-item:nth-child( 2 ),
            .page-item:nth-last-child( 2 ),
            .page-item:last-child,
            .page-item.active,
            .page-item.disabled {

                display: block;
            }
        }

    </style>
@endsection

@section('content')
    @if(session()->has('message'))
        <div class="alert alert-warning alert-dismissible text-sm">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session()->get('message') }}
        </div>
    @endif

    <div>
        <form method="post" action="/searchmoshtari">
            @csrf
            <input type="hidden" name="forosh" value="{{$forosh}}">

            <div class="input-group search-box">
                <div class="input-group-prepend">
                    <button class="btn btn-primary" type="submit">جستجو</button>
                </div>
                <div class="inputs">
                    <input type="text" name="searchbox" class="form-control" placeholder="نام، تلفن، توضیحات و آدرس" aria-label="" aria-describedby="basic-addon1">
                    <input type="text" name="customerNumber" class="form-control" placeholder="شماره مشتری" aria-label="" aria-describedby="basic-addon1">
                </div>
            </div>
        </form>
    </div>

    <div class="row mt-2">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body" id="card-search-panel">
                    <!-- div for form padding-->
                    <div class="col-sm-12 col-md-11 m-auto">
                        <form method="post" action="/filtermoshtari" class="col-sm-12 mt-3 search-panel">
                            @csrf
                            <input type="hidden" name="forosh" value="{{$forosh}}">
                            <div class="row">
                                <div class="form-group col-12 col-sm-12 col-md-6">
                                    <label> محدوده </label>
                                    <div class="input-group mb-3">
                                        <select multiple id="st" name="street[]" class="street col-md-12">
                                            <option></option>
                                            @foreach($street as $st)
                                                <option value="{{$st->id}}">{{$st->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label>انتخاب متراژ:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="fa fa-tachometer"></i>
                                      </span>
                                        </div>
                                        <select name="metr1" class="form-control">
                                            <option></option>
                                            <option disabled selected hidden>متراژ از</option>
                                            @foreach($metr as $m)
                                                <option value="{{$m->id}}"> {{$m->title}} </option>
                                            @endforeach
                                        </select>
                                        <select name="metr2" class="form-control">
                                            <option></option>
                                            <option disabled selected hidden>متراژ تا</option>
                                            @foreach($metr as $m)
                                                <option value="{{$m->id}}"> {{$m->title}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                            </div>
                            <div class="row">
                                @if($forosh == 1)
                                    <div class="form-group col-12 col-md-6">
                                        <label>انتخاب قیمت:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">
                                                <i class="fa fa-money"></i>
                                              </span>
                                            </div>
                                            {{--<select name="price1" id="price1" class="form-control">--}}
                                                {{--<option disabled selected hidden>قیمت از</option>--}}
                                                {{--@foreach($prices as $p)--}}
                                                    {{--<option value="{{$p->price_value}}">{{$p->price_title}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                            <input name="price1" class="form-control" placeholder="قیمت از">
                                            {{--<select name="price2" class="form-control">--}}
                                                {{--<option disabled selected hidden>قیمت تا</option>--}}
                                                {{--@foreach($prices as $p)--}}
                                                    {{--<option value="{{$p->price_value}}">{{$p->price_title}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                            <input name="price2" class="form-control" placeholder="قیمت تا">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                @elseif($forosh == 0)
                                    <div class="form-group col-12 col-md-6">
                                        <label>انتخاب رهن:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">
                                                <i class="fa fa-money"></i>
                                              </span>
                                            </div>
                                            {{--<select name="rahn1" class="form-control">--}}
                                                {{--<option disabled selected hidden>رهن از</option>--}}
                                                {{--<option></option>--}}
                                                {{--@foreach($rahn4select as $r)--}}
                                                    {{--<option value="{{$r->rahn_value}}">{{$r->rahn_title}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                            <input name="rahn1" class="form-control" placeholder="رهن از">
                                            {{--<select name="rahn2" class="form-control">--}}
                                                {{--<option disabled selected hidden>رهن تا</option>--}}
                                                {{--<option></option>--}}
                                                {{--@foreach($rahn4select as $r)--}}
                                                    {{--<option value="{{$r->rahn_value}}">{{$r->rahn_title}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                            <input name="rahn2" class="form-control" placeholder="رهن تا">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label>انتخاب اجاره:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">
                                                <i class="fa fa-money"></i>
                                              </span>
                                            </div>
                                            {{--<select name="ejare1" class="form-control">--}}
                                                {{--<option disabled selected hidden>اجاره از</option>--}}
                                                {{--<option></option>--}}
                                                {{--@foreach($ejare4select as $r)--}}
                                                    {{--<option value="{{$r->ejare_value}}">{{$r->ejare_title}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                            <input name="ejare1" class="form-control" placeholder="اجاره از">
                                            {{--<select name="ejare2" class="form-control">--}}
                                                {{--<option disabled selected hidden>اجاره تا</option>--}}
                                                {{--<option></option>--}}
                                                {{--@foreach($ejare4select as $r)--}}
                                                    {{--<option value="{{$r->ejare_value}}">{{$r->ejare_title}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                            <input name="ejare2" class="form-control" placeholder="اجاره تا">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                @endif

                                <div class="form-group col-12 col-md-6">
                                    <label>انتخاب تاریخ:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                          </span>
                                        </div>
                                        <input name="date1" placeholder="از تاریخ" autocomplete="off" class="date1 form-control ">
                                        <input name="date2" placeholder="تا تاریخ" autocomplete="off" class="date2 form-control ">
                                    </div>
                                    <!-- /.input group -->
                                </div>

                                <div class="form-group col-12 col-md-6">
                                    <label></label>
                                    <button type="submit" class="btn btn-primary text-sm col-12 mt-1">اعمال فیلتر</button>
                                </div>

                            </div>

                        </form>

                    </div>

                </div>
            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">{{$pagetitle}} </h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-widget="remove">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>

                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0 text-center">
                            <thead>
                            <tr class="table-moshtari-title" >
                                <th> # </th>
                                <th>نام</th>
                                <th>محدوده ها</th>
                                <th>تلفن</th>
                                <th>متراژ</th>
                                @if($forosh == 1) <th>قیمت</th> @endif
                                @if($forosh == 0)<th>رهن</th>
                                <th>اجاره</th>@endif
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody class="text-sm">
                                <div class="d-none"></div>
                                @foreach($customers as $customer)
                                    <tr>
                                        <td>{{ $customers->page++ }}</td>
                                        <td> {{ $customer->family }} </td>
                                        <td>
                                            {{--@foreach($customer->streets as $st)--}}
                                                {{--<span class="badge badge-success" style="font-size: 12.7px">{{$st->title}}</span>--}}
                                            {{--@endforeach--}}
                                            @if(!$customer->streets->isEmpty())
                                                @if(count($customer->streets) > 2)
                                                    <div class="tooltip2">{{$customer->streets[0]->title}}، {{$customer->streets[1]->title}}، ...
                                                        <span class="tooltiptext">
                                                            @foreach($customer->streets as $st)
                                                                {{$st->title}}،
                                                            @endforeach
                                                        </span>
                                                    </div>
                                                @else
                                                    @foreach($customer->streets as $st)
                                                        <span class="badge badge-success" style="font-size: 12.7px">{{$st->title}}</span>
                                                    @endforeach
                                                @endif
                                            @endif
                                        </td>
                                        <td class="text-bold">
                                            <a href="tel:{{ $customer->phone }}"> {{ $customer->phone }} </a>
                                        </td>
                                        <td>
                                            {{ $customer->metr }}
                                        </td>
                                        @if($forosh == 1)<td>
                                            {{ $customer->price }}
                                        </td>@endif
                                        @if($forosh == 0)<td>
                                            {{ $customer->rahn }}
                                        </td>
                                        <td>
                                            {{ $customer->ejare }}
                                        </td>@endif
                                        <td>
                                            @if($customer->user->id == auth()->user()->id)
                                                <a href="/deletecustomer/{{$customer->id}}?forosh={{$forosh}}">
                                                    <button class="btn bg-danger text-sm py-1 px-2"> <i class="fa fa-trash"></i> حذف </button>
                                                </a>
                                                <a href="/updatecustomer/{{$customer->id}}">
                                                    <button class="btn bg-warning text-sm py-1 px-2"> <i class="fa fa-edit"></i> ویرایش </button>
                                                </a>
                                            @endif
                                            <a href="/showcustomer/{{$customer->id}}">
                                                <button class="btn bg-info text-sm py-1 px-2"> <i class="fa fa-eye"></i> مشاهده </button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix text-sm">
                    {{ $customers->links() }}
                </div>
                <!-- /.card-footer -->
            </div>

        </div>

    </div>
@endsection

@section('js')
    <script src="/dashbord/dist/js/persian-date.min.js"></script>
    <script src="/dashbord/dist/js/persian-datepicker.min.js"></script>
    <script src="/dashbord/dist/js/plugins/select2.min.js"></script>
    <script>
        $(function (){
            $('.street').select2();
        })
    </script>

    <script>
        $(function (){
            $('.street').select2();
            $(document).ready(function() {
                $(".date1").persianDatepicker({
                    observer: true,
                    format: 'YYYY/MM/DD',
                    initialValue: false,
                    initialValueType: 'persian',
                    autoClose: true,
                    maxDate: 'today',
                });
                $(".date2").persianDatepicker({
                    observer: true,
                    format: 'YYYY/MM/DD',
                    initialValue: false,
                    initialValueType: 'persian',
                    autoClose: true,
                    maxDate: 'today',
                });
            });
        })
    </script>
@endsection