<div id="subscribersLink">
    <a href="/user/subscribers">My subscribers</a>
</div>

<div class="friendlist">
      
        <?php if(!empty($requests) && isset($requests)){ ;?>
        <p><?php echo "Want to be friends" ;?></p>    
           <?php foreach($requests as $k => $v){ ;?>
        <div class="friend">
            <div class="miniPhoto">
                <img src="/<?php echo !empty($requests[$k]->mini_photo)?  $requests[$k]->mini_photo:'img/avatar/default-mini.jpg' ;?>">
            </div>
            <div class="secondBlock">
                <div class="nick">Name: <a href="/user/profile/?id=<?php echo $requests[$k]->id?>"><?php echo $requests[$k]->nickname ;?></a></div>
                <div class="email">E-mail: <?php echo $requests[$k]->email ;?></div>
            </div>    
                <div class="addFriend"><a href="/user/friends/?approve=<?php echo $requests[$k]->id?>">Approve</a></div>
                <div class="removeFriend"><a href="/user/friends/?subscription=<?php echo $requests[$k]->id?>">In subscribers</a></div>
            </div>

        <?php }}?>
        <div class="horLine"></div>
    
    <p>Friends</p>
    <?php foreach($users as $k => $v){?>

    <div class="friend">
        <div class="miniPhoto">
            <img src="/<?php echo !empty($users[$k]->mini_photo)?  $users[$k]->mini_photo:'img/avatar/default-mini.jpg';?>">
        </div>
        <div class="secondBlock">
            <div class="nick">Name: <a href="/user/profile/?id=<?php echo $users[$k]->id?>"><?php echo $users[$k]->nickname ;?></a></div>
            <div class="email">E-mail: <?php echo $users[$k]->email ;?></div>
        </div>    
        <div class="removeFriend">
            <a href="/user/friends/?removefriend=<?php echo $users[$k]->id?>">Remove friend</a>
        </div>  
    </div>
    <?php }?>
    <div class="marginFooter"></div>
</div>

