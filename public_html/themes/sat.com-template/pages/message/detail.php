<?php layout(['rec'=>'recruiter-message','tch'=>'teacher-message']) ?>

<div class="box-gray-light">
  <h1><?= $message->subject ?></h1>

  <div class="box">
    <!-- Message -->
    <div class="row">
      <div class="col-xs-6">
        <h2 class="m-t-0"><?= $sender->name ?></h2>
        <div class="message">
          <?= $message->message ?>
        </div>
      </div>
      <div class="col-xs-6">
        <time class="pull-right"><?= $message->created_at ?></time>
      </div>
    </div>
    <!-- /Message  -->

    <!-- Threads -->
    <?php
    foreach ($threads as $thread) {
      if (auth('is_self', $thread->user->id)) {
        partial('message/thread-right', ['thread'=>$thread, 'user'=>$thread->user]);
      }
      else {
        partial('message/thread-left', ['thread'=>$thread, 'user'=>$thread->user]);
      }
    }
    ?>
    <!-- /Threads -->

  </div>
  <!-- /.box-15 -->

  <!-- Form -->
  <?= form_open('/message/thread-post', 'class="form clearfix m-y-30"') ?>
    <?= form_input('detail', '', 'class="form-control pull-left" style="width:80%"') ?>
    <button type="submit" class="btn btn-pink btn-md pull-right">Send</button>
  </form>
  <!-- /Form -->


</div>
