@php
  $featured = get_posts([
    'meta_key' => 'set_as_featured',
    'meta_value' => 1,
    'post_type' => 'post',
    'posts_per_page' => 1
  ]);

  if (empty($featured)) {
    return;
  }

  $featured_terms = wp_get_post_terms( $featured[0]->ID, 'category' );

@endphp

  <div style="background-color: #f8f8f8;">
    <div class="container">
      <div class="archive-case-studies-featured position-relative">

        @php $case_study_featured_image = get_field('case_study_featured_image', $featured[0]->ID); @endphp

        @if (!empty($case_study_featured_image))
          <img class="d-block ml-auto" src="{{ $case_study_featured_image['url'] }}">
        @else
          <img class="d-block ml-auto" src="{{ get_the_post_thumbnail_url($featured[0]->ID) }}">
        @endif

        <div class="archive-case-studies-featured__content px-4 px-sm-8 py-6 bg-steel text-white">
          <span class="d-inline-block mb-4 text-uppercase">{{ get_the_date('d/m/Y', $featured[0]->ID) }} |</span>
          @if (!empty($featured_terms))
            @foreach ($featured_terms as $term)
              <span class="d-inline-block mb-4 text-uppercase">{{ $term->name }}</span>
            @endforeach
          @endif
          <p class="lead mb-4 font-weight-bold">{!! get_the_title($featured[0]->ID) !!}</p>
          {!! get_the_excerpt($featured[0]->ID) !!}
          <hr class="mb-0 border-primary">
          <a href="{{ get_permalink() }}" class="d-block my-2 text-primary">Read More <img src="@asset('images/arrow.svg')" alt=""></a>
        </div>
      </div>
    </div>
  </div>
