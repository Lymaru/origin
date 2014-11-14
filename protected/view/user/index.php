<!-- Новый дизайн -->
    <div id="rightPartMyPage">
        <div id="forOnline">
            <p class="nickname"><?php echo $nickname; ?></p>
            <p class="online">Online</p>
        </div>
        <div class="myPhoto">
            <img src="/<?php echo (!empty($photo)) ? $photo : "img/avatar/default.jpg"; ?>">
            <?php if($_SESSION['id'] != $id){ ?>
                <a class="sendMsgFromProfile" href='<?php echo '/message/sell?to_user=' . $id ;?>'>Send message</a>
            <?php } ?>
        </div>
        <div id="idMyData1">
            <div class="myDataName">
                <p class="nameData">Birthday:</p>
            </div>

            <div class="myData">
                <p><?php echo date("d M Y",$birthdate); ?></p>
            </div>
        </div>

        <div id="idMyData2">
            <div class="myDataName">
                <p class="nameData">City:</p>
            </div>

            <div class="myData">
                <p><?php echo $city; ?></p>
            </div>
        </div>
        <div id="idMyData3">
            <div class="myDataName">
                <p class="nameData">About me:</p>
            </div>

            <div class="LargeMyData">
                <p>&nbsp <?php echo $about; ?></p>
            </div>
        </div>
    </div>
<!-- Конец нового дизайна -->