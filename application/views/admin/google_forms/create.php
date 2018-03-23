<?php $this->load->view('admin/inc/header.php'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
            	<div class="panel-body">
	                <form method="post" action="<?=current_url()?>">
		                <div class="form-group">
		                	<label class="help-block">გამოჩნდეს ჰედერში?</label>
		                    <div>
		                    	<div class="radio radio-info radio-inline">
                                    <input type="radio" id="show_in_headerY" name="show_in_header" value="1">
                                    <label for="show_in_headerY">დიახ</label>
                                </div>
                                <div class="radio radio-info radio-inline">
                                    <input type="radio" id="show_in_headerN" name="show_in_header" value="0" checked>
                                    <label for="show_in_headerN">არა</label>
                                </div>
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
						                	<label class="help-block">ბმული (დაურთეთ http://)</label>
						                    <div>
						                    	<input type="url" name="link_<?=$lang['code']?>" class="form-control">
						                    </div>
						                </div>
						                <div class="form-group">
						                	<label class="help-block">გახსნა</label>
						                    <div>
						                    	<select class="form-control m-b" name="target_<?=$lang['code']?>">
									                <option value="_self" selected>იგივე ფანჯარაში</option>
						                    		<option value="_blank">სხვა ფანჯარაში</option>
									            </select>
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