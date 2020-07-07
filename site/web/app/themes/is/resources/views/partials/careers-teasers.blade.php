<div class="service-tabs py-4" style="padding-top: 0 !important;">
  <div class="container">
    <div class="row pt-6 border-top border-primary" id="service-tabs">
      <div class="col-md-3 pb-4">
        <div class="nav flex-column nav-pills mb-4" id="service-v-pills-tab" role="tablist" aria-orientation="vertical">
          @foreach ($career_categories as $key => $career_category)
            <a class="nav-link @if ($key == 0) active @endif border-bottom border-primary rounded-0" id="v-pills-{{ $career_category->slug }}-tab" data-toggle="pill" href="#v-pills-{{ $career_category->slug }}" role="tab" aria-controls="v-pills-{{ $career_category->slug }}" aria-selected="false">{{ $career_category->name }}</a>
          @endforeach
        </div>
      </div>
      <div class="col-md-9 pl-sm-4 pl-lg-6">
        <p class="lead text-primary text-uppercase">Current Vacancies</p>
        <hr class="mb-0 border-steel">
        <div class="tab-content" id="service-v-pills-tabContent">
          @forelse ($career_categories as $key => $career_category)
            <div class="tab-pane fade @if ($key == 0) show active @endif" id="v-pills-{{ $career_category->slug }}" role="tabpanel" aria-labelledby="v-pills-{{ $career_category->slug }}-tab">
              @foreach ($careers as $career)
                  @if (in_array($career_category->slug, $career['category_slug']))
                    <div class="career-teaser-post py-4 py-lg-5 border-top">
                      <div class="row">
                        <div class="col-lg-8">
                          <h2>{{ $career['title'] }}</h2>
                          <p class="mb-4">{{ $career['excerpt'] }}</p>
                          <hr class="ml-0 border-primary">
                          <a href="{{ $career['link'] }}" class="d-block mt-2 text-primary">Find out more <img src="@asset('images/arrow.svg')"></a>
                        </div>
                        <div class="col-lg-4">
                          @if ($career['job_type'])
                            <p class="mb-0"><span class="font-weight-bold">Job type: </span>{{ $career['job_type'] }}</p>
                          @endif
                          @if ($career['start_date'])
                            <p class="mb-0"><span class="font-weight-bold">Start Date: </span>{{ $career['start_date'] }}</p>
                          @endif
                          <p class="mb-4"><span class="font-weight-bold">Posted: </span>{{ $career['post_date'] }}</p>
                        </div>
                      </div>
                    </div>
                  @endif
              @endforeach
            </div>
          @empty
            <p class="py-4">Sorry, there are no current vacancies available.</p>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</div>
