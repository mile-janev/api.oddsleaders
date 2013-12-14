<?php

/**
 * This is the model class for table "stack_old".
 *
 * The followings are the available columns in table 'stack_old':
 * @property string $id
 * @property string $code
 * @property string $link
 * @property string $syn_link
 * @property string $opponent
 * @property string $syn
 * @property string $start
 * @property integer $end
 * @property string $data
 * @property string $tournament_id
 * @property integer $cron
 * @property string $cron_time
 * @property string $date_created
 *
 * The followings are the available model relations:
 * @property Tournament $tournament
 */
class StackOld extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'stack_old';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, link, tournament_id, date_created', 'required'),
			array('end, cron', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>20),
			array('opponent, syn', 'length', 'max'=>256),
			array('tournament_id', 'length', 'max'=>10),
			array('syn_link, start, data, result, cron_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, code, link, syn_link, opponent, syn, start, end, data, result, tournament_id, cron, cron_time, date_created', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'tournament' => array(self::BELONGS_TO, 'Tournament', 'tournament_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'code' => 'Code',
			'link' => 'Link',
			'syn_link' => 'Syn Link',
			'opponent' => 'Opponent',
			'syn' => 'Syn',
			'start' => 'Start',
			'end' => 'End',
			'data' => 'Data',
                        'result' => 'Result',
			'tournament_id' => 'Tournament',
			'cron' => 'Cron',
			'cron_time' => 'Cron Time',
			'date_created' => 'Date Created',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('syn_link',$this->syn_link,true);
		$criteria->compare('opponent',$this->opponent,true);
		$criteria->compare('syn',$this->syn,true);
		$criteria->compare('start',$this->start,true);
		$criteria->compare('end',$this->end);
		$criteria->compare('data',$this->data,true);
                $criteria->compare('result',$this->result,true);
		$criteria->compare('tournament_id',$this->tournament_id,true);
		$criteria->compare('cron',$this->cron);
		$criteria->compare('cron_time',$this->cron_time,true);
		$criteria->compare('date_created',$this->date_created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return StackOld the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
