<?php
/* @var $this StackController */
/* @var $model Stack */

$this->breadcrumbs=array(
	'Stacks'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Stack', 'url'=>array('index')),
	array('label'=>'Create Stack', 'url'=>array('create')),
	array('label'=>'Update Stack', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Stack', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Stack', 'url'=>array('admin')),
);
?>

<h1>View Stack #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'link',
		'opponent',
		'start',
		'data',
		'tournament_id',
		'cron',
		'cron_time',
		'date_created',
	),
)); ?>
