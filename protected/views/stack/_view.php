<?php
/* @var $this StackController */
/* @var $data Stack */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />
        
        <b><?php echo CHtml::encode($data->getAttributeLabel('code')); ?>:</b>
	<?php echo CHtml::encode($data->code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('link')); ?>:</b>
	<?php echo CHtml::encode($data->link); ?>
	<br />
        
        <b><?php echo CHtml::encode($data->getAttributeLabel('syn_link')); ?>:</b>
	<?php echo CHtml::encode($data->syn_link); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('opponent')); ?>:</b>
	<?php echo CHtml::encode($data->opponent); ?>
	<br />
        
        <b><?php echo CHtml::encode($data->getAttributeLabel('syn')); ?>:</b>
	<?php echo CHtml::encode($data->syn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('start')); ?>:</b>
	<?php echo CHtml::encode($data->start); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data')); ?>:</b>
	<?php echo CHtml::encode($data->data); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tournament_id')); ?>:</b>
	<?php echo CHtml::encode($data->tournament_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cron')); ?>:</b>
	<?php echo CHtml::encode($data->cron); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('cron_time')); ?>:</b>
	<?php echo CHtml::encode($data->cron_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_created')); ?>:</b>
	<?php echo CHtml::encode($data->date_created); ?>
	<br />

	*/ ?>

</div>