<div class="service-tiles mb-4">
  <div class="row">
    @foreach ($tiles as $tile)
      <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
        <a href="{{ $tile['link'] }}" class="text-decoration-none text-white">
          <div class="d-flex align-items-end position-relative service-tile p-4 text-white" style="background-image: url('{{ $tile['image'] }}');">
            <div class="overlay position-absolute w-100 h-100"></div>
            <div class="position-relative">
              <h3 class="service-tile__title">{!! $tile['title'] !!}</h3>
              <div class="service-tile__content">
                {{ $tile['content'] }}
              </div>
            </div>
          </div>
        </a>
      </div>
    @endforeach
  </div>
</div>
