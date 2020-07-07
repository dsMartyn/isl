{{-- <h1>DEEP BANNER</h1>
<pre>
{!! var_dump($banner) !!}
</pre> --}}
<div class="jumbotron jumbotron-fluid position-relative deep-banner d-flex align-items-end" style="background-image: url('{{ $banner['desktop'] }}');">
  <div class="container">
    <div class="overlay position-absolute w-100 h-100" style="background-color:{{ $banner['overlay']['colour'] }}; opacity: .{{ $banner['overlay']['opacity'] }};"></div>
    <div class="position-relative pt-sm-3 pt-lg-8 pt-xl-10 pb-xl-4 text-white">
      <h1 class="deep-banner__title lead mb-4 text-primary text-uppercase">{{ $banner['title'] }}</h1>
      <h1 class="deep-banner__text display-4 mb-4 font-weight-bold ">{!! $banner['text'] !!}</h1>
    </div>
  </div>
</div>
