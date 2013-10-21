<?php
/* @var $this SportController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sports',
);

$this->menu=array(
	array('label'=>'Create Sport', 'url'=>array('create')),
	array('label'=>'Manage Sport', 'url'=>array('admin')),
);
?>

<h1>Sports</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
