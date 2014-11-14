<?php

class User extends RecordModel
{
        public $tableName = 'user';
        public $username;
        public $email;
        public $birthdate;
        public $password;
        
	public static function model($classname=__CLASS__)
        {
            return parent::model($classname);
        }

	public function validate()
        {
	
	}

        public function relations()
        {
            return array(
                'city'=>array('city'=>'id')
             );
        }
}