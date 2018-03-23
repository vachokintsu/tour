<?php $this->load->view('front/inc/header.php'); ?>

    <!-- SLIDER -->
    <div class="slider" id="home-slider">
        <div class="uk-slidenav-position" data-uk-slideshow="{autoplay: false, autoplayInterval:4000, animation: 'fade'}">
            <ul class="uk-slideshow uk-overlay-active">
                <?php foreach($slider as $row): ?>
                <li>
                    <img src="<?=$row['image']?>" alt="<?=$row['title_'.LANG]?>">
                    <div class="uk-overlay-panel uk-overlay-fade uk-flex uk-flex-left uk-flex-top uk-padding-remove">
                        <div class="slider-caption-box-wrap">
                            <h3 class="slider-caption-title <?php if($row['video']) { echo 'hasvideo'; } ?>">
                                <?php if($row['link_'.LANG]) { ?>
                                    <a href="<?=$row['link_'.LANG]?>" target="<?=$row['target_'.LANG]?>"><?=$row['title_'.LANG]?></a>
                                <?php } else { ?>
                                    <?=$row['title_'.LANG]?>
                                <?php } ?>

                                <?php if($row['video']) { ?>
                                <a href="<?=$row['video']?>" data-uk-lightbox class="slider-video-btn">
                                    <img class="slider-video-icon" src="/public/assets/images/video-play.png" alt="video icon">
                                </a>
                                <?php } ?>
                            </h3>
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php if(count($slider) > 1): ?>
            <div class="slider-nav-wrap uk-hidden-small">
                <div class="slider-nav">
                    <i class="uk-icon-chevron-left" data-uk-slideshow-item="previous"></i>
                    <i class="uk-icon-chevron-right" data-uk-slideshow-item="next"></i>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- SLIDER END -->

    <!-- SCHOOLS -->
    <div class="schools-block">
        <div class="wrap">
            <header class="block-header">
                <h3 class="block-header-title"><?=$translate['schools']?></h3>
            </header>
            <div id="schools-carousel" class="schools-carousel">
                <?php foreach($schools as $row): ?>
                <div class="schools-carousel-item">
                    <a href="/school/index/<?=$row['id']?>">
                        <img src="<?=$row['image']?>" alt="<?=$row['title_'.LANG]?>" title="<?=$row['title_'.LANG]?>">
                        <div class="schools-carousel-item-title-box">
                            <h3 class="schools-carousel-item-title"><?=$row['title_'.LANG]?></h3>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- SCHOOLS END -->

    <!-- NEWS AND ANNOUNCES BLOCK -->
    <div class="wrap block-wrap">
        <div class="uk-grid">
            <div class="uk-width-small-1-1 uk-width-medium-6-10 uk-width-large-8-10">
                <header class="block-header">
                    <h3 class="block-header-title"><?=$translate['news']?></h3>
                    <div class="block-header-actions">
                        <a href="#subscribe-form-modal" data-uk-modal="{center:true}" class="block-header-btn subscribe">
                            <i class="uk-icon-envelope-o"></i>
                            <?=$translate['subscribe']?>
                        </a>
                        <a href="/all_news" class="block-header-btn"><?=$translate['all']?></a>
                    </div>
                </header>
                <div class="news-block">
                    <div class="uk-grid">
                        <?php foreach($news as $row): ?>
                        <div class="uk-width-small-1-2 uk-width-large-1-4">
                            <div class="news-card">
                                <div class="news-card-img-wrap">
                                    <a href="/news/index/<?=$row['slug_'.LANG]?>">
                                        <img src="<?=$row['image']?>" alt="<?=$row['title_'.LANG]?>" class="news-card-img">
                                    </a>
                                </div>
                                <div class="news-card-info-wrap">
                                    <div class="news-card-date-wrap">
                                        <div class="news-card-date">
                                            <?=$row['date']?>
                                        </div>
                                        <div class="news-card-tags-wrap">
                                            <?php
                                            foreach($row['categories'] as $cat):
                                                if($cat['active_'.LANG] == 1):
                                            ?>
                                                <a href="/all_news?cat=<?=$cat['id']?>" class="news-card-tags" style="color: #<?=$cat['color']?>;">
                                                    <?=$cat['title_'.LANG]?>
                                                </a>
                                            <?php
                                                endif;
                                            endforeach;
                                            ?>
                                        </div>
                                    </div>
                                    <h3 class="news-card-title fontchange">
                                        <a href="/news/index/<?=$row['slug_'.LANG]?>">
                                            <?=$row['title_'.LANG];?>
                                        </a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="uk-width-small-1-1 uk-width-medium-4-10 uk-width-large-2-10">
                <header class="block-header">
                    <h3 class="block-header-title"><?=$translate['announces']?></h3>

                    <?php if (count($announcements) > 0 ): ?>
                    <div class="block-header-actions">
                        <a href="javascript:void(0)" class="block-header-btn changer" id="announce-changer">
                            <i class="uk-icon-calendar"></i>
                            <i class="uk-icon-list" style="display: none;"></i>
                        </a>
                        <a href="/announcements" class="block-header-btn"><?=$translate['all']?></a>
                    </div>
                    <?php endif ?>
                </header>

                <div class="announces-block custom-hide" id="announces-list">
                <?php for($i=0;$i< ( (count($announcements) > 3) ? 4 : count($announcements) ); $i++){ ?>
                    <div class="announces-card">
                        <div class="announces-card-date">
                            <span class="start_date"><?=$announcements[$i]['start_date']?></span>
                            <span class="end_date"><?=$announcements[$i]['end_date']?></span>
                        </div>
                        <h3 class="announces-card-title">
                            <a href="<?=base_url('announcements/index/').$announcements[$i]['slug_'.LANG]?>"><?=$announcements[$i]['title_'.LANG]?></a>
                        </h3>
                    </div>
                <?php } ?>
                </div>
                <div class="announces-block calendar" id="announces-calendar">
                    <div id="mini-clndr">
                    <script id="mini-clndr-template" type="text/template">
                      <div class="controls">
                        <div class="clndr-previous-button">&lsaquo;</div><div class="month"><%= month %> <%= year %> <span class="announces-count"><?=count($announcements)?></span></div><div class="clndr-next-button">&rsaquo;</div>
                      </div>
                      <div class="days-container">
                        <div class="days">
                          <div class="headers">
                            <% _.each(daysOfTheWeek, function(day) { %><div class="day-header"><%= day %></div><% }); %>
                          </div>
                          <% _.each(days, function(day) { %><div class="<%= day.classes %>" id="<%= day.id %>">
                                <span><%= day.day %></span>
                            </div><% }); %>
                        </div>
                        <div class="events">
                         <div class="headers">
                           <div class="x-button">x</div>
                           <div class="event-header"></div>
                         </div>
                         <div class="events-list">
                           <% _.each(eventsThisMonth, function(event) {  %>
                             <div class="event <%= event.date %>">
                               <a href="/<%= event.url %>"><div> <%= event.title %> </div> </a>
                             </div>
                           <% }); %>
                         </div>
                       </div>
                      </div>
                    </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- NEWS AND ANNOUNCES BLOCK END -->

    <!-- BANNERS 
    <div class="banners-block">
        <div class="wrap">
            <header class="block-header">
                <h3 class="block-header-title"><?=$translate['banners']?></h3>
            </header>
            <div id="partners-carousel" class="partners-carousel">
                <?php foreach($banners as $row): ?>
                <div class="partners-carousel-item centerV">
                    <a href="<?=$row['link']?>" target="<?=$row['target']?>">
                        <img src="<?=$row['image']?>" alt="<?=$row['title_'.LANG]?>" title="<?=$row['title_'.LANG]?>">
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
   BANNERS END -->

<?php $this->load->view('front/inc/footer.php'); ?>