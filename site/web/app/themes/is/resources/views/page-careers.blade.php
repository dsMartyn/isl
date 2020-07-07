@extends('layouts.app')

@section('content')

  @if ($banner)
    @include('partials.banner-'.$banner['type'])
  @endif

  <div class="wrap container" role="document">
    <div class="content">
      <main class="main">

        <div class="py-4 py-md-6 careers-header-max-width">
          <h2>{!! $fields['page_title'] !!}</h2>
          {!! $fields['page_content'] !!}
        </div>

        @include('partials.careers-teasers',[ 'career_categories' => $career_categories, 'careers' => $careers ])

      </main>
    </div>
  </div>

@endsection
