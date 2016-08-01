<div class="site-header">
	<div class="container">
		<ul class="nav nav-pills nav-trans pull-right">
			<li><a href="<?=base_url()?>/#hiw">HOW IT WORKS</a></li>
			<li><a href="<?=base_url()?>/page/contact">CONTACT US</a></li>
			<li><a href="<?=base_url()?><?=url('about-us')?>">ABOUT US</a></li>
			<li><a class="p-r-0" href="<?=base_url()?><?=url('sign-up')?>">	<button class="btn btn-sm font-medium btn-outline-pink" type="submit">SIGN UP</button></a></li>
			<li><a class="p-r-0" href="<?=base_url()?><?=url('sign-in')?>"><button class="btn btn-sm font-medium btn-outline-pink" type="submit">LOG IN</button></a></li>
		</ul>

		<div class="flex">
			<div class="logo-container m-t-30">
				<a href="/"><img src="<?=theme_url()?>/assets/images/header/Logo.png"></a>
			</div>
			<div class="site-images m-t-45 m-l-30">
				<img style="width:912px" src="<?=theme_url()?>/assets/images/header/char-copy-copy1.png">
			</div>
		</div>

		<h4 class="text-center">Networking and recruitment site for teachers and schools</h4>

		<ul class="nav nav-style-1 dropdown-style-1">
            <?php
            $dd = [
                ['Primary Jobs', model('option')->values('job_primary_jobs'), '/job/listing/primary_job/', '0','200', model('job')->where_active()->count_by('primary_job!=',''), 'primary_job'],
                ['Secondary Jobs', model('option')->values('job_subjects'), '/job/listing/subject/', '-100','600', model('job')->where_active()->count_by('subject!=',''), 'subject'],
                ['Workplace', model('option')->values('job_organizations'), '/job/listing/organization/', '-100','600', model('job')->where_active()->count_by('user_id>','0'), 'organization'],
                ['Academic support staff', model('option')->job_subtypes('Academic support staff'), '/job/listing/subtype/', '0','200', model('job')->where_active()->count_by('subtype',model('option')->job_subtypes('Academic support staff')), 'subtype'],
                ['Non Academic support staff', model('option')->job_subtypes('Non-Academic support staff'), '/job/listing/subtype/', '-300','700', model('job')->where_active()->count_by('subtype',model('option')->job_subtypes('Non-Academic support staff')), 'subtype'],
                ['Leadership jobs', model('option')->job_subtypes('Senior Leadership'), '/job/listing/subtype/', '0','200', model('job')->where_active()->count_by('subtype',model('option')->job_subtypes('Senior Leadership')), 'subtype'],
                ['Location', model('city')->map('name')->limit(50)->get_all(), '/job/listing/location/', '-500','700', model('job')->where_active()->count_by('user_id>','0'), 'location'],
                ['Lecturing', model('option')->job_subtypes('Lecturing'), '/job/listing/subtype/', '-150','200', model('job')->where_active()->count_by('subtype',model('option')->job_subtypes('Lecturing')), 'subtype'],
            ];
            ?>
            <?php foreach ($dd as $dr): ?>
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown"><?= $dr[0] ?> <span class="black">(<?=$dr[5]?>)</span></a>
    			    <div class="dropdown-menu dropdown-div" style="left:<?=$dr[3]?>px;">
                        <h2 class="pink"><?= $dr[0] ?> <span class="black">(<?=$dr[5]?>)</span></h2>
                        <div class="dropdown-div-menu" style="width:<?=$dr[4]?>px">
                            <?php foreach($dr[1] as $j): if (!$j) continue; ?>
								<?php if($dr[6] == 'location'): ?>
									<a href="<?=$dr[2].rawurlencode($j)?>"><?=$j?> (<?=model('job')->where_active()->count_by('user_id', model('user_profile')->map('user_id')->get_many_by('location', $j))?>) </a>
								<?php else: ?>
                                	<a href="<?=$dr[2].rawurlencode($j)?>"><?=$j?> (<?=model('job')->where_active()->count_by([$dr[6]=>$j])?>) </a>
								<?php endif; ?>
								<?php
								$lastEl = end($dr[1]);
								if ($lastEl == $j && $dr[6] == 'location') {
									echo " <a href='/job/listing'>more...</a> ";
								}
								?>
							<?php endforeach; ?>
                        </div>
    			    </div>
    			</li>
            <?php endforeach; ?>
		</ul>

	</div>
</div>
