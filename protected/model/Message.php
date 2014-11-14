<?php

class Message extends RecordModel
{
    
    public $tableName = 'messages';
    
    public static function model($classname=__CLASS__)
    {
        return parent::model($classname);
    }

    public function validate()
    {

    }
    
    public function add_msg($from, $to, $message)
    {
        $send_date = time();
        $sttm = $this->pdo->prepare("INSERT INTO `messages` (`from_user`, `to_user`, `message`, `send_date`) VALUES (:from_user, :to_user, :message, :send_date)");

        try
        {
            $sttm->execute(array(':from_user' => $from, ':to_user' => $to, ':message' => $message, ':send_date' => $send_date));
        } 
        catch (Exception $ex) 
        {
            $e->getMessage();
        }
    }
    
    public function show_msg_history($from_user, $to_user, $last_id)
    {
        $sttm = $this->pdo->prepare("SELECT messages.id, from_user, to_user, message, nickname "
                                    . "FROM messages JOIN user ON messages.from_user = user.id "
                                    . "WHERE from_user = $from_user AND to_user = $to_user AND messages.id > $last_id "
                                    . "OR from_user = $to_user AND to_user = $from_user AND messages.id > $last_id "
                                    . "ORDER BY messages.id DESC LIMIT 20");
        try
        {
            $sttm->execute();
            echo json_encode(array_reverse($sttm->fetchall()));
        }
        catch (PDOException $e) 
        {
            echo 'Ошибка подключения: ' . $e->getMessage();
        }
    }
    
    public function show_last_msg($myId, $friendId)
    {
        $sttm = $this->pdo->prepare("SELECT message, `read` FROM `$this->tableName` WHERE from_user = $myId AND to_user = $friendId "
                                                                      . "OR from_user = $friendId AND to_user = $myId "
                                                                      . "ORDER BY `id` DESC LIMIT 1");
        try
        {
            $sttm->execute();
            $result = $sttm->fetch(PDO::FETCH_ASSOC);
            $rows = $sttm->rowCount();
            if($rows == 0)
            {
                $result = array('message'=>'Message history... (no messages)');
            }
            return $result;
        }
        catch (PDOException $e) 
        {
            echo 'Ошибка подключения: ' . $e->getMessage();
        }
    }
    
    public function show_who_send_msg($myId)
    {
        $sttm = $this->pdo->prepare("SELECT * FROM `$this->tableName` WHERE from_user = $myId AND to_user LIKE '%%' "
                                                                      . "OR from_user LIKE '%%' AND to_user = $myId "
                                                                      . "ORDER BY `id` DESC");
        try
        {
            $sttm->execute();
            $result = $sttm->fetchAll(PDO::FETCH_ASSOC);
            $lastMsgArr = array();
            foreach ($result as $val)
            {
                if(!in_array($val['from_user'], $lastMsgArr) && $myId != $val['from_user'])
                {
                    array_push($lastMsgArr, $val['from_user']);
                }
                if(!in_array($val['to_user'], $lastMsgArr) && $myId != $val['to_user'])
                {
                    array_push($lastMsgArr, $val['to_user']);
                }
            }
            return $lastMsgArr;
        }
        catch (PDOException $e) 
        {
            echo 'Ошибка подключения: ' . $e->getMessage();
        }
    }
    
    public function count_new_messages($myId)
    {
        $sttm = $this->pdo->prepare("SELECT * FROM `$this->tableName` WHERE to_user = $myId AND from_user LIKE '%%' AND `read` = 0");
        try
        {
            $sttm->execute();
            $result = $sttm->fetch(PDO::FETCH_ASSOC);
            $rows = $sttm->rowCount();
            return $rows;
        }
        catch (PDOException $e)
        {
            echo 'Ошибка подключения: ' . $e->getMessage();
        }
    }
    
    public function read_message($myId, $fromId)
    {
        $sttm = $this->pdo->prepare("UPDATE `$this->tableName` SET `read` = 1 WHERE to_user = $myId AND from_user = $fromId AND `read` = 0");
        try
        {
            $sttm->execute();
            $result = $sttm->fetch(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e)
        {
            echo 'Ошибка подключения: ' . $e->getMessage();
        }
    }
}