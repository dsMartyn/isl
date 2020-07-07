<div class="jumbotron jumbotron-fluid position-relative shallow-banner" style="background-image: url('{{ $banner['desktop'] }}');">
  <div class="container mw-100">
    <div class="overlay position-absolute w-100 h-100" style="background-color:{{ $banner['overlay']['colour'] }}; opacity: .{{ $banner['overlay']['opacity'] }};"></div>
    <div class="position-relative p-sm-3 p-lg-8 text-center text-white">
      <h1 class="shallow-banner__title display-4 mb-4 font-weight-bold text-uppercase">{{ $banner['title'] }}</h1>
      <p class="shallow-banner__text lead">{{ $banner['text'] }}</p>
    </div>
  </div>
</div>
