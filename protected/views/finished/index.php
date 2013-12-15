<?php
/* @var $this FinishedController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Finisheds',
);

$this->menu=array(
	array('label'=>'Create Finished', 'url'=>array('create')),
	array('label'=>'Manage Finished', 'url'=>array('admin')),
);
?>

<h1>Finisheds</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
