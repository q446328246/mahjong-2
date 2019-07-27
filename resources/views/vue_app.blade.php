<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <title>VueSample</title>
    <link href="https://fonts.googleapis.com/css?family=Orbitron" rel="stylesheet">

<!--     <link href="{{asset("bower_components/admin-lte/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" /> -->
<!--     <link href="{{asset("bower_components/admin-lte/dist/css/skins/skin-blue.min.css")}}" rel="stylesheet" type="text/css" /> -->
<!--     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

<!--     <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" > -->
<!--         <meta charset="utf-8"> -->
<!--         <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
<!--         <meta name="viewport" content="width=device-width, initial-scale=1"> -->

<!--         <title>Laravel</title> -->

<!--         <link rel="stylesheet" href="{{ mix('css/app.css') }}"></script> -->

<!--         <script> -->

<!--         </script> -->
    </head>
    <body>
        <div id="app">
            <div class="container">
                <router-view></router-view>
            </div>
        </div>
    </body>
    <script src="{{ mix('js/app.js') }}"></script>
</html>