@extends('layouts.app')

@section('title2', 'لیست پرسنل')

@section('content')

    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible text-sm">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="row">

        <div class="col-12">

            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title"> لیست پرسنل </h3>

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
                                <th>نام خانوادگی</th>
                                <th>نام کاربری</th>
                                <th>تلفن</th>
                                <th>سمت</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody class="text-sm">
                                <div class="d-none">{{$i = 0}}</div>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td> {{$user->name}} </td>
                                        <td>{{$user->family}}</td>
                                        <td>{{$user->username}}</td>
                                        <td>
                                            {{$user->phone}}
                                        </td>
                                        <td>
                                            {{$user->role->title}}
                                        </td>
                                        <td>
                                            <a href="/deletepersonel/{{$user->id}}">
                                                <button class="btn bg-danger text-sm py-1 px-2 @if($user->id == 2) disabled d-none @endif"> <i class="fa fa-trash"></i> حذف </button>
                                            </a>
                                            <a href="#">
                                                <a href="/updatepersonel/{{$user->id}}" class="btn bg-warning text-sm py-1 px-2"> <i class="fa fa-edit"></i> ویرایش </a>
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
                <div class="card-footer clearfix">
                </div>
                <!-- /.card-footer -->
            </div>

        </div>

    </div>

@endsection