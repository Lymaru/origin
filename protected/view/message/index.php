<div class="friendlist">
    <p><?php if(empty($users)) echo "You have no any message" ;?></p>
    <?php 
        $i = 0;
        foreach($users as $k => $v){?>
    <div class="messages">
        <div class="miniPhoto">
            <img src="/<?php echo !empty($users[$k]->mini_photo)?  $users[$k]->mini_photo:'img/avatar/default-mini.jpg';?>">
        </div>
        <div class="fromNickname">
            <a href="/user/profile/?id=<?php echo $users[$k]->id?>"><?php echo $users[$k]->nickname ;?></a>
        </div>
        <div class="lastMsg">
            <a <?php if($vars['messages'][$i]['read'] == 0) echo "class='newMsg'"?>href="/message/sell?to_user=<?php echo $users[$k]->id?>"> 
                    <?php 
                        echo $vars['messages'][$i]['message'];
                        $i++;
                    ;?>
            </a>
        </div>
    </div>
    <?php }?>
    <div class="marginFooter"></div>
</div>