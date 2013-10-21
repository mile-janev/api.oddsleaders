<?php
/* @var $this SportController */
/* @var $model Sport */

$this->breadcrumbs=array(
	'Sports'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Sport', 'url'=>array('index')),
	array('label'=>'Create Sport', 'url'=>array('create')),
	array('label'=>'View Sport', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Sport', 'url'=>array('admin')),
);
?>

<h1>Update Sport <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>