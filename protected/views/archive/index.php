<?php
/* @var $this ArchiveController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Archives',
);

$this->menu=array(
	array('label'=>'Create Archive', 'url'=>array('create')),
	array('label'=>'Manage Archive', 'url'=>array('admin')),
);
?>

<h1>Archives</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
