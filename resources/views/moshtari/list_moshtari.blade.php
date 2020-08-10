@extends('layouts.app')

@section('title2', 'جستجوی مشتری')

@section('content')

    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body" id="card-search-panel">

                    <!-- div for form padding-->
                    <div class="col-sm-12 col-md-11 m-auto">

                        <form class="col-sm-12 mt-3 search-panel">

                            <div class="row">
                                <div class="form-group col-12 col-sm-4 col-md-6">
                                    <label> </label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary" type="button">جستجو</button>
                                        </div>
                                        <input type="text" class="form-control" placeholder="نام، تلفن، توضیحات و ..." aria-label="" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="form-group col-6 col-sm-4 col-md-3">
                                    <label>دسته بندی</label>
                                    <select class="form-control">
                                        <optgroup label="فروش مسکونی"></optgroup>
                                        <option>آپارتمان</option>
                                        <option>خانه و ویلا</option>
                                        <option>خانه مسکونی</option>
                                    </select>
                                </div>
                                <div class="form-group col-6 col-sm-4 col-md-3">
                                    <label>  </label>
                                    <div class="input-group mb-3">
                                        <select class="form-control">
                                            <option></option>
                                            <option></option>
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
                                    <label> محدوده </label>
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

        <div class="col-12">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title"> تعداد 10 مشتری یافت شد </h3>

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
                                <th>محدوده</th>
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
                                        <td><span class="badge badge-success">فرهنگ شهر</span></td>
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
                                            <a href="#">
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