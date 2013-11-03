<?php
/* @var $this NamesController */
/* @var $model Names */

$this->breadcrumbs=array(
	'Names'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Names', 'url'=>array('index')),
	array('label'=>'Create Names', 'url'=>array('create')),
	array('label'=>'View Names', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Names', 'url'=>array('admin')),
);
?>

<h1>Update Names <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>