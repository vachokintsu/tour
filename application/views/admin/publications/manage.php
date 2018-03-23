<?php $this->load->view('admin/inc/header.php'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
                <div class="panel-heading">
                    <a href="<?=site_url('admin/publications')?>/create" class="btn btn-primary">
                        <i class="fa fa-plus"></i> დამატება
                    </a>
                </div>
                <div class="panel-body">
                    <form action="<?=site_url('admin/publications')?>" method="get" class="hpanel clearfix">
                        <input type="search" name="search" value="<?=$this->input->get('search')?>" class="form-control input-sm pull-right" placeholder="ძიება..." style="width: 200px">
                    </form>
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th>სათაური</th>
                                    <th class="text-center">თარიღი</th>
                                    <th class="text-center">რედაქტირება</th>
                                    <th class="text-center">წაშლა</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($publications) < 1) { ?>
                                <tr>
                                    <td colspan="5">შედეგი ვერ მოიძებნა!</td>
                                </tr>
                                <?php } ?>
                                <?php foreach($publications as $row): ?>
                                <tr>
                                    <td>
                                        <?=$row['title_ge']?>
                                    </td>
                                    <td class="text-center" width="10%">
                                        <?=$row['date']?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?=site_url('admin/'.$this->uri->segment(2).'/update/'.$row['id'])?>" class="btn btn-xs btn-info edit">
                                            <i class="fa fa-paste"></i>
                                        </a>
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