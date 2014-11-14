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
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="../../../js/custom.js"></script>
        <script src="../../../js/jquery.msg.js"></script> <!-- FOR MESSAGES -->
        <link rel="stylesheet" type="text/css" href="../../../css/datepicker_style/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="../../../css/datepicker_style/jquery-ui.structure.css">
        <link rel="stylesheet" type="text/css" href="../../../css/datepicker_style/jquery-ui.theme.css">
        <script src="../../../js/jquery-ui.min.js"></script>
        <script src="../../../js/jquery.validate.js"></script>
        <script src="../../../js/additional-methods.js"></script>
        <script src="../../../js/validation.js"></script>
        
        <link rel="stylesheet" href="/css/logo_style.css" media="screen" type="text/css">
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
                </section>
            </div>
            <div class="row-fluid" id = 'wprapper2'>
                <?php echo $content; ?>
            </div>
            
        </div>
        <footer class = "navbar-fixed-bottom">
                <p>Awesome footer</p>
        </footer>
    </body>
</html>
<script type="text/javascript">
    Validation.init();
</script>


