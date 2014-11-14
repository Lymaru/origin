$('document').ready(function(){
    
    $("#datepicker").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd',
      defaultDate: '1980-01-01',
      yearRange: '1940:2014'
    });
    
    $('.ajax-menu').click(function(){
        var action = $(this).attr('data');
        $.post('/event/'+action, function(data){
            $('.event-ajax-page').html(data);
        });
        
    });
    
    /*$(".clockpicker").clockpicker({
    placement: 'bottom',
    align: 'left',
    donetext: 'Done'
    });*/
    
});


function showMenu(source){
    var menuClass = 'menu';
    if(!$("."+menuClass).hasClass(menuClass)){
        $('body').append('<div class="'+menuClass+'">');
        $("."+menuClass).append('<ul>');
        for(var li in source){
            $('<li>').appendTo($("."+menuClass+" ul"));
            $("."+menuClass+" ul").children().last().append("<a>");
            $("."+menuClass+" ul li a").last().text(source[li].value);
        }
        $('.menu').click(function(){
            $("."+menuClass).fadeOut();
        });
    }
    $("."+menuClass).fadeToggle();
    setTimeout( function(){
        $("."+menuClass).fadeOut()
    }, 7000);
}

var menu = [
    {value:'Главная', href:''},
    {value:'Сообщения', href:''}
];

/* This is chat for sell.php*/
    $(function(){
    var chat = $('#chat')[0];
    var form = $('#chat-form')[0];

    $('#chat-form').submit(function(event){
        var message = $(form).find('textarea[type="text"]');
        $(form).find('input').attr("disabled", true);
        update(message);
        return false;
    });
    
    function update(message) {
        var send_data = { last_id: $(chat).attr('data-last-id'), user_to: $('#toUserId').val()};
        if (message)
            send_data.message = $(message).val();
        $.post(
            'ajax_send_msg',
            send_data,
        function (data) {
                if (data && $.isArray(data)) {
                    $(data).each(function (k) {
                        var msg = $('<div class="msg">' + data[k].nickname + ': ' + data[k].message + '</div>');
                        $(chat).append(msg);
                        if (parseInt($(chat).attr('data-last-id')) < data[k].id)
                            $(chat).attr('data-last-id', data[k].id);
                    });
                    
                    if (message) {
                        $(form).find('input').attr("disabled", false);
                        $(message).val('');
                    }

                    $(chat).scrollTop(chat.scrollHeight);
                    update_timer();
                }
            },
            'JSON'
        );
    }

    update();

    var timer;
    function update_timer() {
        if (timer)
            clearTimeout(timer);
        timer = setTimeout(function () {
            update();
        }, 2500);
    }
    update_timer();
});

/* New Search */

function getXmlHttp() {
    var xmlhttp;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

function clear() {
    var main_global_search = document.getElementById("main_global_search");
    if (main_global_search !== null) {
        main_global_search.parentNode.removeChild(main_global_search);
    }       
}

function search_res(trigger) {
    clear();
    var form_smain = document.getElementById("form_smain")
    var newdiv = document.createElement("div");
    newdiv.setAttribute('id', 'main_global_search');
    form_smain.appendChild(newdiv);
    
    var xmlhttp = getXmlHttp(); 
    xmlhttp.open('POST', '/search/search', true);
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); 
    var s = document.getElementById("search").value;
    if (trigger === 1) {
        s ='';
    }
    xmlhttp.send("search=" + encodeURIComponent(s)); 
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4) { 
            if (xmlhttp.status == 200) {
                var xmlResponse = xmlhttp.responseText;
                var data = eval("(" + xmlResponse + ")");
                if (data.search_result == null || data.search_result == '' ) {
                    info=data.search_result_def;
                    newdiv.innerHTML = info;
                } else { 
                    var requests = data.requests;
                    var requests_l = requests.length;
                    var show_friends=data.show_friends;
                    var show_friends_len = show_friends.length;
                    var res = data.search_result;
                    var res_len = res.length;
                    for (var x=0; x < res_len; x++) {

                        info_img='';
                        info_tb2=''; 
                        info_tb3 ='';

                        var newdiv_1 = document.createElement("div");
                        newdiv_1.setAttribute('class', 'search_result_style');
                        newdiv.appendChild(newdiv_1);
                        var newdiv_img = document.createElement("div");
                        newdiv_img.setAttribute('id', 'text_inbox1');
                        newdiv_img.setAttribute('class', 'miniPhoto');
                        newdiv_1.appendChild(newdiv_img);
                        if (res[x].mini_photo == 0 || res[x].mini_photo === null){
                            info_img+=('<img src="/img/avatar/default-mini.jpg">');
                        } else {
                            info_img+=('<img src="/' + res[x].mini_photo + '">');    
                        }
                        newdiv_img.innerHTML = info_img;

                        var newdiv_2 = document.createElement("div");
                        newdiv_2.setAttribute('id', 'text_inbox2');newdiv_1.appendChild(newdiv_2);
                        info_tb2+=("<p class = 'nick'> Nickname: " + "<a href='/user/profile/?id=" + res[x].id + "'>" + res[x].nickname + "</a></p>");
                        info_tb2+=("<p>E-mail: " + res[x].email + "</p>");
                        newdiv_2.innerHTML = info_tb2;

                        var newdiv_3 = document.createElement("div");
                        newdiv_3.setAttribute('id', 'text_inbox3');
                        newdiv_1.appendChild(newdiv_3);
                        info_tb3=("<a href='/user/search/?add=" + res[x].id + "'>Add a friend</a>");
                        for (var y=0; y < show_friends_len; y++) {
                            if (show_friends[y].id === res[x].id) {
                                newdiv_3.setAttribute('id', 'remove_from_search');
                                info_tb3=("<a href='/user/friends/?removefriend=" + res[x].id + "'>Remove friend</a>");
                            }
                        }
                        for (var z=0; z < requests_l; z++) {
                            if (requests[z].id === res[x].id) {
                                info_tb3=("<p id='approval'>On approval</p>");
                            }
                        }
                        newdiv_3.innerHTML = info_tb3;

                        var newdiv_4 = document.createElement("div");
                        newdiv_4.setAttribute('class', 'horLine');
                        newdiv.appendChild(newdiv_4);
                    }
                }     
            }
        }
    }    
}
