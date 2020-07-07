<div class="all-clients slick--play-on-hover py-6 py-xl-8 text-center" style="background-color: #F8F8F8;">
  <div class="container">
    @if ($main_title)
      <h2 class="mb-8 font-weight-normal text-primary text-uppercase">{{ $main_title }}</h2>
    @endif
    <div class="row all-clients__row">
      @foreach ($all_clients as $client)
        <div class="mx-4">
          @php
            echo get_the_post_thumbnail( $client->ID, 'thumbnail' );
          @endphp
        </div>
      @endforeach
    </div>
  </div>
</div>
