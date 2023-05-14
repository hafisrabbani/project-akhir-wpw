<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Error {{ $error['code'] }} - {{ $error['message'] }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/highlightjs@11.3.1/styles/a11y-dark.min.css">
    <script src="https://cdn.jsdelivr.net/npm/highlightjs@11.3.1/lib/highlight.min.js"></script>
    <script>hljs.highlightAll();</script>

    <style>
        body {
            background-color: #1a1a1a;
            color: #f1f1f1;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-align: center;
            padding-top: 2rem;
        }

        h1 {
            font-size: 3rem;
            margin-top: 2rem;
            color: #f1f1f1;
        }

        h2 {
            font-size: 2rem;
            margin-top: 0.5rem;
            color: #f1f1f1;
        }

        p {
            font-size: 1.2rem;
            margin-top: 0.3rem;
            color: #f1f1f1;
        }

        .error-message {
            background-color: #2b2b2b;
            color: #f1f1f1;
            padding: 2rem;
            border-radius: 1rem;
            display: inline-block;
            margin-top: 2rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.2);
            width: 80%;
            text-align: left;
        }

        .error-message pre {
            font-size: 1rem;
            margin-top: 1rem;
            background-color: #1a1a1a;
            color: #f1f1f1;
            padding: 1rem;
            border-radius: 0.5rem;
            white-space: pre-wrap;
            word-break: break-word;
            overflow: auto;
        }

        .error-message pre code {
            display: block;
        }

        .button {
            background-color: #3472f7;
            color: #f1f1f1;
            margin-top: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            text-decoration: none;
            transition: background-color 0.2s ease-in-out;
        }

        .button:hover {
            background-color: #1540ab;
            color: #f1f1f1 !important;
        }

        .small-text {
            font-size: 0.8rem;
            color: #777;
            margin-top: 0.5rem;
        }

        .error-header {
            font-size: 1.5rem;
            margin-top: 0.5rem;
            color: #f1f1f1;
        }
    </style>
</head>

<body>
    <h1 style="color: #3472f7;">Error {{ $error['code'] }}</h1>
    <div class="error-message">
        <h4 style="color: #3472f7;">Whoops! Something went wrong.</h4>
        <h5 class="error-header"><strong>{{ $error['message'] }}</strong></h5>
    </div>
    <div class="error-message">
        <p><strong>File:</strong> {{ $error['file'] }}</p>
        <p><strong>Line:</strong> {{ $error['line'] }}</p>
        <pre><code class="language-php">{{ $error['trace'] }}</code></pre>
        <a href="https://google.com/search?q={{ $error['message'] }}" class="button" target="_blank">Search on
            Google</a>
    </div>
    <div class="small-text">
        Windz Framework v1.0 - {{ date('Y') }} | By <a href="https://www.hafizrabbani.com"
            target="_blank">HafizRabbani</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/highlightjs@11.3.1/lib/highlight.min.js"></script>
    <script>hljs.highlightAll();</script>
</body>

</html>