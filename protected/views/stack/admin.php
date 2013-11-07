<?php
/* @var $this StackController */
/* @var $model Stack */

$this->breadcrumbs=array(
	'Stacks'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Stack', 'url'=>array('index')),
	array('label'=>'Create Stack', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#stack-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Stacks</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'stack-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
                'code',
		array(
                    'name'=>'link',
                    'value'=>'"<a href=" .$data->link. " target=_blank>" .$data->link. "</a>"',
                    'sortable'=>TRUE,
                    'type'  => 'raw',
                ),
                array(
                    'name'=>'syn_link',
                    'value'=>'"<a href=" .$data->syn_link. " target=_blank>" .$data->syn_link. "</a>"',
                    'sortable'=>TRUE,
                    'type'  => 'raw',
                ),
		'opponent',
                'syn',
		'start',
		'tournament_id',
		'cron',
		'cron_time',
		'date_created',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
