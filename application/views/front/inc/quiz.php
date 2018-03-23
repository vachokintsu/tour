<?php if (isset($poll['answered'])):?>
    
<div class="fixed-quiz-box" id="fixed-quiz-box" data-id="">

    <div class="fixed-quiz-question-box" id="fixed-quiz-question-box">
        <h3 class="fixed-quiz-question-title">
            <?=$poll['title_'.LANG]?>
        </h3>
        <div class="fixed-quiz-vote-counts custom-hide" id="fixed-quiz-vote-counts" style="display:block">
            <?php foreach ($poll['items'] as $value): ?>
            <div class="fixed-quiz-vote-percent-box" data-id="">
                <p class="fixed-quiz-vote-title"><?=$value['title_'.LANG]?></p>
                <div class="fixed-quiz-vote-bar-box">
                    <div class="uk-progress">
                        <div class="uk-progress-bar" style="width: <?=(int)($value["response_count"]*100/$poll["response_sum"])?>%;">
                            <span class="fixed-quiz-vote-percent"> <?=(int)($value["response_count"]*100/$poll["response_sum"])?>%</span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </div>
    <button class="fixed-quiz-toggler" id="fixed-quiz-toggler">
        <i class="uk-icon-check-square-o"></i>
        <i class="uk-icon-times custom-hide"></i>
    </button>
</div>
<?php endif ?>

<?php
if (!isset($poll['answered']))
 if(isset($poll['active_'.LANG]) && $poll['active_'.LANG] == 1)
 if ( ($poll['max_responses']>$poll['response_sum'] || empty($poll['max_responses']))
    && ($poll['end_date'] >= date('Y-m-d') || empty($poll['end_date']) )
    && ($poll['start_date'] <= date('Y-m-d') || empty($poll['start_date']) )
        ): 
?>
    
<div class="fixed-quiz-box" id="fixed-quiz-box" data-id="<?=$poll["id"]?>">

    <div class="fixed-quiz-question-box" id="fixed-quiz-question-box">
        <h3 class="fixed-quiz-question-title">
            <?=$poll['title_'.LANG]?>
        </h3>
        <div class="fixed-quiz-answers" id="fixed-quiz-answers">
        <?php foreach ($poll['items'] as $value): ?>
            <div>
                <label class="fixed-quiz-answer-wrap">
                    <input class="w3-radio fixed-quiz-answer-btn" type="radio" name="poll" data-id="<?=$value['id']?>" value="<?=$value['response_count']?>"> <?=$value['title_'.LANG]?>
                </label>
            </div>
        <?php endforeach ?>
        </div>
        <div class="fixed-quiz-vote-counts custom-hide" id="fixed-quiz-vote-counts">
        <?php foreach ($poll['items'] as $value): ?>
            <div class="fixed-quiz-vote-percent-box" data-id="<?=$value['id']?>">
                <p class="fixed-quiz-vote-title"><?=$value['title_'.LANG]?></p>
                <div class="fixed-quiz-vote-bar-box">
                    <div class="uk-progress">
                        <div class="uk-progress-bar" style="width: 0%;">
                            <span class="fixed-quiz-vote-percent"> </span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
        </div>
    </div>
    <button class="fixed-quiz-toggler" id="fixed-quiz-toggler">
        <i class="uk-icon-check-square-o"></i>
        <i class="uk-icon-times custom-hide"></i>
    </button>
</div>
<input type="text" id="response_sum" value="<?=$poll['response_sum']?>" style="display: none;">
<div class="mobile-widget-dim custom-hide" id="mobile-widget-dim"></div>
<div id="mobile-widget" class="mobile-widget uk-visible-small">
    <a href="#" target="_blank" class="mobile-widget-link">
        <i class="fa fa-facebook-official"></i>
    </a>
    <button class="fixed-quiz-toggler mobile" id="fixed-quiz-mobile-toggler">
        <i class="uk-icon-check-square-o"></i>
        <i class="uk-icon-times custom-hide"></i>
    </button>
</div>
<?php endif ?>