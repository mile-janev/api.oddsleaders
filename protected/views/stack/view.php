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
        <tr class="even"><th><?php echo $model->getAttributeLabel('link'); ?></th><td><?php echo $model->link; ?></td></tr>
        <tr class="odd"><th><?php echo $model->getAttributeLabel('opponent'); ?></th><td><?php echo $model->opponent; ?></td></tr>
        <tr class="even"><th><?php echo $model->getAttributeLabel('start'); ?></th><td><?php echo $model->start; ?></td></tr>
        <tr class="odd"><th><?php echo $model->getAttributeLabel('sport'); ?></th><td><?php echo $model->tournament->sport->name; ?></td></tr>
        <tr class="odd"><th><?php echo $model->getAttributeLabel('tournament_id'); ?></th><td><?php echo $model->tournament->name; ?></td></tr>
        <tr class="even"><th><?php echo $model->getAttributeLabel('cron'); ?></th><td><?php echo $model->cron; ?></td></tr>
        <tr class="odd"><th><?php echo $model->getAttributeLabel('cron_time'); ?></th><td><?php echo $model->cron_time; ?></td></tr>
        <tr class="even"><th><?php echo $model->getAttributeLabel('date_created'); ?></th><td><?php echo $model->date_created; ?></td></tr>
        <tr class="even">
            <th><?php echo $model->getAttributeLabel('data'); ?></th>
            <td><?php echo CHtml::textArea('data', indent($model->data), array('class'=>'coefficients-textarea','readonly'=>'readonly')); ?></td>
        </tr>
    </tbody>
</table>

<?php
function indent($json) {

    $result      = '';
    $pos         = 0;
    $strLen      = strlen($json);
    $indentStr   = '  ';
    $newLine     = "\n";
    $prevChar    = '';
    $outOfQuotes = true;

    for ($i=0; $i<=$strLen; $i++) {

        // Grab the next character in the string.
        $char = substr($json, $i, 1);

        // Are we inside a quoted string?
        if ($char == '"' && $prevChar != '\\') {
            $outOfQuotes = !$outOfQuotes;

        // If this character is the end of an element,
        // output a new line and indent the next line.
        } else if(($char == '}' || $char == ']') && $outOfQuotes) {
            $result .= $newLine;
            $pos --;
            for ($j=0; $j<$pos; $j++) {
                $result .= $indentStr;
            }
        }

        // Add the character to the result string.
        $result .= $char;

        // If the last character was the beginning of an element,
        // output a new line and indent the next line.
        if (($char == ',' || $char == '{' || $char == '[') && $outOfQuotes) {
            $result .= $newLine;
            if ($char == '{' || $char == '[') {
                $pos ++;
            }

            for ($j = 0; $j < $pos; $j++) {
                $result .= $indentStr;
            }
        }

        $prevChar = $char;
    }

    return $result;
}

?>