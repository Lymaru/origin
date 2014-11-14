<div class="eventview">
    <?php if (empty($my_events)) {
        echo "You have no events";
    } else {
        foreach($my_events as $k => $v){ ?>
            <div class = "search_result_style">
                <div id='text_inbox1' class='miniPhoto'>
                    <img src="/<?php echo !empty($my_events[$k]->photo)?  $my_events[$k]->photo:'img/events/event_def_image.jpg';?>">
                </div>
                <div id='text_inbox2'>
                    <p class="nick">
                        <a href="<?php echo '/event/page/?event_id='.$my_events[$k]->id;?>"><?php echo $my_events[$k]->title; ?></a>
                    </p>
                    <p>Date: <?php echo date('d-M-Y', $my_events[$k]->date_start);?></p> 
                    <p>Time: <?php echo date('H-i', $my_events[$k]->time_start);?></p>    
                </div>
                <div id='text_inbox3'>
                     
                </div>
                
            </div>
        <div class='horLine'></div>
    <?php } } ?>
    <div class="marginFooter"></div>
</div>
