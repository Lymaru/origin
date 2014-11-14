<?php

class Guests extends RecordModel
{
    
    public $tableName = 'guests_users';
    
    public static function model($classname=__CLASS__)
    {
        return parent::model($classname);
    }
          
    public function updateGuest($user_id, $guest_id) 
    {
        $sttm = $this->pdo->prepare("UPDATE `guests_users` SET `review_qty` = `review_qty` + 1 WHERE {$guest_id} = `guest_id` AND {$user_id} = `user_id`");
        try 
        {
            $sttm->execute();    
        }
        catch (Exception $ex) 
        {
            $e->getMessage();
        }
    }
    
    public function deleteReviewGuest() 
    {
        $sttm = $this->pdo->prepare("UPDATE `guests_users` SET `review_qty` = 0;");
        try 
        {
            $sttm->execute();    
        }
        catch (Exception $ex) 
        {
            $e->getMessage();
        }
    }
       
}
