@extends('layouts.app')

@section('title2', 'ویرایش ملک')

@section('content')

    <script src="plugins/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea',
            language: 'fa',
            directionality : 'rtl'
        });
    </script>

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
                        <form method="post" action="" class="col-sm-12 col-md-8 mt-3">
                            @csrf
                            <h5 class="mb-3 mt-5 title col-sm-12 col-md-11">مشخصات صاحب ملک</h5>
                            <div class="col-sm-12 col-md-10 m-auto">
                                <div class="form-group">
                                    <label><span class="text-danger">*</span>
                                        نام خانوادگی مالک</label>
                                    <input name="family" type="text" value="{{ $file->family }}" class="form-control  @error('family') border border-danger @enderror">
                                </div>
                                <div class="form-group mt-3">
                                    <label><span class="text-danger">*</span>
                                        تلفن</label>
                                    <input name="phone" type="text" value="{{ $file->phone }}" class="form-control @error('phone') border border-danger @enderror">
                                </div>
                            </div>

                            <h5 class="mb-3 title col-sm-12 col-md-11">مشخصات ملک</h5>
                            <div class="col-sm-12 col-md-10 m-auto">
                                <div class="form-group">
                                    <label>دسته بندی</label>
                                    <select name="daste" class="form-control">
                                        @foreach($category as $cat)
                                            <option value="{{ $cat->id }}" {{ ($file->cat_id == $cat->id ? "selected":"") }}>{{ $cat->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>محدوده</label>
                                    <select name="street" class="form-control @error('street') border border-danger @enderror">
                                        <option></option>
                                        @foreach($street as $st)
                                            <option value="{{ $st->id }}" {{ ($file->street_id == $st->id ? "selected":"") }}>{{ $st->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label>آدرس</label>
                                    <input name="address" type="text" value="{{ $file->address }}" class="form-control">
                                </div>
                                <div class="form-group mt-3">
                                    <label>متراژ</label>
                                    <input name="metr" value="{{ $file->metr }}" type="text" class="form-control">
                                </div>
                                <div class="form-group mt-3">
                                    <label>سند</label>
                                    <select name="sanad" class="form-control">
                                        <option></option>
                                        @foreach($sanads as $sanad)
                                            <option value="{{ $sanad->id }}" {{( $file->sanad_id == $sanad->id ? "selected":"")}}> {{ $sanad->title }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label>قیمت</label>
                                    <input name="gheymat" value="{{$file->price}}" type="text" class="form-control">
                                </div>
                            </div>

                            <h5 class="mb-3 mt-5 title col-sm-12 col-md-11">مشخصات ساختمان </h5>
                            <div class="col-sm-12 col-md-10 m-auto">
                                <div class="form-group mt-3">
                                    <label>جهت ساختمان</label>
                                    <select name="direction" class="form-control">
                                        @foreach($directions as $direction)
                                            <option value="{{ $direction->id }}" {{( $file->direction_id == $direction->id ? "selected":"")}} > {{ $direction->title }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label>سال ساخت</label>
                                    <select name="year" class="form-control">
                                        @for($i = $year + 1 ; $i > 1370; )
                                            <option value="{{ --$i }}" {{($file->year == $i ? "selected":"")}} > {{ $i }} </option>
                                        @endfor
                                        <option value="1369" {{($file->year == 1369 ? "selected":"")}}> قبل از 1370 </option>
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label> تعداد خواب </label>
                                    <select name="room" class="form-control">
                                        <option></option>
                                        @foreach($rooms as $room)
                                            <option value="{{ $room->id }}" {{( $file->room_id == $room->id ? "selected":"")}} >{{ $room->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label> طبقه </label>
                                    <select name="tabaghe" class="form-control">
                                        <option></option>
                                        @foreach($tabaghe as $t)
                                            <option value="{{ $t->id }}" {{( $file->tabaghe_id == $t->id ? "selected":"")}}> {{ $t->title }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label> تعداد کل طبقات </label>
                                    <select name="kole_tabaghat" class="form-control">
                                        @for($i = 0; $i < 12;)
                                            <option value="{{++$i}}" {{( $file->kole_tabaghat == $i ? "selected":"")}} >{{ $i }}</option>
                                        @endfor
                                        <option value="13" {{( $file->kole_tabaghat == 13 ? "selected":"")}}>بیشتر از 12</option>
                                    </select>
                                </div>
                            </div>

                            <h5 class="mb-3 mt-5 title col-sm-12 col-md-11"> امکانات </h5>
                            <div class="col-sm-12 col-md-10 m-auto">
                                <div class="form-group">
                                    <label> گرمایش </label>
                                    <select name="garmayesh" class="form-control">
                                        <option></option>
                                        @foreach($heatings as $h)
                                            <option value="{{ $h->id }}" {{( $file->heating_id == $h->id ? "selected":"")}}>{{ $h->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label>سرمایش</label>
                                    <select name="sarmayesh" class="form-control">
                                        <option></option>
                                        @foreach($coolings as $c)
                                            <option value="{{ $c->id }}" {{( $file->cooling_id == $c->id ? "selected":"")}}>{{ $c->title }} >{{ $c->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label>کابینت</label>
                                    <select name="cabinet" class="form-control">
                                        <option></option>
                                        @foreach($cabinets as $c)
                                            <option value="{{ $c->id }}" {{( $file->cabinet_id == $c->id ? "selected":"")}} >{{ $c->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label>کف</label>
                                    <select name="kaf" class="form-control">
                                        <option></option>
                                        @foreach($kaf as $c)
                                            <option value="{{ $c->id }}" {{( $file->floor_id == $c->id ? "selected":"")}} >{{ $c->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group row mt-5 border border-dark rounded p-2">
                                    <label class="mx-3">پارکینگ:</label>
                                    <div class="form-check mx-3">
                                        <input class="form-check-input" type="radio" {{($file->parking == '' ? "checked":"")}} name="parking" checked value="">
                                        <label class="">نامشخص</label>
                                    </div>
                                    <div class="form-check mx-3">
                                        <input class="form-check-input" type="radio" {{($file->parking == 1 ? "checked":"")}} name="parking" value="1">
                                        <label class="">دارد</label>
                                    </div>
                                    <div class="form-check mr-3">
                                        <input class="form-check-input" type="radio" {{($file->parking == 2 ? "checked":"")}} name="parking" value="2">
                                        <label class="">ندارد</label>
                                    </div>
                                </div>
                                <div class="form-group row mt-4 border border-dark rounded p-2">
                                    <label class="mx-3">انباری:</label>
                                    <div class="form-check mx-3">
                                        <input class="form-check-input" type="radio" {{($file->anbari == '' ? "checked":"")}} name="anbari" checked value="">
                                        <label class="">نامشخص</label>
                                    </div>
                                    <div class="form-check mx-3">
                                        <input class="form-check-input" type="radio" {{($file->anbari == 1 ? "checked":"")}} name="anbari" value="1">
                                        <label class="">دارد</label>
                                    </div>
                                    <div class="form-check mr-3">
                                        <input class="form-check-input" type="radio" {{($file->anbari == 2 ? "checked":"")}} name="anbari" value="2">
                                        <label class="">ندارد</label>
                                    </div>
                                </div>
                                <div class="form-group row mt-4 border border-dark rounded p-2">
                                    <label class="mx-3">آسانسور:</label>
                                    <div class="form-check mx-3">
                                        <input class="form-check-input" type="radio" {{($file->asansor == '' ? "checked":"")}} name="asansor" checked value="">
                                        <label class="">نامشخص</label>
                                    </div>
                                    <div class="form-check mx-3">
                                        <input class="form-check-input" type="radio" {{($file->asansor == 1 ? "checked":"")}} name="asansor" value="1">
                                        <label class="">دارد</label>
                                    </div>
                                    <div class="form-check mr-3">
                                        <input class="form-check-input" type="radio" {{($file->asansor == 2 ? "checked":"")}} name="asansor" value="2">
                                        <label class="">ندارد</label>
                                    </div>
                                </div>

                            </div>

                            <h5 class="mb-3 title col-sm-12 col-md-11">افزودن سایر امکانات </h5>
                            <div class="col-sm-12 col-md-10 m-auto">

                                <div class="row">
                                    <div class="form-group ml-3 mt-1">
                                        <label>#</label>
                                    </div>
                                    <div class="form-group ml-3 col-5">
                                        <input type="text" id="emkanatinput" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <button type="button" id="add" class="btn btn2  btn-outline-success btn-block btn-afzodan"> افزودن </button>
                                    </div>
                                </div>

                                <div id="emkanat">
                                    @if(isset($file->facilities))
                                        <p id="countFacility" class=""> {{count($file->facilities)}}</p>
                                        @foreach($file->facilities as $f)
                                            <input type='text' class=' {{$f->value . $f->id}} d-none' name='facility[]'  value="{{$f->title}}">
                                            <div class=" {{$f->value . $f->id}} row text-bold mt-2 mb-0">
                                                <div class="form-group ml-4 mb-0">
                                                    <p>{{ $f->id }}</p>
                                                </div>
                                                <div class="form-group col-5 mb-0">
                                                    <p>{{$f->value}}</p>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <button type="button" onclick="t1(this)" class="{{$f->value . $f->id}} btn btn-hazf btn-outline-danger"> حذف </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                            </div>

                            <h5 class="mb-3 title col-sm-12 col-md-11"> توضیحات </h5>
                            <textarea name="tozihat" id="mytextarea">{{ $file->tozihat }}</textarea>

                            <div class="space2"></div>
                            <div class="row"></div>
                            <div class="col-sm-12 col-md-10 m-auto mb-5 mt-5 ">
                                <button type="submit" class="btn  btn-outline-success btn-block">بروز رسانی ملک</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>

    </div>

@endsection

@section('js')
    <script src="/dashbord/dist/js/jquery/sabte_melk_add_emkanat.js"></script>
@endsection