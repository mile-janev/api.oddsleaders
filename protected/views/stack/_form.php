<?php
/* @var $this StackController */
/* @var $model Stack */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'stack-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        
        <div class="row">
		<?php echo $form->labelEx($model,'code'); ?>
		<?php echo $form->textField($model,'code',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'link'); ?>
		<?php echo $form->textArea($model,'link',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'link'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'syn_link'); ?>
		<?php echo $form->textArea($model,'syn_link',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'syn_link'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'opponent'); ?>
		<?php echo $form->textField($model,'opponent',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'opponent'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'syn'); ?>
		<?php echo $form->textField($model,'syn',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'syn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'start'); ?>
		<?php echo $form->textField($model,'start'); ?>
		<?php echo $form->error($model,'start'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data'); ?>
		<?php echo $form->textArea($model,'data',array('class'=>'coefficients-textarea')); ?>
		<?php echo $form->error($model,'data'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tournament_id'); ?>
		<?php echo $form->textField($model,'tournament_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'tournament_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cron'); ?>
		<?php echo $form->textField($model,'cron'); ?>
		<?php echo $form->error($model,'cron'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cron_time'); ?>
		<?php echo $form->textField($model,'cron_time'); ?>
		<?php echo $form->error($model,'cron_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_created'); ?>
		<?php echo $form->textField($model,'date_created'); ?>
		<?php echo $form->error($model,'date_created'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->