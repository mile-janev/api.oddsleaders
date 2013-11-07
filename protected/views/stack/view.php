<?php
/* @var $this StackController */
/* @var $model Stack */

$this->breadcrumbs=array(
	'Stacks'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Stack', 'url'=>array('index')),
	array('label'=>'Create Stack', 'url'=>array('create')),
	array('label'=>'Update Stack', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Stack', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Stack', 'url'=>array('admin')),
);
?>

<h1>View Stack #<?php echo $model->id; ?></h1>

<table id="yw0" class="detail-view">
    <tbody>
        <tr class="odd"><th><?php echo $model->getAttributeLabel('id'); ?></th><td><?php echo $model->id; ?></td></tr>
        <tr class="even"><th><?php echo $model->getAttributeLabel('code'); ?></th><td><?php echo $model->code; ?></td></tr>
        <tr class="odd"><th><?php echo $model->getAttributeLabel('link'); ?></th><td><a href='<?php echo $model->link; ?>' target='_blank'><?php echo $model->link; ?></a></td></tr>
        <tr class="even"><th><?php echo $model->getAttributeLabel('syn_link'); ?></th><td><a href='<?php echo $model->syn_link; ?>' target='_blank'><?php echo $model->syn_link; ?></a></td></tr>
        <tr class="odd"><th><?php echo $model->getAttributeLabel('opponent'); ?></th><td><?php echo $model->opponent; ?></td></tr>
        <tr class="even"><th><?php echo $model->getAttributeLabel('syn'); ?></th><td><?php echo $model->syn; ?></td></tr>
        <tr class="odd"><th><?php echo $model->getAttributeLabel('start'); ?></th><td><?php echo $model->start; ?></td></tr>
        <tr class="even"><th><?php echo $model->getAttributeLabel('sport'); ?></th><td><?php echo $model->tournament->sport->name; ?></td></tr>
        <tr class="odd"><th><?php echo $model->getAttributeLabel('tournament_id'); ?></th><td><?php echo $model->tournament->name; ?></td></tr>
        <tr class="even"><th><?php echo $model->getAttributeLabel('cron'); ?></th><td><?php echo $model->cron; ?></td></tr>
        <tr class="odd"><th><?php echo $model->getAttributeLabel('cron_time'); ?></th><td><?php echo $model->cron_time; ?></td></tr>
        <tr class="even"><th><?php echo $model->getAttributeLabel('date_created'); ?></th><td><?php echo $model->date_created; ?></td></tr>
        <tr class="odd">
            <th><?php echo $model->getAttributeLabel('data'); ?></th>
            <td><?php echo CHtml::textArea('data', Oddsleaders::pretty_print($model->data), array('class'=>'coefficients-textarea','readonly'=>'readonly')); ?></td>
        </tr>
    </tbody>
</table>