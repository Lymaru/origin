<div class="eventview">
    <nav>
        <a class = "ajax-menu" data="myevents">My Events</a>
        <a class = "ajax-menu" data="create">Create Event</a>
    </nav>
    <section class = 'event-ajax-page' style="width:400px; margin-left:260px;">
        <?php if (empty($events)) {
            echo "No events";
            } else {
            foreach($events as $event){ ?>
            <div class = "search_result_style">
                <div id='text_inbox1' class='miniPhoto'>
                    <img src="/<?php echo !empty($event->photo)?  $event->photo:'img/events/event_def_image.jpg';?>">
                </div>
                <div id='text_inbox2'>
                    <p class="nick">
                        <a href="<?php echo '/event/page/?event_id='.$event->id;?>"><?php echo $event->title; ?></a>
                    </p>
                    <p>Date: <?php echo date('d-M-Y', $event->date_start);?></p> 
                    <p>Time: <?php echo date('H-i', $event->time_start);?></p>    
                </div>
                <div id='text_inbox3'>
                     <?php 
                        $i=0;
                        foreach ($my_events as $k1 => $v1)  {
                            if ($my_events[$k1]->id === $event->id ){ 
                                $i=1;
                            }      
                        }
                        if ($i!==1) { ?>
                            <a href="<?php echo '/event/?accept='.$event->id;?> ">I'm going!</a>
                        <?php }  ?>    
                </div>
            </div>
        <div class='horLine'></div>
        <?php }} ?>
    </section>
    <div class="marginFooter"></div>
</div>


