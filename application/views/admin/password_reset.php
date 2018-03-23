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
	                <h3>პაროლის აღდგენა</h3>
	            </div>
	            <div class="hpanel">
	                <div class="panel-body">
                        <?php if($success == 0) { ?>
                        <form action="<?=site_url('admin/login/password_reset')?>" method="post" id="loginForm">
                            <div class="form-group">
                                <label class="control-label" for="email">ელ-ფოსტა</label>
                                <input type="email" placeholder="example@gmail.com" title="გთხოვთ შეიყვანოთ ელ-ფოსტა" required="" value="" name="email" id="email" class="form-control">
                                <span class="help-block small">თქვენი ელ-ფოსტა</span>
                            </div>
                            <?php if($error == 2) { ?>
                            <div class="hr-line-dashed"></div>
                            <span class="text-success">ელ-ფოსტაზე მიიღებთ პალორის აღდგენის ბმულს.</span>
                            <?php } else if($error == 1) { ?>
                            <div class="hr-line-dashed"></div>
                            <span class="text-danger">მეილი არასწორია!</span>
                            <?php } ?>
                            <div class="hr-line-dashed"></div>
                            <button class="btn btn-success btn-block" type="submit" name="resetPassword">დადასტურება</button>
                        </form>
                        <?php } else { ?>
                        <form action="<?=site_url('admin/login/password_reset/'.$password_reset_hash_url)?>" method="post" id="loginForm">
                            <div class="form-group">
                                <label class="control-label" for="newpassword">ახალი პაროლი</label>
                                <input type="password" title="გთხოვთ შეიყვანოთ ახალი პაროლი" placeholder="******" required="" value="" name="newpassword" id="newpassword" autocomplete="off" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="newpassword2">გამეორეთ ახალი პაროლი</label>
                                <input type="password" title="გთხოვთ გამეორეთ ახალი პაროლი" placeholder="******" required="" value="" name="newpassword2" id="newpassword2" autocomplete="off" class="form-control">
                            </div>
                            <?php if($error == 2) { ?>
                            <div class="hr-line-dashed"></div>
                            <span class="text-success">პაროლი წარმატებით შეიცვალა! <a href="<?=site_url('admin/login')?>"><u>ავტორიზაცია</u></a></span>
                            <?php } else if($error == 1) { ?>
                            <div class="hr-line-dashed"></div>
                            <span class="text-danger">პაროლი ვერ შეიცვალა(ახალი და განმეორებითი პაროლები უნდა ემთხვეოდეს და პაროლი უნდა იყოს მინ. 5 სიმბოლო)!</span>
                            <?php } ?>
                            <div class="hr-line-dashed"></div>
                            <button class="btn btn-success btn-block" type="submit" name="resetNewPassword">შეცვლა</button>
                        </form>
                        <?php } ?>
                        <br>
                        <div class="text-center">
                            <a href="<?=site_url('admin/login')?>"><u>ავტორიზაციის გვერდზე დაბრუნება</u></a>
                        </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</body>
</html>