@extends('layouts.full-screen-master')
@section('title', 'Wishyouapp.in | Quotes')

@section('content')
<?php
  $columns = 3;
?>
<section class="container">
          <h1 class="title">Quotes</h1>
            @foreach ($quotes['data'] as $key => $quote)
             @if ($key % $columns  == 0)
                <div class="columns is-multiline "><!-- column open {{ $key % $columns  }} -->
             @endif
              <div class="column has-text-centered is-{{ $columns / 12 }}">
                <div class="card">
                  <div class="card-image">
                    <figure class="image is-4by3">
                      {{-- <img src="https://wishyouapp.in/adminpanel/images/{{ $quote->category_image }}" alt="{{ $quote->category_name }} images {{ $quote->category_name }}"> --}}
                      <img src="https://bulma.io/images/placeholders/1280x960.png" alt="Placeholder image">
                    </figure>
                  </div>
                  <div class="card-content">
                  <p class="title">
                    <?= $quote->quote; ?>
                    {{-- {!!  $quote->quote  !!} --}}
                  </p>
                  <p class="subtitle">
                      {{ $quote->category_name }}
                  </p>
                </div>
                <footer class="card-footer">
                  <a href="#" class="card-footer-item">Copy</a>
                  <a href="#" class="card-footer-item">Share</a>
                </footer>
                </div>
              </div>
              @if ( $key % $columns  == $columns - 1)
                </div><!-- column end {{ $key % $columns  }} -->
              @endif
            @endforeach


          <div class="columns">
            <div class="column is-2">
            <?php
              $pagination = $quotes['pagination'];
            ?>
              {{ view('vendor.pagination.bulma', compact('pagination')) }}
              </div>
          </div>
        </section>
@endsection