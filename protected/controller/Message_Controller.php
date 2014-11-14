<?php

class Message_Controller extends BaseController
{
    public $baseViewPath = '/protected/view/message/';
    
    public function index()
    {
        $this->baseView = '/protected/view/layers/profile';
        
        if(!isset ($_SESSION['id']))
        {
            $this->redirect('/user/auth');
        }

        // Делаем вывод всех друзей
        $usersArr = array();
        $messagesArr = array();
        
        $msgObj = Message::model()->show_who_send_msg($_SESSION['id']);
        foreach($msgObj as $userLastMsg)
        {
            $user = User::model()->getByAttributes(array('id','=',$userLastMsg));
            array_push($usersArr, $user);
            
            $message = Message::model()->show_last_msg($_SESSION['id'],$userLastMsg);
            array_push($messagesArr, $message);
        }
        //Подсчет количества новых сообщений
        $countNewMsg = Message::model()->count_new_messages($_SESSION['id']);
        $this->show('index', array('users' => $usersArr, 'messages' => $messagesArr, 'NewMsg' => $countNewMsg));
    }
    
    public function sell()
    {
        if(!isset ($_SESSION['id']))
        {
            $this->redirect('/user/auth');
        }
        $this->baseView = '/protected/view/layers/profile';
        
        if(isset($_GET['to_user']) && !empty($_GET['to_user'])) 
            {   
                $sendToUser = (int)$_GET['to_user'];
                if($sendToUser == $_SESSION['id']) $this->redirect('/message/'); //что бы исключить отправление писем себе
                $user = User::model()->getByAttributes(array('id','=',$sendToUser)); 
                $read = Message::model()->read_message($_SESSION['id'], $sendToUser);
                
                $countNewMsg = Message::model()->count_new_messages($_SESSION['id']);
                $this->show('sell', array('user' => $user, 'NewMsg' => $countNewMsg));
            }
            else
            {
                $this->redirect('index');
            }
        
    }
    
    public function ajax_send_msg()
    {   
            $last_id = isset($_POST['last_id']) ? (int)$_POST['last_id'] : 0;
            $message = isset($_POST['message']) ? trim($_POST['message']) : '';
            $from = $_SESSION['id'];
            $to = $_POST['user_to'];
            $msgObj = Message::model();
            
            if(isset($to) && !empty($to))
            {
                $msgObj->show_msg_history($from, $to, $last_id);
            
                    if (!empty($message)) 
                {
                    $msgObj->add_msg($from, $to, $message);
                }
            }
    }
}