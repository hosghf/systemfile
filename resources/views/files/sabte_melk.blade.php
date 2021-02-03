@extends('layouts.app')

@section('title2', 'ثبت ملک')

@section('pagetitle', $pagetitle)

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
                        <form method="post" action="" enctype="multipart/form-data" class="col-sm-12 col-md-8 mt-3">
                            @csrf
                            <input type="hidden" name="forosh" value="{{$forosh}}">
                            <input type="hidden" name="maskoni" value="{{$maskoni}}">
                            <input type="hidden" name="sakht" value="{{$sakht}}">
                            <h5 class="mb-3 mt-5 title2 col-sm-12 col-md-11">مشخصات صاحب ملک</h5>
                            <div class="col-sm-12 col-md-10 m-auto">
                                <div class="form-group">
                                    <label><span class="text-danger">*</span>
                                        نام خانوادگی مالک</label>
                                    <input name="family" type="text" value="{{ old('family') }}" class="form-control  @error('family') border border-danger @enderror">
                                </div>
                                <div class="form-group mt-3">
                                    <label><span class="text-danger">*</span>
                                        تلفن</label>
                                    <input name="phone" type="text" value="{{ old('phone') }}" class="form-control @error('phone') border border-danger @enderror">
                                </div>
                            </div>

                            <h5 class="mb-3 title2 col-sm-12 col-md-11">مشخصات ملک</h5>
                            <div class="col-sm-12 col-md-10 m-auto">
                                <div class="form-group">
                                    @if($sakht < 1)
                                        <label>دسته بندی</label>
                                        <select name="daste" class="form-control">
                                            @foreach($category as $cat)
                                                <option value="{{ $cat->id }}" {{ (old("daste") == $cat->id ? "selected":"") }}>{{ $cat->title }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label><span class="text-danger">*</span>
                                        محدوده
                                    </label>
                                    <select name="street" class="form-control @error('street') border border-danger @enderror">
                                        <option></option>
                                        @foreach($street as $st)
                                            <option value="{{ $st->id }}" {{ (old("street") == $st->id ? "selected":"") }}>{{ $st->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label>آدرس</label>
                                    <input id="address" autocomplete="off" name="address" type="text" value="{{ old('address') }}" class="form-control">
                                    <p class="mt-2">
                                        <span>نمایش به همکاران:</span>
                                        <span id="addressToShow" class="text-danger"> </span>
                                    </p>
                                </div>
                                <div class="form-group mt-3">
                                    <label>متراژ</label>
                                    <input name="metr" value="{{ old('metr') }}" type="text" class="form-control @error('metr') border border-danger @enderror">
                                </div>
                                @if($forosh == 1 || $sakht == 1)
                                    <div class="form-group mt-3">
                                        <label>سند</label>
                                        <select name="sanad" class="form-control">
                                            <option></option>
                                           @foreach($sanads as $sanad)
                                              <option value="{{ $sanad->id }}" {{(old("sanad") == $sanad->id ? "selected":"")}}> {{ $sanad->title }} </option>
                                           @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>قیمت</label>
                                        <input name="gheymat" value="{{old('gheymat')}}" type="text" class="form-control @error('gheymat') border border-danger @enderror">
                                    </div>
                                @endif
                                @if($forosh == 0 && $sakht == 0)
                                    <div class="form-group mt-3">
                                        <label>رهن</label>
                                        <input name="rahn" value="{{old('rahn')}}" type="text" class="form-control">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>اجاره</label>
                                        <input name="ejare" value="{{old('ejare')}}" type="text" class="form-control">
                                    </div>
                                @endif
                            </div>

                            <h5 class="mb-3 mt-5 title2 col-sm-12 col-md-11">مشخصات ساختمان </h5>
                            <div class="col-sm-12 col-md-10 m-auto">
                                <div class="form-group mt-3">
                                    <label>جهت ساختمان</label>
                                    <select name="direction" class="form-control">
                                        <option></option>
                                        @foreach($directions as $direction)
                                            <option value="{{ $direction->id }}" {{(old("direction") == $direction->id ? "selected":"")}} > {{ $direction->title }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label>سال ساخت</label>
                                    <select name="year" class="form-control">
                                        <option></option>
                                        @for($i = $year + 1 ; $i > 1370; )
                                          <option value="{{ --$i }}" {{(old("year") == $i ? "selected":"")}} > {{ $i }} </option>
                                        @endfor
                                        <option value="1369" {{(old("year") == 1369 ? "selected":"")}}> قبل از 1370 </option>
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label> تعداد خواب </label>
                                    <select name="room" class="form-control">
                                        <option></option>
                                        @foreach($rooms as $room)
                                            <option value="{{ $room->id }}" {{(old("room") == $room->id ? "selected":"")}} >{{ $room->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label> طبقه </label>
                                    <select name="tabaghe" class="form-control">
                                        <option></option>
                                        @foreach($tabaghe as $t)
                                            <option value="{{ $t->id }}" {{(old("tabaghe") == $t->id ? "selected":"")}}> {{ $t->title }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label> تعداد کل طبقات </label>
                                    <select name="kole_tabaghat" class="form-control">
                                        <option></option>
                                        @for($i = 0; $i < 12;)
                                          <option value="{{++$i}}" {{(old("kole_tabaghat") == $i ? "selected":"")}} >{{ $i }}</option>
                                        @endfor
                                            <option value="13" {{(old("kole_tabaghat") == 13 ? "selected":"")}}>بیشتر از 12</option>
                                    </select>
                                </div>
                            </div>

                            <h5 class="mb-3 mt-5 title2 col-sm-12 col-md-11"> امکانات </h5>
                            <div class="col-sm-12 col-md-10 m-auto">
                                <div class="form-group">
                                    <label> گرمایش </label>
                                    <select name="garmayesh" class="form-control">
                                        <option></option>
                                        @foreach($heatings as $h)
                                            <option value="{{ $h->id }}" {{(old("garmayesh") == $h->id ? "selected":"")}}>{{ $h->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label>سرمایش</label>
                                    <select name="sarmayesh" class="form-control">
                                        <option></option>
                                        @foreach($coolings as $c)
                                            <option value="{{ $c->id }}" {{(old("sarmayesh") == $c->id ? "selected":"")}}>{{ $c->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label>کابینت</label>
                                    <select name="cabinet" class="form-control">
                                        <option></option>
                                        @foreach($cabinets as $c)
                                            <option value="{{ $c->id }}" {{(old("cabinet") == $c->id ? "selected":"")}} >{{ $c->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label>کف</label>
                                    <select name="kaf" class="form-control">
                                        <option></option>
                                        @foreach($kaf as $c)
                                            <option value="{{ $c->id }}" {{(old("kaf") == $c->id ? "selected":"")}} >{{ $c->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group row mt-5 border border-dark rounded p-2">
                                    <label class="mx-3">پارکینگ:</label>
                                    <div class="form-check mx-3">
                                        <input class="form-check-input" type="radio" {{(old("parking") == '' ? "checked":"")}} name="parking" checked value="">
                                        <label class="">نامشخص</label>
                                    </div>
                                    <div class="form-check mx-3">
                                        <input class="form-check-input" type="radio" {{(old("parking") == 1 ? "checked":"")}} name="parking" value="1">
                                        <label class="">دارد</label>
                                    </div>
                                    <div class="form-check mr-3">
                                        <input class="form-check-input" type="radio" {{(old("parking") == 2 ? "checked":"")}} name="parking" value="2">
                                        <label class="">ندارد</label>
                                    </div>
                                </div>
                                <div class="form-group row mt-4 border border-dark rounded p-2">
                                    <label class="mx-3">انباری:</label>
                                    <div class="form-check mx-3">
                                        <input class="form-check-input" type="radio" {{(old("anbari") == '' ? "checked":"")}} name="anbari" checked value="">
                                        <label class="">نامشخص</label>
                                    </div>
                                    <div class="form-check mx-3">
                                        <input class="form-check-input" type="radio" {{(old("anbari") == 1 ? "checked":"")}} name="anbari" value="1">
                                        <label class="">دارد</label>
                                    </div>
                                    <div class="form-check mr-3">
                                        <input class="form-check-input" type="radio" {{(old("anbari") == 2 ? "checked":"")}} name="anbari" value="2">
                                        <label class="">ندارد</label>
                                    </div>
                                </div>
                                <div class="form-group row mt-4 border border-dark rounded p-2">
                                    <label class="mx-3">آسانسور:</label>
                                    <div class="form-check mx-3">
                                        <input class="form-check-input" type="radio" {{(old("asansor") == '' ? "checked":"")}} name="asansor" checked value="">
                                        <label class="">نامشخص</label>
                                    </div>
                                    <div class="form-check mx-3">
                                        <input class="form-check-input" type="radio" {{(old("asansor") == 1 ? "checked":"")}} name="asansor" value="1">
                                        <label class="">دارد</label>
                                    </div>
                                    <div class="form-check mr-3">
                                        <input class="form-check-input" type="radio" {{(old("asansor") == 2 ? "checked":"")}} name="asansor" value="2">
                                        <label class="">ندارد</label>
                                    </div>
                                </div>

                            </div>

                            <h5 class="mb-3 title2 col-sm-12 col-md-11">افزودن سایر امکانات </h5>
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
                                </div>

                            </div>

                            <h5 class="mb-3 title2 col-sm-12 col-md-11"> توضیحات </h5>
                            <div class="col-sm-12 col-md-10 m-auto">
                                 <textarea name="tozihat" class="form-control tozihat" >{{ old('tozihat') }}</textarea>
                            </div>

                            <h5 class="mb-3 title2 col-sm-12 col-md-11"> افزودن تصاویر </h5>
                            <div class="col-sm-12 col-md-10 m-auto">
                                <label class="btn btn-outline-info" for="images">تصاویر را انتخاب کنید</label>
                                    <input type="file" name="images[]" id="images" style="opacity: 0.7" multiple class="form-control">
                            </div>

                            <div class="space2"></div>
                            <div class="row"></div>
                            <div class="col-sm-12 col-md-10 m-auto mb-5 mt-5 ">
                                <button type="submit" class="btn  btn-outline-success btn-block">ثبت ملک</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="dashbord/dist/js/jquery/sabte_melk_add_emkanat.js"></script>
    <script src="/dashbord/dist/js/jquery/namayesh_address.js"></script>
@endsection