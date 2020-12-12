@extends('layouts.app')

@section('title2', 'فایل های من')
@section('pagetitle', $pagetitle)

@section('css')
    <link rel="stylesheet" href="/dashbord/dist/css/persian-datepicker.min.css">
    <link rel="stylesheet" href="/dashbord/dist/css/select2.min.css">
@endsection

@section('content')
    @if(session()->has('message'))
        <div class="alert alert-warning alert-dismissible text-sm">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session()->get('message') }}
        </div>
    @endif
    <div>
        <form method="post" action="/mysearchfile" class="col-12">
            @csrf
            <input type="hidden" name="forosh" value="{{$forosh}}">
            <input type="hidden" name="archive" value="{{$archive}}">
            <div class="input-group ">
                <div class="input-group-prepend">
                    <button class="btn btn-outline-secondary" type="submit">جستجو</button>
                </div>
                <input type="text" name="searchbox" class="form-control" placeholder="نام، تلفن، توضیحات و آدرس" aria-label="" aria-describedby="basic-addon1">
            </div>
        </form>
    </div>

    <div class="row mt-2">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body" id="card-search-panel">
                    <!-- div for form padding-->
                    <div class="col-sm-12 col-md-11 m-auto">
                        <form method="post" action="/myfilterfile" class="col-sm-12 mt-3 search-panel">
                            @csrf
                            <input type="hidden" name="forosh" value="{{$forosh}}">
                            <input type="hidden" name="archive" value="{{$archive}}">
                            <div class="row">
                                <div class="form-group col-12 col-sm-3 col-md-6">
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
                                <div class="form-group col-6 col-sm-3 col-md-3">
                                    <label>دسته بندی</label>
                                    <select name="category" class="form-control">
                                        <option></option>
                                        @foreach($category as $cat)
                                            <option value="{{$cat->id}}">{{$cat->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-3 col-6 col-md-3">
                                    <label> سال ساخت </label>
                                    <select name="year" class="form-control">
                                        <option></option>
                                        <option value="1">حداکثر 1 سال</option>
                                        <option value="2">حداکثر 2 سال</option>
                                        <option value="5">حداکثر 5 سال</option>
                                        <option value="10">حداکثر 10 سال</option>
                                        <option value="15">حداکثر 15 سال</option>
                                        <option value="20">حداکثر 20 سال</option>
                                        <option value="30">حداکثر 30 سال</option>
                                    </select>
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
                                            <input name="price1" class="form-control">
                                            {{--<select name="price2" class="form-control">--}}
                                                {{--<option disabled selected hidden>قیمت تا</option>--}}
                                                {{--@foreach($prices as $p)--}}
                                                    {{--<option value="{{$p->price_value}}">{{$p->price_title}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                            <input name="price2" class="form-control">
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
                                            <input class="form-control" name="rahn1">
                                            {{--<select name="rahn2" class="form-control">--}}
                                                {{--<option disabled selected hidden>رهن تا</option>--}}
                                                {{--<option></option>--}}
                                                {{--@foreach($rahn4select as $r)--}}
                                                    {{--<option value="{{$r->rahn_value}}">{{$r->rahn_title}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                            <input class="form-control" name="rahn2">
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
                                            <input class="form-control" name="ejare1">
                                            {{--<select name="ejare2" class="form-control">--}}
                                                {{--<option disabled selected hidden>اجاره تا</option>--}}
                                                {{--<option></option>--}}
                                                {{--@foreach($ejare4select as $r)--}}
                                                    {{--<option value="{{$r->ejare_value}}">{{$r->ejare_title}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                            <input name="ejare2" class="form-control">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                @endif
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

                                <div class="form-group col-6 col-md-6">
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
        @foreach($files as $file)
            <div class="col-12 col-sm-6 col-md-3 ">
                <a href="/showfile/{{$file->id}}?forosh={{$forosh}}" class="card-file-link">
                    <div class="card">
                        <div class="card-title pt-3 bg-black">
                            <div class="card-file-title">
                                <h6 class="text-center">
                                    <span>{{$file->metr}}</span>
                                    @if(isset($file->metr))<span>متر</span>@endif
                                    <span>{{$file->street->title}}</span>
                                </h6>
                                <div class="text-center text-sm">
                                    @if(isset($file->room))
                                        <span>{{ $file->room->title }}</span>
                                        <span>خواب</span>
                                    @endif
                                </div>
                                <div class="text-center mt-1 text-sm pb-1">
                                    {{ $file->category->title }}
                                </div>
                            </div>
                            {{--<p class="text-center">  </p>--}}
                        </div>
                        <div class="card-body p-4 @if($forosh == 1) card-file @else card-ejare @endif">
                        <ul class="list-group list-group-unbordered mb-3">
                                @if($forosh == 1)
                                    <li class="list-group-item text-sm">
                                        <b>قیمت: </b>
                                        <span>{{ number_format($file->price) }}</span>
                                        @if(isset($file->price))<span>ملیون</span>@endif
                                    </li>
                                @endif
                                @if($forosh == 0)
                                    <li class="list-group-item text-sm">
                                        <b>رهن: </b>
                                        <span>{{ number_format($file->rahn) }}</span>
                                        @if(isset($file->rahn))<span>ملیون</span>@endif
                                    </li>
                                    <li class="list-group-item text-sm">
                                        <b>اجاره: </b>
                                        <span>{{ number_format($file->ejare) }}</span>
                                        @if(isset($file->ejare))<span>ملیون</span>@endif
                                    </li>
                                @endif
                                <li class="list-group-item text-sm">
                                    <b>  نام مالک:</b>
                                    {{$file->family}}
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer bg-warning text-sm">
                            <span class="text-sm">
                                {{ $file->tarikh }}
                            </span>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach

    </div>
    <div>{{$files->links()}}</div>
@endsection

@section('js')
    <script src="/dashbord/dist/js/persian-date.min.js"></script>
    <script src="/dashbord/dist/js/persian-datepicker.min.js"></script>
    <script src="/dashbord/dist/js/plugins/select2.min.js"></script>
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