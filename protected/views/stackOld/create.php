<?php
/* @var $this StackOldController */
/* @var $model StackOld */

$this->breadcrumbs=array(
	'Stack Olds'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List StackOld', 'url'=>array('index')),
	array('label'=>'Manage StackOld', 'url'=>array('admin')),
);
?>

<h1>Create StackOld</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>