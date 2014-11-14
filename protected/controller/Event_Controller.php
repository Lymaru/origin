<?php

class Event_Controller extends BaseController{
    public $baseViewPath = '/protected/view/event/';
    public $baseView = '/protected/view/layers/profile';
    
    public function index(){
        if(isset($_SESSION['id'])){
            $events = Event::model()->getAll();
            //Подсчет количества новых сообщений
            $countNewMsg = Message::model()->count_new_messages($_SESSION['id']);
            
            $my_events = array();
            $my_events_accepted = My_Events::model()->getAllByAttributes(array('user_id','=',$_SESSION['id']));
            foreach($my_events_accepted as $i)
            {
                $event = Event::model()->getByAttributes(array('id','=',(int)$i->event_id));
                array_push($my_events, $event);
            }
            
            $this->show('index', array('events'=>$events, 'NewMsg' => $countNewMsg, 'my_events'=>$my_events));
            
            if(isset($_GET['accept']) && !empty($_GET['accept']))
            {
             /*   $this->redirect('/event');*/ /* Обновление страницы*/
                Requests::model()->acceptInvitation();    
            }
            
        }else{
            $this->redirect ('/user/auth');
        }
    }
    
    public function page(){
        if(isset($_GET['event_id'])){
            $event = Event::model()->getByAttributes(array('id', '=', $_GET['event_id'])); 
            if($event != false){
                $this->show('page',array('event'=>$event));
            }else{
                $this->redirect('/event');
            }
        }
        else{
            $this->redirect('/event');
        }
    }
    
    public function create()
    {
        if(isset($_POST['create']))
        {
            $post = $_POST['create'];
            $event = Event::model();
            $event->creator_id = $_SESSION['id'];
            $event->title = $post['title'];
            $event->description = $post['description'];
            
            if (!empty($_FILES['photo']) && preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)|(gif)|(GIF)|(png)|(PNG)$/', $_FILES['photo']['name']))
            {
                $filename = $_FILES['photo']['name'];
                $source = $_FILES['photo']['tmp_name'];

                $target = PictureResizer::ORIGIN_PATH_DIR_EVENT . $filename;
                move_uploaded_file($source, $target);

                $resizeObj = new PictureResizer(PictureResizer::ORIGIN_PATH_DIR_EVENT . $filename);
                // (options: exact, portrait, landscape, auto, crop)
                $resizeObj->resizeImage(200, 1, 'landscape');
                $newName = time();
                $resizeObj->saveImage(PictureResizer::RESIZED_PATH_DIR_EVENT . $newName . ".jpg", 100);
                
                $resizedPhotoPath = PictureResizer::RESIZED_PATH_DIR_EVENT . $newName . ".jpg";
                $event->photo = $resizedPhotoPath;
                
                $resizeObj->resizeImage(1, 100, 'portrait');
                $resizeObj->saveImage(PictureResizer::MINI_PATH_DIR_EVENT . $newName . ".jpg", 100);
                
                $resizedMiniPhotoPath = PictureResizer::MINI_PATH_DIR_EVENT . $newName . ".jpg";
                $event->mini_photo = $resizedMiniPhotoPath;
            }
            
            $event->date_start = strtotime($post['date_start']);
            $event->date_end = strtotime($post['date_end']);
            $event->time_start = strtotime($post['time_start']);
            $event->save();
            $this->redirect('/event');
            
        }
        $this->showPart('create');
    }
    
    public function myEvents()
    {
        $my_events = array();
        $my_events_accepted = My_Events::model()->getAllByAttributes(array('user_id','=',$_SESSION['id']));
        foreach($my_events_accepted as $i)
        {
            $event = Event::model()->getByAttributes(array('id','=',(int)$i->event_id));
            array_push($my_events, $event);
        }
            
        $this->showPart('myevents', array('my_events'=>$my_events));
    }
    
    
}

