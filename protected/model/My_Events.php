<?php

class My_Events extends RecordModel{
    
    public $tableName = 'events_users';
    
    public static function model($classname=__CLASS__)
    {
        return parent::model($classname);
    }
    
}

