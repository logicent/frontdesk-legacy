<?php 
$setting_modules = Model_Setting::menu_list_items();

foreach ($setting_modules as $setting_module) : ?>

<div class="row">
<?php 
    foreach ($setting_module as $setting_item) : 
        if ($setting_item['column'] == Model_Setting::SETTINGS_COLUMN_RIGHT) : ?>

    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <a class="btn btn-lg btn-link" href="<?= Uri::create($setting_item['route']); ?>"><?= $setting_item['label'] ?></a>
            </div>
        </div>
    </div>
    <?php   
        endif;
        if ($setting_item['column'] == Model_Setting::SETTINGS_COLUMN_LEFT) : ?>

    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <a class="btn btn-lg btn-link" href="<?= Uri::create($setting_item['route']); ?>"><?= $setting_item['label'] ?></a>
            </div>
        </div>
    </div>
    <?php 
        endif;
    endforeach ?>
</div>
<?php
endforeach ?>