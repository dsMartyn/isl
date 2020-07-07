@extends('layouts.app')

@section('content')

  <div class="wrap" role="document">
    <div class="content">
      <main class="main">

        @while(have_posts()) @php the_post() @endphp
          @include('partials.content-single-'.get_post_type())

          <div id="apply-now">
            @include('partials.apply-now')
          </div>
        @endwhile
      </main>
    </div>
  </div>

@endsection
