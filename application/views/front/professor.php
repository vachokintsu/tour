<?php $this->load->view('front/inc/header.php'); ?>

    <div class="wrap pages-header-wrap">
        <ul class="uk-breadcrumb">
            <li><a href="/"><?=$translate['main']?></a></li>
            <li><a href="/personal"><?=$translate['academic_staff']?></a></li>
            <li><a class="uk-active"><?=$data['title_'.LANG]?> <?=$data['fname_'.LANG]?></a></li>
        </ul>
        <header class="pages-header filters"> 
            <h2 class="pages-heading">
                <?=$data['title_'.LANG]?> <?=$data['fname_'.LANG]?>
            </h2>
        </header>
    </div>
    <div class="wrap professor-wrap">
        <div class="uk-grid">
        <!--
        	<div class="uk-width-medium-2-10">
        		<div class="professor-box">
        			<div class="professor-img-box">
        				<img class="professor-img" src="<?=$data['image']?>">
        			</div>
        			<p class="professor-rank"><?=$data['rank_'.LANG]?></p>
        			<div class="professor-email">
        				<i class="uk-icon-envelope"></i>
        				<a href="mailto:<?=$data['email']?>"><?=$data['email']?></a>
        			</div>
        		</div>
        	</div>
		-->
        	<div class="uk-width-medium-1-1 uk-position-relative">
        		<div class="professor-tabs" style="opacity:0; visibility: hidden;">
        			<ul class="uk-tab" data-uk-switcher="{connect:'#my-id', animation: 'fade'}">
					    <li class="uk-active">
					    	<a href=""></a>
					    </li>
					    
					</ul>
        		</div>
        		<ul id="my-id" class="uk-switcher">
        			<li>
        				<div class="professor-about-box">
		        			<?=$data['cv_'.LANG]?>
		        		</div>
        			</li>
        			<?php if(count($pubs) != 0) { ?>
        			<li>
        				<div class="professor-pubs-box">
        					<div class="uk-grid">
        						<?php foreach($pubs as $pub): ?>
			        			<div class="uk-width-small-1-2 uk-width-medium-1-3 uk-width-large-1-4">
			        				<a href="<?=$pub['file']?>" target="_blank">
			        					<div class="pub-card">
				        					<h3 class="pub-card-title">
				        						<i class="uk-icon-file-pdf-o"></i>
				        						<span><?=$pub['title_'.LANG]?></span>
				        					</h3>
				        					<p class="pub-card-dets">
				        						<span>
				        						<?php foreach($pub['lectors'] as $lector): ?>
				        							<?=$lector['title_'.LANG]?> <?=$lector['fname_'.LANG]?>, 
				        						<?php endforeach; ?>
				        						</span>

				        						<span>
				        						<?php
			        							foreach($pub['faculties'] as $i => $faculty):
			        								echo $faculty['title_'.LANG];
			        								if($i != (count($pub['faculties']) - 1)) {
			        									echo ", ";
			        								}
			        							endforeach;
				        						?>
				        						</span>
				        					</p>
				        					<span class="pub-card-date"><?=$pub['date']?></span>
				        				</div>
			        				</a>
			        			</div>
			        			<?php endforeach; ?>
			        		</div>
        				</div>
        			</li>
        			<?php } if(count($lector_news) != 0) { ?>
        			<li>
        				<div class="professor-projects">
        					<div class="uk-grid">
        						<?php foreach (array_chunk($lector_news, 2, true) as $news): ?>
			        			<div class="uk-width-small-1-1">
			        				<div class="uk-grid">
			        					<?php foreach($news as $row): ?>
			        					<div class="uk-width-small-1-2">
					        				<div class="announces-card">
					                            <div class="announces-card-date">
					                                <span class="news-date"><?=$row['date']?></span>
					                            </div>
					                            <h3 class="announces-card-title">
					                                <a href="/news/index/<?=$row['slug_'.LANG]?>"><?=$row['title_'.LANG]?></a>
					                            </h3>
					                            <div class="news-card-tags-wrap">
					                                <?php
			                                        foreach($row['categories'] as $row):
			                                            if($row['active_'.LANG] == 1):
			                                        ?>
			                                            <a href="/all_news?cat=<?=$row['id']?>" class="news-card-tags" style="color: #<?=$row['color']?>;">
			                                                <?=$row['title_'.LANG]?>
			                                            </a>
			                                        <?php
			                                            endif;
			                                        endforeach;
			                                        ?>
					                            </div>
					                        </div>
					                    </div>
					                    <?php endforeach; ?>
					                </div>
			        			</div>
			        			<?php endforeach; ?>
			        		</div>
        				</div>
        			</li>
        			<?php } ?>
        		</ul>
        	</div>
        </div>
    </div>

<?php $this->load->view('front/inc/footer.php'); ?>