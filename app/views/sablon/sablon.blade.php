<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="description" content=""/>
        <meta name="author" content=""/>
        @yield('title')
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"/>
        <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet"/>
        <link href="{{ asset('css/prettyPhoto.css') }}" rel="stylesheet"/>
        <link href="{{ asset('css/price-range.css') }}" rel="stylesheet"/>
        <link href="{{ asset('css/animate.css') }}" rel="stylesheet"/>
        <link href="{{ asset('css/main.css') }}" rel="stylesheet"/>
        <link href="{{ asset('css/responsive.css') }}" rel="stylesheet"/>
        <link href="{{ asset('css/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
        <!--[if lt IE 9]> 
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->       
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}"/>
        <script src="{{ asset('http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/jquery.scrollUp.min.js') }}"></script>
        <script src="{{ asset('js/price-range.js') }}"></script>
        <script src="{{ asset('js/jquery.prettyPhoto.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="{{ asset('js/plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap.js') }}" type="text/javascript"></script>
        <!-- page script -->
        <script type="text/javascript">
$(function () {
    $("#example1").dataTable();
    $('#example2').dataTable({
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": false,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false
    });
});
        </script>

        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-55176856-1', 'auto');
            ga('send', 'pageview');

        </script>
    </head><!--/head-->
    <?php
    if (Sentry::check()) {
        DB::table('online')->insert(
                array('time' => time(), 'ip' =>  Request::server('HTTP_CLIENT_IP'), 'users_id' => Sentry::getUser()->id)
        );
    }
    ?>
    <body>
        @include ('sablon/header')
        @yield('container')
        @include ('sablon/footer')


    </body>

</html>
