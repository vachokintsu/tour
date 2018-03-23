<?php $this->load->view('admin/inc/header.php'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
            	<div class="panel-heading">
                    <a href="<?=site_url('admin/'.$this->uri->segment(2).'/create_item/'.$poll_id)?>" class="btn btn-primary">
                        <i class="fa fa-plus"></i> დამატება
                    </a>
                    <a href="<?=site_url('admin/'.$this->uri->segment(2).'/export/'.$poll_id)?>" class="btn btn-success">
                        <i class="fa fa-file-excel-o"></i> ექსპორტი
                    </a>
                </div>
                <div class="panel-body">
                    <div class="dd" id="nestable-menu">
                        <ol class="dd-list" id="nestable-menu-list">
                            <?php $i = 1; foreach ($parents as $parent): ?>
                            <li class="dd-item" data-id="<?=$parent['id']?>" data-number="<?=$i?>">
                                <div class="dd-handle" style="padding-right: 140px;"> 
                                    <?=$parent['title_ge']?>
                                </div>
                                <span class="menu-opener">
                                    <span class="label label-warning"><?=$parent['response_count']?></span> &nbsp;
                                    <a href="<?=base_url()?>admin/<?=$this->uri->segment(2)?>/update_item/<?=$poll_id?>/<?=$parent['id']?>" class="btn btn-xs btn-info edit"><span class="fa fa-pencil-square-o"></span></a>
                                    <button data-link="<?=base_url()?>admin/<?=$this->uri->segment(2)?>/delete_item/<?=$poll_id?>/<?=$parent['id']?>" type="button" class="btn btn-xs btn-danger delete"><i class="fa fa-trash-o"></i></button>
                                </span>
                            </li>
                            <?php $i++; endforeach; ?>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="cssloader" id="loader"></div>
    <script>
    // remove list if it has no child
    $('.dd-list .dd-list').each(function(index, el) {
        if($(this).children('li').length < 1) {
            $(this).remove();
        }
    });

    var updateOutput = function (e) {
        var list = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            var answers = [];
            $('.dd-list li').each(function(index, el) {
                var that = $(this);
                that.attr('data-number', index + 1);
                if(that.parent('.dd-list').parent('.dd-item').length) {
                    answers.push({
                        id: that.attr('data-id'),
                        number: that.attr('data-number')
                    });
                } else {
                    answers.push({
                        id: that.attr('data-id'),
                        number: that.attr('data-number')
                    });
                }
            });
            $('#loader').fadeIn('fast');
            jQuery.ajax({
                type: "GET",
                url: config.base_url + "admin/<?=$this->uri->segment(2)?>/update_sorting",
                data: {
                    answers: answers
                },
                success: function (res) {
                    var answers = [];
                    $('#loader').fadeOut('fast');
                },
                error: function (res) {
                    var answers = [];
                    alert('მოხდა შეცდომა რის გამოც ვერ შეინახა ინფორმაცია. გთხოვთ გადატვირთოთ გვერდი და ხელახლა ცადოთ!');
                }
            });
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };
    // activate Nestable
    $('#nestable-menu').nestable({
        group: 1,
        maxDepth: 1
    }).on('change', updateOutput);
    </script>
<?php $this->load->view('admin/inc/footer.php'); ?>