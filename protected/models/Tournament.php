<?php

/**
 * This is the model class for table "tournament".
 *
 * The followings are the available columns in table 'tournament':
 * @property string $id
 * @property string $name
 * @property string $syn
 * @property string $link
 * @property string $syn_link
 * @property integer $active
 * @property string $sport_id
 *
 * The followings are the available model relations:
 * @property Stack[] $stacks
 * @property Sport $sport
 */
class Tournament extends CActiveRecord
{
	/**
	 * @return stactivering the associated database table name
	 */
	public function tableName()
	{
		return 'tournament';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, link, sport_id', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
                        array('special', 'numerical', 'integerOnly'=>true),
			array('name, syn', 'length', 'max'=>256),
			array('sport_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, syn, link, syn_link, active, sport_id, special', 'safe', 'on'=>'search'),
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
			'stacks' => array(self::HAS_MANY, 'Stack', 'tournament_id'),
			'sport' => array(self::BELONGS_TO, 'Sport', 'sport_id'),
                        'country' => array(self::BELONGS_TO, 'Country', 'country_id'),
                        'finisheds' => array(self::HAS_MANY, 'Finished', 'tournament_id'),
                        'archives' => array(self::HAS_MANY, 'Archive', 'tournament_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
                        'syn' => 'Res Name',
                        'country_id' => 'Country',
			'link' => 'Link',
                        'syn_link' => 'Res Link',
			'active' => 'Active',
			'sport_id' => 'Sport',
                        'special' => 'Special tournament'
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
		$criteria->compare('name',$this->name,true);
                $criteria->compare('syn',$this->syn,true);
		$criteria->compare('link',$this->link,true);
                $criteria->compare('syn_link',$this->syn_link,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('sport_id',$this->sport_id,true);
                $criteria->compare('special',$this->special,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tournament the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
