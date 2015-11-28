<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reminder System</title>


    <link rel="stylesheet" href="{!! url('/css/bootstrap.min.css') !!}">
    <link rel="stylesheet" href="{!! url('/css/xeditable.css') !!}">


    <script src="{!! url('/Scripts/jquery-1.11.3.min.js') !!}"></script>
    <script src="{!! url('/Scripts/bootstrap.min.js') !!}"></script>
    <script src="{!! url('/Scripts/angular.min.js') !!}"></script>
    <script src="{!! url('/Scripts/xeditable.min.js') !!}"></script>
</head>

<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{!! url('/') !!}">GOE</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                        <li><a href="{!! url('employees')!!}">Employee <span class="sr-only">(current)</span></a></li>
                        <li ><a href="{!! url('sites') !!}">Site</a></li>
                        <li ><a href="{!! url('transactions') !!}">Transaction</a></li>

            </ul>

        </div>
    </div>
</nav>
<div class="row">
    @yield('content')
</div>
</body>


</html>
</body>