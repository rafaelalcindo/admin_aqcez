<html>
<head>
    @include('includes.head')
</head>
<body>
<div class="container">

    <div class="row">
        <div class="col-md-12">
            @include('includes.header')    
        </div>        
    </div>

    <div id="main" class="row">
        <div class="col-md-12">
            @yield('content')
        </div>
    </div>

    <div>
        <div class="col-md-12">
            @include('includes.footer')    
        </div>        
    </div>

</div>
</body>
</html>