<div class="p-y-30 bg-pattern">
  <div class="container">
    <div class="row">
      <div class="col-xs-6">
        <div class="box" data-module="Fsp" data-fsp-base-url="/job/listing">
          <div class="flex-sb-h">
            <h1>I AM LOOKING FOR A JOB</h1>
            <div class="text-right">
              <div>
                <span class="pink font-22 font-lg-regular"><?=$num_jobs?></span>
                <span class="orange font-22 font-lg-regular">Jobs Posted</span>
              </div>
              <div>
                <a href="<?=url('job-listing')?>" class="pink font-20 font-lg-regular">Browse All</a>
              </div>
            </div>
          </div>

          <div class="input-group">
            <input type="text" id="Show-1" class="form-control form-control-pink" data-module="typeahead" data-typeahead-prefetch="/page/jobs" data-fsp-key="search" data-fsp-on="enter" placeholder="Enter a Name, Subject or School">
            <span data-fsp-do class="input-group-addon btn btn-md btn-icon btn-pink"><span>Search</span> <i class="icon-search"></i></span>
          </div>

          <br>
          <div data-module="Show" data-Show-on="focus:#Show-1" class="hide">
            <div class="flex-sb-h font-lg-regular font-20">
              <span>OPTIONAL</span>
              <a href="<?=url('job-listing')?>" class="pink">GO ADVANCED</a>
            </div>
            <div class="row">
              <div class="col-xs-6">
                <?php partial('fsp/subject') ?>
              </div>
              <div class="col-xs-6">
                <?php partial('fsp/job_organization') ?>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-xs-6">
                <?php partial('fsp/location') ?>
              </div>
              <div class="col-xs-6">
                <?php partial('fsp/job_subtype') ?>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xs-6">
        <div class="box" data-module="Fsp" data-fsp-base-url="/teacher/listing">
          <div class="flex-sb-h">
            <h1>I AM LOOKING FOR A TEACHER/STAFF</h1>
            <div class="text-right">
              <div>
                <span class="pink font-22 font-lg-regular"><?=$num_teachers?></span>
                <span class="orange font-22 font-lg-regular">People Joined</span>
              </div>
              <div>
                <a href="<?=url('teacher-listing')?>" class="pink font-20 font-lg-regular">Browse All</a>
              </div>
            </div>
          </div>

          <div class="input-group">
            <input type="text" id="Show-2" class="form-control form-control-pink" data-module="typeahead" data-typeahead-prefetch="/page/teachers" data-fsp-key="search" data-fsp-on="enter" placeholder="Psychology, Primary...">
            <span data-fsp-do class="input-group-addon btn btn-md btn-icon btn-pink"><span>Search</span> <i class="icon-search"></i></span>
          </div>

          <br>
          <div data-module="Show" data-Show-on="focus:#Show-2" class="hide">
            <div class="flex-sb-h font-lg-regular font-20">
              <span>OPTIONAL</span>
              <a href="<?=url('teacher-listing')?>" class="pink">GO ADVANCED</a>
            </div>
            <div class="row">
              <div class="col-xs-6">
                <?php partial('fsp/subject') ?>
              </div>
              <div class="col-xs-6">
                <?php partial('fsp/location') ?>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-xs-6">
                <?php partial('fsp/avail-status') ?>
              </div>
              <div class="col-xs-6">
                <?php partial('fsp/postcode') ?>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

</div>
