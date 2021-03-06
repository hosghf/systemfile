@extends('layouts.app')

@section('title2', 'ثبت پرسنل')

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

    @if($user->id != 2)
    <div class="row">
        <div class="col-lg-12">

            <div class="card card-primary card-outline">
                <div class="card-body">
                    <!-- div for form padding-->
                    <div class="col-sm-12 col-md-11 m-auto">

                        <form method="post" action="/updatepersonel/{{$user->id}}" class="col-sm-12 col-md-8 mt-3">
                            @csrf
                            <h5 class="mb-3 mt-5 title col-sm-12 col-md-11">مشخصات مشاور</h5>
                            <div class="col-sm-12 col-md-10 m-auto">
                                <div class="form-group">
                                    <label>نام مشاور</label>
                                    <input name="name" type="text" value="{{ $user->name }}" class="form-control @error('name') border border-danger @enderror">
                                </div>
                                <div class="form-group">
                                    <label>نام خانوادگی مشاور</label>
                                    <input name="family" type="text" value="{{ $user->family }}" class="form-control @error('family') border border-danger @enderror">
                                </div>
                                <div class="form-group">
                                    <label> شماره همراه </label>
                                    <input name="phone" type="text" value="{{ $user->phone }}" class="form-control @error('phone') border border-danger @enderror">
                                </div>
                                <div class="form-group">
                                    <label>سمت</label>
                                    <select name="role" class="form-control @error('phone') border border-danger @enderror">
                                        <option></option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{($user->role_id == $role->id ? "selected":"")}} > {{ $role->title }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <h5 class="mb-3 title col-sm-12 col-md-11"> اطلاعات کاربری </h5>
                            <div class="col-sm-12 col-md-10 m-auto">
                                <div class="form-group">
                                    <label> نام کاربری </label>
                                    <input name="username" type="text" value="{{ $user->username }}" class="form-control @error('username') border border-danger @enderror">
                                </div>
                            </div>

                            <div class="space2"></div>
                            <div class="row"></div>
                            <div class="col-sm-12 col-md-10 m-auto mb-5 mt-5 ">
                                <button type="submit" class="btn  btn-outline-success btn-block"> بروز رسانی</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <!-- div for form padding-->
                    <div class="col-sm-12 col-md-11 m-auto">
                        <form method="post" action="/changepassword/{{$user->id}}" class="col-sm-12 col-md-8 mt-3">
                            @csrf
                            <h5 class="mb-3 mt-5 title col-sm-12 col-md-11"> تغییر رمز</h5>
                            <div class="col-sm-12 col-md-10 m-auto">
                                <div class="form-group">
                                    <label> رمز جدید </label>
                                    <input name="password" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="space1"></div>
                            <div class="col-sm-12 col-md-10 m-auto mb-5 mt-4 ">
                                <button type="submit" class="btn  btn-outline-success btn-block"> تغییر رمز </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection