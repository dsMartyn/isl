<div class="service-tabs py-4">
  <div class="container">
    {{-- <pre>
      {!! print_r($tabs) !!}
    </pre> --}}
    <div class="row pt-6 border-top border-primary" id="service-tabs">
      <div class="col-sm-3 pb-4">
        <div class="nav flex-column nav-pills mb-4" id="service-v-pills-tab" role="tablist" aria-orientation="vertical">
          @foreach ($tabs as $key => $tab)
            @php
              $tab_title = str_replace(' ', '-', strtolower($tab['title']));
            @endphp
            <a class="nav-link @if ($key == 0) active @endif border-bottom border-primary rounded-0" id="v-pills-{{ $tab_title }}-tab" data-toggle="pill" href="#v-pills-{{ $tab_title }}" role="tab" aria-controls="v-pills-{{ $tab_title }}" aria-selected="false">{{ $tab['title'] }}</a>
          @endforeach
          @if ($header['type'] == 'Service')
            <a href="/services" class="pt-2 text-primary font-weight-normal"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back to All Services</a>
          @endif

          <a href="#get-in-touch" class="btn btn-primary mt-5">Get in touch</a>
        </div>
      </div>
      <div class="col-sm-9 pl-sm-4 pl-lg-6">
        <div class="tab-content" id="service-v-pills-tabContent">
          @foreach ($tabs as $key => $tab)
            @php
              $tab_title = str_replace(' ', '-', strtolower($tab['title']));
            @endphp
            <div class="tab-pane fade @if ($key == 0) show active @endif" id="v-pills-{{ $tab_title }}" role="tabpanel" aria-labelledby="v-pills-{{ $tab_title }}-tab">
              <h2>{{ $tab['content_heading'] }}</h2>
              <p>{!! $tab['content_top'] !!}</p>

              @if (array_filter($tab['icons']))
                <h2 class="my-4">Benefits</h2>
                <div class="row">
                  @foreach ($tab['icons'] as $icon)
                    {{-- <div class="col-md-6 col-lg-4 px-sm-4 mb-4 text-center"> --}}
                    <div class="col-12 mb-3">
                      @if ($icon['image'])
                        <img src="{{ $icon['image'] }}" alt="{{ $icon['title'] }}">
                      @endif
                      <p class="font-weight-bold mb-0">{{ $icon['title'] }}</p>
                      <p>{!! $icon['content'] !!}</p>
                    </div>
                  @endforeach
                </div>
              @endif

              <p>{!! $tab['content_bottom'] !!}</p>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
