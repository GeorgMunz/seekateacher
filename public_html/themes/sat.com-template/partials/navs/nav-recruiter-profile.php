<nav class="bg-gray-light">
  <div class="container">
    <ul class="nav-white">

      <li class="dropdown"><a href="<?= url('message-inbox') ?>">Messages</a></li>

      <li class="dropdown">
        <a data-target="#" href="#" data-toggle="dropdown" role="button">
          Jobs
        </a>

        <ul class="dropdown-menu">
          <li><a href="<?=url('job-form-1')?>">Post new Job</a></li>
          <li><a href="<?=url('job-manage')?>">Manage Posted Jobs</a></li>
        </ul>
      </li>

      <li class="dropdown">
        <a data-target="#" href="#" data-toggle="dropdown" role="button">
            Courses
        </a>
        <ul class="dropdown-menu">
          <li><a href="<?=url('course-listing')?>">Course Listing</a></li>
          <?php if (auth('is', 'ec')): ?>
          <li><a href="<?= url('course-form') ?>">Create Course</a></li>
          <li><a href="<?= url('course-manage') ?>">Manage Courses</a></li>
          <?php endif;?>
        </ul>
      </li>

      <li class="dropdown">
        <a data-target="#" href="#" data-toggle="dropdown">Community</a>
        <ul class="dropdown-menu">
          <li><a href="<?= url('community-event-listing')?>">Event</a></li>
          <li><a href="<?= url('community-request-listing')?>">Request</a></li>
          <li><a href="<?= url('community-recom-listing')?>">Recommendation</a></li>
        </ul>
      </li>

      <li class="dropdown">
        <a data-target="#" href="#" data-toggle="dropdown" role="button">
            Explore SAT
        </a>
        <ul class="dropdown-menu">
          <li><a href="<?=url('job-listing')?>">Jobs</a></li>
          <li><a href="<?=url('teacher-listing')?>">Teachers</a></li>
          <li><a href="<?=url('course-listing')?>">Courses</a></li>
          <li><a href="<?=url('recruiter-listing/education-companies')?>">Educations companies</a></li>
          <li><a href="<?=url('recruiter-listing/supply-agencies')?>">Supply Agencies</a></li>
        </ul>
      </li>

      <li class="dropdown">
        <a href="<?=url('job-form-1')?>" class="btn-pink">Post a Job</a>
      </li>
    </ul>
  </div>
</nav>
