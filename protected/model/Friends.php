<?php

class Friends extends RecordModel
{

    public $tableName = 'friends';

    public static function model($classname=__CLASS__)
    {
        return parent::model($classname);
    }

    public function validate()
    {

    }
    
    public function lateApprove()
    {
        $lateapproveId = (int)$_GET['lateapprove'];
        
        $sttm = $this->pdo->prepare("INSERT INTO `friends` (`userid`, `friendid`) VALUES ({$_SESSION['id']}, {$lateapproveId})");
        $sttm->execute();
        
        $sttm = $this->pdo->prepare("INSERT INTO `friends` (`userid`, `friendid`) VALUES ({$lateapproveId}, {$_SESSION['id']})");
        $sttm->execute();
        
        $sttm = $this->pdo->prepare("DELETE FROM `subscriptions` WHERE `subscriber` = {$lateapproveId} AND `the_followed` = {$_SESSION['id']}");
        $sttm->execute();

    }
    
    public function removeFriend()
    {
        $removeFriendId = (int)$_GET['removefriend'];
        
        $sttm = $this->pdo->prepare("INSERT INTO `subscriptions` (`subscriber`, `the_followed`) VALUES ({$removeFriendId}, {$_SESSION['id']})");
        $sttm->execute();
        
        $sttm = $this->pdo->prepare("DELETE FROM `friends` WHERE `userid` = {$removeFriendId} AND `friendid` = {$_SESSION['id']}");
        $sttm->execute();
        
        $sttm = $this->pdo->prepare("DELETE FROM `friends` WHERE `userid` = {$_SESSION['id']} AND `friendid` = {$removeFriendId}");
        $sttm->execute();
    }
}

