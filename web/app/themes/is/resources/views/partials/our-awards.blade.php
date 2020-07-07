<div class="our-awards slick--play-on-hover py-6 py-xl-8 text-center">
  <div class="container">
    <h2 class="mb-6 mb-xl-8 font-weight-normal text-primary text-uppercase">Our Awards</h2>
    <div class="row our-awards__row">
      @foreach ($all_awards as $award)
        <div class="mx-4">
          @php
            echo get_the_post_thumbnail( $award->ID, 'thumbnail' );
          @endphp
        </div>
      @endforeach
    </div>
  </div>
</div>
