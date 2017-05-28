<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ isset($pageTitle) ? $pageTitle : 'Program Planner' }}</title>

    @include('layouts._css')
</head>
<body id="app-layout" ng-app="programPlannerApp">
@include('admin._navigation')

<div class="container-fluid">
    @include('admin._sidebar')
    <div class="col-sm-10">
        @if(Session::has('responseSuccess'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-close"></i></span>
                </button>
                {{ Session::get('responseSuccess') }}
            </div>
        @endif
        @if(Session::has('responseError'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-close"></i></span>
                </button>
                {{ Session::get('responseError') }}
            </div>
        @endif
        @yield('content')
    </div>
</div>

@include('layouts._js')
@yield('scripts')
</body>
</html>
