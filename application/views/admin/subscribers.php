<?php $this->load->view('admin/inc/header.php'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
                <div class="panel-body">
	                <form action="<?=site_url('admin/subscribers')?>" method="post" class="form-group">
	                	<label class="help-block">ელ-ფოსტის კონტენტი</label>
	                    <div>
	                    	<textarea class="editor" id="editor" name="template"><?=$template['template']?></textarea>
	                    </div>
		                <div class="hr-line-dashed"></div>
                        <!-- <div class="form-group">
                            <label class="help-block">კატეგორია</label>
                            <div>
                                <select class="form-control m-b" name="category" required>
                                    <option value="all" selected>ყველა</option>
                                    <?php foreach($cats as $cat): ?>
                                    <option value='<?=json_encode($cat)?>'><?=$cat['title_ge']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div> -->
                        <!-- <div class="hr-line-dashed"></div> -->
		                <button class="btn btn-primary" type="submit" name="send">გაგზავნა</button>
	                </form>
                    <div class="hr-line-dashed"></div>
                    <form action="<?=site_url('admin/subscribers')?>" method="get" class="hpanel clearfix">
                        <input type="search" name="search" value="<?=$this->input->get('search')?>" class="form-control input-sm pull-right" placeholder="ძიება..." style="width: 200px">
                    </form>
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <!-- <th>სახელი და გვარი</th> -->
                                    <th class="text-center">ელ-ფოსტა</th>
                                    <th class="text-center">წაშლა</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($subscribers) < 1) { ?>
                                <tr>
                                    <td colspan="3">შედეგი ვერ მოიძებნა!</td>
                                </tr>
                                <?php } ?>
                                <?php foreach($subscribers as $row): ?>
                                <tr>
                                    <!-- <td>
                                        
                                    </td> -->
                                    <td>
                                        <a href="mailto:<?=$row['email']?>"><?=$row['email']?></a>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-xs btn-danger delete" data-link="<?=site_url('admin/'.$this->uri->segment(2).'/delete/'.$row['id'])?>">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php if($pages) { ?>
                        <div class="text-center"><?=$pages?></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $this->load->view('admin/inc/footer.php'); ?>