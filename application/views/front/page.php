<?php $this->load->view('front/inc/header.php'); ?>

    <div class="text-page">
        <div class="pages-header-wrap">
            <ul class="uk-breadcrumb">
                <li><a href="/"><?=$translate['main']?></a></li>
                <li><a href="/page/index/<?=$data['slug_'.LANG] ?>" class="uk-active"><?=$data['title_'.LANG] ?></a></li>
            </ul>
        </div>

        <div class="page-data">
            <header class="uk-grid text-page-haeder">
                <div class="uk-width-medium-7-10 uk-width-small-6-10 uk-width-5-10 uk-flex uk-flex-middle">
                    <h1 class="text-page-title"><?=$data['title_'.LANG] ?></h1>
                </div>
                <div class="uk-width-medium-3-10 uk-width-small-4-10 uk-width-5-10 uk-text-right">
                    <button type="button" class="text-page-act-btn" onclick="fbShare()">
                        <i class="uk-icon-facebook-square"></i>
                        <span><?=$translate['share']?></span>
                    </button>
                </div>
            </header>
            <div id="print-area">
                <?=$data['text_'.LANG] ?>
            </div>
        </div>
    </div>

<?php $this->load->view('front/inc/footer.php'); ?>