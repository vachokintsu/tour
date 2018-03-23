<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Page title -->
    <title>Admin</title>

    <!-- Vendor styles -->
    <link rel="stylesheet" href="<?=site_url('public')?>/admin/vendor/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="<?=site_url('public')?>/admin/styles/style.css">
</head>
<body class="fixed-navbar fixed-sidebar">
	<div class="color-line"></div>
    <div class="login-container">
	    <div class="row">
	        <div class="col-md-12">
	            <div class="text-center m-b-md">
	                <h3>გაიარეთ ავტორიზაცია</h3>
	            </div>
	            <div class="hpanel">
	                <div class="panel-body">
                        <form action="<?=current_url()?>" method="post" id="loginForm">
                            <div class="form-group">
                                <label class="control-label" for="email">ელ-ფოსტა</label>
                                <input type="email" placeholder="example@gmail.com" title="გთხოვთ შეიყვანოთ ელ-ფოსტა" required="" value="" name="email" id="email" class="form-control">
                                <span class="help-block small">თქვენი ელ-ფოსტა</span>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">პაროლი</label>
                                <input type="password" title="გთხოვთ შეიყვანოთ პაროლი" placeholder="******" required="" value="" name="password" id="password" autocomplete="off" class="form-control">
                                <span class="help-block small">თქვენი პაროლი</span>
                            </div>
                            <?php if($error == 1) { ?>
                            <div class="hr-line-dashed"></div>
                            <div class="text-center">
                                <span class="text-danger">ელ-ფოსტა ან პაროლი არასწორია!</span>
                            </div>
                            <?php } ?>
                            <div class="hr-line-dashed"></div>
                            <button class="btn btn-success btn-block" type="submit">შესვლა</button>
                        </form>
                        <br>
                        <div class="text-center">
                            <a href="<?=site_url('admin/login/password_reset')?>"><u>დაგავიწყდათ პაროლი?</u></a>
                        </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</body>
</html>