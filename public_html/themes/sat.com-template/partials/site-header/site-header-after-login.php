<div class="container p-y-10">
  <div class="flex-sb-h">
    <div class="logo">
      <?php if (auth('is', 'tch')): ?>
        <a href="/teacher/dashboard"><img src="<?=theme_url()?>/assets/images/header/Logo.png" style="height:75px"></a>
      <?php else :  ?>
        <a href="/recruiter/dashboard"><img src="<?=theme_url()?>/assets/images/header/Logo.png" style="height:75px"></a>
      <?php endif;?>
    </div>
    <nav>
      <ul class="nav nav-pills nav-trans flex-center">
        <li><a href="/#hiw">HOME</a></li>
        <li><a href="/page/contact">CONTACT US</a></li>
        <li><a href="<?=url('about-us')?>">ABOUT US</a></li>
        <li class="flex">
          <img src="<?=sess('profile_pic')?>" style="width:75px;height:75px">
          <div class="flex-center">
            <div data-module="fix" data-fix="link">
              <div data-toggle="dropdown" data-target="#dd" id="dd" class="dropdown m-t">
                <span>MY <span class="pink">S</span><span class="">A</span><span class="orange">T</span> Profile </span>
                <span class="block text-center pink">
                  <span class="icon-down"></span>
                </span>
                <?php if (auth('is','tch')): ?>
                  <ul class="dropdown-menu">
                    <li><a href="/teacher/dashboard">Dashboard</a></li>
                    <li><a href="/teacher/profile">My Profile</a></li>
                    <li><a href="<?=url('watchlist')?>">Watchlist</a></li>
                    <li><a href="/user/sync-contacts">Sync Contacts</a></li>
                    <li><a href="/auth/logout">Logout</a></li>
                  </ul>
                <?php else:?>
                  <ul class="dropdown-menu">
                    <li><a href="/recruiter/dashboard">Dashboard</a></li>
                    <li><a href="/recruiter/profile">My Profile</a></li>
                    <li><a href="/user/sync-contacts">Sync Contacts</a></li>
                    <li><a href="/auth/logout">Log out</a></li>
                  </ul>
                <?php endif;?>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </nav>
  </div>
</div>
