@extends('layouts.app')

@section('title2', 'جستجوی مشتری')

@section('pagetitle', $pagetitle)

@section('css')
    <link rel="stylesheet" href="/dashbord/dist/css/select2.min.css">
@endsection

@section('content')

    <div>
        <form method="post" action="/searchmoshtari">
            @csrf
            <input type="hidden" name="forosh" value="{{$forosh}}">
            <div class="input-group ">
                <div class="input-group-prepend">
                    <button class="btn btn-outline-secondary" type="submit">جستجو</button>
                </div>
                <input type="text" name="searchbox" class="form-control" placeholder="نام، تلفن، توضیحات" aria-label="" aria-describedby="basic-addon1">
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
                                            <select name="price1" id="price1" class="form-control">
                                                <option disabled selected hidden>قیمت از</option>
                                                @foreach($prices as $p)
                                                    <option value="{{$p->price_value}}">{{$p->price_title}}</option>
                                                @endforeach
                                            </select>
                                            <select name="price2" class="form-control">
                                                <option disabled selected hidden>قیمت تا</option>
                                                @foreach($prices as $p)
                                                    <option value="{{$p->price_value}}">{{$p->price_title}}</option>
                                                @endforeach
                                            </select>
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
                                            <select name="rahn1" class="form-control">
                                                <option disabled selected hidden>رهن از</option>
                                                <option></option>
                                                @foreach($rahn4select as $r)
                                                    <option value="{{$r->rahn_value}}">{{$r->rahn_title}}</option>
                                                @endforeach
                                            </select>
                                            <select name="rahn2" class="form-control">
                                                <option disabled selected hidden>رهن تا</option>
                                                <option></option>
                                                @foreach($rahn4select as $r)
                                                    <option value="{{$r->rahn_value}}">{{$r->rahn_title}}</option>
                                                @endforeach
                                            </select>
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
                                            <select name="ejare1" class="form-control">
                                                <option disabled selected hidden>اجاره از</option>
                                                <option></option>
                                                @foreach($ejare4select as $r)
                                                    <option value="{{$r->ejare_value}}">{{$r->ejare_title}}</option>
                                                @endforeach
                                            </select>
                                            <select name="ejare2" class="form-control">
                                                <option disabled selected hidden>اجاره تا</option>
                                                <option></option>
                                                @foreach($ejare4select as $r)
                                                    <option value="{{$r->ejare_value}}">{{$r->ejare_title}}</option>
                                                @endforeach
                                            </select>
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
                                <th>قیمت</th>
                                <th>رهن</th>
                                <th>اجاره</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody class="text-sm">
                                <div class="d-none">{{$i = 0}}</div>
                                @foreach($customers as $customer)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td> {{ $customer->family }} </td>
                                        <td>
                                            @foreach($customer->streets as $st)
                                                <span class="badge badge-success">{{$st->title}}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $customer->phone }}
                                        </td>
                                        <td>
                                            {{ $customer->metr }}
                                        </td>
                                        <td>
                                            {{ $customer->price }}
                                        </td>
                                        <td>
                                            {{ $customer->rahn }}
                                        </td>
                                        <td>
                                            {{ $customer->ejare }}
                                        </td>
                                        <td>
                                            <a href="/deletecustomer/{{$customer->id}}">
                                                <button class="btn bg-danger text-sm py-1 px-2"> <i class="fa fa-trash"></i> حذف </button>
                                            </a>
                                            <a href="/updatecustomer/{{$customer->id}}">
                                                <button class="btn bg-warning text-sm py-1 px-2"> <i class="fa fa-edit"></i> ویرایش </button>
                                            </a>
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
    <script src="/dashbord/dist/js/plugins/select2.min.js"></script>
    <script>
        $(function (){
            $('.street').select2();
        })
    </script>
@endsection