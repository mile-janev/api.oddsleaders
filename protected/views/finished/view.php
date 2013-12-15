<?php
/* @var $this FinishedController */
/* @var $model Finished */

$this->breadcrumbs=array(
	'Finisheds'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Finished', 'url'=>array('index')),
	array('label'=>'Create Finished', 'url'=>array('create')),
	array('label'=>'Update Finished', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Finished', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Finished', 'url'=>array('admin')),
);
?>

<h1>View Finished #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'code',
		'opponent',
		'start',
		'data',
		'result',
		'tournament_id',
	),
)); ?>
