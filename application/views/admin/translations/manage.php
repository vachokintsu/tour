<?php $this->load->view('admin/inc/header.php'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
                <div class="panel-body">
                    <form action="<?=site_url('admin/Translations')?>" method="get" class="hpanel clearfix">
                        <input type="search" name="search" value="<?=$this->input->get('search')?>" class="form-control input-sm pull-right" placeholder="ძიება..." style="width: 200px">
                    </form>
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th>სათაური</th>
                                    <th class="text-center">რედაქტირება</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($Translations) < 1) { ?>
                                <tr>
                                    <td colspan="2">შედეგი ვერ მოიძებნა!</td>
                                </tr>
                                <?php } ?>
                                <?php foreach($Translations as $row): ?>
                                <tr>
                                    <td>
                                        <?=$row['word_ge']?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?=site_url('admin/'.$this->uri->segment(2).'/update/'.$row['id'])?>" class="btn btn-xs btn-info edit">
                                            <i class="fa fa-paste"></i>
                                        </a>
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