<?php $this->load->view('admin/inc/header.php'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
            	<div class="panel-body">
	                <form method="post" action="<?=current_url()?>">
		                <div class="form-group">
		                	<label class="help-block">ფაკულტეტები</label>
		                    <div>
		                    	<select class="form-control m-b" name="facult" required>
					                <option value="" selected>აირჩიეთ</option>
					                <?php foreach($faculties as $facult): ?>
					                <option value="<?=$facult['id']?>"><?=$facult['title_ge']?></option>
					            	<?php endforeach; ?>
					            </select>
		                    </div>
		                </div>
		                <div class="form-group">
		                	<label class="help-block">მიმართულებები</label>
		                    <div>
		                    	<select class="form-control m-b" name="direction" required>
					                <option value="" selected>აირჩიეთ</option>
					                <?php foreach($directions as $direction): ?>
					                <option value="<?=$direction['id']?>"><?=$direction['title_ge']?></option>
					            	<?php endforeach; ?>
					            </select>
		                    </div>
		                </div>
	                	<div class="hr-line-dashed"></div>
	                	<div class="form-group">
		                	<label class="help-block">სურათი (290x220)</label>
		                    <div>
		                    	<div class="form-group">
			                    	<div class="input-group">
			                        	<input type="text" name="image" class="form-control" id="image">
		                                <span class="input-group-addon">
		                                    <button type="button" onclick="openFileManager('image');"><span class="fa fa-upload"></span></button>
		                                </span>
			                    	</div>
			                    </div>
		                    </div>
		                </div>
		                <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="control-label" for="phone">ტელეფონის ნომერი</label>
                            <input type="text" name="phone[]" class="form-control" data-role="tagsinput">
                        </div>
		                <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="control-label" for="email">ელ. ფოსტა</label>
                            <input type="text" name="email[]" class="form-control" data-role="tagsinput">
                        </div>
		                <div class="hr-line-dashed"></div>
                        <div class="form-group">
		                	<label class="help-block">Facebook</label>
		                    <div>
		                    	<input type="text" name="facebook" class="form-control" maxlength="255" >
		                    </div>
		                </div>
		                <div class="hr-line-dashed"></div>
                        <div class="form-group">
		                	<label class="help-block">Linkedin</label>
		                    <div>
		                    	<input type="text" name="linkedin" class="form-control" maxlength="255" >
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
						                	<label class="help-block">სახელი</label>
						                    <div>
						                    	<input type="text" name="title_<?=$lang['code']?>" class="form-control" maxlength="255" <?=($i == 1) ? 'required' : ''; ?>>
						                    </div>
						                </div>
				                        <div class="form-group">
						                	<label class="help-block">გვარი</label>
						                    <div>
						                    	<input type="text" name="fname_<?=$lang['code']?>" class="form-control" maxlength="255" <?=($i == 1) ? 'required' : ''; ?>>
						                    </div>
						                </div>
				                        <div class="form-group">
						                	<label class="help-block">წოდება</label>
						                    <div>
						                    	<input type="text" name="rank_<?=$lang['code']?>" class="form-control" maxlength="255" <?=($i == 1) ? 'required' : ''; ?>>
						                    </div>
						                </div>
				                        <div class="form-group">
						                	<label class="help-block">კაბინეტის მისამსართი</label>
						                    <div>
						                    	<input type="text" name="cabinet_<?=$lang['code']?>" class="form-control" maxlength="255" <?=($i == 1) ? 'required' : ''; ?>>
						                    </div>
						                </div>
						                <div class="form-group">
						                	<label class="help-block">CV</label>
						                    <div>
						                    	<textarea class="editor" id="editor_<?=$lang['code']?>" name="cv_<?=$lang['code']?>"></textarea>
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