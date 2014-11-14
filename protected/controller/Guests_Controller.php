<?php

class Guests_Controller extends BaseController
{
    public $baseViewPath = '/protected/view/guests/';
    
     public function index() 
    {        
         if(!isset($_SESSION['id']) || empty($_SESSION['id']))
        {
            $this->redirect('/user/auth');
        }
        
        $this->baseView = '/protected/view/layers/profile';
        
        $user = User::model()->getByAttributes(array('id','=',$_SESSION['id']));
        
        $show_friends = array();
        $friends = Friends::model()->getAllByAttributes(array('userid','=',$_SESSION['id']));
        foreach($friends as $friend)
        {
           $fr = User::model()->getByAttributes(array('id','=',(int)$friend->friendid));
           array_push($show_friends, $fr);
        }
                
        $requests = array();
        $friendsRequests = Requests::model()->getAllByAttributes(array('user1','=',$_SESSION['id']));
        foreach($friendsRequests as $friend)
        {
            $request = User::model()->getByAttributes(array('id','=',(int)$friend->user2));
            array_push($requests, $request);
        }
        
        $guests = array();
        $guests_statuses=array();
        $userReview = guests::model()->getAllByAttributes(array('user_id','=',$_SESSION['id']));
        foreach($userReview as $u)
        {
            $guest = User::model()->getByAttributes(array('id','=',(int)$u->guest_id));
            array_push($guests, $guest);
          Switch ($u->review_qty)
            {
            case ($u->review_qty >= 0 && $u->review_qty <= 6):
                $guest_status = 'Accidental guest';
                break;
            
            case ($u->review_qty > 6 && $u->review_qty <= 12):
                $guest_status = 'Ordinary guest';
                break;
            
            case ($u->review_qty > 12 && $u->review_qty <= 18):
                $guest_status = 'Interested guest';
                break;
            
            case ($u->review_qty >18 && $u->review_qty <= 24):
                $guest_status = 'Stalker';
                break;
            
            case ($u->review_qty >24):
                $guest_status = 'Maniac';
                break;
             }
           array_push($guests_statuses, $guest_status);
        }
        //Подсчет количества новых сообщений
        $countNewMsg = Message::model()->count_new_messages($_SESSION['id']);
        
        $this->show('guests', array('guests' => $guests, 'show_friends' => $show_friends, 
            'requests' => $requests, 'user' => $user, 'guests_statuses'=>$guests_statuses, 'NewMsg' => $countNewMsg));
    }
}