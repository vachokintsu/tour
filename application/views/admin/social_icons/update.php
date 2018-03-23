<?php $this->load->view('admin/inc/header.php'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
                <div class="panel-body">
                    <form method="post" action="<?=current_url()?>">
                        <div class="form-group">
                            <label class="help-block">სათაური</label>
                            <div>
                                <input type="text" required="" name="title" class="form-control" value="<?=$item['title']?>">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
		                	<label class="help-block">ბმული (დაურთეთ http://)</label>
		                    <div>
		                    	<input type="url" required="" name="link" class="form-control" value="<?=$item['link']?>">
		                    </div>
		                </div>
		                <div class="hr-line-dashed"></div>
		                <div class="form-group">
                            <label class="help-block">გახსნა</label>
                            <div>
                                <select class="form-control m-b" name="target" value="<?=$item['target']?>">
                                    <option value="_self" <?php if($item['target'] == '_self') { echo "selected"; } ?> >იგივე ფანჯარაში</option>
                                    <option value="_blank" <?php if($item['target'] == '_blank') { echo "selected"; } ?> >სხვა ფანჯარაში</option>
                                </select>
                            </div>
                        </div>
		                <div class="hr-line-dashed"></div>
		                <div class="form-group">
		                	<label class="help-block">იკონკა</label>
		                    <div>
		                    	<select name="icon" class="select-icon" style="width: 100%;">
		                    		<option <?php if($item['icon'] == '1') { echo "selected"; } ?> ><?=$item['icon']?></option>
		                    		<?php if($item['icon'] != 'აირჩიეთ') { ?> 
		                    		<option value="აირჩიეთ">აირჩიეთ</option>
		                    		<?php } ?> 
			                    </select>
		                    </div>
		                </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="help-block">აქტიური</label>
                            <div>
                                <div class="radio radio-info radio-inline">
                                    <input type="radio" id="radioY" name="active" value="1" <?php if($item['active'] == '1') { echo "checked"; } ?> >
                                    <label for="radioY">დიახ</label>
                                </div>
                                <div class="radio radio-info radio-inline">
                                    <input type="radio" id="radioN" name="active" value="0" <?php if($item['active'] == '0') { echo "checked"; } ?> >
                                    <label for="radioN">არა</label>
                                </div>
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