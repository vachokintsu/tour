	<footer id="footer" class="footer">
        <div class="wrap">
            <div class="footer-first">
                <div class="uk-grid wrap">
                    <div class="uk-width-medium-2-10">
                        <h2 class="foot-row-heading"><?=$translate['information']?></h2>
                        <ul class="footer-list fast-links">
                            <?php foreach($fast_links as $key => $row): if($key < 3) { ?>
                            <li>
                                <a href="<?=$row['link_'.LANG]?>" target="<?=$row['target_'.LANG]?>"><span><?=$row['title_'.LANG]?></span></a>
                            </li>
                            <?php } endforeach; ?>
                        </ul>
                    </div>
                    <div class="uk-width-medium-2-10">
                        <?php if(count($fast_links) > 3): ?>
                        <h2 class="foot-row-heading">&nbsp;</h2>
                        <ul class="footer-list fast-links">
                            <?php foreach($fast_links as $key => $row): if($key > 2 && $key < 6) { ?>
                            <li>
                                <a href="<?=$row['link_'.LANG]?>" target="<?=$row['target_'.LANG]?>"><span><?=$row['title_'.LANG]?></span></a>
                            </li>
                            <?php } endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </div>
                    <div class="uk-width-medium-2-10">
                        <?php if(count($fast_links) > 6): ?>
                        <h2 class="foot-row-heading"><?php if($google_forms_link): ?>
                            <a href="<?=$google_forms_link['link_'.LANG]?>" target="<?=$google_forms_link['target_'.LANG]?>" class="header-conference-link"><?=$google_forms_link['title_'.LANG]?></a>
                            <?php endif; ?></h2>
                        <ul class="footer-list fast-links">
                            <?php foreach($fast_links as $key => $row): if($key > 5) { ?>
                            <li>
                                <a href="<?=$row['link_'.LANG]?>" target="<?=$row['target_'.LANG]?>"><span><?=$row['title_'.LANG]?></span></a>
                            </li>
                            <?php } endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </div>
                    <div class="uk-width-medium-3-10">
                        <h2 class="foot-row-heading"><?=$translate['contact']?></h2>
                        <ul class="footer-list foot-contact">
                            <li>
                                <a>
                                    <i class="uk-icon-map-marker foot-contact-icons" aria-hidden="true"></i>
                                    <span><?=$contact['address_'.LANG]?></span>
                                </a>
                            </li>
                            <li>
                                <div>
                                    <i class="uk-icon-envelope foot-contact-icons" aria-hidden="true"></i>
                                    <div>
                                        <?php foreach (explode(',',$contact['email']) as $value): ?>
                                            <a href="mailto:<?=$value?>"><span><?=$value?></span></a><br>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <i class="uk-icon-phone foot-contact-icons" aria-hidden="true"></i>
                                    <div>
                                        <?php foreach (explode(',',$contact['phone']) as $value): ?>
                                            <a href="tel:<?=$value?>"><span><?=$value?></span></a>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="uk-width-medium-1-10">
                        <ul class="footer-list social-links">
                            <?php foreach($socials as $row): ?>
                            <li>
                                <a href="<?=$row['link']?>" target="<?=$row['target']?>">
                                    <i class="uk-icon-<?=str_replace('fa-','',$row['icon']);?>"></i>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="uk-grid uk-flex-middle uk-margin-top">
                <div class="uk-width-1-2 uk-width-medium-3-10"></div>
                    <!-- <div class="uk-width-medium-4-10 uk-text-center">
                        <a href="https://indygo.ge">
                            <img src="/public/assets/images/indygo-logo.png" alt="Indygo Studio Logo">
                        </a>
                    </div> -->
                <div class="uk-width-1-1 uk-width-medium-3-10">
                </div>
            </div>
        </div>
    </footer>

    <!--  JQUERY JS -->
    <script src="/public/assets/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- JQUERY COOKIE -->
    <script src="/public/assets/bower_components/js-cookie/src/js.cookie.js"></script>
    <!-- UIKIT JS -->
    <script src="/public/assets/bower_components/uikit/js/uikit.min.js"></script>
    <script src="/public/assets/bower_components/uikit/js/components/slideshow.min.js"></script>
    <script src="/public/assets/bower_components/uikit/js/components/slideshow-fx.min.js"></script>
    <script src="/public/assets/bower_components/uikit/js/components/slider.min.js"></script>
    <script src="/public/assets/bower_components/uikit/js/components/lightbox.min.js"></script>
    <script src="/public/assets/bower_components/uikit/js/components/tooltip.min.js"></script>
    <script src="/public/assets/bower_components/uikit/js/components/form-select.min.js"></script>
    <script src="/public/assets/bower_components/uikit/js/components/datepicker.min.js"></script>
    <!-- SLICK JS -->
    <script src="/public/assets/bower_components/slick-carousel/slick/slick.min.js"></script>
    <!-- TRUNK8 JS -->
    <script src="/public/assets/bower_components/trunk8/trunk8.js"></script>
    <!-- COUNTUP JS -->
    <script src="/public/assets/bower_components/countUp.js/dist/countUp.min.js"></script>
    <!-- UNDERSCORE JS -->
    <script src="/public/assets/bower_components/underscore/underscore-min.js"></script>
    <!-- MOMENT JS -->
    <script src="/public/assets/bower_components/moment/min/moment.min.js"></script>
    <script src="/public/assets/bower_components/moment/locale/ka.js"></script>
    <script src="/public/assets/bower_components/moment/locale/ru.js"></script>
    <script src="/public/assets/bower_components/moment/locale/fa.js"></script>
    <!-- CLNDR JS -->
    <script src="/public/assets/bower_components/clndr/clndr.min.js"></script>
    <!-- MUSTACHE JS -->
    <script src="/public/assets/bower_components/mustache.js/mustache.min.js"></script>
    <!-- SELECT2 JS -->
    <script src="/public/assets/bower_components/select2/dist/js/select2.min.js"></script>
    <!-- CUSTOM JS -->
    <script src="/public/assets/js/main.js?v=<?=RAND()?>"></script>

</body>
</html>