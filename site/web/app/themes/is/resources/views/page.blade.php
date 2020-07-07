@extends('layouts.app')

@section('content')

  @if ($banner)
    @include('partials.banner-'.$banner['type'])
  @endif

  <div class="wrap container my-6" role="document">
    <div class="content">
      <main class="main">

        @while(have_posts()) @php the_post() @endphp
          @include('partials.content-page')
        @endwhile

      </main>
    </div>
  </div>

@endsection
