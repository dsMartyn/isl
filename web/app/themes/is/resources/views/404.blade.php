@extends('layouts.app')

@section('content')

  <div class="wrap container" role="document">
    <div class="content">
      <main class="main">

        @include('partials.page-header')

        @if (!have_posts())
          <div class="alert alert-warning">
            {{ __('Sorry, but the page you were trying to view does not exist.', 'sage') }}
          </div>
          {!! get_search_form(false) !!}
        @endif

      </main>
    </div>
  </div>

@endsection
