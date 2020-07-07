<div class="testimonials pt-6 pt-xl-8 pb-4 pb-xl-6">
  <div class="container">
    <div class="testimonials__slider">
      @foreach ($all_testimonials as $testimonial)
        <div class="testimonials__slide">
          <div class="row">
            <div class="col-lg-6">
              <div class="testimonials__slide__image">
                <img class="m-auto" src="{{ get_the_post_thumbnail_url($testimonial->ID) }}" style="max-width: 255px;">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="testimonials__slide__content">
                <p class="text-primary text-uppercase">Testimonial</p>
                <p class="lead mb-4">{{ $testimonial->post_content }}</p>
                <hr class="border-primary">
                <p class="text-primary">{{ get_field('company_name', $testimonial->ID) }}</p>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>
