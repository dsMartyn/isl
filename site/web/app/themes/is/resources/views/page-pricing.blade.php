@extends('layouts.app')

@section('content')

  @if ($banner)
    @include('partials.banner-'.$banner['type'])
  @endif

  <div class="wrap" role="document">
    <div class="content">
      <div class="hardware max-width-lg-956 py-4 py-xl-8 text-center">
        <div class="container">
          <h2 class="mb-4 text-primary text-uppercase font-weight-normal">{{ $fields['section_one_title'] }}</h2>
          {!! $fields['section_one_description'] !!}
        </div>
      </div>

      <div class="how-we-price py-6 pb-4 py-xl-8 text-center" style="background-color: #F8F8F8;">
        <div class="container">
          <h2 class="mb-6 font-weight-normal text-primary text-uppercase">{{ $fields['section_two_title'] }}</h2>
          <div class="row">

            @if (is_array($fields['section_two_icon_set']))

              @foreach($fields['section_two_icon_set'] as $icon)

                <div class="col-md-4 px-xl-6 mb-4">
                  <div class="d-flex align-items-end justify-content-center match-height">
                    <img src="{{ $icon['image']['url'] }}" alt="{{ $icon['title'] }}">
                  </div>
                  <h2 class="mt-4 mb-2">{{ $icon['title'] }}</h2>
                  {!! $icon['description'] !!}
                </div>

              @endforeach

            @endif

          </div>
        </div>
      </div>

      @include('partials.get-in-touch')

    </div>
  </div>
@endsection
