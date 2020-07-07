<article {{ post_class() }}>
  <div class="entry-content">
    <div class="container">
      <p class="mt-4 mt-md-6 lead text-primary text-uppercase">Careers /</p>
      <h1 class="entry-title case-study--max-width">{!! get_the_title() !!}</h1>
      <hr class="my-4 my-md-6 border-primary">
      <div class="row mt-md-6">
        <div class="col-md-8">
          <div class="post-content case-study--max-width">
            <p class="mb-2 text-primary text-uppercase">About the role</p>
            @php
              the_content();
            @endphp
          </div>

          <div class="mt-md-6 why-work-with-us case-study--max-width">
            <p class="mb-2 text-primary text-uppercase">{{$career_fields['career_section_title']}}</p>
            {!! $career_fields['career_section_content'] !!}
          </div>

          <div class="case-study-quote case-study--max-width py-2">
            <hr class="border-primary">
            <blockquote class="py-4">
              <h2 class="text-primary mb-6">{{ $career_fields['career_quote_content'] }}</h2>
              <footer class="lead text-primary">{{ $career_fields['career_quote_name'] }}</footer>
            </blockquote>
            <hr class="border-primary">
          </div>

          <div class="mt-4 case-study--max-width">
            <p class="mb-2 font-weight-bold">{{$career_fields['career_second_section_title']}}</p>
            {!! $career_fields['career_second_section_content'] !!}
          </div>

          <div class="mt-4 mt-md-5 case-study--max-width">
            {!! $career_fields['career_third_section_content'] !!}
          </div>

          <a href="/careers/" class="btn btn-primary px-4 my-4 mb-md-6">Search jobs at Invisible Systems</a>

        </div>

        <div class="career-aside col-md-4 order-md-first pr-md-4 pr-lg-6 mb-2">
          <div class="career-job-details mb-4">
            <p class="mb-2 text-primary text-uppercase">Job Details</p>
            @if ($fields['job_type'])
              <p class="mb-0"><span class="font-weight-bold">Job type: </span>{{ $fields['job_type'] }}</p>
            @endif
            @if ($fields['start_date'])
              <p class="mb-0"><span class="font-weight-bold">Start Date: </span>{{ $fields['start_date'] }}</p>
            @endif
            <p class="mb-0"><span class="font-weight-bold">Posted: </span>
              <time class="updated" datetime="{{ get_post_time('c', true) }}">
                {{ human_time_diff( strtotime(get_the_date('d F Y')), current_time( 'timestamp' ) ).' '.__( 'ago' ) }}
              </time>
            </p>
          </div>

          <div class="career-contact mb-4">
            <p class="mb-2 text-primary text-uppercase">Contact</p>
            @if ($fields['telephone'])
              <p class="mb-0"><span class="font-weight-bold">Telephone: </span>{{ $fields['telephone'] }}</p>
            @endif
            @if ($fields['email'])
              <p class="mb-0"><span class="font-weight-bold">Email: </span><a href="mailto:{{ $fields['email'] }}">{{ $fields['email'] }}</a></p>
            @endif
          </div>

          <div class="career-location mb-4">
            <p class="mb-2 text-primary text-uppercase">Location</p>
            @if ($fields['location'])
              <p class="mb-0"><span class="font-weight-bold">{!! $fields['location'] !!}</p>
            @endif
          </div>
          <a href="#apply-now" class="btn btn-primary my-4 px-4">Apply now</a>
        </div>
      </div>

    </div>
  </div>
</article>
