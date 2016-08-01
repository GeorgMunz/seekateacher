<?php layout('c1') ?>

<div class="col-xs-8 ">
    <?php partial('navs/nav-horizontal-community') ?>
    <?= alert() ?>
    <?= form_open(url('community-event-form-post'), 'class=""') ?>

    <div class="form-group">
        <label class="label-pink">Event Name <span>(Max 100 Characters)</span></label>
        <?= form_input('title', $event->title, 'class="form-control form-text"') ?>
    </div>

    <div class="form-group">
        <label class="label-pink">Time Slot</label>
        <div class="row">
            <div class="col-xs-5">
                <div class="input-group">
                    <span class="input-group-addon">Start Time</span>
                    <?= form_input('start_time', $event->start_time, 'class="form-control" data-plugin="datetimepicker" data-time') ?>
                </div>
            </div>

            <div class="col-xs-5">
                <div class="input-group">
                    <span class="input-group-addon">End Time</span>
                    <?= form_input('end_time', $event->end_time, 'class="form-control" data-plugin="datetimepicker" data-time') ?>
                </div>
            </div>

            <div class="col-xs-2 p-t-10">
                <?= form_checkbox_custom('all_day', '1', $event->all_day, 'class="rc-custom-3" data-label="All Day"') ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="label-pink">Event Dates</label>
        <div class="row">
            <div class="col-xs-5">
                <div class="input-group">
                    <span class="input-group-addon">Start Date</span>
                    <?= form_input('start_date', $event->start_date, 'class="form-control" data-plugin="datetimepicker" data-date') ?>
                </div>
            </div>

            <div class="col-xs-5">
                <div class="input-group">
                    <span class="input-group-addon">End Date</span>
                    <?= form_input('end_date', $event->end_date, 'class="form-control" data-plugin="datetimepicker" data-date') ?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="label-pink">Venue</label>
        <?= form_input('venue', $event->venue, 'class="form-control"') ?>
    </div>

    <!--DESCRIPTION-->
    <div class="form-group">
        <label class="label-pink">Description</label>
        <?= form_textarea('detail', $event->detail, 'data-plugin="tinymce"'); ?>
    </div>

    <div class="form-group">
        <label class="label-pink">Attachment</label>
        <input type="file" name="attachment">
    </div>

    <div class="row">
        <div class="col-xs-4">
            <div class="form-group">
                <label class="label-pink">Region</label>
                <?= form_dropdown('location', $locations, $event->location, 'data-plugin="select2"') ?>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="form-group">
                <label class="label-pink">Subject</label>
                <?= form_dropdown('subject', $subjects, $event->subject, 'data-plugin="select2"') ?>
            </div>
        </div>
    </div>

    <div class="flex-end m-t-30">
        <a href="/" class="btn btn-white">Cancel</a>
        <button class="btn btn-pink" value="submit">Post</button>
    </div>
</form>

</div><!--col-xs-8-->
