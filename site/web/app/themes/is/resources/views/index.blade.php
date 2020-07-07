@extends('layouts.app')

@section('content')

  <div class="wrap container" role="document">
    <div class="content">
      <main class="main">

        @include('partials.page-header')

        @if (!have_posts())
          <div class="alert alert-warning">
            {{ __('Sorry, no results were found.', 'sage') }}
          </div>
          {!! get_search_form(false) !!}
        @endif

        @while (have_posts()) @php the_post() @endphp
          @include('partials.content-'.get_post_type())
        @endwhile

        {!! get_the_posts_navigation() !!}

      </main>
    </div>
  </div>

@endsection
