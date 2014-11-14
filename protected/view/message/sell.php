<div id="forChat">
    <div id="msgSendToUsername">
        <p id="userNameAndId"><?php if (isset($vars['user']->nickname)) echo "Send to: " . $vars['user']->nickname ;?></p>
    </div>
 
    <div id="chat" data-last-id="0"></div>
    <form id="chat-form">
        <input id="toUserId" type="hidden" name="login" value="<?php if(isset ($vars['user']->id)) echo $vars['user']->id ;?>">
        <textarea id="chat-msg" type="text" name="message" placeholder="Message"></textarea>
        <input id="sendMessBtn" type="submit" value="Отправить">
    </form>
</div>