<?php layout('teacher-profile') ?>


<h1>People you may know</h1>


  <div class="container-gray">
    <div class="card-container card-contain-4">
      <?php for($i=0; $i<=15; $i++) { ?>
      <?php partial('cards/card-teacher-veiw') ?>
      <?php } ?>
    </div>
    <div class="content-center">
      <a class="btn btn-black text-center" value="submit" type="button">Load More</a>
    </div>
  </div>
