<!DOCTYPE html>
<html>
    <head>
        <title>Laravel 4.2</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Laravel 4.2</div>
                <!--h2><a href="http://git.laravel-5.com/protected-route?expires=1445459977&signature=88d6968e13ce18dac397eba61b6fe96b">Expiry Link [2 hours]</a></h2-->
                @if($validate == true)
                    <h2>Link is available</h2>
                @else
                    <h2>Link is not available</h2>
                @endif
            </div>
        </div>
    </body>
</html>
