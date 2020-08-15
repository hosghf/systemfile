@extends('layouts.app')

@section('title2', 'تغییر رمز')

@section('content')

    <div class="row">
        <div class="col-lg-12">

            <div class="card card-primary card-outline">
                <div class="card-body">
                    <!-- div for form padding-->
                    <div class="col-sm-12 col-md-11 m-auto">

                        <form method="post" action="/changepassword/{{auth()->id()}}" class="col-sm-12 col-md-8 mt-3">
                            @csrf
                            <h5 class="mb-3 mt-5 title col-sm-12 col-md-11"> تغییر رمز</h5>
                            <div class="col-sm-12 col-md-10 m-auto">
                                <div class="form-group">
                                    <label> رمز جدید </label>
                                    <input type="text" name="password" class="form-control">
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