<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../../../js/custom.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

  
<div id="form_smain">
    <form role="form" method="post" action='/user/search' id="search_form"> 
        <div id="form_s"> 
	    <input name="search" type="text" placeholder="Search..." size=25 max=25 class="search_main_inp" id="search">
            <input name="start_search" type="submit" value="Start search" class="search_main_butt" 
                   onClick="search_res(2);return false;">
             <input name="start_search_all" type="submit" value="Show all users" class="search_main_butt" 
                    id="search_all" onClick="search_res(1);return false;">
        </div>
    </form>
</div>
<div class="marginFooter"></div>