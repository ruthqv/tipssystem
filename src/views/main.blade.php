<!DOCTYPE doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
            <meta content="IE=edge" http-equiv="X-UA-Compatible">
                <meta content="width=device-width, initial-scale=1" name="viewport">
                    <meta content="{{ csrf_token() }}" name="csrf-token">
                      <link rel="shortcut icon" href="/favicon.ico">

                        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
                        <link href="{{ asset('css/custom/style.css') }}" rel="stylesheet" type="text/css">
                 

                            <title>
                                    Laravel Tips & Tricks

                            </title>
                        </link>
                    </meta>
                </meta>
            </meta>
        </meta>
    </head>
    <body>
   <section>
        @if(!empty($error))
            <div class="alert alert-danger">
                {{$error}}
            </div>
        @endif
   </section> 
       <section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12"> @yield('header')</div>
        </div>
    </div>
    </section>
    <section>
        <div class="col-sm-12">
            <div id="app">
            </div>
        </div>
    </section>      
    <section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12"> @yield('content')</div>
        </div>
    </div>
    </section>
        @yield('variables')
         <script src="{{ asset('js/app.js') }}"></script>

    </body>
</html>    