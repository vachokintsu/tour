<?php $this->load->view('admin/inc/header.php'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
            	<div class="panel-body">
	                <form method="post" action="<?=current_url()?>">
		                <div class="form-group">
		                	<label class="help-block">ფაკულტეტი</label>
		                    <div>
		                    	<select class="form-control m-b js-select" name="facult[]" multiple>
					                <?php foreach($facults as $facult): ?>
					                <option value="<?=$facult['id']?>"><?=$facult['title_ge']?></option>
					            	<?php endforeach; ?>
					            </select>
		                    </div>
		                </div>
	                	<div class="hr-line-dashed"></div>
	                	<div class="form-group">
		                	<label class="help-block">მიმართულება</label>
		                    <div>
		                    	<select class="form-control m-b js-select" name="direction[]" multiple>
					                <?php foreach($directions as $direction): ?>
					                <option value="<?=$direction['id']?>"><?=$direction['title_ge']?></option>
					            	<?php endforeach; ?>
					            </select>
		                    </div>
		                </div>
	                	<div class="hr-line-dashed"></div>
	                	<div class="form-group">
		                	<label class="help-block">ლექტორი</label>
		                    <div>
		                    	<select class="form-control m-b js-select" name="lector[]" multiple>
					                <?php foreach($lectors as $lector): ?>
					                <option value="<?=$lector['id']?>"><?=$lector['title_ge']?> <?=$lector['fname_ge']?></option>
					            	<?php endforeach; ?>
					            </select>
		                    </div>
		                </div>
	                	<div class="hr-line-dashed"></div>
	                	<div class="form-group">
		                	<label class="help-block">ფაილი</label>
		                    <div>
		                    	<div class="form-group">
			                    	<div class="input-group">
			                        	<input type="text" name="file" class="form-control" id="file">
		                                <span class="input-group-addon">
		                                    <button type="button" onclick="openFileManagerForFiles('file');"><span class="fa fa-upload"></span></button>
		                                </span>
			                    	</div>
			                    </div>
		                    </div>
		                </div>
		                <div class="hr-line-dashed"></div>
		                <div class="form-group">
		                	<label class="help-block">თარიღი</label>
		                    <div>
		                    	<input type="text" name="date" autocomplete="off" class="form-control" id="datetimepicker">
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
						                    	<input type="text" name="title_<?=$lang['code']?>" class="form-control" maxlength="255" <?=($i == 1) ? 'required' : ''; ?>>
						                    </div>
						                </div>
						                <div class="hr-line-dashed"></div>
						                <div class="form-group">
						                	<label class="help-block">აქტიური</label>
						                    <div>
						                    	<div class="radio radio-info radio-inline">
				                                    <input type="radio" id="radioY_<?=$lang['code']?>" name="active_<?=$lang['code']?>" value="1">
				                                    <label for="radioY_<?=$lang['code']?>">დიახ</label>
				                                </div>
				                                <div class="radio radio-info radio-inline">
				                                    <input type="radio" id="radioN_<?=$lang['code']?>" name="active_<?=$lang['code']?>" value="0" checked>
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
		                <button class="btn btn-primary" type="submit">დამატება</button>
		            </form>
		        </div>
            </div>
        </div>
    </div>
<?php $this->load->view('admin/inc/footer.php'); ?>