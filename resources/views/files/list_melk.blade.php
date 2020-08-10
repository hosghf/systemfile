@extends('layouts.app')

@section('title2', 'جستجوی ملک')

@section('content')

    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body" id="card-search-panel">

                    <!-- div for form padding-->
                    <div class="col-sm-12 col-md-11 m-auto">

                        <form class="col-sm-12 mt-3 search-panel">

                            <div class="row">
                                <div class="form-group col-12 col-sm-6 col-md-6">
                                    <label> </label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary" type="button">جستجو</button>
                                        </div>
                                        <input type="text" class="form-control" placeholder="نام، تلفن، توضیحات و ..." aria-label="" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="form-group col-6 col-sm-3 col-md-3">
                                    <label>دسته بندی</label>
                                    <select class="form-control">
                                        <optgroup label="فروش مسکونی"></optgroup>
                                        <option>آپارتمان</option>
                                        <option>خانه و ویلا</option>
                                        <option>خانه مسکونی</option>
                                    </select>
                                </div>
                                <div class="form-group col-6 col-sm-3 col-md-3">
                                    <label> محدوده </label>
                                    <div class="input-group mb-3">
                                        <select class="form-control">
                                            <option>قصرالدشت</option>
                                            <option>معالی آباد</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6 col-md-3">
                                    <label> متراژ از</label>
                                    <select class="form-control">
                                        <option>100</option>
                                        <option>200</option>
                                        <option>300</option>
                                    </select>
                                </div>
                                <div class="form-group col-6 col-md-3">
                                    <label> متراژ تا</label>
                                    <select class="form-control">
                                        <option>100</option>
                                        <option>200</option>
                                        <option>300</option>
                                    </select>
                                </div>
                                <div class="form-group col-6 col-md-3">
                                    <label> قیمت از</label>
                                    <select class="form-control">
                                        <option>100</option>
                                        <option>200</option>
                                        <option>300</option>
                                    </select>
                                </div>
                                <div class="form-group col-6 col-md-3">
                                    <label> قیمت تا</label>
                                    <select class="form-control">
                                        <option>100</option>
                                        <option>200</option>
                                        <option>300</option>
                                    </select>
                                </div>
                                <div class="form-group col-6 col-md-3">
                                    <label> از تاریخ </label>
                                    <select class="form-control">
                                        <option>100</option>
                                        <option>200</option>
                                        <option>300</option>
                                    </select>
                                </div>
                                <div class="form-group col-6 col-md-3">
                                    <label> تا تاریخ </label>
                                    <select class="form-control">
                                        <option>100</option>
                                        <option>200</option>
                                        <option>300</option>
                                    </select>
                                </div>

                                <div class="form-group col-3 col-6 col-md-3">
                                    <label> سال ساخت </label>
                                    <select class="form-control">
                                        <option>100</option>
                                        <option>200</option>
                                        <option>300</option>
                                    </select>
                                </div>
                                <div class="form-group col-6 col-md-3">
                                    <label></label>
                                    <button class="btn btn-primary text-sm col-12 mt-1">اعمال فیلتر</button>
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
                <a href="#" class="card-file-link">
                    <div class="card">
                        <div class="card-body p-4 card-file">
                            <div class="card-file-title ">
                                <h6 class="text-center">
                                    <span>{{$file->metr}}</span>
                                    @if(isset($file->metr))<span>متر</span>@endif
                                    <span>{{$file->street->title}}</span>
                                </h6>
                            </div>
                            <p class="text-muted text-center"> آپارتمان </p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item text-sm">
                                    <b>قیمت: </b>
                                    <span>{{ number_format($file->price) }}</span>
                                    @if(isset($file->metr))<span>ملیون</span>@endif
                                </li>
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