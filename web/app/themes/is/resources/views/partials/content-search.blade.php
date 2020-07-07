<article @php post_class() @endphp>
  <header class="mt-4">
    <h2 class="entry-title"><a href="{{ get_permalink() }}">{!! get_the_title() !!}</a></h2>
    @if (get_post_type() === 'post')
      @include('partials/entry-meta')
    @endif
  </header>
  <div class="entry-summary mb-4 pb-4 border-bottom border-primary">
    @php the_excerpt() @endphp
  </div>
</article>
