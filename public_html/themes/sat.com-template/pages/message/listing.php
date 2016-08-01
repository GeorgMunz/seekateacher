<?php layout(['tch'=>'teacher-message','rec'=>'recruiter-message']) ?>

<?php
partial('navs/nav-message-actions');
?>
<div class="cards">
<?php
foreach ($messages as $message) {
  partial('message/card-lg-5', ['message'=>$message, 'sender'=>$message->sender]);
}
?>  
</div>
<?php
partial('paginations/pagination-center');
?>
