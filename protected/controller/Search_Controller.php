<?php

class Search_Controller extends BaseController
{
    public $baseViewPath = '/protected/view/user/';
    
    public function search()
    {
        
        if(!isset($_SESSION['id']) || empty($_SESSION['id']))
        {
            $this->redirect('/user/auth');
        }

        $this->baseView = '/protected/view/layers/profile';
        $user = User::model()->getByAttributes(array('id','=',$_SESSION['id']));
        
        if(isset($_POST['search']) && !empty($_POST['search']))
        { 
            $data=$_POST['search'];
            $data = substr($data, 0, 25);//выделяет из строки искомое слово
            $data = trim($data); //удаляет пробелы из начала и конца строки
            $search_data = preg_replace('/[^a-zа-яё0-9]+/iu', '', $data);// убирает из запроса символы
	     
            if (mb_strlen($search_data,'utf-8')<3){
		$search_result_def = 'Слово для поиска должно быть больше двух букв.';
                echo json_encode(array('search_result_def' => $search_result_def));
            } 
            else
            {		
                $search_result = User::model()->getAllByAttributes(array('nickname LIKE "%'.$search_data.'%"','', ''));
                $search_result_def = 'По вашему запросу ничего не найдено.';
                
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
                
                echo json_encode(array('search_result' => $search_result, 'search_result_def' => $search_result_def, 'show_friends'=>$show_friends, 'requests'=> $requests));
            }
        }
        else
        {
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
            
            $users = User::model()->getAll();
            $search_result_def = '';
            
            echo json_encode(array('search_result_def' => $search_result_def, 'search_result'=>$users,'show_friends'=>$show_friends, 'requests'=> $requests));
        }
        
        if(isset($_GET['add']) && !empty($_GET['add']))
        {
            Requests::model()->addRequestFriend();
        }
    }
}