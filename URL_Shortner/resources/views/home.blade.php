<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>URL Shortener</title>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/global.css') }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

</head>
<body>

<header>
<h1 class="title">URL <span> Shortener</span></h1>

</header>

    
    <div class="container text-center" style="">
        
@if (count($errors)>0)
    <ul class="list-group">
        @foreach ($errors->all() as $error)
            <li class="list-group-item text-danger">
                {{$error}}
            </li>
        @endforeach
    </ul>
@endif


    <form action="{{route('make')}}" method="POST">
            {{csrf_field()}}
            <div class="col-md-12">
                
            <input class="col-md-8  col-xs-12 form-control-static" style="border-radius: 5px" type="url" name="url" id="url" placeholder="Enter a URL">
            <input type="submit" value="Shorten" class="btn btn-primary col-md-3 col-md-offset-1">
            </div>
        </form>
  
@if (Session::has('code'))
<div class="col-md-12"  style="margin-top: 40px;margin-bottom: 105px;">
    
    <div class="bg-success col-md-8  col-xs-12" style="padding: 15px;">
        <a id="c-url" class="" href="http://127.0.0.1:8000/{{Session::get('code')}}">http://www.url-short.com/{{Session::get('code')}}</a>
        </div>
    <div class="col-md-3 col-md-offset-1" style="padding: 8px;">
        <button  class="btn btn-success " onclick="CopyToClipboard('c-url')">Copy</button>
    </div>
</div>
@else
    @if (Session::has('bad'))
        <div class="bg-danger" style="margin-top: 75px;margin-bottom: 110px; padding: 15px;">
                Sorry your requested link not found !!!
        </div>
    @else
        <div class="main-info">
                <p class="">Use this webiste to shorten your Url<br>
                    100% Free and alwayes wil be
                </p>
        </div>
    @endif  

@endif

  
</div>

<footer class="footer-distributed">

    <div class="footer-left">

        <h3>URL<span>Shortener</span></h3>

    <!--
        <p class="footer-links">
            <a href="#">Home</a>
            ·
            <a href="#">Blog</a>
            ·
            <a href="#">Pricing</a>
            ·
            <a href="#">About</a>
            ·
            <a href="#">Faq</a>
            ·
            <a href="#">Contact</a>
        </p>
    -->
        <br>
        <p class="footer-company-name">Developed By FaridDomat © 2019<br><br>
        Developed for Test reason only.
        </p>
    </div>

    <div class="footer-center">

        <div>
            <i class="fa fa-map-marker"></i>
            <p><span>Kafrram</span> Homs, Syria</p>
        </div>

        <div>
            <i class="fa fa-phone"></i>
            <p>+963 934538775</p>
        </div>

        <div>
            <i class="fa fa-envelope"></i>
            <p><a href="mailto:fariddomat@outlook.com">fariddomat@outlook.com</a></p>
        </div>

    </div>

    <div class="footer-right">

        <p class="footer-company-about">
            <span>About</span>
            Url Shortener service<br>
            This service developed by <object style="color: #5383d3;">PHP Laravel.</object> <br>
            Here you can change long links to short one.
        </p>

        <div class="footer-icons">

            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-github"></i></a>

        </div>

    </div>

</footer>
<script>
function CopyToClipboard(containerid) {
if (document.selection) { 
    var range = document.body.createTextRange();
    range.moveToElementText(document.getElementById(containerid));
    range.select().createTextRange();
    document.execCommand("copy"); 

} else if (window.getSelection) {
    var range = document.createRange();
     range.selectNode(document.getElementById(containerid));
     window.getSelection().addRange(range);
     document.execCommand("copy");
     alert("URL copied successfully  to clipboard ^_^") 
}}
</script>
</body>

</html>