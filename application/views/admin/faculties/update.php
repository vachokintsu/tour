<?php $this->load->view('admin/inc/header.php'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
                <div class="panel-body">
                    <form method="post" action="<?=current_url()?>">
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
                                            <label class="help-block">სათაური (მაქს. 255 სიმბოლო)</label>
                                            <div>
                                                <input type="text" name="title_<?=$lang['code']?>" value="<?=$item['title_'.$lang["code"].'']?>" class="form-control" maxlength="255" <?=($i == 1) ? 'required' : ''; ?>>
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="help-block">აქტიური</label>
                                            <div>
                                                <div class="radio radio-info radio-inline">
                                                    <input type="radio" id="radioY_<?=$lang['code']?>" name="active_<?=$lang['code']?>" value="1" <?php if($item['active_'.$lang["code"].''] == '1') { echo "checked"; } ?> >
                                                    <label for="radioY_<?=$lang['code']?>">დიახ</label>
                                                </div>
                                                <div class="radio radio-info radio-inline">
                                                    <input type="radio" id="radioN_<?=$lang['code']?>" name="active_<?=$lang['code']?>" value="0" <?php if($item['active_'.$lang["code"].''] == '0') { echo "checked"; } ?> >
                                                    <label for="radioN_<?=$lang['code']?>">არა</label>
                                                </div>
                                            </div>
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