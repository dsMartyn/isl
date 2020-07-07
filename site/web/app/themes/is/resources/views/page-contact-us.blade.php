@extends('layouts.app')

@section('content')

  @if ($banner)
    @include('partials.banner-'.$banner['type'])
  @endif

  <div class="wrap" role="document">
    <div class="content">
      <div class="container contact-us-wrap my-4 py-xl-6">
        <div class="row justify-content-center">
          <div class="col-md-4">
            <div class="contact-details pt-md-4">
              <h2>Address</h2>
              {!! $fields['contact_address'] !!}
              @if ($fields['contact_google_link'] != "")
              <p><a class="google-map text-primary" href="{{ $fields['contact_google_link'] }}" target="_blank" rel="noopener">Open in Google Maps <img class="size-full wp-image-619" src="@asset('images/arrow.svg')" alt="img"></a></p>
              @endif

              <p class="lead mt-4">
                @if ($fields['contact_telephone'] != "")
                  <a href="tel:{!! str_replace(" ", "", str_replace("(", "", str_replace(")", "", $fields['contact_telephone']))) !!}">{{ $fields['contact_telephone'] }}</a><br>
                @endif
                @if ($fields['contact_email'] != "")
                  <a href="mailto:{{ $fields['contact_email'] }}">{{ $fields['contact_email'] }}</a>
                @endif
              </p>

              <ul class="list-inline add-more" style="list-style-type: none;">
                @if ($fields['contact_linkedin'] != "")
                <li class="d-inline mr-2"><a href="{{ $fields['contact_linkedin'] }}" target="_blank"><i class="fab fa-linkedin-in fa2x" aria-hidden="true"></i></a></li>
                @endif
                @if ($fields['contact_twitter'] != "")
                <li class="d-inline mr-2"><a href="{{ $fields['contact_twitter'] }}" target="_blank"><i class="fab fa-twitter fa2x" aria-hidden="true"></i></a></li>
                @endif
              </ul>

              @if($fields['contact_support_url'] != "")
                <hr class="w-75 mx-0 border-primary">
                <h3>Need Support ?</h3>
                <p><a class="google-map text-primary" href="{{ $fields['contact_support_url'] }}" target="_blank" rel="noopener noreferrer">Visit our Service Desk <img class="size-full wp-image-619" src="@asset('images/arrow.svg')" alt="img"></a></p>
              @endif
            </div>
          </div>

          <div class="col-md-6">

            @include('partials.contact-us')

          </div>

        </div>
      </div>
    </div>
  </div>
@endsection
