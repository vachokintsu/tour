<?php $this->load->view('admin/inc/header.php'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
            	<div class="panel-heading">
                    <a href="<?=site_url('admin/menu')?>/create" class="btn btn-primary">
                        <i class="fa fa-plus"></i> დამატება
                    </a>
                </div>
                <div class="panel-body">
                	<div id="nestable-menu-actions">
		                <button type="button" data-action="expand-all" class="btn btn-default btn-sm">ყველას გაშლა</button>
		                <button type="button" data-action="collapse-all" class="btn btn-default btn-sm">ყველას დახურვა</button>
		            </div>
                    <div class="dd" id="nestable-menu">
                        <ol class="dd-list" id="nestable-menu-list">
                            <?php $i = 1; foreach ($parents as $parent): ?>
                            <li class="dd-item" data-id="<?=$parent['id']?>" data-number="<?=$i?>" data-parent="<?=$parent['parent']?>">
                                <div class="dd-handle"> 
                                    <?=$parent['title_ge']?>
                                </div>
                                <span class="menu-opener">
                                    <a href="<?=base_url()?>admin/<?=$this->uri->segment(2)?>/update/<?=$parent['id']?>" class="btn btn-xs btn-info edit">
                                        <span class="fa fa-pencil-square-o"></span>
                                    </a>
                                    <button data-link="<?=base_url()?>admin/<?=$this->uri->segment(2)?>/delete/<?=$parent['id']?>" type="button" class="btn btn-xs btn-danger delete"><i class="fa fa-trash-o"></i></button>
                                </span>
                                <ol class="dd-list">
                                    <?php foreach ($childs as $child):
                                        if($child['parent'] == $parent['id']) {
                                    ?>
                                    <li class="dd-item" data-id="<?=$child['id']?>" data-number="<?=$i?>" data-parent="<?=$child['parent']?>">
                                        <div class="dd-handle">
                                            <?=$child['title_ge']?>
                                        </div>
                                        <span class="menu-opener">
                                            <a href="<?=site_url('admin/'.$this->uri->segment(2).'/update/'.$child['id'])?>" class="btn btn-xs btn-info edit"><span class="fa fa-pencil-square-o"></span></a>
                                            <button data-link="<?=site_url('admin/'.$this->uri->segment(2).'/delete/'.$child['id'])?>" type="button" class="btn btn-xs btn-danger delete"><i class="fa fa-trash-o"></i></button>
                                        </span>
                                    </li>
                                    <?php } endforeach; ?>
                                </ol>
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
            var menu = [];
            $('.dd-list li').each(function(index, el) {
                var that = $(this);
                that.attr('data-number', index + 1);
                if(that.parent('.dd-list').parent('.dd-item').length) {
                    that.attr('data-parent', that.parent('.dd-list').parent('.dd-item').attr('data-id'));
                    menu.push({
                        id: that.attr('data-id'),
                        number: that.attr('data-number'),
                        parent: that.parent('.dd-list').parent('.dd-item').attr('data-id')
                    });
                } else {
                    that.attr('data-parent', '0');
                    menu.push({
                        id: that.attr('data-id'),
                        number: that.attr('data-number'),
                        parent: 0
                    });
                }
            });
            $('#loader').fadeIn('fast');
            jQuery.ajax({
                type: "GET",
                url: config.base_url + "admin/menu/update_sorting",
                data: {
                    menu: menu
                },
                success: function (res) {
                    var menu = [];
                    $('#loader').fadeOut('fast');
                },
                error: function (res) {
                    var menu = [];
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
        maxDepth: 2
    }).on('change', updateOutput);

    $('#nestable-menu-actions').on('click', function (e) {
        var target = $(e.target),
                action = target.data('action');
        if (action === 'expand-all') {
            $('.dd').nestable('expandAll');
        }
        if (action === 'collapse-all') {
            $('.dd').nestable('collapseAll');
        }
    });
    </script>
<?php $this->load->view('admin/inc/footer.php'); ?>