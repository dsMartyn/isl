@extends('layouts.app')

@section('content')

  @if ($banner)
    @include('partials.banner-'.$banner['type'])
  @endif

  <div class="wrap" role="document">
    <div class="content">

      @foreach ($fields['section_first'] as $section)

        <div class="{!! strtolower($section['title']) !!} max-width-lg-956 py-4 py-xl-8">
          <div class="container">
            <h2 class="mb-4">{!! $section['title'] !!}</h2>
            {!! $section['description'] !!}
          </div>
        </div>

        @if (is_array($section['product']))

          <div class="{!! strtolower($section['title']) !!}-grid">
            <div class="container">
              <div class="row">

                @foreach ($section['product'] as $product)

                  <div class="col-sm-6 col-lg-4 mb-4">

                    @if ($product['product_pdf_link'] != "")
                    <a href="{!! $product['product_pdf_link'] !!}" class="text-decoration-none" target="_blank">
                    @endif

                    <img src="{{ $product['product_image']['url'] }}" alt="{{ $product['product_title'] }}">
                    <h2 class="mt-2">{{ $product['product_title'] }}</h2>
                    {!! $product['product_short_details'] !!}

                    @if ($product['product_pdf_link'] != "")
                    </a>
                    @endif

                  </div>

                @endforeach

              </div>
            </div>
          </div>

        @endif

      @endforeach

      @include('partials.footer-page-links')

    </div>
  </div>
@endsection
