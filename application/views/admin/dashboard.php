<?php $this->load->view('admin/inc/header.php'); ?>
    <div class="content animate-panel">
        <div class="row">
            <div class="col-md-4">
                <div class="hpanel hbggreen" style="margin-bottom: 0;">
                    <div class="panel-body">
                        <div class="text-center">
                            <h3>სიახლეები</h3>
                            <p class="font-light">
                                სულ - <?=$news_count?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="hpanel">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <caption class="text-center">ბოლოს დამატებულები</caption>
                                <thead>
                                    <tr>
                                        <th>სათაური</th>
                                        <th>სურათი</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($news as $row): ?>
                                    <tr>
                                        <td>
                                            <span class="text-success font-bold"><?=$row['title_ge']?></span>
                                        </td>
                                        <td>
                                            <a href="<?=$row['image']?>" title="<?=$row['title_ge']?>" data-gallery="news">
                                                <img src="<?=$row['image']?>" style="width: 50px;">
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="hpanel hbgblue" style="margin-bottom: 0;">
                    <div class="panel-body">
                        <div class="text-center">
                            <h3>ღონისძიებები</h3>
                            <p class="font-light">
                                სულ - <?=$announces_count?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="hpanel">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <caption class="text-center">ბოლოს დამატებულები</caption>
                                <thead>
                                    <tr>
                                        <th>სათაური</th>
                                        <th>დასრულების თარიღი</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($announces as $row): ?>
                                    <tr>
                                        <td>
                                            <span class="text-info font-bold"><?=$row['title_ge']?></span>
                                        </td>
                                        <td>
                                            <span class="text-info font-bold"><?=$row['end_date']?></span>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="hpanel hbgyellow" style="margin-bottom: 0;">
                    <div class="panel-body">
                        <div class="text-center">
                            <h3>გამომწერები</h3>
                            <p class="font-light">
                                სულ - <?=$subscribers_count?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="hpanel">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <caption class="text-center">ბოლოს დამატებულები</caption>
                                <thead>
                                    <tr>
                                        <th>ელ-ფოსტა</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($subscribers as $row): ?>
                                    <tr>
                                        <td>
                                            <span class="text-warning font-bold">
                                                <a href="mailto:<?=$row['email']?>"><?=$row['email']?></a>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $this->load->view('admin/inc/footer.php'); ?>