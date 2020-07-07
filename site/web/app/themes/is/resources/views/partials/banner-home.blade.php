{{-- <h1>HOME BANNER</h1>
<pre>
{!! var_dump($banner) !!}
</pre> --}}
<div class="banner-home jumbotron jumbotron-fluid mb-0 pb-10" style="background-image: url('{{ $banner['desktop'] }}');">
  <div class="container pt-6">
    <h1 class="display-3 text-uppercase font-weight-bold text-primary">{!! str_replace(' ', '<br>', $banner['title']) !!}</h1>
    <p class="lead mb-6">{{ $banner['text'] }}</p>
    <a href="{{ $banner['url'] }}" class="banner-home__link text-primary">{{ $banner['link'] }} <i class="fal fa-long-arrow-down ml-2"></i></a>
  </div>
</div>
<div id="{{ str_replace('#', '', $banner['url']) }}"></div>
