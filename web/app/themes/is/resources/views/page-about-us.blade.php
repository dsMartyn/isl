@extends('layouts.app')

@section('content')

  @if ($banner)
    @include('partials.banner-'.$banner['type'])
  @endif

  <div class="wrap" role="document">
    <div class="content">
      <div class="what-we-do max-width-lg-956 py-4 py-lg-8 text-center">
        <div class="container">
          <p class="mb-4 font-weight-bold text-uppercase">{{$fields['about_lead_title']}}</p>
          <h2 class="mb-4 font-weight-normal text-primary text-uppercase">{{$fields['about_lead_subtitle']}}</h2>
          {!!$fields['about_lead_content']!!}
        </div>
      </div>

      <div class="reasons-to-choose-us py-4">
        <div class="container">
          <div class="reasons-to-choose-us__slider">
            @if ($fields['about_slider_slides'])
              @foreach ($fields['about_slider_slides'] as $slide)
                @php
                $slide['slide_content'] = strip_tags($slide['slide_content'],'<strong>');
                @endphp
                <div class="reasons-to-choose-us__slider--slide position-relative">
                  <img class="ml-auto" src="{!! $slide['slide_image']['url'] !!}" style="width: 1100px;">
                  <div class="reasons-to-choose-us__slider__content px-4 px-sm-8 py-6 py-sm-8 bg-steel text-white">
                    <p class="mb-4 text-uppercase">{!! $fields['about_slider_title'] !!}</p>
                    <p class="reasons-to-choose-us__slider__content__title font-weight-bold">{!! $slide['about_slide_title'] !!}</p>
                    <p class="reasons-to-choose-us__slider__content__excerpt mb-sm-6">{!! $slide['slide_content'] !!}</p>
                    <hr class="mb-2 border-primary">
                    <div class="reasons-to-choose-us__slider__navigation">
                      <div class="reasons-to-choose-us__slider__dots float-left"></div>
                      <div class="reasons-to-choose-us__slider__arrows float-right">
                        <div class="reasons-to-choose-us__slider__arrows__next text-primary">
                          Next <img class="d-inline" src="@asset('images/arrow.svg')">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @endif
          </div>
        </div>
      </div>

      <div class="about-us-quote py-4">
        <div class="container position-relative">
          <img src="{!! $fields['about_quote_image']['url'] !!}" alt="Quote" style="width: 1100px;">
          <blockquote class="blockquote px-4 px-sm-8 px-xl-9 py-6 py-xl-8 bg-steel text-white">
            <p class="mb-6 about-us-quote__quote font-weight-normal">{!! $fields['about_quote_content'] !!}</p>
            <p>{!! $fields['about_quote_name'] !!}</p>
          </blockquote>
        </div>
      </div>

      <div class="our-background max-width-lg-956 py-4 py-xl-8 text-center">
        <div class="container">
          <h2 class="mb-4 font-weight-normal text-primary text-uppercase">{!! $fields['about_second_title'] !!}</h2>
          {!! $fields['about_second_content'] !!}
        </div>
      </div>

      @if (!empty($all_team_members))
        @include('partials.meet-the-team', ['all_team_members' => $all_team_members])
      @endif

      @if (!empty($all_testimonials))
        @include('partials.testimonials')
      @endif

      <div class="commitment-to-environment py-6 py-xl-8 text-center" style="background-color: #F8F8F8;">
        <div class="container max-width-lg-956">
          <h2 class="mb-4 font-weight-normal text-primary text-uppercase">{!! $fields['about_third_title'] !!}</h2>
          {!! $fields['about_third_content'] !!}
        </div>
      </div>

      @if (!empty($all_awards))
        @include('partials.our-awards', ['all_awards' => $all_awards])
      @endif

      @include('partials.footer-page-links')
    </div>
  </div>

@endsection
