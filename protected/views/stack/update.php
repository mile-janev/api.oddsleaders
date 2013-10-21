<?php
/* @var $this StackController */
/* @var $model Stack */

$this->breadcrumbs=array(
	'Stacks'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Stack', 'url'=>array('index')),
	array('label'=>'Create Stack', 'url'=>array('create')),
	array('label'=>'View Stack', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Stack', 'url'=>array('admin')),
);
?>

<h1>Update Stack <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>