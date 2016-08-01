
<?php layout('teacher-profile'); ?>

<div class="col-xs-12">

  <h1 class="heading">Set Job Alert Criteria</h1>
  <?= form_open('/_dev/form-dump', 'form form-horizontal form-alter') ?>
    <div class="form-group">
      <label class="form-title">Type of job</label>
      <div class="flex-wrap">
        <?php foreach ($GLOBALS['job_organizations'] as $jo): ?>
          <label class="checkbox-inline checkbox-label-custom">
            <input type="checkbox" name="job_organizations[]" value="<?= $jo ?>"><?= $jo ?>
            <span></span>
          </label>
        <?php endforeach;?>
      </div>
    </div>

    <div class="form-group">
      <label>Location</label>
      <?= form_dropdown('location', $GLOBALS['locations']) ?>
    </div>

    <div class="form-group">
      <label>Subject</label>
      <div class="flex-wrap">
        <?php foreach ($GLOBALS['job_subjects'] as $js): ?>
          <label class="checkbox-inline checkbox-label-custom">
            <input type="checkbox" name="job_subjects[]" value="<?=$js?>"><?= $js ?>
            <span></span>
          </label>
        <?php endforeach;?>
      </div>
    </div>

    <div class="text-center">
      <button class="btn btn-pink btn-xs" value="submit">Save</button>
    </div>
  </form>

</div>
