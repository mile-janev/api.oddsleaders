<?php
/* @var $this StackOldController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Stack Olds',
);

$this->menu=array(
	array('label'=>'Create StackOld', 'url'=>array('create')),
	array('label'=>'Manage StackOld', 'url'=>array('admin')),
);
?>

<h1>Stack Olds</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
