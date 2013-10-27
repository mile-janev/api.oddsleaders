<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $name
 * @property string $email
 * @property string $date_created
 * @property integer $active
 * @property string $oauth_provider
 * @property string $oauth_uid
 *
 * The followings are the available model relations:
 * @property Role[] $roles
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}
        
        public function beforeSave() { // 06adb4cbaa2eabbc41f8f2af3b095bf65d67d7b8
            if ($this->isNewRecord) {
                $this->date_created = new CDbExpression('NOW()');
            }
            
            $bcrypt = new Bcrypt();
            $this->password = $bcrypt->hash($this->password);

            return parent::beforeSave();
        }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, name, email', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('username, password, email', 'length', 'max'=>64),
			array('name', 'length', 'max'=>255),
			array('oauth_provider', 'length', 'max'=>32),
			array('oauth_uid', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, name, email, date_created, active, oauth_provider, oauth_uid', 'safe', 'on'=>'search'),
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
			'roles' => array(self::HAS_MANY, 'Role', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'name' => 'Name',
			'email' => 'Email',
			'date_created' => 'Date Created',
			'active' => 'Active',
			'oauth_provider' => 'Oauth Provider',
			'oauth_uid' => 'Oauth Uid',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('oauth_provider',$this->oauth_provider,true);
		$criteria->compare('oauth_uid',$this->oauth_uid,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
