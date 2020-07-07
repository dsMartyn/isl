<div class="meet-the-team py-6 py-xl-8" style="background-color: #F8F8F8;">
  <div class="container">
    <h2 class="mb-4 text-primary text-uppercase font-weight-normal">Meet the Team</h2>
    <div class="row">
      @foreach ($all_team_members as $team_member)
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="service-tile d-flex align-items-end position-relative p-4 text-white" style="background-image: url('{{ get_the_post_thumbnail_url($team_member->ID) }}');">
            <div class="overlay position-absolute w-100 h-100 bg-transparent"></div>
            <div class="position-relative">
              <span class="service-tile__title">
                <h2>{{ $team_member->post_title }}</h2>
                <span class="d-block mb-2">{{ get_field('job_title', $team_member->ID) }}</span>
              </span>
              <div class="service-tile__content">
                {{ $team_member->post_content }}
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>
