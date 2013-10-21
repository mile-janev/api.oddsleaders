<?php
/* @var $this StackController */
/* @var $model Stack */

$this->breadcrumbs=array(
	'Stacks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Stack', 'url'=>array('index')),
	array('label'=>'Manage Stack', 'url'=>array('admin')),
);
?>

<h1>Create Stack</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>