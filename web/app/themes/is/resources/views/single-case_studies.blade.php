@extends('layouts.app')

@section('content')

  <div class="wrap" role="document">
    <div class="content">
      <main class="main">

        @while(have_posts()) @php the_post() @endphp
          @include('partials.content-single-'.get_post_type())
        @endwhile

        @if (!empty($related_category_case_studies))
          <div class="container">
            <hr class="border-primary">
          </div>
          @include('partials.related-articles', ['related_category_posts' => $related_category_case_studies, 'related_category_title' => 'Case Studies'])
        @endif

      </main>
    </div>
  </div>

@endsection
