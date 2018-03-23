<?php $this->load->view('front/inc/header.php'); ?>

    <div class="wrap pages-header-wrap">
        <ul class="uk-breadcrumb">
            <li><a href="/"><?=$translate['main']?></a></li>
            <li><a class="uk-active"><?=$translate['academic_staff']?></a></li>
        </ul>
        <header class="pages-header filters"> 
            <h2 class="pages-heading">
                <?=$translate['academic_staff']?> <b id="personal-chosen-fac"></b>
            </h2>
            <div class="pages-filter-box">
                <div>
                    <div class="pages-filter-inp-wrap">
                        <i class="uk-icon-search pages-filter-inp-icon"></i>
                        <input type="text" placeholder="<?=$translate['write_name_or_surname']?>" class="pages-filter-inp" id="personal-search-filter">
                    </div>
                </div>
                <div>
                    <div class="pages-filter-inp-wrap">
                        <select class="pages-filter-inp select2" id="personal-filter-rank">
                            <option value=""><?=$translate['all']?></option>
                            <?php foreach($directions as $direction): ?>
                            <option value="<?=$direction['id']?>"><?=$direction['title_'.LANG]?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <!-- <div>
                    <div class="pages-filter-inp-wrap">
                        <select class="pages-filter-inp select2" id="personal-filter-faculty">
                            <option value=""><?=$translate['all']?></option>
                            <?php foreach($faculties as $faculty): ?>
                            <option value="<?=$faculty['id']?>"><?=$faculty['title_'.LANG]?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div> -->
            </div>
        </header>
    </div>

    <script id="template" type="x-tmpl-mustache">
        {{#data}}
        <div class="uk-width-small-1-2 uk-width-medium-1-3 uk-width-large-1-5">
            <div class="personal-card">
                <div class="personal-card-img-box">
                    <a href="/professor/index/{{id}}">
                        <img src="{{image}}" class="personal-card-img">
                    </a>
                </div>
                <div class="personal-card-text-box">
                    <h3 class="personal-card-title">
                        <a href="/professor/index/{{id}}">
                            {{title_<?=LANG?>}} {{fname_<?=LANG?>}}
                        </a>
                    </h3>
                    <p class="personal-card-subtitle">
                        <span>{{rank_<?=LANG?>}}</span>
                    </p>
                </div>
            </div>
        </div>
        {{/data}}
    </script>

    <div class="wrap pages-cards">
        <p class="nodata custom-hide" id="nodata">შედეგი ვერ მოიძებნა</p>
        <div class="uk-grid" id="load-personal-cards"></div>
        
        <!-- loader -->
        <div class="sk-fading-circle cards-loader" id="cards-loader">
            <div class="sk-circle1 sk-circle"></div>
            <div class="sk-circle2 sk-circle"></div>
            <div class="sk-circle3 sk-circle"></div>
            <div class="sk-circle4 sk-circle"></div>
            <div class="sk-circle5 sk-circle"></div>
            <div class="sk-circle6 sk-circle"></div>
            <div class="sk-circle7 sk-circle"></div>
            <div class="sk-circle8 sk-circle"></div>
            <div class="sk-circle9 sk-circle"></div>
            <div class="sk-circle10 sk-circle"></div>
            <div class="sk-circle11 sk-circle"></div>
            <div class="sk-circle12 sk-circle"></div>
        </div>
    </div>

<?php $this->load->view('front/inc/footer.php'); ?>