<ul class="admin-menu">
    <li><?php echo CHtml::link("Cron Names", Yii::app()->createUrl("names/cron")); ?></li>
    <li><?php echo CHtml::link("Cron Tournament Handly", Yii::app()->createUrl("cron/tournament")); ?></li>
    <li><?php echo CHtml::link("Cron Stack", Yii::app()->createUrl("cron/stack")); ?></li>
    <li><?php echo CHtml::link("Cron Odds", Yii::app()->createUrl("cron/odds")); ?></li>
    <li><?php echo CHtml::link("Cron Results", Yii::app()->createUrl("cron/results")); ?></li>
    <li><?php echo CHtml::link("Cron XML", Yii::app()->createUrl("cron/xml")); ?></li>
    <li><?php echo CHtml::link("Cron Archive", Yii::app()->createUrl("cron/archive")); ?></li>
</ul>