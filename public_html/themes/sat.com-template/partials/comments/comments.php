<div class="clearfix" data-module-comment="target">
<?php
foreach ($comments as $comment) {
  partial('comments/comment', ['comment'=>$comment, 'user'=>$comment->user]);
}
?>
</div>
