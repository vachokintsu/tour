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
                                                <input type="text" name="title_<?=$lang['code']?>" value="<?=$item['title_'.$lang["code"].'']?>" class="form-control" <?=($i == 1) ? 'required' : ''; ?>>
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="help-block">ტიპი</label>
                                            <div class="type-box">
                                                <div class="radio radio-info radio-inline">
                                                    <input type="radio" id="isLink_<?=$lang['code']?>" name="type_<?=$lang['code']?>" value="0" <?php if($item['type_'.$lang["code"].''] == '0') { echo "checked class='active'"; } ?> >
                                                    <label for="isLink_<?=$lang['code']?>">ბმული</label>
                                                </div>
                                                <div class="radio radio-info radio-inline">
                                                    <input type="radio" id="isContent_<?=$lang['code']?>" name="type_<?=$lang['code']?>" value="1" <?php if($item['type_'.$lang["code"].''] == '1') { echo "checked class='active'"; } ?> >
                                                    <label for="isContent_<?=$lang['code']?>">რედაქტორი</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="link-box type_<?=$lang['code']?>" style="<?php if($item['type_'.$lang["code"].''] == '1') { echo "display: none;"; } ?>" >
                                            <div class="form-group">
                                                <label class="help-block">ბმული</label>
                                                <div>
                                                    <input type="text" name="link_<?=$lang['code']?>" value="<?=$item['link_'.$lang["code"].'']?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="help-block">გახსნა</label>
                                                <div>
                                                    <select class="form-control m-b" name="target_<?=$lang['code']?>" value="<?=$item['target_'.$lang["code"].'']?>">
                                                        <option value="_self" <?php if($item['target_'.$lang["code"].''] == '_self') { echo "selected"; } ?> >იგივე ფანჯარაში</option>
                                                        <option value="_blank" <?php if($item['target_'.$lang["code"].''] == '_blank') { echo "selected"; } ?> >სხვა ფანჯარაში</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="content-box type_<?=$lang['code']?>" style="<?php if($item['type_'.$lang["code"].''] == '0') { echo "display: none;"; } ?>">
                                            <div class="form-group">
                                                <label class="help-block">მოკლე აღწერა (მაქს. 255 სიმბოლო)</label>
                                                <div>
                                                    <textarea class="form-control" maxlength="255" name="descr_<?=$lang['code']?>"><?=$item['descr_'.$lang["code"].'']?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="help-block">სრული აღწერა</label>
                                                <div>
                                                    <textarea class="editor" id="editor_<?=$lang['code']?>" name="text_<?=$lang['code']?>"><?=$item['text_'.$lang["code"].'']?></textarea>
                                                </div>
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