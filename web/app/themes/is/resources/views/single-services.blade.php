@extends('layouts.app')

@section('content')

  <div class="wrap" role="document">
    <div class="content">
      <main class="main">

        @include('partials.service-header', [ 'header' => $header ])

        @include('partials.service-tabs', [ 'tabs' => $tabs, 'header' => $header ])

        @include('partials.all-clients', [ 'all_clients' => $all_clients, 'main_title' => "Who we've helped" ])

        {{-- @include('partials.case-studies-slider', ['latest_case_studies' => $latest_case_studies]) --}}

        @if (!empty($related_posts_from_current_title))
          <div class="pt-4">
            @include('partials.related-articles', ['related_category_posts' => $related_posts_from_current_title])
          </div>
        @endif

        <div id="get-in-touch">
          @include('partials.get-in-touch')
        </div>

      </main>
    </div>
  </div>

@endsection
