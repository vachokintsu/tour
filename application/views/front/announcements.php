<?php $this->load->view('front/inc/header.php'); ?>

    <div class="news-page">
        <div class="pages-header-wrap">
            <ul class="uk-breadcrumb">
                <li><a href="/"><?=$translate['main']?></a></li>
                <li><a href="/all_news"><?=$translate['all_announcements']?></a></li>
                <?php if($data['title_'.LANG]) { ?><li><a class="uk-active"><?=$data['title_'.LANG] ?></a></li><?php } ?>
            </ul>
        </div>

        <div class="uk-grid">
            <?php if($data['title_'.LANG]) { ?>
            <div class="uk-width-large-1-4 uk-width-medium-3-10">
                <div class="related-news">
                    <header class="block-header">
                        <h3 class="block-header-title"><?=$translate['all_announcements']?></h3>
                    </header>
                    <div class="announces-scroll-list uk-scrollable-text">
                        <!-- these are news cards -->
                        <?php foreach ($announcements as $value): ?>
                            <div class="announces-card">
                                <div class="announces-card-date">
                                    <?php if(!empty($value['start_date'])) { ?>
                                    <span class="start_date"><?=$value['start_date']?></span>
                                    <?php } if(!empty($value['end_date'])) { ?>
                                    <span class="end_date"><?=$value['end_date']?></span>
                                    <?php } ?>
                                </div>
                                <h3 class="announces-card-title">
                                    <a href="<?=base_url('announcements/index/').$value['slug_'.LANG]?>"><?=$value['title_'.LANG]?></a>
                                </h3>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="uk-width-large-<?=($data['title_'.LANG]) ? '2-4' : '3-4'; ?> uk-width-medium-7-10 middle-grid">
                <div class="page-data">
                    <?php if($data['title_'.LANG]) { ?>
                    <header class="text-page-haeder">
                        <h1 class="text-page-title"><?=$data['title_'.LANG] ?></h1>
                        <div class="uk-grid">
                            <div class="uk-width-medium-4-10 uk-width-small-6-10 uk-width-5-10 uk-flex uk-flex-middle">
                                <div class="announces-card-date">
                                    <span class="start_date"><?=$data['start_date']?></span>
                                    <span class="end_date"><?=$data['end_date']?></span>
                                </div>
                            </div>
                            <div class="uk-width-medium-6-10 uk-width-small-4-10 uk-width-5-10 uk-text-right">
                                <button type="button" class="text-page-act-btn share" onclick="fbShare()">
                                    <i class="uk-icon-facebook-square"></i>
                                    <span><?=$translate['share']?></span>
                                </button>
                                <button type="button" class="text-page-act-btn" onclick="printDiv('print-area')">
                                    <i class="uk-icon-print"></i>
                                    <span><?=$translate['print']?></span>
                                </button>
                            </div>
                        </div>
                    </header>

                    <div id="print-area">
                        <?=$data['text_'.LANG] ?>
                    </div>
                    <?php } else { ?>
                    <h3><?=$translate['not_found']?></h3>
                    <?php } ?>
                </div>
            </div>
            <div class="uk-width-large-1-4 uk-width-medium-1-1">
                <div class="related-news">
                    <header class="block-header">
                        <h3 class="block-header-title"><?=$translate['news']?></h3>
                        <div class="block-header-actions">
                            <a href="/announces" class="block-header-btn"><?=$translate['all']?></a>
                        </div>
                    </header>
                    <div>
                        <?php foreach ($latest_news as $value): ?>
                        <div class="announces-card">
                            <div class="announces-card-date">
                                <span class="news-date"><?=$value['date']?></span>
                            </div>
                            <h3 class="announces-card-title">
                                <a href="<?=base_url('news/index/').$value['slug_'.LANG]?>"><?=$value['title_'.LANG]?></a>
                            </h3>
                            <div class="news-card-tags-wrap">
                                <?php foreach($value['categories'] as $row): ?>
                                    <a href="<?=base_url()?>all_news?cat=<?=$row['id']?>" class="news-card-tags" style="color: #<?=$row['color']?>;">
                                        <?=$row['title_'.LANG]?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $this->load->view('front/inc/footer.php'); ?>