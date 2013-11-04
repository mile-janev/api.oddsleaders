<?php
/* @var $this TournamentController */
/* @var $data Tournament */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />
        
        <b><?php echo CHtml::encode($data->getAttributeLabel('syn')); ?>:</b>
	<?php echo CHtml::encode($data->syn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('link')); ?>:</b>
	<?php echo CHtml::encode($data->link); ?>
	<br />
        
        <b><?php echo CHtml::encode($data->getAttributeLabel('syn_link')); ?>:</b>
	<?php echo CHtml::encode($data->syn_link); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sport_id')); ?>:</b>
	<?php echo CHtml::encode($data->sport_id); ?>
	<br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('special')); ?>:</b>
	<?php echo CHtml::encode($data->special); ?>
	<br />

</div>