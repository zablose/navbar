<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="Navbar Demo">
        <title>Navbar Demo</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <style>
            body { padding-top: 70px; }
            .sub-header { padding-bottom: 10px; border-bottom: 1px solid #eee; }
            .navbar-fixed-top { border: 0; }
            .sidebar { display: none; }
            @media (min-width: 768px) {
                .sidebar { position: fixed; top: 51px; bottom: 0; left: 0; z-index: 1000; display: block;
                    padding: 20px; overflow-x: hidden; overflow-y: auto; background-color: #f5f5f5;
                    border-right: 1px solid #eee;
                }
            }
            .nav-sidebar { margin-right: -21px; margin-bottom: 20px; margin-left: -20px; }
            .nav-sidebar > li > a { padding-right: 20px; padding-left: 20px; }
            .nav-sidebar > .active > a,
            .nav-sidebar > .active > a:hover,
            .nav-sidebar > .active > a:focus { color: #fff; background-color: #428bca; }
            .main { padding: 20px; }
            @media (min-width: 768px) { .main { padding-right: 40px; padding-left: 40px; } }
            .main .page-header { margin-top: 0; }
            .placeholders { margin-bottom: 30px; text-align: center; }
            .placeholders h4 { margin-bottom: 0; }
            .placeholder { margin-bottom: 20px; }
            .placeholder img { display: inline-block; border-radius: 50%; }
        </style>
    </head>
    <body role="document">

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/zablose/navbar/demo') }}">Navbar Demo</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    {!! $navbar->prepare()->render('main'); !!}
                    <form class="navbar-form navbar-right" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                    {!! $navbar->prepare()->render('dashboard') !!}
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <div class="jumbotron">
                        <h1>Hello, world!</h1>
                        <p>Welcome to the Navbar Demo page.</p>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    </body>
</html>