<?= form_dropdown('t', model('option')->dropdown('job_subjects'), fsp('data', 'subject'), 'style="width:100%;" data-plugin="select2" placeholder="Subject" data-fsp-key="subject" ' . (isset($on_change) ? 'data-fsp-on="change"':'') ) ?>