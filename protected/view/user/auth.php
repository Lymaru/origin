<section id = 'content'>
        
            <h2>Input your credentials, please:</h2>
            <form id="userInfo" action="/user/auth" method="POST">
                <input type="text" name="auth[username]" placeholder=" Username" required><br/>
                <input type="password" name="auth[password]" placeholder=" Password" required><br/>
                <input id = "sendBtn" type="submit" name="send" value="Sign In"><br/>		
            </form>
            <a class="reglink" href="/user/register">New account</a>
</section>

