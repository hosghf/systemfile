@extends('layouts.app')

@section('title2', 'نمایش فایل')

@section('content')
    <div class="d-none">{{$forosh = 5}} {{$maskoni = 5}}</div>
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="clearfix">
                    <div class="float-right  mt-3 mr-4 text-bold text-sm">
                        شماره فایل:
                        <span> {{$file->id}} </span>
                        @if($file->archive == 1)<span class="badge badge-danger"> آرشیو </span>@endif
                    </div>
                    <span class="float-left mt-3 ml-4 text-bold text-sm">تاریخ:
                  <span>{{ $file->created_at }}</span>
                </span>
                </div>

                <div class="card-body show-file-cbody">

                    <!-- div for form padding-->
                    <div class="col-sm-12 col-md-11 m-auto">

                        <form class="col-sm-12 col-md-8">

                            <h5 class="mb-3 mt-5 mb-4 title2 col-sm-12 col-md-11">مشخصات صاحب ملک</h5>
                            <div class="col-sm-12 col-md-10 m-auto mt-2">
                                <div class="form-group row">
                                    <label class="col-6 col-sm-4 col-md-6">نام خانوادگی مالک:</label>
                                    <p class="text-bold"> {{ $file->family }}</p>
                                </div>
                                <div class="form-group row mt-3">
                                    <label class="col-6 col-sm-4 col-md-6">تلفن:</label>
                                    <p class="text-bold text-xs">{{ $file->phone }}</p>
                                </div>
                            </div>

                            <h5 class="mb-3 title2 col-sm-12 col-md-11">مشخصات ملک</h5>
                            <div class="col-sm-12 col-md-10 m-auto">
                                <div class="form-group row">
                                    <label class="col-6 col-sm-4 col-md-6">دسته بندی:</label>
                                    <p class="text-bold"> {{$file->category == null ? '' : $file->category->title}} </p>
                                </div>
                                <div class="form-group row mt-3">
                                    <label class="col-6 col-sm-4 col-md-6">خیابان:</label>
                                    <p class="text-bold text-xs">{{ $file->street == null ? '' : $file->street->title }}</p>
                                </div>
                                <div class="form-group row mt-3">
                                    <label class="col-6 col-sm-4 col-md-6">آدرس:</label>
                                    <p class="text-bold text-xs">{{ $file->address }}</p>
                                </div>
                                <div class="form-group row mt-3">
                                    <label class="col-6 col-sm-4 col-md-6">متراژ:</label>
                                    <p class="text-bold text-xs">{{ $file->metr }}</p>
                                </div>
                                <div class="form-group row mt-3">
                                    <label class="col-6 col-sm-4 col-md-6">سند:</label>
                                    <p class="text-bold text-xs">{{ $file->sanad == null ? '' : $file->sanad->title }}</p>
                                </div>
                                <div class="form-group row mt-3">
                                    <label class="col-6 col-sm-4 col-md-6">قیمت:</label>
                                    <p class="text-bold text-xs">
                                        {{$file->price}}
                                        ملیون</p>
                                </div>
                            </div>

                            <h5 class="mb-3 mt-5 title2 col-sm-12 col-md-11">مشخصات ساختمان </h5>
                            <div class="col-sm-12 col-md-10 m-auto">
                                <div class="form-group row mt-3">
                                    <label class="col-6 col-sm-4 col-md-6">جهت ساختمان:</label>
                                    <p class="text-bold text-xs">{{$file->BuildingDirection == null ? '' : $file->BuildingDirection->title}}</p>
                                </div>
                                <div class="form-group row mt-3">
                                    <label class="col-6 col-sm-4 col-md-6">سال ساخت:</label>
                                    <p class="text-bold text-xs">{{ $file->year }}</p>
                                </div>
                                <div class="form-group row mt-3">
                                    <label class="col-6 col-sm-4 col-md-6">تعداد خواب:</label>
                                    <p class="text-bold text-xs">{{$file->room == null ? '' : $file->room->title}}</p>
                                </div>
                                <div class="form-group row mt-3">
                                    <label class="col-6 col-sm-4 col-md-6">طبقه:</label>
                                    <p class="text-bold text-xs">{{$file->tabaghe == null ? '' : $file->tabaghe->title}}</p>
                                </div>
                                <div class="form-group row mt-3">
                                    <label class="col-6 col-sm-4 col-md-6">تعداد کل طبقات:</label>
                                    <p class="text-bold text-xs">{{$file->kole_tabaghat}}</p>
                                </div>
                            </div>

                            <h5 class="mb-3 mt-5 title2 col-sm-12 col-md-11"> امکانات </h5>
                            <div class="col-sm-12 col-md-10 m-auto">
                                <div class="form-group row mt-3">
                                    <label class="col-6 col-sm-4 col-md-6"> گرمایش:</label>
                                    <p class="text-bold text-xs">{{$file->heating == null ? '' : $file->heating->title}}</p>
                                </div>
                                <div class="form-group row mt-3">
                                    <label class="col-6 col-sm-4 col-md-6">سرمایش:</label>
                                    <p class="text-bold text-xs">{{$file->cooling == null ? '' : $file->cooling->title}}</p>
                                </div>
                                <div class="form-group row mt-3">
                                    <label class="col-6 col-sm-4 col-md-6"> کابینت:</label>
                                    <p class="text-bold text-xs">{{$file->cabinet == null ? '' : $file->cabinet->title}}</p>
                                </div>
                                <div class="form-group row mt-3">
                                    <label class="col-6 col-sm-4 col-md-6">کف:</label>
                                    <p class="text-bold text-xs">{{$file->floor == null ? '' : $file->floor->title}}</p>
                                </div>
                                <div class="form-group row mt-3">
                                    <label class="col-6 col-sm-4 col-md-6">پارکینگ:</label>
                                    @if($file->parking == 1)<p class="text-bold text-xs">دارد</p> @endif
                                    @if($file->parking == 2)<p class="text-bold text-xs">ندارد</p> @endif
                                    @if($file->parking == '')<p class="text-bold text-xs">نامشخص</p> @endif
                                </div>
                                <div class="form-group row mt-3">
                                    <label class="col-6 col-sm-4 col-md-6">انباری:</label>
                                    @if($file->anbari == 1)<p class="text-bold text-xs">دارد</p> @endif
                                    @if($file->anbari == 2)<p class="text-bold text-xs">ندارد</p> @endif
                                    @if($file->anbari == '')<p class="text-bold text-xs">نامشخص</p> @endif
                                </div>
                                <div class="form-group row mt-3">
                                    <label class="col-6 col-sm-4 col-md-6">آسانسور:</label>
                                    @if($file->asansor == 1)<p class="text-bold text-xs">دارد</p> @endif
                                    @if($file->asansor == 2)<p class="text-bold text-xs">ندارد</p> @endif
                                    @if($file->asansor == '')<p class="text-bold text-xs">نامشخص</p> @endif
                                </div>
                            </div>

                            @if(count($file->facilities) > 0)
                                <h5 class="mt-5 mb-2 title2 col-sm-12 col-md-11"> سایر امکانات </h5>
                                <div class="col-sm-12 col-md-10 m-auto mt-2 clearfix">
                                    @foreach($file->facilities as $faci)
                                        <div class="float-right mt-4 ml-4">
                                            <img height="20px" width="25px" src="/dashbord/dist/img/check.png">
                                            <span>{{$faci->value}}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <h5 class="mb-3 mt-5 mb-4 title2 col-sm-12 col-md-11"> توضیحات </h5>
                            <div class="col-sm-12 col-md-10 m-auto mt-2 post-description">
                                {{$file->tozihat}}
                            </div>
                        </form>

                        <div class="row"></div>
                        <div class="mt-5 float-left">
                            <h6>ثبت شده توسط:
                                <span class="text-bold text-sm"> وحید حیدری </span>
                            </h6>
                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body melk-action-card px-2">
                    <div class="row">
                        <a href="/deletefile/{{$file->id}}" class="btn btn-danger btn-file-action col-4 m-0 text-sm text-bold"><i class="fa fa-trash"></i> حذف </a>
                        <a href="/updatefile/{{$file->id}}" class="btn btn-warning btn-file-action col-4 m-0 text-sm text-bold"><i class="fa fa-edit"></i> ویرایش </a>
                        <a href="/arichivefile/{{$file->id}}" class="btn btn-info btn-file-action col-4 m-0 text-sm text-bold"><i class="fa fa-archive"></i> آرشیو </a>
                    </div>
                </div><!-- /.card-body -->
            </div>
        </div>
    </div>

@endsection