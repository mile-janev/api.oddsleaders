<?php
/* @var $this StackOldController */
/* @var $model StackOld */

$this->breadcrumbs=array(
	'Stack Olds'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List StackOld', 'url'=>array('index')),
	array('label'=>'Create StackOld', 'url'=>array('create')),
	array('label'=>'View StackOld', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage StackOld', 'url'=>array('admin')),
);
?>

<h1>Update StackOld <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>