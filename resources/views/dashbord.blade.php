@extends('layouts.app')

@section('title2', 'پنل مدیریت')

@section('content')

    <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-file"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"> تعداد کل فایل ها </span>
                    <span class="info-box-number">@if(isset($allfiles)){{$allfiles}}@endif</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fa fa-shopping-cart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">فایل های فروش</span>
                    <span class="info-box-number">{{$foroshcount}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="fa fa-building"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">فایل های اجاره</span>
                    <span class="info-box-number">{{$ejarecount}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="fa fa-user"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">تعداد پرسنل فعال</span>
                    <span class="info-box-number">{{$usercount}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>



    <h5 class="mt-4 mb-2"> فایل های من </h5>
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$mysalefiles}}</h3>

                    <p> فایل های فروش من</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="/myfiles?forosh=1&archive=0" class="small-box-footer">بیشتر <i class="fa fa-arrow-circle-left"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$myrentfiles}}</h3>
                    <p>فایل اجاره های من</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="/myfiles?forosh=0&archive=0" class="small-box-footer">بیشتر <i class="fa fa-arrow-circle-left"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$myarchivefiles}}</h3>

                    <p>آرشیوهای فروش من</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="/myfiles?forosh=1&archive=1" class="small-box-footer"> بیشتر <i class="fa fa-arrow-circle-left"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$ejarearchive}}</h3>

                    <p> آرشیو های اجاره من </p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="/myfiles?forosh=0&archive=1" class="small-box-footer"> بیشتر <i class="fa fa-arrow-circle-left"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>


    <h5 class="mt-4 mb-2"> گزارش کار پرسنل </h5>
    <div class="row">
        <div class="card col-12">
            <div class="card-header border-transparent">
                <h3 class="card-title"> تعداد فایل های ثبت شده</h3>

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
                    <table class="table m-0">
                        <thead>
                        <tr>
                            <th>نام</th>
                            <th>نام خانوادگی</th>
                            <th>سمت</th>
                            <th>فایل ها امروز</th>
                            <th>فایل های هفت روز گذشته</th>
                            <th>فایل های یک ماه گذشته</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>حمید</td>
                            <td>گودرزی</td>
                            <td>مشاور اجاره</td>
                            <td>20</td>
                            <td><span class="badge badge-success">21</span></td>
                            <td>32</td>
                        </tr>
                        <tr>
                            <td>حمید</td>
                            <td>گودرزی</td>
                            <td>مشاور اجاره</td>
                            <td>20</td>
                            <td><span class="badge badge-success">21</span></td>
                            <td>32</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                {{--<a href="javascript:void(0)" class="btn btn-sm btn-info float-left">سفارش جدید</a>--}}
                {{--<a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">مشاهده همه سفار</a>--}}
            </div>
            <!-- /.card-footer -->
        </div>

    </div>



@endsection