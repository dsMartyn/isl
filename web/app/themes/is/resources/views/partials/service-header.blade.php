{{-- <pre>
  {!! print_r($header) !!}
</pre> --}}

<div class="service-header py-6" style="background-color: #F8F8F8;">
  <div class="container">
    @if ($header['type'])
       <p class="lead mb-1 text-uppercase text-primary">{{ $header['type'] }} /</p>
    @endif
    <p class="lead font-weight-bold">{!! $header['title'] !!}</p>
    <div class="lead service-header__intro">{!! $header['intro'] !!}</div>
    @if ($header['desktop_image'])
      <div class="service-header__image position-relative pt-4 text-right">
        <img src="{{ $header['desktop_image'] }}" alt="{!! $header['title'] !!}">
        <div class="service-header__image__chevron d-none d-xl-block position-absolute text-left"><a href="#service-tabs"><i class="fal fa-chevron-down fa-3x text-primary" aria-hidden="true"></i></a></div>
      </div>
    @endif
  </div>
</div>
