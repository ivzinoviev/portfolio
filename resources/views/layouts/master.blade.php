<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Портфолио</title>
        <script src="//code.jquery.com/jquery-2.2.4.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link href="//bootswatch.com/flatly/bootstrap.min.css" rel="stylesheet"/>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
        <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
        <script src="/js/jquery.magnific-popup.min.js"></script>
        <link href="/css/magnific-popup.css" rel="stylesheet"/>
        <link href="/css/style.css" rel="stylesheet"/>
        @if (Auth::check())
            <script src="/js/admin.js"></script>
        @else
            <script src="/js/user.js"></script>
        @endif
    </head>
    <body>
                    <div id="_token" class="hidden" data-token="{{ csrf_token() }}"></div>
                    @include('navbar')
                    @yield('content')
    </body>
</html>
