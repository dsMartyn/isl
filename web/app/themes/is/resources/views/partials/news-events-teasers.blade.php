<div class="py-4">
  <div class="container">
    <div id="news-events-tabs">
      <div class="nav nav-tabs row mb-4" id="nav-tab" role="tablist">
        @foreach ($news_categories as $key => $news_category)
          <a class="col-sm-4 nav-item nav-link @if ($key == 0) active @endif rounded-0" id="nav-{{ $news_category->slug }}-tab" data-toggle="tab" href="#nav-{{ $news_category->slug }}" role="tab" aria-controls="nav-{{ $news_category->slug }}" aria-selected="false"><span class="d-block pb-2">{{ $news_category->name }}</span></a>
        @endforeach
      </div>
      <div class="tab-content" id="nav-tabContent">
        @foreach ($news_categories as $key => $news_category)
          <div class="tab-pane fade @if ($key == 0) show active @endif" id="nav-{{ $news_category->slug }}" role="tabpanel" aria-labelledby="nav-{{ $news_category->slug }}-tab">
            <div class="row">
              @foreach ($news_posts as $news)
                @if (in_array($news_category->slug, $news['category_slug']))
                  <div class="col-sm-6 col-md-4 mb-4">
                    <a href="{{ $news['link'] }}" class="text-decoration-none text-white">
                      <div class="d-flex align-items-end position-relative service-tile case-studies-archive-tile p-4 text-white" style="background-image: url('{{ $news['thumbnail_url'] }}');">
                        <div class="overlay position-absolute w-100 h-100"></div>
                        <div class="position-relative">
                          <span class="service-tile__title d-block">
                            <span class="d-block mb-3 font-weight-normal text-uppercase">{{ $news['post_date'] }} | @foreach ($news['category_name'] as $category_name) <span class="mr-2">{{ $category_name }}</span> @endforeach</span>
                            <h2>{!! $news['title'] !!}</h2>
                          </span>
                          <div class="service-tile__content">
                            {{ $news['excerpt'] }}
                            <p class="mt-4">Read More <img src="@asset('images/arrow-w.png')"></p>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                @endif
              @endforeach
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
