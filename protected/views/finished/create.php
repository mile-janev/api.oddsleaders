<?php
/* @var $this FinishedController */
/* @var $model Finished */

$this->breadcrumbs=array(
	'Finisheds'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Finished', 'url'=>array('index')),
	array('label'=>'Manage Finished', 'url'=>array('admin')),
);
?>

<h1>Create Finished</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>