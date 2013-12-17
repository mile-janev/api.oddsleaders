<?php
/* @var $this FinishedController */
/* @var $model Finished */

$this->breadcrumbs=array(
	'Finisheds'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Finished', 'url'=>array('index')),
	array('label'=>'Create Finished', 'url'=>array('create')),
	array('label'=>'Update Finished', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Finished', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Finished', 'url'=>array('admin')),
);
?>

<h1>View Finished #<?php echo $model->id; ?></h1>

<table id="yw0" class="detail-view">
    <tbody>
        <tr class="odd"><th><?php echo $model->getAttributeLabel('id'); ?></th><td><?php echo $model->id; ?></td></tr>
        <tr class="even"><th><?php echo $model->getAttributeLabel('code'); ?></th><td><?php echo $model->code; ?></td></tr>
        <tr class="odd"><th><?php echo $model->getAttributeLabel('opponent'); ?></th><td><?php echo $model->opponent; ?></td></tr>
        <tr class="even"><th><?php echo $model->getAttributeLabel('start'); ?></th><td><?php echo $model->start; ?></td></tr>
        <tr class="odd"><th><?php echo $model->getAttributeLabel('sport'); ?></th><td><?php echo $model->tournament->sport->name; ?></td></tr>
        <tr class="even"><th><?php echo $model->getAttributeLabel('tournament_id'); ?></th><td><?php echo $model->tournament->name; ?></td></tr>
        <tr class="odd">
            <th><?php echo $model->getAttributeLabel('data'); ?></th>
            <td><?php echo CHtml::textArea('data', Oddsleaders::pretty_print($model->data), array('class'=>'coefficients-textarea','readonly'=>'readonly')); ?></td>
        </tr>
        <tr class="even">
            <th><?php echo $model->getAttributeLabel('result'); ?></th>
            <td><?php echo CHtml::textArea('result', Oddsleaders::pretty_print($model->result), array('class'=>'coefficients-textarea','readonly'=>'readonly')); ?></td>
        </tr>
    </tbody>
</table>
