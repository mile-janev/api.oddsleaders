<?php
/* @var $this SportController */
/* @var $model Sport */

$this->breadcrumbs=array(
	'Sports'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Sport', 'url'=>array('index')),
	array('label'=>'Create Sport', 'url'=>array('create')),
	array('label'=>'Update Sport', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Sport', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Sport', 'url'=>array('admin')),
);
?>

<h1>View Sport #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
                'syn',
		'link',
                'syn_link',
		'active',
	),
)); ?>
