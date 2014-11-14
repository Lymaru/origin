<div class="friendlist">
    <p><?php if(empty ($subscribers)) echo "You have no subscribers" ;?></p>
    <?php if (!empty($subscribers) && isset($subscribers)) {; ?>
        <p><?php echo "Your subscribers"; ?></p>    
    <?php foreach ($subscribers as $k => $v) {; ?>
            <div class="friend">
                <div class="miniPhoto">
                    <img src="/<?php echo !empty($subscribers[$k]->mini_photo) ? $subscribers[$k]->mini_photo : 'img/avatar/default-mini.jpg'; ?>">
                </div>
                <div class="secondBlock">
                    <div class="nick">Name: <a href="/user/profile/?id=<?php echo $subscribers[$k]->id ?>"><?php echo $subscribers[$k]->nickname; ?></a></div>
                    <div class="email">E-mail: <?php echo $subscribers[$k]->email; ?></div>
                </div>    
                    <div class="addFriend">
                        <a href="<?php echo "/user/subscribers/?lateapprove=" . $subscribers[$k]->id; ?>">Add a friend</a>
                    </div>
            </div>
    <?php }} ;?>
    <div class="marginFooter"></div>
</div>
