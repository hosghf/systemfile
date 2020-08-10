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
                    <span class="float-left mt-3 ml-4 text-bold text-sm">تاریخ:
                  <span>{{$customer->created_at}}</span>
                </span>
                </div>

                <div class="card-body show-file-cbody">
                    <!-- div for form padding-->
                    <div class="col-sm-12 col-md-11 m-auto">

                        <form class="col-sm-12 col-md-8">

                            <h5 class="mb-3 mt-5 mb-4 title col-sm-12 col-md-11">مشخصات مشتری</h5>
                            <div class="col-sm-12 col-md-10 m-auto mt-2">
                                <div class="form-group row">
                                    <label class="col-6 col-sm-4 col-md-6">نام خانوادگی مشتری:</label>
                                    <p class="text-bold"> {{ $customer->family }}</p>
                                </div>
                                <div class="form-group row mt-3">
                                    <label class="col-6 col-sm-4 col-md-6">تلفن:</label>
                                    <p class="text-bold text-xs">{{ $customer->phone }}</p>
                                </div>
                            </div>

                            <h5 class="mb-3 title col-sm-12 col-md-11">مشخصات ملک مورد نیاز مشتری</h5>
                            <div class="col-sm-12 col-md-10 m-auto">
                                <div class="form-group row mt-3">
                                    <label class="col-6 col-sm-4 col-md-6"> دسته بندی:</label>
                                    <p class="text-bold text-xs">فروش/مسکونی/آپارتمان</p>
                                </div>
                                <div class="form-group row mt-3">
                                    <label class="col-6 col-sm-4 col-md-6">محدوده ها:</label>
                                    <p class="text-bold text-xs"></p>
                                </div>
                                <div class="form-group row mt-3">
                                    <label class="col-6 col-sm-4 col-md-6">متراژ:</label>
                                    <p class="text-bold text-xs">{{$customer->metr}}</p>
                                </div>
                                <div class="form-group row mt-3">
                                    <label class="col-6 col-sm-4 col-md-6">قیمت:</label>
                                    <p class="text-bold text-xs">
                                        <span>{{$customer->price}}</span>
                                        ملیون</p>
                                </div>
                            </div>

                            <h5 class="mb-3 mt-5 mb-4 title col-sm-12 col-md-11"> توضیحات </h5>
                            <div class="col-sm-12 col-md-10 m-auto mt-2" style="white-space: pre-wrap">
                                {{$customer->tozihat}}
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

@endsection