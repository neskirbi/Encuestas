<!DOCTYPE html>
<html lang="en">
<head>
    @include('header')
    <title>{{$title}}</title>
</head>
<body>
<br><br><br>
    <center>
        <img src="{{asset('images/logo.png')}}" alt="" width="200px">
        <h2>{{$title}}</h2>
        <h3>{{$subtitle}}</h3>
        <h5>{!!$body!!}</h5>
        {!!$links!!}
    </center>
    
</body>
</html>