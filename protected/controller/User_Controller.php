<?php

class User_Controller extends BaseController
{
    public $baseViewPath = '/protected/view/user/';
    
    public function index()
    {
        if(isset($_SESSION['username']))
        {
            $this->redirect('/user/profile');
        }
        else
        {
        $this->show('auth');
        }
    }
    
    public function error()
    {
        $this->show('error');
    }
    
    public function register()
    {
        if(isset($_POST['registerForm']))
        {
            $user = User::model();
            $user->nickname = $_POST['registerForm']['username'];
            $user->email = $_POST['registerForm']['email'];
            $user->birthdate = strtotime($_POST['registerForm']['date']);
            $user->password = $_POST['registerForm']['password'];
            $user->regdate = $_POST['registerForm']['regdate'];
            
            if($user->save())
            {
                $this->show('auth');
            }
            else
            {
                echo 'Bad news for you...We can not register you=(';
            }
        }
        else
        {
            $this->show('register');
        }
    }
    
    public function auth()
    {
        if(isset($_POST['auth']) && !empty($_POST['auth']['username']) && !empty($_POST['auth']['password']))
        {
            $user = User::model()->getByAttributes(array('nickname','=', $_POST['auth']['username']),array('password','=',$_POST['auth']['password']));

            if(!empty($user) && $user->nickname === $_POST['auth']['username'] && $user->password === $_POST['auth']['password'])
            {
                    $_SESSION['username'] = $_POST['auth']['username'];
                    $_SESSION['id'] = $user->id;
                    $this->redirect("/user/index");
            }
            else 
            {
                $this->refresh('/user/auth', 2);
                echo "Your login or password isn't valid. Please try again...";
            }
        }
        else
        {
            $this->show('auth');
        }
    }
    
    public function logout()
    {
        unset($_SESSION['username']);
        unset($_SESSION['id']);
        session_destroy();
        $this->redirect('auth');
    }
    
    public function profile()
    {
        $this->baseView = '/protected/view/layers/profile';

        if(!isset($_SESSION['id']) || empty($_SESSION['id']))
        {
            $this->redirect('/user/auth');
        }
        else 
        {
            $user = User::model()->getAllByAttributes(array('id','=',$_SESSION['id']))[0];
            //Подсчет количества новых сообщений (будет повторяться по всему контроллеру)
            $countNewMsg = Message::model()->count_new_messages($_SESSION['id']);
            
            if (!isset($_GET['id']))
            {
                $this->show('index', array('user'=>$user, 'NewMsg' => $countNewMsg));
            }
            else
            {
                $user = User::model()->getByAttributes(array('id','=',$_GET['id']));
                $this->show('index', array('user'=>$user, 'NewMsg' => $countNewMsg)); 
            }
        }
        
        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            $guest = Guests::model();
            $guest->guest_id = $_SESSION['id'];
            $guest->user_id = $_GET['id'];
            $guest->date = date("j");
            $guest->save();
            Guests::model()->updateGuest($_GET['id'], $_SESSION['id']);
                
        }
        
        $remove_guests = Guests::model();
        $oldtime = strtotime("-1 day");
        $olddate = date('j', $oldtime);
        $remove_guests->deleteByAttributes(array('date', '=', $olddate));
        
        if ((int)date("j") === 1) 
        {
            $del_review_guest = Guests::model();
            $del_review_guest->deleteReviewGuest();
        }
    }
              
    public function editProfile()
    {
        $this->baseView = '/protected/view/layers/profile';

        if (!isset($_SESSION['id']) || empty($_SESSION['id'])) 
        {
            $this->redirect('/user/auth');
        }

        $user = User::model()->getByAttributes(array('id','=', $_SESSION['id']));

        if (!empty($_POST))
        {
            if (!empty($_FILES['photo']) && preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)|(gif)|(GIF)|(png)|(PNG)$/', $_FILES['photo']['name']))
            {
                $filename = $_FILES['photo']['name'];
                $source = $_FILES['photo']['tmp_name'];

                $target = PictureResizer::ORIGIN_PATH_DIR . $filename;
                move_uploaded_file($source, $target);

                // *** 1) Initialize / load image
                $resizeObj = new PictureResizer(PictureResizer::ORIGIN_PATH_DIR . $filename);
                // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
                $resizeObj->resizeImage(200, 1, 'landscape');
                // *** 3) Save image
                $newName = $user->id;
                $resizeObj->saveImage(PictureResizer::RESIZED_PATH_DIR . $newName . ".jpg", 100);
                
                $resizedPhotoPath = PictureResizer::RESIZED_PATH_DIR . $newName . ".jpg";
                $user->photo = $resizedPhotoPath;
                
                //create mini-photo
                $resizeObj->resizeImage(1, 100, 'portrait');
                // *** 3) Save image
                $resizeObj->saveImage(PictureResizer::MINI_PATH_DIR . $newName . ".jpg", 100);
                //end of create photo mini
                
                $resizedMiniPhotoPath = PictureResizer::MINI_PATH_DIR . $newName . ".jpg";
                $user->mini_photo = $resizedMiniPhotoPath;
            }

            if (isset($_POST['birth_date']))
            {
                $user->birthdate = strtotime(($_POST['birth_date']));
            }

            $user->country = $_POST['country'];
            $user->city = $_POST['city'];
            $user->about = $_POST['about'];
            $user->save();
            header('Refresh');
        }
            $countNewMsg = Message::model()->count_new_messages($_SESSION['id']);
            $this->show('editProfile', array('user'=>$user, 'NewMsg' => $countNewMsg));
    }

    public function search()
    {
        if(!isset($_SESSION['id']) || empty($_SESSION['id']))
        {
            $this->redirect('/user/auth');
        }

        $this->baseView = '/protected/view/layers/profile';
        $user = User::model()->getByAttributes(array('id','=',$_SESSION['id']));
        
        if(isset($_POST['search']))
        { 
            $data=$_POST['search'];
            $data = substr($data, 0, 25);//выделяет из строки искомое слово
            $data = trim($data); //удаляет пробелы из начала и конца строки
            $search_data = preg_replace('/[^a-zа-яё0-9]+/iu', '', $data);// убирает из запроса символы
	       
            if (mb_strlen($search_data,'utf-8')<3)
            {
		$search_result_def = 'Слово для поиска должно быть больше двух букв.';
                $this->show('search', array('search_result_def' => $search_result_def));
            } 
            else
            {
                $search_result = User::model()->getAllByAttributes(array('nickname','=', $search_data));
                $search_result_def = 'По вашему запросу ничего не найдено.';
                $this->show('search', array('search_result' => $search_result, 'search_result_def' => $search_result_def));
            }
        }
        else
        {
            $users = User::model()->getAll();
            $search_result_def = '';
            $users1 = array();
            
            $countNewMsg = Message::model()->count_new_messages($_SESSION['id']);          
            $this->show('search', array('search_result_def' => $search_result_def, 'search_result'=>$users, 'NewMsg' => $countNewMsg));
        }
        
        if(isset($_GET['add']) && !empty($_GET['add']))
        {
            Requests::model()->addRequestFriend();
        }
    }
    
    
    public function friends()
    {
        if(!isset($_SESSION['id']) || empty($_SESSION['id']))
        {
            $this->redirect('/user/auth');
        }

        $this->baseView = '/protected/view/layers/profile';
        // Делаем вывод всех запросов на подтверждение друга
        $requests = array();

        $friendsRequests = Requests::model()->getAllByAttributes(array('user2','=',$_SESSION['id']));
        foreach($friendsRequests as $friend)
        {
           $request = User::model()->getByAttributes(array('id','=',(int)$friend->user1));
           array_push($requests, $request);
        }
        
        // Делаем вывод всех друзей
        $users = array();
        
        $friends = Friends::model()->getAllByAttributes(array('userid','=',$_SESSION['id']));
        foreach($friends as $friend)
        {
           $user = User::model()->getByAttributes(array('id','=',(int)$friend->friendid));
           array_push($users, $user);
        }
    
        if(isset($_GET['approve']) && !empty($_GET['approve']))
        {
            $this->redirect('/user/friends');
            Requests::model()->approveRequest();
        }
        
        if(isset($_GET['subscription']) && !empty($_GET['subscription']))
        {
            $this->redirect('/user/friends');
            Subscribers::model()->inSubscribers();
        }
        
        if(isset($_GET['removefriend']) && !empty($_GET['removefriend']))
        {
            $this->redirect('/user/friends');
            Friends::model()->removeFriend();
        }
        
        $countNewMsg = Message::model()->count_new_messages($_SESSION['id']);
        $this->show('friends', array('users'=>$users, 'requests'=>$requests, 'NewMsg' => $countNewMsg));
    }

    public function subscribers()
    {
        if(!isset($_SESSION['id']) || empty($_SESSION['id']))
        {
            $this->redirect('/user/auth');
        }
        
        $this->baseView = '/protected/view/layers/profile';
        $subscribers = array();
        $friends = Subscribers::model()->getAllByAttributes(array('the_followed','=',$_SESSION['id']));
        
        foreach($friends as $mySubscribers)
        {
           $user = User::model()->getByAttributes(array('id','=',(int)$mySubscribers->subscriber));
           array_push($subscribers, $user);
        }
             
        if(isset($_GET['lateapprove']) && !empty($_GET['lateapprove']))
        {
            $this->redirect('/user/subscribers');
            Friends::model()->lateApprove();
        }
        
        $countNewMsg = Message::model()->count_new_messages($_SESSION['id']);
        $this->show('subscribers', array('subscribers'=>$subscribers, 'NewMsg' => $countNewMsg));
    }
}

