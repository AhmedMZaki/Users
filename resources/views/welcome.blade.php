<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <script src="{{asset('js/vue.js')}}"></script>
        <script src="{{asset('js/axios.js')}}"></script>
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
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
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

            <div class="content">
                <div class="title m-b-md" id="app1">
                    <form method="get" action="" @submit.prevent="search">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="search" id="search" class="form-control" v-model="searchBody">
                            <input type="submit" name="submit" value="submit" >
                        </div>
                    </form>
                </div>

                <div>
                    <lable>search result</lable>
                    <ul id="list">
                    </ul>
                </div>
            </div>
        </div>
    <script>
        var app1 = new Vue({
            el: '#app1',
            data: {
                searchBody: ''
            },
            methods:{
                search:function () {
                   if (this.searchBody)
                   {
                       axios.get("/search/"+this.searchBody, {
                       })
                           .then(function (response) {
                               console.log(response.data);
                               for (var i=0 ;i<response.data.length;i++)
                               {
                                   li = document.createElement('li');
                                   li.innerHTML = response.data[0].name;
                                   document.getElementById('list').appendChild(li);
                               }
                           })
                           .catch(function (error) {
                               alert('error');
                           });
                   }else{
                       alert('you can not search for empty data');
                   }
                }
            }
        })
    </script>
    </body>
</html>
