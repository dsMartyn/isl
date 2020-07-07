<footer class="content-info py-5" style="background-color: #F8F8F8;">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-lg-3 mb-4">
        <a class="navbar-brand" href="{{ home_url('/') }}"><img class="mw-100" src="@asset('images/invisiblesystems-black-no_strapline.svg')" alt="Invisible Systems" width="236"></a>
      </div>
      <div class="col-md-6 col-lg-3 mb-4">
        @if (has_nav_menu('footer_one_navigation'))
          {!! wp_nav_menu(['theme_location' => 'footer_one_navigation', 'menu_class' => 'nav navbar-nav']) !!}
        @endif
      </div>
      <div class="col-md-6 col-lg-3 mb-4">
        @if (has_nav_menu('footer_two_navigation'))
          {!! wp_nav_menu(['theme_location' => 'footer_two_navigation', 'menu_class' => 'nav navbar-nav']) !!}
        @endif
      </div>
      <div class="col-md-6 col-lg-3 mb-4">
        <div class="textwidget">
          <ul class="add-more" style="list-style-type: none;">
            <li style="list-style-type: none;">
              <ul class="add-more" style="list-style-type: none;">
                <li style="max-width: 280px;">
                  {!! strip_tags(str_replace("</strong>", ":</strong>", $contact_fields['contact_address']), "<strong>") !!}
                </li>
                <li>
                  @if ($contact_fields['contact_telephone'] != "")
                    <a href="tel:{!! str_replace(" ", "", str_replace("(", "", str_replace(")", "", $contact_fields['contact_telephone']))) !!}">{{ $contact_fields['contact_telephone'] }}</a><br>
                  @endif
                  @if ($contact_fields['contact_email'] != "")
                    <a href="mailto:{{ $contact_fields['contact_email'] }}">{{ $contact_fields['contact_email'] }}</a>
                  @endif
                </li>
              </ul>
            </li>
          </ul>
          <!--
             <li><a href="mailto:info@invisible-systems.com">info@invisible-systems.com</a></li>
          -->
          @if($contact_fields['contact_support_url'] != "")
            <ul class="add-more" style="list-style-type: none;">
              <li><a style="color: #d8006b; margin-top: 10px; font-size: 12px;" href="{{ $contact_fields['contact_support_url'] }}" target="blank">Need Support? Visit Our Service Desk <img class="img-responsive" src="/app/uploads/2019/10/arrow.png" /></a></li>
            </ul>
          @endif

          <ul class="list-inline add-more" style="list-style-type: none;">
            @if ($contact_fields['contact_linkedin'] != "")
              <li class="d-inline mr-2"><a href="{{ $contact_fields['contact_linkedin'] }}" target="_blank"><i class="fab fa-linkedin-in fa2x" aria-hidden="true"></i></a></li>
            @endif
            @if ($contact_fields['contact_twitter'] != "")
              <li class="d-inline mr-2"><a href="{{ $contact_fields['contact_twitter'] }}" target="_blank"><i class="fab fa-twitter fa2x" aria-hidden="true"></i></a></li>
            @endif
          </ul>
        </div>
      </div>
    </div>
  </div>
</footer>
