@extends('layouts.app')

@section('content')

  @if ($banner)
    @include('partials.banner-'.$banner['type'])
  @endif

  <div class="wrap" role="document">
    <div class="content">
      <div class="our-partner-programme max-width-lg-956 py-4 py-xl-8 text-center">
        <div class="container">
          <h2 class="mb-4 font-weight-normal text-primary text-uppercase">{{$fields['section_one_title']}}</h2>
          {!! $fields['section_one_description'] !!}
        </div>
      </div>

      <div class="benefits py-6 pb-4 py-xl-8 text-center" style="background-color: #F8F8F8;">
        <div class="container">
          <h2 class="mb-6 font-weight-normal text-primary text-uppercase">{{$fields['section_two_title']}}</h2>

          @if (is_array($fields['section_two_icon']))
            <div class="row">
              @foreach ($fields['section_two_icon'] as $icon)
                <div class="col-md-4 px-xl-6 mb-4">
                  <div class="d-flex align-items-end justify-content-center match-height">
                    <img src="{{$icon['icon']['url']}}" alt="{{$icon['title']}}">
                  </div>
                  <h2 class="mt-4 mb-2">{{$icon['title']}}</h2>
                  {!! $icon['description'] !!}
                </div>
              @endforeach
            </div>
          @endif

        </div>
      </div>

      @if(is_array($fields['section_three_content_area']))

        @php $i = 0; @endphp

        @foreach($fields['section_three_content_area'] as $area)

          <div class="partner-page-content-column pt-6 pb-3 @if($i == 0) pt-xl-8 @endif">
            <div class="container">
              <div class="row align-items-center">
                <div class="col-md-6">
                  <img src="{{ $area['image']['url'] }}" alt="Why Partner with us?">
                </div>
                <div class="col-md-6 px-lg-6 @if ($i%2 == 1) order-first @endif">
                  {!! $area['description'] !!}
                </div>
              </div>
            </div>
          </div>

          @php $i++; @endphp

        @endforeach

      @endif

      <div class="pb-xl-8"></div>

      @include('partials.get-in-touch')

    </div>
  </div>
@endsection
