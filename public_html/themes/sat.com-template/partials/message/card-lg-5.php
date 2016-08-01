<div class="card-message flex bg-gray-light m-b p-a">
  <div class="col-xs-1 p-t-10">
    <label class="rc-custom-3">
      <input data-message-id type="checkbox" name="message" value="<?=$message->id?>">
      <span></span>
    </label>
  </div>
  <div class="col-xs-11">
    <a href="<?= $message->url ?>" class="colorless">
      <div class="flex-sb-h">
        <span class="author"><?= $sender->name ?></span>
        <time><?= $message->created_at ?></time>
      </div>
      <div class="excerpt"> <?= $message->excerpt ?> </div>
    </a>
  </div>
</div>
