@extends('layouts.app')

@section('title2', 'جستجوی مشتری')

@section('content')


    <div class="row">
        <div class="col-lg-12">

            <div class="card card-primary card-outline">
                <div class="clearfix">
                    <div class="float-right  mt-3 mr-4 text-bold text-sm">
                        شماره مشتری:
                        <span> {{$customer->id}} </span>
                    </div>
                    <!-- <span class="float-left mt-3 ml-4 text-bold text-sm">
                        تاریخ:
                    <span>{{$customer->tarikh}}</span> -->
                    <div class="float-left mt-3 ml-4 text-bold text-left text-sm">
                        تاریخ ثبت:
                        <span>{{ $customer->tarikh }}</span>
                        <div class="bg-success rounded">
                         بروز رسانی:
                            <span>{{ $customer->update }}</span>
                        </div>
                    </div>
                </span>
                </div>

                <div class="card-body show-file-cbody">
                    <!-- div for form padding-->
                    <div class="col-sm-12 col-md-11 m-auto">

                        <form class="col-sm-12 col-md-8">

                            <h5 class="mb-3 mt-5 mb-4 title2 col-sm-12 col-md-11">مشخصات مشتری</h5>
                            <div class="col-sm-12 col-md-10 m-auto mt-2">
                                <div class="form-group row">
                                    <label class="col-6 col-sm-4 col-md-6">نام خانوادگی مشتری:</label>
                                    <p class="text-bold"> {{ $customer->family }}</p>
                                </div>
                                <div class="form-group row mt-4">
                                    <label class="col-6 col-sm-4 col-md-6">تلفن:</label>
                                    <p class="text-bold">
                                        <a href="tel:{{ $customer->phone }}">
                                        {{ $customer->phone }}
                                        </a>
                                    </p>
                                </div>
                            </div>

                            <h5 class="mb-3 title2 col-sm-12 col-md-11">مشخصات ملک مورد نیاز مشتری</h5>
                            <div class="col-sm-12 col-md-10 m-auto">
                                <div class="form-group row mt-3">
                                    <label class="col-6 col-sm-4 col-md-6">محدوده ها:</label>
                                    @foreach($customer->streets as $st)
                                        <p class="text-bold badge badge-info text-sm m-1">{{$st->title}}</p>
                                    @endforeach
                                </div>
                                <div class="row"></div>
                                <div class="form-group row mt-4">
                                    <label class="col-6 col-sm-4 col-md-6">متراژ:</label>
                                    <p class="text-bold">{{$customer->metr}}</p>
                                </div>
                                @if($customer->forosh == 1)
                                    <div class="form-group row mt-4">
                                        <label class="col-6 col-sm-4 col-md-6">قیمت:</label>
                                        <p class="text-bold">
                                            <span>{{$customer->price}}</span>
                                            ملیون</p>
                                    </div>
                                @else
                                    <div class="form-group row mt-3">
                                        <label class="col-6 col-sm-4 col-md-6">رهن:</label>
                                        <p class="text-bold">
                                            <span>{{$customer->rahn}}</span>
                                            ملیون</p>
                                    </div>
                                    <div class="form-group row mt-3">
                                        <label class="col-6 col-sm-4 col-md-6">اجاره:</label>
                                        <p class="text-bold">
                                            <span>{{$customer->ejare}}</span>
                                            ملیون</p>
                                    </div>
                                @endif
                            </div>

                            <h5 class="mb-3 mt-5 mb-4 title2 col-sm-12 col-md-11"> توضیحات </h5>
                            <div class="col-sm-12 col-md-10 m-auto mt-2 post-description">
                                {{$customer->tozihat}}
                            </div>
                        </form>

                        <div class="row"></div>
                        <div class="mt-5 float-left">
                            <h6>ثبت شده توسط:
                                <span class="text-bold text-sm"> {{$customer->user->name}} {{$customer->user->family}} </span>
                            </h6>
                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>

@endsection