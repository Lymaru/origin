<?php

class Subscribers extends RecordModel
{
    
    public $tableName = 'subscriptions';
    
    public static function model($classname=__CLASS__)
    {
        return parent::model($classname);
    }

    public function inSubscribers()
    {
        $subscriptionId = (int)$_GET['subscription'];

        $sttm = $this->pdo->prepare("INSERT INTO `subscriptions` (`subscriber`, `the_followed`) VALUES ({$subscriptionId}, {$_SESSION['id']})");
        $sttm->execute();
        
        $sttm = $this->pdo->prepare("DELETE FROM `requests` WHERE `user1` = {$subscriptionId} AND `user2` = {$_SESSION['id']}");
        $sttm->execute(); 
    }    
}