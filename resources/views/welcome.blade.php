<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

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
            * {box-sizing: border-box;}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=button] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=button]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
.divice {
    margin: 50px 0px;
}
.upfile-title {
    margin-bottom: 30px 
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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Gen Card
                </div>

                <div class="container">
                <form action="/">
                    <label for="fname">First Name</label>
                    <input type="text" id="seri" name="firstname" placeholder="Seri">

                    <label for="lname">Last Name</label>
                    <input type="text" id="code" name="lastname" placeholder="Code">

                    <input type="button" value="Gen Card" id="btn-gen-card">
                </form>
                <div class="divice">
                    <hr>
                </div>
                <div class="upfile-title">
                    <label for="fname">Upload File</label>
                </div>
                <form action="/upload-file" method="POST">
                    {{ csrf_field() }}
                    <label for="file">Select files:</label>
                    <input type="file" id="file" name="file"><br><br>
                    <input type="submit" id="btn-submit">
                </form>
                </div>
            </div>

        </div>
    </body>
    <script type="text/javascript">
        $(document).ready(function() {
            var disabled = 'disabled';
            var file = $('#file');
            var submit = $('#btn-submit');
            var seri = $('#seri');
            var code = $('#code');

            file.disabled = disabled;
            submit.disabled = disabled;

            $("#btn-gen-card").click(function(){
                var request = new XMLHttpRequest()

                // Open a new connection, using the GET request on the URL endpoint
                request.open('GET', 'http://localhost:8000/get-card', true)

                request.onload = function() {
                    var data = JSON.parse(this.response)

                    console.log(data.card);

                    if(data.card !== null) {
                        seri.val(data.card.seri);
                        code.val(data.card.code);
                    } else {
                        seri.val('');
                        code.val('');
                    }
                }

                // Send request
                request.send()
            });
        });

    </script>
</html>
