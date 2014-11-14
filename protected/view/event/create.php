<div id = 'create_event'>
    <form enctype="multipart/form-data" method="POST" action="/event/create">
        <input type="text" placeholder='Event title' name='create[title]'/>
        <input type="text" placeholder='Event description' name='create[description]'/>
        <input type="text" placeholder='Event start date' name='create[date_start]' class="event_datepicker"/>
        <div class="input-group clockpicker">
            <input type="text" class="form-control" placeholder='Time' name='create[time_start]' id="form_control">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-time"></span>
                </span>
        </div>
        <input type="text" placeholder='Event end date' name='create[date_end]' class="event_datepicker"/>
        <div class="input">
                <input type="file" name="photo" accept="image/*,image/jpeg">
        </div>
        <input type='submit' value='Create'/>
    </form>
</div>
<script type="text/javascript">
$('.clockpicker').clockpicker({
    placement: 'bottom',
    align: 'left',
    donetext: 'Done',
    autoclose: true
});

$(".event_datepicker").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'dd-mm-yy',
      defaultDate: new Date(),
      yearRange: '2014:2016',
      autocomplete:'off'
    });
    
    $( ".event_datepicker").keydown(function() {
        return false;
    });
</script>