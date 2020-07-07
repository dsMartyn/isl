@extends('layouts.app')

@section('content')

  <div class="wrap" role="document">
    <div class="content">
      <main class="main">
        @include('partials.news-events-featured')

        <div class="mt-4 mt-md-6 container">
          @include('partials.page-header')
        </div>

        @include('partials.news-events-teasers', [ 'news_categories' => $news_categories, 'news_posts' => $news_posts ])

      </main>
    </div>
  </div>

@endsection
