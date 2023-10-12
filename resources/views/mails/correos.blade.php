<!DOCTYPE html>
<html lang="en">
<head>
    @include('header')
    <title>{{$title}}</title>
</head>
<body>
<br><br><br>
  
    {!!$body!!}

    

    @if($links!='')
    <center>        
        {!!$links!!}
    </center>
    @endif
    
</body>
</html>