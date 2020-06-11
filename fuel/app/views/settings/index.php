<?php 
$setting_modules = Model_Setting::menu_list_items($business, $ugroup);

foreach ($setting_modules as $setting_module) : ?>

<!-- <div class="row"> -->
<?php 
    foreach ($setting_module as $setting_item) : 
        if (!$setting_item['visible']) :
            continue;
        endif;
        // if ($setting_item['column'] == Model_Setting::SETTINGS_COLUMN_LEFT) : ?>
    <div class="col-md-6">
        <div class="panel panel-default">
            <!--<div class="panel-heading">
                <div class="panel-title"><?= $setting_item['label'] ?></div>
            </div>-->
            <div class="panel-body">
                <i class="text-muted fa fa-fw fa-lg fa-<?= !empty($setting_item['icon']) ? $setting_item['icon'] : '' ?>"></i>
                <a class="btn btn-lg btn-link" href="<?= Uri::create($setting_item['route']); ?>">
                    <span><?= $setting_item['label'] ?></span>
                </a>
                <div class="small text-muted"><?= $setting_item['description'] ?></div>
            </div>
        </div>
    </div>
    <?php   
        // endif;
        // if ($setting_item['column'] == Model_Setting::SETTINGS_COLUMN_RIGHT) : ?>
    <!-- <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <!--<i class="fa fa-fw fa-lg fa-<?php !empty($setting_item['icon']) ? $setting_item['icon'] : '' ?>"></i>
                <a class="btn btn-lg btn-link" href="<?php Uri::create($setting_item['route']); ?>">
                    <span><?php $setting_item['label'] ?></span>
                </a>
                <div class="small text-muted"><?php $setting_item['description'] ?></div>
            </div>
        </div>
    </div> -->
    <?php 
        // endif;
    endforeach ?>
<!-- </div> -->
<?php
endforeach ?>