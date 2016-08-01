<?php layout('c1') ?>

<div class="col-xs-8">

  <?php partial('navs/nav-horizontal-community') ?>

  <?= form_open(url('community-request-form-post'), 'class="form"') ?>
    <?= alert() ?>

    <div class="form-group">
      <label class="label-pink">Title <span>(Max 100 Characters)</span></label>
      <?= form_input('title', $request->title, 'class="form-control"') ?>
    </div>

    <div class="form-group">
      <label class="label-pink">Description</label>
      <?= form_textarea('detail', $request->detail, 'data-plugin="tinymce"') ?>
    </div>

    <div class="form-group">
      <?= form_dropdown('location', $locations, $request->location, 'data-plugin="select2"') ?>
      <?= form_dropdown('subject', $subjects, $request->subject, 'data-plugin="select2"') ?>
    </div>

    <div class="form-group" style="display:flex">
      <?= form_checkbox_custom('sat_appear', 1, $request->sat_appear, 'class="rc-custom-3" data-label="Message Appear in My SAT Group"') ?>
    </div>

    <div class="flex-end">
      <a href="/" class="btn btn-white btn-xs">Cancel</a>
      <button class="btn btn-pink btn-xs" type="submit">Post</button>
    </div>

  </form>

</div>
