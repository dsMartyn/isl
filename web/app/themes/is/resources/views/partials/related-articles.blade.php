<div class="related-articles pt-4 pb-6">
  <div class="container">
    <h2 class="mb-4 text-primary text-uppercase font-weight-normal">Related @if (!empty($related_category_title)) {{ $related_category_title }} @else Articles @endif
      <a href="@if (!empty($related_category_title)) /{{ strtolower(str_replace(' ', '-', $related_category_title)) }} @else /news-events @endif" class="d-none d-sm-inline float-right lead text-primary text-capitalize">
        See all @if (!empty($related_category_title)) {{ $related_category_title }} @else News @endif <img src="@asset('images/arrow.svg')">
      </a>
    </h2>
    <div class="row">
      @foreach ($related_category_posts as $post)
        <div class="col-md-4 mb-4">
          <a href="{{ get_permalink($post->ID) }}" class="text-decoration-none text-white">
            <div class="service-tile d-flex align-items-end position-relative p-4 text-white" style="background-image: url('{{ get_the_post_thumbnail_url($post->ID) }}');">
              <div class="overlay position-absolute w-100 h-100 bg-transparent"></div>
              <div class="position-relative">
                <h2 class="service-tile__title">
                <span class="d-block mb-2 h6 text-uppercase font-weight-normal">{{ get_the_date( 'd/m/Y', $post->ID ) }}</span>
                  {{ $post->post_title }}
                </h2>
                <div class="service-tile__content">
                  <p>{{ $post->post_excerpt }}</p>
                </div>
              </div>
            </div>
          </a>
        </div>
      @endforeach

    </div>
  </div>
</div>
