    <section id = 'content'>
            <h2>Register, please:</h2>
            <form id="userInfoReg" action='/user/register' method="POST">
                <input type="text" name="registerForm[username]" placeholder="Username"><br/>
                    <input type="email" name="registerForm[email]" placeholder="E-mail"><br/>

                    <input type="text" name="registerForm[date]" placeholder="Date of birth" id="datepicker" class="event_datepicker"><br/>
                    <input type="password" name="registerForm[password]" placeholder="Password"><br/>
                    <input type="password" name="registerForm[retypepassword]" placeholder="Retype password"><br/>
                    <input type="hidden" name="registerForm[regdate]" value="<?php echo time(); ?>">
					<input id = "sendBtn" type="submit" name="send" value="Create Account"><br/>		
            </form>
            <a class="pagelink" href="/user/auth">Main Page</a>
    </section>

