<div class="uk-modal subscribe-form-wrap" id="subscribe-form-modal">
    <div class="uk-modal-dialog">
        <div class="subscribe-form">
            <i class="uk-icon-times subscribe-form-close uk-modal-close"></i>
            <h3 class="subscribe-form-title"><?=$translate['subscribe_modal_title']?>:</h3>
            <form class="subscribe-form-fields-wrap" id="subscribe-form">
                <input type="email" name="email" class="subscribe-form-email-field" id="subscribe-form-email-field" placeholder="<?=$translate['email']?>">

                <?php foreach($news_categories as $row): ?>
                <div class="subscribe-form-checkbox-wrap">
                    <label class="subscribe-form-checkbox">
                        <input type="checkbox" name="category" value="<?=$row['id']?>" class="subscribe-form-checkbox-field">
                        <?=$row['title_'.LANG]?>
                    </label>
                </div>
                <?php endforeach; ?>

                <button type="button" class="subscribe-form-submit" id="subscribe-form-submit"><?=$translate['confirm']?></button>

                <div class="uk-text-danger uk-margin-top custom-hide subscribe-email-error"><?=$translate['email_error']?></div>
                <div class="uk-text-warning uk-margin-top custom-hide subscribe-email-exists"><?=$translate['email_exists']?></div>
                <div class="uk-text-success uk-margin-top custom-hide subscribe-email-success"><?=$translate['subscribe_success']?></div>
            </form>
        </div>
    </div>
</div>