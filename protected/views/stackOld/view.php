<?php
/* @var $this StackOldController */
/* @var $model StackOld */

$this->breadcrumbs=array(
	'Stack Olds'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List StackOld', 'url'=>array('index')),
	array('label'=>'Create StackOld', 'url'=>array('create')),
	array('label'=>'Update StackOld', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete StackOld', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage StackOld', 'url'=>array('admin')),
);
?>

<h1>View StackOld #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'code',
		'link',
		'syn_link',
		'opponent',
		'syn',
		'start',
		'end',
		'data',
		'tournament_id',
		'cron',
		'cron_time',
		'date_created',
	),
)); ?>
