<?php $this->load->view('admin/inc/header.php'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
                <div class="panel-body">
                    <form method="post" action="<?=current_url()?>">
                        <div class="hr-line-dashed"></div>
                        <!-- <div class="form-group">
                            <label class="help-block">კატეგორია</label>
                            <div>
                                <select class="form-control m-b js-select" name="category[]" value="<?=$item['category']?>" multiple required>
                                    <?php foreach($cats as $category): ?>
                                    <option value="<?=$category['id']?>" <?php if(preg_match('/\b' . $category['id'] . '\b/', $item['category'])) { echo "selected"; } ?>><?=$category['title_ge']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div> -->
                        <!-- <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="help-block">ლექტორი</label>
                            <div>
                                <select class="form-control m-b js-select" name="lector[]" value="<?=$item['lector']?>" multiple>
                                    <?php foreach($lectors as $lector): ?>
                                    <option value="<?=$lector['id']?>" <?php if(preg_match('/\b' . $lector['id'] . '\b/', $item['lector'])) { echo "selected"; } ?>><?=$lector['title_ge']?> <?=$lector['fname_ge']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div> -->
                        <!-- <div class="hr-line-dashed"></div> -->
                        <div class="form-group">
                            <label class="help-block">სურათი (290x190)</label>
                            <div>
                                <?php if($item['image']) { ?><img src="<?=$item['image']?>" class="admin-image"><?php } ?>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" name="image" class="form-control" id="image" value="<?=$item['image']?>">
                                        <span class="input-group-addon">
                                            <button type="button" onclick="openFileManager('image');"><span class="fa fa-upload"></span></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="help-block">სურათების ალბომი (820x400)</label>
                            <div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="hidden" name="image_paths" class="form-control" id="paths" value="<?=$item['image_paths']?>">
                                        <button class="btn btn-success " type="button" onclick="openMultiple('paths');"><i class="fa fa-upload"></i> <span class="bold">არჩევა</span></button>
                                    </div>
                                </div>
                                <div class="images-box lightBoxGallery" id="albumImages">
                                    <?php if($item['image_paths']) {
                                        $paths = explode(',', $item['image_paths']);
                                        foreach ($paths as $path): ?>
                                        <div class="item">
                                            <a href="<?=$path?>" data-gallery>
                                                <img src="<?=$path?>">
                                            </a>
                                            <span data-path="<?=$path?>" class="pe pe-7s-close-circle text-danger"></span>
                                        </div>
                                    <?php endforeach; } ?>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="help-block">თარიღი</label>
                            <div>
                                <input type="text" name="date" autocomplete="off" class="form-control" id="datetimepicker" value="<?=$item['date']?>">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

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
                                            <label class="help-block">მოკლე აღწერა (მაქს. 255 სიმბოლო)</label>
                                            <div>
                                                <textarea class="form-control" name="descr_<?=$lang['code']?>" maxlength="255"><?=$item['descr_'.$lang["code"].'']?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="help-block">სრული აღწერა</label>
                                            <div>
                                                <textarea class="editor" id="editor_<?=$lang['code']?>" name="text_<?=$lang['code']?>"><?=$item['text_'.$lang["code"].'']?></textarea>
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