<nav class="bg-gray-light">
  <div class="container">
    <ul class="nav-white">

      <li class="dropdown">
        <a href="<?= url('message-inbox') ?>">Messages</a>
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
        <a href="<?= url('group-sc') ?>">Groups</a>
        <ul class="dropdown-menu">
          <li><a href="<?= url('group-sc')?>">Existing groups</a></li>
          <li><a href="<?= url('group-form') ?>">Start a group</a></li>
        </ul>
      </li>

      <li class="dropdown">
        <!-- <a data-target="#" href="#" data-toggle="dropdown">
          Teachers
        </a> -->
        <a href="<?=url('teacher-listing')?>">Teachers</a>
        <ul class="dropdown-menu">
          <li><a href="<?= url('teacher-listing') ?>">Teachers</a></li>
          <li><a href="/user/sync-contacts">Sync Contacts</a></li>
        </ul>
      </li>

      <li class="dropdown">
        <a data-target="#" href="#" data-toggle="dropdown">
          Jobs
        </a>

        <ul class="dropdown-menu">
          <li><a href="<?= url('job-listing') ?>">Find Jobs</a></li>
          <li><a href="<?= url('job-applied') ?>">Applied Jobs</a></li>
        </ul>
      </li>

      <li class="dropdown">
        <a href="<?= url('course-listing') ?>">Courses</a>
      </li>
    </ul>
  </div>
</nav>
