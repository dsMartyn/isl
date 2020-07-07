@extends('layouts.app')

@section('content')

  @if ($banner)
    @include('partials.banner-'.$banner['type'])
  @endif

  <div class="wrap container" role="document">
    <div class="content">
      <main class="main">

        <nav class="pt-1">
          <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-industry-tab" data-toggle="tab" href="#nav-industry" role="tab" aria-controls="nav-industry" aria-selected="true">Browse by Industry</a>
            <a class="nav-item nav-link" id="nav-service-tab" data-toggle="tab" href="#nav-service" role="tab" aria-controls="nav-service" aria-selected="false">Browse by Service</a>
          </div>
        </nav>

        <div class="tab-content pb-4" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-industry" role="tabpanel" aria-labelledby="nav-industry-tab">

            @include('partials.service-tiles',[ 'tiles' => $industries ])

          </div>
          <div class="tab-pane fade" id="nav-service" role="tabpanel" aria-labelledby="nav-service-tab">

            @include('partials.service-tiles',[ 'tiles' => $services ])

          </div>

      </main>
    </div>
  </div>

@endsection
