@extends('layouts.app')

@section('title2', 'جستجوی فایل')
@section('pagetitle', $pagetitle)

@section('css')
    <link rel="stylesheet" href="/dashbord/dist/css/persian-datepicker.min.css">
    <link rel="stylesheet" href="/dashbord/dist/css/select2.min.css">
@endsection

@section('content')
    <div>
        <form method="post" action="/searchfile" class="col-12">
            @csrf
            <input type="hidden" name="forosh" value="{{$forosh}}">
            <input type="hidden" name="maskoni" value="{{$maskoni}}">
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
                        <form method="post" action="/filterfile" class="col-sm-12 mt-3 search-panel">
                            @csrf
                            <input type="hidden" name="forosh" value="{{$forosh}}">
                            <input type="hidden" name="maskoni" value="{{$maskoni}}">
                            <div class="row">
                                <div class="form-group col-6 col-sm-3 col-md-3">
                                    <label>دسته بندی</label>
                                    <select name="category" class="form-control">
                                        <option></option>
                                        @foreach($category as $cat)
                                            <option value="{{$cat->id}}">{{$cat->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-6 col-sm-3 col-md-6">
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
                                <div class="form-group col-6 col-md-3">
                                    <label> متراژ از</label>
                                    <select name="metr1" class="form-control">
                                        <option></option>
                                        @foreach($metr as $m)
                                            <option value="{{$m->id}}"> {{$m->title}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-6 col-md-3">
                                    <label> متراژ تا</label>
                                    <select name="metr2" class="form-control">
                                        <option></option>
                                        @foreach($metr as $m)
                                            <option value="{{$m->id}}"> {{$m->title}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-6 col-md-3 ml-0">
                                    <label> قیمت از</label>
                                    <select name="price1" id="price1" class="form-control">
                                        <option disabled selected hidden>قیمت از</option>
                                       @foreach($prices as $p)
                                           <option value="{{$p->price_value}}">{{$p->price_title}}</option>
                                       @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-6 col-md-3 mr-0">
                                    <label> قیمت تا</label>
                                    <select name="price2" class="form-control">
                                        <option disabled selected hidden>قیمت تا</option>
                                        @foreach($prices as $p)
                                            <option value="{{$p->price_value}}">{{$p->price_title}}</option>
                                        @endforeach
                                    </select>
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

                                <div class="form-group col-6 col-md-3">
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
                <a href="/showfile/{{$file->id}}?forosh={{$forosh}}&maskoni={{$maskoni}}" class="card-file-link">
                    <div class="card">
                        <div class="card-body p-4 @if($forosh == 1) card-file @else card-ejare @endif">
                            <div class="card-file-title ">
                                <h6 class="text-center">
                                    <span>{{$file->metr}}</span>
                                    @if(isset($file->metr))<span>متر</span>@endif
                                    <span>{{$file->street->title}}</span>
                                </h6>
                            </div>
                            <p class="text-muted text-center"> {{ $file->category->title }} </p>
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
                        <div class="card-footer text-sm">
                            <span class="text-sm">
                                {{ $file->tarikh }}
                            </span>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach

    </div>
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