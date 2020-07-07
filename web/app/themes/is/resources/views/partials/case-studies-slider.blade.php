<div class="case-studies py-6">
  <div class="container position-relative">
    <h2 class="mb-4 text-primary text-uppercase font-weight-normal">Case Studies</h2>
    <div class="case-studies__slider">
      @foreach ($latest_case_studies as $case_study)
        <div class="case-studies__slider--slide position-relative">
          {!! get_the_post_thumbnail($case_study->ID, 'case_studies_slider_thumb') !!}
          <div class="case-studies__slider__content match-height p-4 p-sm-8 bg-steel text-white">
            {{-- @foreach (wp_get_post_terms($case_study->ID, 'services' ) as $term)
              <p class="lead">{{ $term->name }}</p>
            @endforeach --}}
            <h2 class="mb-4">{{ get_the_title($case_study->ID) }}</h2>
            <p class="mb-4">{{ get_the_excerpt($case_study->ID) }}</p>
            <hr class="border-primary">
            <a href="{{ get_post_permalink($case_study->ID) }}" class="text-primary">Read more <img class="d-inline" src="@asset('images/arrow.svg')"></a>
          </div>
        </div>
      @endforeach
    </div>
    <div class="case-studies__slider--arrows text-center">
      <div class="d-inline-block align-middle case-studies--prev-slide m-4"><i class="fal fa-chevron-left fa-3x text-lighttext"></i></div>
      <div class="d-inline-block align-middle case-studies__pageinfo"></div>
      <div class="d-inline-block align-middle case-studies--next-slide m-4"><i class="fal fa-chevron-right fa-3x text-lighttext"></i></div>
    </div>
  </div>
</div>
