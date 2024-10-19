<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=0.9, user-scalable=0, minimal-ui">
    <meta name="description" content="Poet, Post, Writer, Composer"/>
    <meta name="keywords" content=""/>
    <meta property="og:type" content="website"/>
    <meta property="og:site_name" content="Writer's Post | Poet's Post"/>
    <meta property="og:title" content="Writer's Post | Poet's Post"/>
    <meta property="og:description" content=""/>
    <meta property="og:image" content=""/>
    <meta property="og:url" content=""/>
    <meta itemprop="name" content="Writer's Post | Poet's Post"/>
    <meta itemprop="description"content=""/>
    <meta itemprop="image" content="" />
    <meta name="google-adsense-account" content="ca-pub-3304643762159808">
    <meta name="robots" content="index, follow">
    <meta name ="rating" content="adult">
    <meta name="author" content="Blooms-AI">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="canonical" href=""/>
    <link rel="apple-touch-icon" href="{{asset('symstorage/photo')}}/apple-touch-icon.png">
    <link rel="icon" type="image/gif" href="{{asset('symstorage/photo')}}/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital@0;1&family=Tiro+Bangla:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/bootstrap.css" />
    <link rel="stylesheet" href="{{asset('frontend')}}/css/style.css">
    <title>@yield('task_title')</title>
</head>
<body class="bg-greenblue">
    @yield('main_content')
    <script src="{{asset('frontend')}}/js/jquery.min.js"></script> 
    <script src="{{asset('frontend')}}/js/bootstrap.min.js"></script> 
    <script src="{{asset('frontend')}}/js/script.js"></script> 
    @include('task.task_ajax') 
    @vite(['resources/js/app.js'])
    <script>        
       document.addEventListener('DOMContentLoaded', function() {
        Echo.channel('tasks')
            .listen('TaskNotification', (data) => {
                alert(JSON.stringify(data));     
                const taskNotification = document.createElement('div');
                taskNotification.innerText = `New Task: ${event.task.body} at ${event.task.alarm_time}`;
                document.getElementById('notifications').appendChild(taskNotification);
            });
        });
    </script>
</body>
</html>