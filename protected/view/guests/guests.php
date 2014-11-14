<div id="rightPartMyPage_guests">
<div id="forOnline">
   <p id="guests_header"> Guests for the day:</p>    
</div>
<div id="main_global_search">
        <?php 
        foreach($guests as $k => $v){?>
            <div class="search_result_style">
                <div class="miniPhoto" id="text_inbox1">
                    <img src="/<?php echo !empty($guests[$k]->mini_photo)?  $guests[$k]->mini_photo:'img/avatar/default-mini.jpg';?>">
                </div>
                <div class="nick" id="text_inbox2">
                    <a href="/user/profile/?id=<?php echo $guests[$k]->id?>"><?php echo $guests[$k]->nickname ;?> </a><p id="guest_status"><?php echo $guests_statuses[$k];?></p>
                </div>
                <?php 
                $i=0;   
                foreach($show_friends as $k1 => $v1) {
                    if ($show_friends[$k1]->id === $guests[$k]->id ){
                        $i=1; ?>
                        <div id="remove_from_search"> 
                            <a href="/user/friends/?removefriend=<?php echo $guests[$k]->id?>">Remove friend</a> 
                        </div>
                    <?php }
                } 
                foreach($requests as $k2 => $v2) {
                    if ($requests[$k2]->id === $guests[$k]->id ){
                        $i=1;?>
                        <div id="text_inbox3">
                            <p id='approval'>On approval</p>
                        </div>
                    <?php }
                } 
                if ($i!==1) { ?>
                    <div id="text_inbox3">
                        <a href="/user/search/?add=<?php echo $guests[$k]->id?>">Add friend</a>
                    </div>
                <?php } ?>    
                </div>
                <div class="horLine"></div>
        <?php }?>
</div>
</div>
<div class="marginFooter"></div>