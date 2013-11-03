<?php
/* @var $this NamesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Names',
);

$this->menu=array(
	array('label'=>'Create Names', 'url'=>array('create')),
	array('label'=>'Manage Names', 'url'=>array('admin')),
);
?>

<h1>Names</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
