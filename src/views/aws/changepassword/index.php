<?php
use luya\admin\Module;
use luya\admin\ngrest\aw\ActiveWindowFormWidget;

/**
 * @var $this \luya\admin\ngrest\base\ActiveWindowView
 * @var $form luya\admin\ngrest\aw\ActiveWindowFormWidget
 */
?>
<div>
    <p><?= Module::t('aws_changepassword_info'); ?></p>
    <?php $form = ActiveWindowFormWidget::begin([
        'callback' => 'save',
        'buttonValue' => Module::t('button_save'),
        'options' => [
            'closeOnSuccess' => true,
            'clearOnError' => true,
        ],
    ]); ?>
    <?= $form->field('newpass', Module::t('aws_changepassword_new_pass'))->passwordInput(); ?>
    <?= $form->field('newpasswd', Module::t('aws_changepassword_new_pass_retry'))->passwordInput(); ?>
    <?php $form::end(); ?>
</div>