@extends('layouts.app')

@section('content')

  @if ($banner)
    @include('partials.banner-'.$banner['type'])
  @endif

  <div class="wrap" role="document">
    <div class="content">
      <div class="what-we-do py-6 py-xl-8 text-center" style="background-color: #F8F8F8;">
        <div class="max-width-lg-956">
          <div class="container">
            <h2 class="mb-4 font-weight-normal text-primary text-uppercase">{{$fields['section_fisrt_title']}}</h2>
            {!! $fields['section_first_details'] !!}
            {{-- <a href="/about-us/" class="text-primary">About Us <img src="@asset('images/arrow.svg')"></a> --}}
          </div>
        </div>
      </div>

      <div class="how-we-price pt-6 pt-xl-8 pb-4 pb-xl-6 text-center">
        <div class="container">
          <h2 class="mb-6 font-weight-normal text-primary text-uppercase">{{$fields['section_second_title']}}</h2>
          <div class="row">
            @if (is_array($fields['section_secound']))
            @foreach ($fields['section_secound'] as $icon)
                <div class="d-flex flex-column col-md-4 px-xl-6 mb-4">
                  <div class="d-flex align-items-end justify-content-center flex-grow-1">
                    <img src="{{$icon['icon']['url']}}" alt="{{$icon['title']}}">
                  </div>
                  <h2 class="mt-4 mb-2">{{$icon['title']}}</h2>
                  <p>{{$icon['content_details']}}</p>
                </div>
              @endforeach
            @endif
          </div>
        </div>
      </div>

      <div class="homepage-industries slick--play-on-hover py-6 py-xl-8" style="background-color: #F8F8F8;">
        <div class="container">
          <h2 class="mb-4 font-weight-normal text-primary text-uppercase">{{$fields['section_third_title']}}</h2>
          @include('partials.service-tiles', [ 'tiles' => $industries ])
          <a href="{{$fields['all_industry_link']}}" class="text-primary">See All Industries <img src="@asset('images/arrow.svg')"></a>
        </div>
      </div>

      <div class="homepage-page-content-column pt-6 pt-xl-8 pb-3">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-6">
              <img src="{{$fields['section_forth_image']['url']}}" alt="{{$fields['section_forth_title']}}">
            </div>
            <div class="col-md-6 px-lg-6">
              <h2 class="mb-4 text-primary font-weight-normal text-uppercase">{{$fields['section_forth_title']}}</h2>
              {!! $fields['section_forth_description'] !!}
            </div>
          </div>
        </div>
      </div>

      <div class="homepage-page-content-column mb-3 py-6 pb-xl-8">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-6">
              <img src="{{$fields['section_fifth_image']['url']}}" alt="{{$fields['section_fifth_title']}}">
            </div>
            <div class="col-md-6 order-first px-lg-6">
              <h2 class="mb-4 text-primary font-weight-normal text-uppercase">{{$fields['section_fifth_title']}}</h2>
              {!! $fields['section_fifth_content'] !!}
            </div>
          </div>
        </div>
      </div>

      @if (!empty($all_clients))
         @include('partials.all-clients', [ 'all_clients' => $all_clients, 'main_title' => $fields['section_six_title'] ])
      @endif

      <div class="environmental-benefits py-6 py-xl-8 text-center">
        <div class="max-width-lg-956">
          <div class="container">
            <h2 class="mb-4 font-weight-normal text-primary text-uppercase">{{$fields['section_seven_title']}}</h2>
            {!! $fields['section_seven_content'] !!}
          </div>
        </div>
      </div>

      @if (!empty($latest_case_studies))
        @include('partials.case-studies-latest', ['latest_case_studies' => $latest_case_studies])
      @endif

      @if (!empty($all_awards))
        @include('partials.our-awards', ['all_awards' => $all_awards])
      @endif

      @include('partials.get-in-touch')
    </div>
  </div>

@endsection
