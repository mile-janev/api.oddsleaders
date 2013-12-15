<?php
/* @var $this FinishedController */
/* @var $model Finished */

$this->breadcrumbs=array(
	'Finisheds'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Finished', 'url'=>array('index')),
	array('label'=>'Create Finished', 'url'=>array('create')),
	array('label'=>'View Finished', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Finished', 'url'=>array('admin')),
);
?>

<h1>Update Finished <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>