<?php $this->load->view('admin/inc/header.php'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
            	<div class="panel-body">
	                <form method="post" action="<?=current_url()?>">
	                	<div class="form-group">
		                	<label class="help-block">სათაური</label>
		                    <div>
		                    	<input type="text" required="" name="title" class="form-control">
		                    </div>
		                </div>
		                <div class="hr-line-dashed"></div>
		                <div class="form-group">
		                	<label class="help-block">ბმული (დაურთეთ http://)</label>
		                    <div>
		                    	<input type="url" required="" name="link" class="form-control">
		                    </div>
		                </div>
		                <div class="hr-line-dashed"></div>
		                <div class="form-group">
		                	<label class="help-block">გახსნა</label>
		                    <div>
		                    	<select class="form-control m-b" name="target">
					                <option value="_self" selected>იგივე ფანჯარაში</option>
		                    		<option value="_blank">სხვა ფანჯარაში</option>
					            </select>
		                    </div>
		                </div>
		                <div class="hr-line-dashed"></div>
		                <div class="form-group">
		                	<label class="help-block">იკონკა</label>
		                    <div>
		                    	<select name="icon" class="select-icon" style="width: 100%;">
		                    		<option value="0" selected="selected">აირჩიეთ</option>
			                    </select>
		                    </div>
		                </div>
		                <div class="hr-line-dashed"></div>
		                <div class="form-group">
		                	<label class="help-block">აქტიური</label>
		                    <div>
		                    	<div class="radio radio-info radio-inline">
                                    <input type="radio" id="radioY" name="active" value="1">
                                    <label for="radioY">დიახ</label>
                                </div>
                                <div class="radio radio-info radio-inline">
                                    <input type="radio" id="radioN" name="active" value="0" checked="">
                                    <label for="radioN">არა</label>
                                </div>
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