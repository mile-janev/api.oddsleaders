<?php
/* @var $this ArchiveController */
/* @var $model Archive */

$this->breadcrumbs=array(
	'Archives'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Archive', 'url'=>array('index')),
	array('label'=>'Manage Archive', 'url'=>array('admin')),
);
?>

<h1>Create Archive</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>