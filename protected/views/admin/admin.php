<ul class="admin-menu">
    <li><?php echo CHtml::link("Sport Admin", Yii::app()->createUrl("sport/admin")); ?></li>
    <li><?php echo CHtml::link("Tournament Admin", Yii::app()->createUrl("tournament/admin")); ?></li>
    <li><?php echo CHtml::link("Stack Admin", Yii::app()->createUrl("stack/admin")); ?></li>
    <li><?php echo CHtml::link("Country Admin", Yii::app()->createUrl("country/admin")); ?></li>
    <li><?php echo CHtml::link("Names Admin", Yii::app()->createUrl("names/admin")); ?></li>
    <li>-------------------------------------------------------------------------------------</li>
    <li><?php echo CHtml::link("Finished admin", Yii::app()->createUrl("finished/admin")); ?></li>
    <li><?php echo CHtml::link("Archive admin", Yii::app()->createUrl("archive/admin")); ?></li>
    <li>-------------------------------------------------------------------------------------</li>
    <li><?php echo CHtml::link("User admin", Yii::app()->createUrl("user/admin")); ?></li>
    <li><?php echo CHtml::link("Role admin", Yii::app()->createUrl("role/admin")); ?></li>
</ul>