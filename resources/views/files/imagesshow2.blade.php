<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="/dashbord/plugins/imgslider/slippry.min.js"></script>
<link rel="stylesheet" href="/dashbord/plugins/imgslider/slippry.css" />
<body>

<div class="container" style="max-height: 600px">

    <ul id="slippry-demo">
        <div style="">{{$i = 1}}</div>
        @foreach($file->images as $img)
            <li style="max-height: 600px">
                <a href="#slide{{$i++}}"><img style="max-height: 600px" src="{{ URL::to('/') }}/images/{{$file->y}}/{{$file->m}}/{{$img->name}}" alt="Welcome to Slippry!"></a>
            </li>
        @endforeach
    </ul>
</div>
    <script>
        // $(document).ready(function () {
            jQuery(document).ready(function(){
                jQuery('#slippry-demo').slippry()
            });
        // });
    </script>
</body>
</html>
