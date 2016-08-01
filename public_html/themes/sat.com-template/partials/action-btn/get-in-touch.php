<?php if (auth('is', 'guest')): ?>
    <a href="/auth/login" class="btn btn-outline-pink btn-block m-b-10">Get in Touch</a>
<?php else: ?>
<form action="/user/get-in-touch-post" method="post">
  <?= form_hidden('user_id', $user->id) ?>
  <button class="btn btn-outline-pink btn-block m-b-10" type="submit">Get in Touch</button>
</form>
<?php endif; ?>
