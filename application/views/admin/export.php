<?php $this->load->view('admin/inc/header.php'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
                <form method="post" action="<?=site_url('admin/export/getData')?>" class="panel-body">
                    <div class="form-group">
                        <label class="help-block">ცხრილი</label>
                        <select id="table" name="table" class="form-control">
                            <option value="0">აირჩიეთ</option>
                            <option value="news">სიახლეები</option>
                        </select>
                    </div>
                    <div class="form-group" id="table-fields-box" style="display: none;">
                        <label class="help-block">აირჩიეთ ველები(დატოვეთ ცარიელი თუ გსურთ ყველას ამობეჭდვა)</label>
                        <div id="table-fields"></div>
                    </div>
                    <div id="limit-box" style="display: none;" class="form-group">
                        <label class="help-block">შეიყვანეთ რაოდენობა(დატოვეთ ცარიელი თუ გსურთ ყველას ამობეჭდვა. ჩაწერეთ მხოლოდ რიცხვი)</label>
                        <div>
                            <input type="number" class="form-control" name="limit" id="limit">
                        </div>
                    </div>
                    <button type="submit" name="excel" class="btn btn-primary export" style="display: none;">(EXCEL) ექსპორტი</button>
                </form>
            </div>
        </div>
    </div>
    <div class="cssloader" id="loader"></div>
    <script>
    $('#table').change(function(event) {
        var table = $(this).val();
        $('#table-fields-box, .export, #limit-box').hide('fast');
        if(table != 0) {
            $('#table-fields').empty();
            $('#loader').fadeIn('fast');
            jQuery.ajax({
                type: "POST",
                url: config.base_url + "admin/export/listFields",
                data: {
                    table: table
                },
                success: function (res) {
                    res = JSON.parse(res);
                    for (var i = res.length - 1; i >= 0; i--) {
                        var field = "<div class='checkbox'>" +
                            "<input id='checkbox" + [i] + "' type='checkbox' name='fields[]' value='" + res[i] + "'>" +
                            "<label for='checkbox" + [i] + "'>" + res[i] + "</label>" +
                        "</div>";
                        $('#table-fields').prepend(field);
                    }
                    $('#table-fields-box, .export, #limit-box').fadeIn('fast');
                    $('#loader').fadeOut('fast');
                },
                error: function (res) {
                    alert('მოხდა შეცდომა. გთხოვთ გადატვირთოთ გვერდი და ხელახლა ცადოთ!');
                }
            });
        }
    });
    </script>
<?php $this->load->view('admin/inc/footer.php'); ?>