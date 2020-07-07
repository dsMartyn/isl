<header class="banner fixed-top mb-0">
  <nav class="navbar navbar-expand-lg bg-white">
    <div class="container">
      <div class="is-navbar-header d-flex justify-content-center align-items-center d-block-lg">
        <button class="navbar-toggler position-absolute" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"><i class="far fa-bars"></i></span>
        </button>
        <div class="is-navbar-logo">
          <a class="navbar-brand ml-0 mr-0 mr-lg-3 pt-2 pt-md-1 pt-lg-2 text-center" href="{{ home_url('/') }}"><img class="is-logo" src="@asset('images/invisiblesystems-black-no_strapline.svg')" alt="Invisible Systems" width="300" height="54"></a>
        </div>
      </div>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <button class="navbar-toggler float-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span>X</span>
        </button>
        <nav class="nav-primary ml-auto pr-4">
          @if (has_nav_menu('main_navigation'))
            {!! wp_nav_menu(['theme_location' => 'main_navigation', 'menu_class' => 'nav navbar-nav']) !!}
          @endif
        </nav>
      </div>
      <div class="is-navbar-search">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link py-0" data-toggle="collapse" href="#searchCollapse" aria-expanded="false" aria-controls="#searchCollapse"><i class="fal fa-search text-primary"></i></a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link py-0 border-left border-primary" data-toggle="modal" data-target="#getInTouchModal"><img src="@asset('images/human-icon.png')" alt="Human icon" width="20" height="20" class="mr-2 mt-n1"><span class="d-none d-lg-inline">Quote Request</span></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="collapse is-navbar-search--block" id="searchCollapse">
    <div class="p-3 bg-dark text-white">
      <div class="container">
        {!! get_search_form() !!}
      </div>
    </div>
  </div>
</header>
