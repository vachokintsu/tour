<?php $this->load->view('admin/inc/header.php'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
                <div class="panel-heading">
                    <a href="<?=site_url('admin/'.$this->uri->segment(2).'/create')?>" class="btn btn-primary">
                        <i class="fa fa-plus"></i> დამატება
                    </a>
                </div>
                <div class="panel-body">
                    <div class="dd" id="nestable-menu">
                        <ol class="dd-list" id="nestable-menu-list">
                            <?php $i = 1; foreach ($fast_links as $row): ?>
                            <li class="dd-item" data-id="<?=$row['id']?>" data-number="<?=$i?>">
                                <div class="dd-handle" style="padding-right: 140px;"> 
                                    <?=$row['title_ge']?>
                                </div>
                                <span class="menu-opener">
                                    <a href="<?=base_url()?>admin/<?=$this->uri->segment(2)?>/update/<?=$row['id']?>" class="btn btn-xs btn-info edit"><span class="fa fa-pencil-square-o"></span></a>
                                    <button data-link="<?=base_url()?>admin/<?=$this->uri->segment(2)?>/delete/<?=$row['id']?>" type="button" class="btn btn-xs btn-danger delete"><i class="fa fa-trash-o"></i></button>
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
            var fast_links = [];
            $('.dd-list li').each(function(index, el) {
                var that = $(this);
                that.attr('data-number', index + 1);
                if(that.parent('.dd-list').parent('.dd-item').length) {
                    fast_links.push({
                        id: that.attr('data-id'),
                        number: that.attr('data-number')
                    });
                } else {
                    fast_links.push({
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
                    fast_links: fast_links
                },
                success: function (res) {
                    var fast_links = [];
                    $('#loader').fadeOut('fast');
                },
                error: function (res) {
                    var fast_links = [];
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