@extends('layouts.app')

@section('content')

  <div class="wrap" role="document">
    <div class="content">
      <main class="main">
        @include('partials.case-studies-featured')

        <div class="mt-4 mt-md-6 container">
          @include('partials.page-header')
        </div>

        @if (!have_posts())
          <div class="alert alert-warning">
            {{ __('Sorry, no results were found.', 'sage') }}
          </div>
          {!! get_search_form(false) !!}
        @endif

        <div class="container my-4 my-md-6">
          <div class="row">
            @while (have_posts()) @php the_post() @endphp
              <div class="col-sm-6 col-md-4 mb-4">
                @include('partials.content-'.get_post_type())
              </div>
            @endwhile
          </div>
        </div>


        {!! get_the_posts_navigation() !!}

      </main>
    </div>
  </div>

@endsection
