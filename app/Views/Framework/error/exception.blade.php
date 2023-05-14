<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{$error['code']}} Error - {{$error['message']}}</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <style>
        body {
            background-color: #1a1a1a;
            color: #f1f1f1;
            font-family: 'Montserrat', sans-serif;
            text-align: center;
            padding-top: 2rem;
        }

        h1 {
            font-size: 4rem;
            margin-top: 2rem;
            color: #3472f7;
            padding-bottom: 1rem;
            border-bottom: 1px solid #3472f7;
        }

        p {
            font-size: 1.2rem;
            margin-top: 0.5rem;
            color: #666;
        }

        a {
            color: #3472f7;
            text-decoration: none;
        }

        .container {
            max-width: 800px;
            margin: auto;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>{{$error['code']}} {{$error['message']}}</h1>
        <h2>x_x</h2>
        <p>
            {{$error['message']}}
        </p>
        <div class="small-text">
            Windz Framework v1.0 - {{ date('Y') }} | By <a href="https://www.hafisrabbani.tech"
                target="_blank">HafizRabbani</a>
        </div>
    </div>
</body>

</html>