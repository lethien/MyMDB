<?php

class Page {
    // Title property
    public static $title = "Set your title!";

    public static function header() {
        ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>

                <!-- Basic Page Needs
                –––––––––––––––––––––––––––––––––––––––––––––––––– -->
                <meta charset="utf-8">
                <title><?php echo self::$title; ?></title>
                <meta name="description" content="">
                <meta name="author" content="">

                <!-- Mobile Specific Metas
                –––––––––––––––––––––––––––––––––––––––––––––––––– -->
                <meta name="viewport" content="width=device-width, initial-scale=1">

                <!-- FONT
                –––––––––––––––––––––––––––––––––––––––––––––––––– -->
                <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

                <!-- CSS
                –––––––––––––––––––––––––––––––––––––––––––––––––– -->
                <link rel="stylesheet" href="css/normalize.css">
                <link rel="stylesheet" href="css/skeleton.css">

                <!-- Favicon
                –––––––––––––––––––––––––––––––––––––––––––––––––– -->
                <link rel="icon" type="image/png" href="images/favicon.png">

            </head>
            <body>
                <!-- No Script Warning
                –––––––––––––––––––––––––––––––––––––––––––––––––– -->
                <noscript>Your browser does not support JavaScript! Some features may not work properly!</noscript>

                <!-- Primary Page Layout
                –––––––––––––––––––––––––––––––––––––––––––––––––– -->
                <div class="container">                                                    
        <?php
    }

    public static function page_head($isLoggedin = false) {
        ?>
            <div class="row">
                <div class="one-half column" style="margin-top: 50px">  
                    <a href="<?php echo HOME_PAGE;?>" style="color: black;text-decoration: none;">                                      
                        <h3><img src="images/pageicon.png" 
                                    style="vertical-align: middle;height: 75px;margin-right: 10px;" />
                            My Movie DataBase
                        </h3>
                    </a>
                </div>
                <div class="one-half column" style="margin-top: 50px">                                        
                    <?php
                        if($isLoggedin) {
                            ?>
                                <p style="text-align: right;margin: 0;padding: 20px 0;">
                                    Welcome <a href="UserDetail.php"><?php echo LoginManager::getLoggedinUser()->getUserName(); ?></a>
                                    /
                                    <a href="Logout.php">Logout</a>
                                </p>                                
                            <?php
                        }
                    ?>
                </div>
            </div>
        <?php
    }

    public static function footer() {
        ?>
                </div>

                <script>
                    // Util method for delete and edit links in table
                    function setActionAndCustIdForTable(action, custId) {
                        document.getElementById("table_action").value = action;
                        document.getElementById("table_cust_id").value = custId;
                    }
                </script>
                <!-- End Document
                –––––––––––––––––––––––––––––––––––––––––––––––––– -->
            </body>
            </html>
        <?php
    }

    public static function authenticateForm($validateMessages) {
        echo '<div class="row">';
        self::loginform($validateMessages);
        echo '<div class="two columns"><p></p></div>';
        self::registerForm($validateMessages);
        echo '</div>';
    }

    public static function loginform($validateMessages) {        
        ?>
            <div class="five columns">
                <h4>Already a user? Login</h4>
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                    <input type="hidden" name="action" value="login" >                   
                    <?php
                        self::renderFormInputField("username", "User Name", 
                            isset($_POST['username']) ? $_POST['username'] : "", 
                            isset($validateMessages['username']) ? $validateMessages['username'] : "");                        
                        self::renderFormInputField("password", "Password", 
                            "", 
                            isset($validateMessages['password']) ? $validateMessages['password'] : "", "password");                        
                    ?>                                                 
                    <input class="button-primary u-pull-right" type="submit" value="Login">
                </form>
            </div>
        <?php
    }

    public static function registerForm($validateMessages) {  
        ?>
            <div class="five columns">
                <h4>New to MyMDB? Register</h4>
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                    <input type="hidden" name="action" value="register" >                    
                    <?php
                        self::renderFormInputField("newusername", "User Name", 
                            isset($_POST['newusername']) ? $_POST['newusername'] : "",
                            isset($validateMessages['newusername']) ? $validateMessages['newusername'] : "");
                        self::renderFormInputField("newemail", "Email", 
                            isset($_POST['newemail']) ? $_POST['newemail'] : "", 
                            isset($validateMessages['newemail']) ? $validateMessages['newemail'] : "");
                        self::renderFormInputField("newpassword", "Password", 
                            "", 
                            isset($validateMessages['newpassword']) ? $validateMessages['newpassword'] : "", "password");
                        self::renderFormInputField("newconfirmpassword", "Confirm Password", 
                            "", 
                            isset($validateMessages['newconfirmpassword']) ? $validateMessages['newconfirmpassword'] : "", "password");
                    ?>
                    <input class="button-primary u-pull-right" type="submit" value="Register">
                </form>
            </div>
        <?php
    }

    public static function renderFormInputField($fieldID, $fieldLabel, $fieldDefaultValue, $fieldValidation, $fieldType = "text") {
        ?>
            <div class="row">
                <div class="u-full-width">
                    <label for="<?php echo $fieldID; ?>"><?php echo $fieldLabel; ?>: </label>
                    <input class="u-full-width" type="<?php echo $fieldType; ?>"
                    <?php
                        if($fieldValidation != "") {
                            echo ' style="border-color: #721c24;background-color: #f8d7da" ';
                            echo ' placeholder="'. $fieldValidation .'" ';
                        } else {
                            echo ' value="'. $fieldDefaultValue .'" ';
                        }
                    ?>
                            id="<?php echo $fieldID; ?>" name="<?php echo $fieldID; ?>" >
                </div>
            </div>
        <?php
    }

    public static function messagearea($message = null, $severity = "error") {        
        ?>
            <div class="row">
                <div class="one-full column">
                    <?php
                        if(is_null($message) || $message == "") {
                            // No message
                            echo '<p style="padding: 10px 25px;border-radius: 10px;">&nbsp;</p>';
                        } else {
                            // Display message with style based on severity 
                            echo '<p style="padding: 10px 25px;border-radius: 10px;';
                            if($severity == "success") {
                                echo 'color: #155724;background-color: #d4edda;border-color: #c3e6cb;';
                            } else if($severity == "error") {
                                echo 'color: #721c24;background-color: #f8d7da;border-color: #f5c6cb;';
                            }
                            echo '">';
    
                            echo $message;

                            echo '</p>';
                        }
                    ?>
                </div>
            </div>
        <?php
    }
}

?>