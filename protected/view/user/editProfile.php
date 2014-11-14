    <div id="rightPartMyPage">
        <p class="nickname"><?php echo $nickname; ?></p>
    <img class="editImg" src="/<?php echo (!empty($photo)) ? $photo : "img/avatar/default.jpg" ;?>">
    
    <form enctype="multipart/form-data" id="editMyPage" method="post">	
        <div class="input">
                <input type="file" name="photo" accept="image/*,image/jpeg">
        </div>
		
            <p><label>День рожения:</label></p>
            <div class="input">	
                <input type="text" name="birth_date" placeholder="Date of birth" id="datepicker" class="event_datepicker" 
                       value = "<?php echo date('Y-m-d', $birthdate)?>"><br/>
            </div>	
            <div class="input">	
                    <label>Country:</label><input type="text" name="country" value="<?php echo $country; ?>">
            </div>

            <div class="input">	
                    <label>City:</label><input type="text" name="city" value="<?php echo $city; ?>">
            </div>

            <p>About me:<br>
                <textarea class="aboutTextArea" name="about" maxlength="175"><?php echo $about; ?></textarea>
            </p>

            <input id="saveButton" name="saveButton" type="submit" value="Save">	
    </form>
    </div>


















