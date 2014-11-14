<?php

class Event extends RecordModel{
    
    public $tableName = 'event';
    
    public function save(){
        if(parent::save()){
            
            $INSERT = "INSERT INTO `events_users` VALUES (".$this->id.",".$this->creator_id.");";
            $sttm = $this->pdo->prepare($INSERT);
            $sttm->execute();
        }
    }
    
    public static function model($classname=__CLASS__)
    {
        return parent::model($classname);
    }
    
}
