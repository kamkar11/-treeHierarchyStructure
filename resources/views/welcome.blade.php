<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .showAll{
                margin: 10px;

            }

            .treeStructure{
                margin: 60px;
            }

        </style>
    </head>
    <body>


        <div class=" position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

                <div class="showAll">
                    <button class="btn btn-primary" onclick="rozwin()" style="height: 50px; weigth: 150px">Show all tree</button>
                </div>




                <div id="jstree" class="treeStructure">
                    @if($categories === null)
                        <p>Something wrong</p>
                    @else
                    <ul>
                        @foreach($categories as $category)
                            <li>
                                {{ $category->name }}
                                @if(count($category->children))
                                    @include('manageChild',['childs' => $category->children])
                                @endif
                            </li>
                        @endforeach
                    </ul>
                    @endif
                </div>



        </div>



        <!-- 4 include the jQuery library -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
        <!-- 5 include the minified jstree source -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>


        <script>

            var rozwiniete = 0;

            function rozwin(){
                if (rozwiniete == 0){
                    rozwiniete = 1;
                    $('#jstree').jstree('open_all');
                } else {
                    rozwiniete = 0;
                    $('#jstree').jstree('close_all');
                }
            }

            $(function () {
                // 6 create an instance when the DOM is ready
                $('#jstree').jstree({
                    'plugins' : ["sort"]
                });

            });
        </script>

    </body>
</html>
