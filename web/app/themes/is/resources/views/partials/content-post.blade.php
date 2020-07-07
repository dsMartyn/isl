<article @php post_class() @endphp>

  @php $terms = get_the_terms( get_the_ID(), 'services' ); @endphp

  <a href="{{ get_permalink() }}" class="text-decoration-none text-white">
    <div class="case-studies-archive-tile d-flex align-items-end position-relative service-tile p-4 text-white" style="background-image: url('{{ get_the_post_thumbnail_url() }}');">
      <div class="overlay position-absolute w-100 h-100"></div>
      <div class="position-relative">
          <span class="service-tile__title d-block">
            @if (!empty($terms))
              @foreach ($terms as $term)
                <span class="d-inline-block mb-2 text-uppercase">{{ $term->name }}</span>
              @endforeach
            @endif
            <h2>{!! get_the_title() !!}</h2>
          </span>
        </span>
        <div class="service-tile__content">
          {!! the_excerpt() !!}
        </div>
      </div>
    </div>
  </a>
</article>
