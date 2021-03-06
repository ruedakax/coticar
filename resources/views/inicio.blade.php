<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" href="{{csrf_token()}}">
        <title>Laravel</title>
        <!-- Styles -->
		<link rel="stylesheet" href="{{asset('css/app.css')}}">
        <style>
            html, body {
                background: rgb(2,0,36);
                background: radial-gradient(circle, rgba(2,0,36,1) 0%, rgba(247,143,32,1) 100%, rgba(0,212,255,1) 100%);
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .titulo-cabeza{
                color: #f88102
            }
			.card-result{
				background-image: url("{{asset('images/car.png')}}");
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-position: center;
                min-height: 300px;
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
            .btn .custom-select{
                margin-top:10px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
				<div id="root"></div>                
            </div>
        </div>
    </body>
	<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
</html>
