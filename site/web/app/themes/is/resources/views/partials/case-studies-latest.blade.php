<div class="case-studies-block py-6 py-xl-8" style="background-color: #F8F8F8;">
  <div class="container">
    <h2 class="mb-4 text-primary text-uppercase font-weight-normal">Case Studies</h2>
      <div class="row">
        @foreach ($latest_case_studies as $case_study)
          <div class="col-md-6 mb-4">
            <a href="{{ get_field('pdf_link', $case_study->ID) }}" target="_blank" class="text-decoration-none text-white">
            <div class="service-tile d-flex align-items-end position-relative p-4 text-white" style="background-image: url('{{ get_the_post_thumbnail_url($case_study->ID) }}');">
                <div class="overlay position-absolute w-100 h-100 bg-transparent"></div>
                <div class="position-relative">
                  <span class="service-tile__title d-block">
                  @foreach (wp_get_post_terms($case_study->ID, 'services' ) as $term)
                  <span class="d-inline-block mb-2 text-uppercase">{{ $term->name }}</span>
                  @endforeach
                  <h2>{{ $case_study->post_title }}</h2>
                  </span>
                  <div class="service-tile__content">
                    <p>{{ $case_study->post_excerpt }}</p>
                  </div>
                </div>
              </div>
            </a>
          </div>
        @endforeach
      </div>
  </div>
</div>
