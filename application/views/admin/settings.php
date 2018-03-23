<?php $this->load->view('admin/inc/header.php'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
                <div class="panel-body">
                    <form method="post" action="<?=current_url()?>">
                        <h3>ელ-ფოსტის შეცვლა</h3>
                        <div class="form-group">
                            <label class="control-label" for="email">ახალი ელ-ფოსტა</label>
                            <input type="email" placeholder="example@gmail.com" title="გთხოვთ შეიყვანოთ ახალი ელ-ფოსტა" required="" value="" name="new_email" id="email" autocomplete="off" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="oldpassword">მიმდინარე პაროლი</label>
                            <input type="password" title="გთხოვთ შეიყვანოთ მიმდინარე პაროლი" placeholder="******" required="" value="" name="oldpassword" id="oldpassword" autocomplete="off" class="form-control" data-validation="length" data-validation-length="min5">
                        </div>

                        <?php if(isset($_POST['change_email']) && $error == 2) { ?>
                        <p class="text-success">ელ-ფოსტა წარმატებით შეიცვალა!</p>
                        <?php } else if(isset($_POST['change_email']) && $error == 1) { ?>
                        <p class="text-danger">ელ-ფოსტა ვერ შეიცვალა. გთხოვთ შეიყვანოთ სწორი პაროლი და ელ-ფოსტა!</p>
                        <?php } ?>

                        <button class="btn btn-primary" type="submit" name="change_email">შეცვლა</button>
                    </form>
                    <div class="hr-line-dashed"></div>
                    <form method="post" action="<?=current_url()?>">
                        <h3>პაროლის შეცვლა</h3>
                        <div class="form-group">
                            <label class="control-label" for="oldpassword">მიმდინარე პაროლი</label>
                            <input type="password" title="გთხოვთ შეიყვანოთ მიმდინარე პაროლი" placeholder="******" required="" value="" name="oldpassword" id="oldpassword" autocomplete="off" class="form-control" data-validation="length" data-validation-length="min5">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="newpassword">ახალი პაროლი</label>
                            <input type="password" title="გთხოვთ შეიყვანოთ ახალი პაროლი" placeholder="******" required="" value="" name="newpassword" id="newpassword" autocomplete="off" class="form-control" data-validation="strength" data-validation-strength="3">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="newpassword2">გამეორეთ ახალი პაროლი</label>
                            <input type="password" title="გთხოვთ გამეორეთ ახალი პაროლი" placeholder="******" required="" value="" name="newpassword2" id="newpassword2" autocomplete="off" class="form-control" data-validation="confirmation" data-validation-confirm="newpassword">
                        </div>

                        <?php if(isset($_POST['change_password']) && $error == 2) { ?>
                        <p class="text-success">პაროლი წარმატებით შეიცვალა!</p>
                        <?php } else if(isset($_POST['change_password']) && $error == 1) { ?>
                        <p class="text-danger">პაროლი ვერ შეიცვალა(ახალი და განმეორებითი პაროლები უნდა ემთხვეოდეს და პაროლი უნდა იყოს მინ. 5 სიმბოლო)!</p>
                        <?php } ?>

                        <button class="btn btn-primary" type="submit" name="change_password">შეცვლა</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $this->load->view('admin/inc/footer.php'); ?>