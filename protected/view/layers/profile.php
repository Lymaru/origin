<!Doctype html>
<html>
    <head>
        <title>Main Page</title>
        <meta charset='utf-8'>
        <link rel="stylesheet" type="text/css" href="../../../css/style.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="http://malsup.github.com/min/jquery.form.min.js"></script>
        <script src="../../../js/custom.js"></script>
        <script src="../../../js/jquery.msg.js"></script> <!-- FOR MESSAGES -->
        <link rel="stylesheet" type="text/css" href="../../../css/datepicker_style/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="../../../css/datepicker_style/jquery-ui.structure.css">
        <link rel="stylesheet" type="text/css" href="../../../css/datepicker_style/jquery-ui.theme.css">
        <script src="../../../js/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="/css/logo_style.css" media="screen" type="text/css">
        <link rel="stylesheet" type="text/css" href="../../../css/clockpiker_style/jquery-clockpicker.css">
        <link rel="stylesheet" type="text/css" href="../../../css/clockpiker_style/bootstrap-clockpicker.css">
        <script src="../../../js/clockpicker/jquery-clockpicker.js"></script>
        <script src="../../../js/clockpicker/bootstrap-clockpicker.js"></script>
    </head>
    <body>

        <div class="container-fluid" id="wraper">
            <div class="row header">
                <section class="wrapper">
                    <a id="goHome" href="/">
                        <h1>
                            ISocial
                            <div class="orbit orbit-1"></div>
                            <div class="orbit orbit-2"></div>
                            <div class="orbit orbit-4"></div>
                            <div class="orbit orbit-5"></div>
                            <div class="orbit orbit-7"></div>
                            <div class="orbit orbit-8"></div>
                            <div class="orbit orbit-9"></div>
                            <div class="orbit orbit-10"></div>
                            <div class="orbit orbit-11"></div>
                        </h1>
                    </a>

                    <div class="logout">
                        <a href="/user/logout">LogOut</a>
                    </div>
                </section>

            </div>
        </div>
        <div id="wrapper2">
            <div id="leftPartMyPage">
                <li><a class="MyPageButtAnd" href="/user/profile">My page</a></li>
                <li><a class="MyPageButtEdit" href="/user/editProfile"></a></li>
                <li><a class="MyPageButtAnd" href="/user/friends">My friends</a></li>
                <li><a class="MyPageButtSearch" href="/user/search" onClick="search_res(1);return false;"></a></li>
                <li><a class="MyPageButtMess" href="/message/">My messages
                    <?php if(isset($vars['NewMsg']) && $vars['NewMsg'] != 0) echo "(<span>" . $vars['NewMsg'] . "</span>)" ?>
                </a></li>
                <li><a class="MyPageButtEvents" href="/event/">My events</a></li>
                <li><a class="MyPageButtGuests" href="/guests/">My guests</a></li>
            </div>
            <?php echo $content; ?>
        </div>
        <footer class = "navbar-fixed-bottom">
            <p>Awesome footer</p>
        </footer>
    </body>
</html>

