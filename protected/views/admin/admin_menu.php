<ul class="admin-menu">
    <li><?php echo CHtml::link("Sport admin", Yii::app()->createUrl("sport/admin")); ?></li>
    <li><?php echo CHtml::link("Tournament admin", Yii::app()->createUrl("tournament/admin")); ?></li>
     <li><?php echo CHtml::link("Stack admin", Yii::app()->createUrl("stack/admin")); ?></li>
    <li>-------------------------------------------------------------------------------------</li>
    <li><?php echo CHtml::link("Get odds", Yii::app()->createUrl("cron/getodds")); ?></li>
    <li>-------------------------------------------------------------------------------------</li>
    <li><?php echo CHtml::link("Insert league teams", Yii::app()->createUrl("cron/insertTeams")); ?></li>
    <li><?php echo CHtml::link("Slave cron odds", Yii::app()->createUrl("slave/odds")); ?></li>
    <li><?php echo CHtml::link("Generate coefficients", Yii::app()->createUrl("cron/odds")); ?></li>
    <li><?php echo CHtml::link("Get Results", Yii::app()->createUrl("cron/result")); ?></li>
    <li><?php echo CHtml::link("Get Coefficients for game", Yii::app()->createUrl("cron/linkdata")); ?></li>
    <li><?php echo CHtml::link("Coefficient admin", Yii::app()->createUrl("coefficient/admin")); ?></li>
    <li><?php echo CHtml::link("Game admin", Yii::app()->createUrl("game/admin")); ?></li>
    <li><?php echo CHtml::link("House admin", Yii::app()->createUrl("house/admin")); ?></li>
    <li><?php echo CHtml::link("League admin", Yii::app()->createUrl("league/admin")); ?></li>
    <li><?php echo CHtml::link("Nickname admin", Yii::app()->createUrl("nickname/admin")); ?></li>
    <li><?php echo CHtml::link("Role admin", Yii::app()->createUrl("role/admin")); ?></li>
    <li><?php echo CHtml::link("Round admin", Yii::app()->createUrl("round/admin")); ?></li>
    <li><?php echo CHtml::link("Team admin", Yii::app()->createUrl("team/admin")); ?></li>
    <li><?php echo CHtml::link("User admin", Yii::app()->createUrl("user/admin")); ?></li>
</ul>