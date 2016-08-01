<?php layout('teacher-profile') ?>

<div class="col-xs-8">
  <h1 class="darkpink">Start Group</h1>
  <?= alert() ?>
  <?= form_open(url('group-form-post'), 'class="form form-horizontal form-horizontal-create-community"') ?>

    <div class="form-group">
      <label class="heading">Title<span class="subheading">(Max 100 Characters)</span></label>
      <?= form_input('title', $group->title, 'class="form-control"') ?>
    </div>

    <div class="form-group">
      <label class="heading">Description</label>
      <?= form_textarea('detail', $group->detail, 'data-plugin="tinymce"') ?>
    </div>

    <div class="flex-end mar-t-30">
      <a href="<?=url('group-sc')?>" class="btn btn-white btn-xs">Cancel</a>
      <button class="btn btn-pink btn-xs" type="submit">Next</button>
    </div>

  </form>
</div>
