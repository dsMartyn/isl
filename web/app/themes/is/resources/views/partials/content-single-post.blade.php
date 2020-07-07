<article @php post_class() @endphp>
  <div class="entry-content">
    <div class="case-study-background-overlay d-none d-md-block" style="background-color: #F8F8F8;"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <time class="updated d-block my-4" datetime="{{ get_post_time('c', true) }}">{{ get_the_date( 'd/m/Y' ) }}</time>
          <h1 class="entry-title font-weight-normal case-study--max-width">{!! get_the_title() !!}</h1>
          <div class="post-thumbnail my-5">
            {!! get_the_post_thumbnail() !!}
          </div>
          <div class="post-content case-study--max-width">
            @php
              the_content();
            @endphp
          </div>

          @php
            $fields = get_fields();
          @endphp

          @if (!empty($fields['quote']))
            <div class="case-study-quote py-2">
              <hr class="border-primary">
              <blockquote class="py-4 case-study--max-width">
                <h2 class="text-primary mb-6">"{{ $fields['quote'] }}"</h2>
                <footer class="lead text-primary">{{ $fields['quote_citation'] }}</footer>
              </blockquote>
              <hr class="border-primary">
            </div>
          @endif

          <div class="case-study-content-middle case-study--max-width py-2">
            {!! $fields['case_study_content_middle'] !!}
          </div>

          @if (is_array($fields['case_study_content_middle_images']))
            <div class="case-study-content-middle-images py-2">
              <div class="row">
                @foreach ($fields['case_study_content_middle_images'] as $content_middle_images)
                  <div class="col-sm-6 mb-4">
                    <img src="{{ $content_middle_images['url'] }}" alt="{{ $content_middle_images['alt'] }}">
                  </div>
                @endforeach
              </div>
            </div>
          @endif

          <div class="case-study-content-bottom case-study--max-width py-2">
            {!! $fields['case_study_bottom_content'] !!}
          </div>

          <div class="case-study--max-width pb-4">
            <hr class="border-steel">

            {{ __('Written by:', 'sage') }} <a href="{{ get_author_posts_url(get_the_author_meta('ID')) }}" rel="author" class="fn">
            {{ get_the_author() }}</a>
            <p class="mt-4 text-uppercase">Share</p>
            @php echo do_shortcode('[addtoany]'); @endphp
          </div>
        </div>

        <div class="case-study-aside col-md-4 order-md-first pr-md-4 pr-lg-6 mb-2">
          <hr class="border-primary">
          <a href="/news-events" class="lead pt-2 text-primary font-weight-normal"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Return to All Articles</a>
          <p class="mt-4 text-uppercase">Share</p>
          @php echo do_shortcode('[addtoany]'); @endphp
        </div>
      </div>

    </div>
  </div>
</article>
