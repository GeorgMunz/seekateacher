<div class="panel panel-pink mar-b-15">
  <div class="panel-heading">
    <h2 class="panel-title">About the school</h2>
  </div>
  <div class="container-gray">
    <div class="panel-body">
      <div class="row m-b">
        <div class="col-xs-6">
          <p>
            <span class="gray-dark text-uppercase">Gender: </span>
            Male
          </p>
          <p>
            <span class="gray-dark text-uppercase">Age group: </span>
            4-15yrs
          </p>
        </div>
        <div class="col-xs-6">
          <img src="<?=$user->org_logo?>" class="img-responsive">
        </div>
      </div>
      <a href="<?=$user->org_website?>" target="_blank" class="btn btn-blue btn-block">VISIT WEBSITE</a>
      <a href="/recruiter/public-profile/<?=$user->id?>" class="btn btn-blue btn-block">PROFILE</a>
    </div>
  </div>
</div>
