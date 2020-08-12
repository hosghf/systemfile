@extends('layouts.app')

@section('content')
    @foreach ($errors->all() as $error)
        <div class="error">
            {{ $error }}
        </div>
    @endforeach



        <h1 class="hh">i am visible at first</h1>

        <form method="post" action="/test" class="d-none">
            @csrf
            <input type="text" name="test" value="{{old('test')}}">
            <input type="text" name="test2" value="{{old('test2')}}">

            <button type="submit">submit</button>

        </form>
    <script src="/dashbord/plugins/jquery/jquery.min.js"></script>
    <script src="/dashbord/dist/js/jquery/jqtest.js"></script>
@endsection