<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

         <title>@yield('title' )</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <!-- Styles -->
        <link rel="stylesheet" href="public/css/app.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@700&display=swap" rel="stylesheet">

        <style>
            body {
               font-family: 'Mukta', sans-serif;
            }
        </style>
    </head>

    <body>
    <section class="hero is-success">
    @include('layouts.partials.main-nav')

     <!-- Hero content: will be in the middle -->
{{--     <div class="hero-body">
        <div class="container has-text-centered">
          <p class="title">
            Title
          </p>
          <p class="subtitle">
            Subtitle
          </p>
        </div>
    </div> --}}
</section>