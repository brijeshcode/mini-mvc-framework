@extends('layouts.full-screen-master')

@section('title', 'Wishyouapp.in | Images')


@section('content')
<?php
  $columns = 3;
?>
    <section class="container">
          <h1 class="title">Images</h1>
            @foreach ($imgs['data'] as $key => $img)
             @if ($key % $columns  == 0)
                <div class="columns is-multiline "><!-- column open {{ $key % $columns  }} -->
             @endif

              <div class="column has-text-centered is-{{ $columns / 12 }}">
                <div class="card">
                  <div class="card-image">
                    <figure class="image is-4by3">
                      {{-- <img src="https://wishyouapp.in/adminpanel/images/{{ $img->story_image }}" alt="{{ $img->story_image }} images {{ $img->author_name }}"> --}}
                      <img src="https://bulma.io/images/placeholders/1280x960.png" alt="Placeholder image">
                    </figure>
                  </div>
                  <div class="card-content">
                  <p class="title">
                    {{-- “There are two hard things in computer science: cache invalidation, naming things, and off-by-one errors.” --}}
                  </p>
                  <p class="subtitle">
                      {{ $img->author_name }}
                      <a href="category/{{ $img->author_name }}">{{ $img->author_name }}</a>
                  </p>
                </div>
                </div>
              </div>
              @if ( $key % $columns  == $columns - 1)
                </div><!-- column end {{ $key % $columns  }} -->
              @endif
            @endforeach

          <div class="columns">
            <div class="column is-2">
            <?php
              $pagination = $imgs['pagination'];
            ?>
              {{ view('vendor.pagination.bulma', compact('pagination')) }}
              </div>
          </div>

        </section>
@endsection