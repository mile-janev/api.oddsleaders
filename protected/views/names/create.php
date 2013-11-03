<?php
/* @var $this NamesController */
/* @var $model Names */

$this->breadcrumbs=array(
	'Names'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Names', 'url'=>array('index')),
	array('label'=>'Manage Names', 'url'=>array('admin')),
);
?>

<h1>Create Names</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>