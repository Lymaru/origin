<?php

class Requests extends RecordModel
{
    
    public $tableName = 'requests';
    
    public static function model($classname=__CLASS__)
    {
        return parent::model($classname);
    }
    
    public function addRequestFriend()
    {
        $add = (int)$_GET['add'];

        $sttm = $this->pdo->prepare("INSERT INTO `requests` (`user1`, `user2`) VALUES ({$_SESSION['id']}, {$add})");
        try 
        {
            $sttm->execute();
        }
        catch (Exception $ex) 
        {
            $e->getMessage();
        }         
    }

    public function approveRequest()
    {
        $approveId = (int)$_GET['approve'];
        
        $friend1 = min($_SESSION['id'], $approve);
        $friend2 = max($_SESSION['id'], $approve);
        
        $sttm = $this->pdo->prepare("INSERT INTO `friends` (`userid`, `friendid`) VALUES ({$_SESSION['id']}, {$approveId})");
        $sttm->execute();
        
        $sttm = $this->pdo->prepare("INSERT INTO `friends` (`userid`, `friendid`) VALUES ({$approveId}, {$_SESSION['id']})");
        $sttm->execute();
        
        $sttm = $this->pdo->prepare("DELETE FROM `requests` WHERE `user1` = {$approveId} AND `user2` = {$_SESSION['id']}");
        $sttm->execute();
    }
    
    public function acceptInvitation()
    {
        $acceptId = (int)$_GET['accept'];
        
        $sttm = $this->pdo->prepare("INSERT INTO `events_users` (`event_id`, `user_id`) VALUES ({$acceptId}, {$_SESSION['id']})");
        $sttm->execute();
        
    }
        
}