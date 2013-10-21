<?php
/* @var $this StackController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Stacks',
);

$this->menu=array(
	array('label'=>'Create Stack', 'url'=>array('create')),
	array('label'=>'Manage Stack', 'url'=>array('admin')),
);
?>

<h1>Stacks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
