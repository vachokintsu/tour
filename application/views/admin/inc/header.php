<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Page title -->
    <title>Tour.ge</title>

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="shortcut icon" type="image/ico" href="<?=site_url('public')?>/admin/images/favicon.ico" />

    <!-- Vendor styles -->
    <link rel="stylesheet" href="<?=site_url('public')?>/admin/vendor/fontawesome/css/font-awesome.css" />
    <link rel="stylesheet" href="<?=site_url('public')?>/admin/vendor/metisMenu/dist/metisMenu.css" />
    <link rel="stylesheet" href="<?=site_url('public')?>/admin/vendor/animate.css/animate.css" />
    <link rel="stylesheet" href="<?=site_url('public')?>/admin/vendor/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="<?=site_url('public')?>/admin/vendor/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" />
    <link rel="stylesheet" href="<?=site_url('public')?>/admin/vendor/bootstrap-datepicker-master/dist/css/bootstrap-datepicker3.min.css" />
    <link rel="stylesheet" href="<?=site_url('public')?>/admin/vendor/select2-3.5.2/select2.css" />
    <link rel="stylesheet" href="<?=site_url('public')?>/admin/vendor/select2-bootstrap/select2-bootstrap.css" />
    <link rel="stylesheet" href="<?=site_url('public')?>/admin/vendor/sweetalert/lib/sweet-alert.css" />
    <link rel="stylesheet" href="<?=site_url('public')?>/admin/vendor/toastr/build/toastr.min.css" />
    <link rel="stylesheet" href="<?=site_url('public')?>/admin/vendor/blueimp-gallery/css/blueimp-gallery.min.css" />
    <link rel="stylesheet" href="<?=site_url('public')?>/admin/vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" />
    <link rel="stylesheet" href="<?=site_url('public')?>/admin/vendor/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
    <!-- App styles -->
    <link rel="stylesheet" href="<?=site_url('public')?>/admin/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css" />
    <link rel="stylesheet" href="<?=site_url('public')?>/admin/fonts/pe-icon-7-stroke/css/helper.css" />
    <link rel="stylesheet" href="<?=site_url('public')?>/admin/styles/style.css?v=1">
    <!-- Vendor scripts -->
    <script src="<?=site_url('public')?>/admin/vendor/jquery/dist/jquery.min.js"></script>
    <script src="<?=site_url('public')?>/admin/vendor/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?=site_url('public')?>/admin/vendor/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="<?=site_url('public')?>/admin/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?=site_url('public')?>/admin/vendor/metisMenu/dist/metisMenu.min.js"></script>
    <script src="<?=site_url('public')?>/admin/vendor/iCheck/icheck.min.js"></script>
    <script src="<?=site_url('public')?>/admin/vendor/select2-3.5.2/select2.min.js"></script>
    <script src="<?=site_url('public')?>/admin/vendor/sparkline/index.js"></script>
    <script src="<?=site_url('public')?>/admin/vendor/sweetalert/lib/sweet-alert.min.js"></script>
    <script src="<?=site_url('public')?>/admin/vendor/toastr/build/toastr.min.js"></script>
    <script src="<?=site_url('public')?>/admin/vendor/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="<?=site_url('public')?>/admin/vendor/moment/moment.js"></script>
    <script src="<?=site_url('public')?>/admin/vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <script src="<?=site_url('public')?>/admin/vendor/nestable/jquery.nestable.js"></script>
    <script src="<?=site_url('public')?>/admin/vendor/blueimp-gallery/js/jquery.blueimp-gallery.min.js"></script>
    <script src="<?=site_url('public')?>/admin/vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="<?=site_url('public')?>/admin/vendor/jquery-form-validator/form-validator/jquery.form-validator.min.js"></script>
    <script src="<?=site_url('public')?>/admin/vendor/jscolor/jscolor.min.js"></script>
    <!-- ckEditor -->
    <script type="text/javascript" src="<?=base_url()?>ckeditor/ckeditor.js"></script>

    <script>
    var config = {
        base_url: '<?=base_url()?>'
    };
    </script>
    <!-- App scripts -->
    <script src="<?=site_url('public')?>/admin/scripts/homer.js?v=1"></script>
</head>
<body class="fixed-navbar fixed-sidebar">

    <!--[if lt IE 7]>
    <p class="alert alert-danger">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
    <div id="blueimp-gallery" class="blueimp-gallery">
        <div class="slides"></div>
        <h3 class="title"></h3>
        <a class="prev">‹</a>
        <a class="next">›</a>
        <a class="close">×</a>
        <a class="play-pause"></a>
        <ol class="indicator"></ol>
    </div>

    <!-- Header -->
    <div id="header">
        <div class="color-line"></div>
        <div id="logo" class="light-version">
            <span>
                <a href="<?=base_url()?>" target="_blank">Tour.ge</a>
            </span>
        </div>
        <nav role="navigation">
            <div class="header-link hide-menu"><i class="fa fa-bars"></i></div>
            <div class="small-logo">
                <span class="text-primary">
                    <a href="<?=base_url()?>" target="_blank">Tour.ge</a>
                </span>
            </div>
            <div class="mobile-menu">
                <button type="button" class="navbar-toggle mobile-menu-toggle" data-toggle="collapse" data-target="#mobile-collapse">
                    <i class="fa fa-chevron-down"></i>
                </button>
                <div class="collapse mobile-navbar" id="mobile-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a class="" href="<?=site_url('admin/settings')?>">პარამეტრები</a>
                        </li>
                        <li>
                            <a class="" href="<?=site_url('admin/login/logout')?>">გასვლა</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="navbar-right">
                <ul class="nav navbar-nav no-borders">
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                            <i class="pe-7s-keypad"></i>
                        </a>

                        <div class="dropdown-menu hdropdown bigmenu animated flipInX">
                            <table>
                                <tbody>
                                <tr>
                                    <td>
                                        <a href="<?=site_url('admin/menu')?>">
                                            <i class="pe pe-7s-menu text-warning"></i>
                                            <h5>მენიუ</h5>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?=site_url('admin/slider')?>">
                                            <i class="pe pe-7s-photo-gallery text-danger"></i>
                                            <h5>სლაიდერი</h5>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?=site_url('admin/announces')?>">
                                            <i class="pe pe-7s-speaker text-success"></i>
                                            <h5>ღონისძიებები</h5>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="<?=site_url('admin/news')?>">
                                            <i class="pe pe-7s-news-paper text-danger"></i>
                                            <h5>სიახლეები</h5>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?=site_url('admin/settings')?>">
                                            <i class="pe pe-7s-tools text-success"></i>
                                            <h5>პარამეტრები</h5>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="<?=site_url('admin/login/logout')?>">
                            <i class="pe-7s-upload pe-rotate-90"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <!-- Navigation -->
    <aside id="menu">
        <div id="navigation">
            <div class="profile-picture">
                <a href="/" target="_blank">
                    საიტზე გადასვლა
                </a>
            </div>

            <ul class="nav" id="side-menu">
                <li class="<?php if($this->uri->segment(2) == 'dashboard') echo "active"; ?>">
                    <a href="<?=site_url('admin/dashboard')?>"> <span class="nav-label">მთავარი</span> </a>
                </li>
                <li class="<?php if($this->uri->segment(2) == 'menu') echo "active"; ?>">
                    <a href="<?=site_url('admin/menu')?>"> <span class="nav-label">მენიუ</span> </a>
                </li>
                <li class="<?php if($this->uri->segment(2) == 'fast_links') echo "active"; ?>">
                    <a href="<?=site_url('admin/fast_links')?>"> <span class="nav-label">სწრაფი ბმულები</span> </a>
                </li>
                <li class="<?php if($this->uri->segment(2) == 'slider') echo "active"; ?>">
                    <a href="<?=site_url('admin/slider')?>"> <span class="nav-label">სლაიდერი</span> </a>
                </li>
                <li class="<?php if($this->uri->segment(2) == 'news') echo "active"; ?>">
                    <a href="<?=site_url('admin/news')?>"> <span class="nav-label">სიახლეები</span> </a>
                </li>
                <!-- <li class="<?php if($this->uri->segment(2) == 'news_cats') echo "active"; ?>">
                    <a href="<?=site_url('admin/news_cats')?>"> <span class="nav-label">სიახლის კატეგორიები</span> </a>
                </li> -->
                <li class="<?php if($this->uri->segment(2) == 'announces') echo "active"; ?>">
                    <a href="<?=site_url('admin/announces')?>"> <span class="nav-label">ღონისძიებები</span> </a>
                </li>
                <li class="<?php if($this->uri->segment(2) == 'schools') echo "active"; ?>">
                    <a href="<?=site_url('admin/schools')?>"> <span class="nav-label">პოპულარული ტურები</span> </a>
                </li>
                <!-- <li class="<?php if($this->uri->segment(2) == 'faculties') echo "active"; ?>">
                    <a href="<?=site_url('admin/faculties')?>"> <span class="nav-label">ფაკულტეტები</span> </a>
                </li> -->
                <!-- <li class="<?php if($this->uri->segment(2) == 'directions') echo "active"; ?>">
                    <a href="<?=site_url('admin/directions')?>"> <span class="nav-label">მიმართულებები</span> </a>
                </li> -->
                <li class="<?php if($this->uri->segment(2) == 'academic_staff') echo "active"; ?>">
                    <a href="<?=site_url('admin/academic_staff')?>"> <span class="nav-label">ტურები</span> </a>
                </li>
                <!-- <li class="<?php if($this->uri->segment(2) == 'publications') echo "active"; ?>">
                    <a href="<?=site_url('admin/publications')?>"> <span class="nav-label">პუბლიკაციები</span> </a>
                </li> -->
                <li class="<?php if($this->uri->segment(2) == 'social_icons') echo "active"; ?>">
                    <a href="<?=site_url('admin/social_icons')?>"> <span class="nav-label">სოციალური ქსელები</span> </a>
                </li>
<!--                 <li class="<?php if($this->uri->segment(2) == 'poll') echo "active"; ?>">
                    <a href="<?=site_url('admin/poll')?>"> <span class="nav-label">გამოკითხვა</span> </a>
                </li> -->
                <li class="<?php if($this->uri->segment(2) == 'subscribers') echo "active"; ?>">
                    <a href="<?=site_url('admin/subscribers')?>"> <span class="nav-label">გამომწერები</span> </a>
                </li>
                <!-- <li class="<?php if($this->uri->segment(2) == 'banners') echo "active"; ?>">
                    <a href="<?=site_url('admin/banners')?>"> <span class="nav-label">ბანერები</span> </a>
                </li> -->
                <li class="<?php if($this->uri->segment(2) == 'google_forms') echo "active"; ?>">
                    <a href="<?=site_url('admin/google_forms')?>"> <span class="nav-label">Google ფორმები</span> </a>
                </li>
                <li class="<?php if($this->uri->segment(2) == 'contact') echo "active"; ?>">
                    <a href="<?=site_url('admin/contact')?>"> <span class="nav-label">კონტაქტი</span> </a>
                </li>
                <li class="<?php if($this->uri->segment(2) == 'export') echo "active"; ?>">
                    <a href="<?=site_url('admin/export')?>"> <span class="nav-label">ექსპორტი</span> </a>
                </li>
                <li class="<?php if($this->uri->segment(2) == 'Translations') echo "active"; ?>">
                    <a href="<?=site_url('admin/Translations')?>"> <span class="nav-label">თარგმანი</span> </a>
                </li>
                <li class="<?php if($this->uri->segment(2) == 'settings') echo "active"; ?>">
                    <a href="<?=site_url('admin/settings')?>"> <span class="nav-label">პარამეტრები</span> </a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Main Wrapper -->
    <div id="wrapper">
        <?php if($this->uri->segment(2) != 'dashboard') { ?>
        <div class="normalheader transition animated fadeIn">
            <div class="hpanel">
                <div class="panel-body">
                    <div id="hbreadcrumb" class="pull-right  m-t-lg">
                        <ol class="hbreadcrumb breadcrumb">
                            <li>
                                <a href="<?=site_url('admin/dashboard')?>">მთავარი</a>
                            </li>
                            <?php
                            if($this->uri->segment(3)) {
                                $pageUrl = $this->uri->segment(2);
                            ?>
                            <li>
                                <a href="<?=site_url('admin/'.$pageUrl)?>"><?=$pageTitle?></a>
                            </li>
                            <?php } else { ?>
                            <li>
                                <span><?=$pageTitle?></span>
                            </li>
                            <?php
                            }
                            if($this->uri->segment(3)) {
                                $parentPageUrl = $this->uri->segment(2);
                                if($this->uri->segment(3) == 'create') {
                                    $pageName = 'დამატება';
                                } else {
                                    $pageName = 'რედაქტირება';
                                }
                            ?>
                            <li class="active">
                                <span><?=$pageName?></span>
                            </li>
                            <?php } ?>
                        </ol>
                    </div>
                    <h2 class="font-light m-b-xs"><?=$pageTitle?></h2>
                    <small>ნავიგაცია</small>
                </div>
            </div>
        </div>
        <?php } ?>

        <div class="content">
            