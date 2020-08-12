@extends('layouts.app')

@section('title2', 'ویرایش مشتری')

@section('content')

    {{--flush message--}}
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible text-sm">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ $error }}
        </div>
    @endforeach

    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible text-sm">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">

            <div class="card card-primary card-outline">
                <div class="card-body">
                    <!-- div for form padding-->
                    <div class="col-sm-12 col-md-11 m-auto">

                        <form method="post" action="/updatecustomer/{{$customer->id}}" class="col-sm-12 col-md-8 mt-3">
                            @csrf
                            <h5 class="mb-3 mt-5 title col-sm-12 col-md-11">مشخصات مشتری</h5>
                            <div class="col-sm-12 col-md-10 m-auto">
                                <div class="form-group">
                                    <label>نام خانوادگی مشتری</label>
                                    <input type="text" name="family" value="{{ $customer->family }}"  class="form-control @error('family') border border-danger @enderror">
                                </div>
                                <div class="form-group mt-3">
                                    <label>تلفن</label>
                                    <input type="text" name="phone" value="{{ $customer->phone }}" class="form-control @error('phone') border border-danger @enderror">
                                </div>
                            </div>

                            <h5 class="mb-3 title col-sm-12 col-md-11">مشخصات ملک مورد نظر</h5>
                            <div class="col-sm-12 col-md-10 m-auto">
                                <div class="form-group">
                                    <label>محدوده ها</label>
                                    <select name="streets" class="form-control">
                                        <option></option>
                                        @foreach($streets as $street)
                                            <option value="{{$street->id}}"> {{ $street->title }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label>متراژ</label>
                                    <input type="text" name="metr" value="{{ $customer->metr }}" class="form-control">
                                </div>
                                <div class="form-group mt-3">
                                    <label>تعداد خواب</label>
                                    <select name="room" class="form-control">
                                        <option></option>
                                        @foreach($rooms as $room)
                                            <option value="{{$room->id}}" {{($room->id == $customer->room_id ? 'selected' : '')}} > {{ $room->title }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label> دسته بندی </label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group mt-3">
                                    <label>قیمت</label>
                                    <input type="text" name="gheymat" value="{{ $customer->price }}" class="form-control">
                                </div>
                                <div class="form-group mt-3">
                                    <label>توضیحات</label>
                                    <textarea name="tozihat" class="form-control">{{$customer->tozihat}}</textarea>
                                </div>
                            </div>

                            <div class="space2"></div>
                            <div class="row"></div>
                            <div class="col-sm-12 col-md-10 m-auto mb-5 mt-5 ">
                                <button type="submit" class="btn  btn-outline-success btn-block">ثبت مشتری</button>
                            </div>

                        </form>

                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection