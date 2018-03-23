<?php $this->load->view('admin/inc/header.php'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
                <div class="panel-body">
                    <form method="post" action="<?=current_url()?>">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="control-label" for="email">ელ-ფოსტა</label>
                                    <input type="text" value="<?=$contact['email']?>" name="email[]" class="form-control" data-role="tagsinput">
                                </div>
                                <div class="hr-line-dashed"></div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="control-label" for="phone">ტელეფონის ნომერი</label>
                                    <input type="text" value="<?=$contact['phone']?>" name="phone[]" class="form-control" data-role="tagsinput">
                                </div>
                                <div class="hr-line-dashed"></div>
                            </div>
                        </div>
                        <div>
                            <ul class="nav nav-tabs">
                                <?php $i = 1; foreach($langs as $lang): ?>
                                <li <?php if($i == 1) { echo 'class="active"'; } ?> >
                                    <a data-toggle="tab" href="#tab-<?=$i?>" aria-expanded="true"><?=$lang['title']?></a>
                                </li>
                                <?php $i++; endforeach; ?>
                            </ul>
                            <div class="tab-content">
                                <?php $i = 1; foreach($langs as $lang): ?>
                                <div id="tab-<?=$i?>" class="tab-pane fade <?php if($i == 1) { echo 'in active'; } ?>">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="control-label">კორპუსი</label>
                                            <input type="text" value="<?=$contact['address_'.$lang["code"].'']?>" name="address_<?=$lang['code']?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <?php $i++; endforeach; ?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <button class="btn btn-primary" type="submit">შენახვა</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $this->load->view('admin/inc/footer.php'); ?>