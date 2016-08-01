<?php layout('teacher-profile') ?>

<div class="col-xs-8">
  <?php partial('navs/nav-horizontal-community') ?>
  <?= alert() ?>
  <?= form_open(url('community-recom-form-post'), 'class="form"') ?>

    <div class="form-group">
      <label class="label-pink">Title <span>(Max 100 Characters)</span></label>
      <?= form_input('title', $recom->title, 'class="form-control"') ?>
    </div>

    <div class="form-group">
      <label class="label-pink">Description</label>
      <?= form_input('detail', $recom->detail, 'data-plugin="tinymce"') ?>
    </div>

    <div class="row">
      <div class="col-xs-4">
        <div class="form-group">
          <label class="label-pink">Region</label>
          <?= form_dropdown('location_id', $locations, '', 'data-plugin="select2"') ?>
        </div>
      </div>
      <div class="col-xs-6">
        <div class="form-group">
          <label class="label-pink">Subject</label>
          <?= form_dropdown('subject', $subjects, '', 'data-plugin="select2"') ?>
        </div>
      </div>
    </div>

    <div class="form-group" style="display:flex;">
      <?= form_checkbox_custom('sat_appear', 1, $recom->sat_appear, 'class="rc-custom-3" data-label="Message Appear in MY SAT Group"') ?>
    </div>

    <div class="flex-end">
      <a href="/" class="btn btn-white">Cancel</a>
      <button class="btn btn-pink" value="submit" type="submit">Post</button>
    </div>

  </form>

</div>
