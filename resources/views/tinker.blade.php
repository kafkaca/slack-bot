<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BotMan Studio</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        body {
            font-family: "Source Sans Pro", sans-serif;
            margin: 0;
            padding: 0;
            background: radial-gradient(#57bfc7, #45a6b3);
        }

        .container {
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
        }

        .content {
            text-align: center;
        }
        .ChatLog {
            max-width: 100em !important;
            margin: 0 auto;
        }
        ul.ChatLog {
            max-height: 600px !important;
            overflow-y: scroll !important;
        }   
    </style>
</head>
<body>
<div class="container">
    <div class="content" id="app">
        <botman-tinker api-endpoint="/botman" user-id="{!! $user_id !!}"></botman-tinker>
       <!-- <iframe src="/botman/chat" frameborder="0"></iframe> -->
    </div>
</div>

<script src="/js/app.js"></script>
</body>
</html>