<?php
    include "classes/db.php";
    include "classes/user.php";
    
    session_start();
    
    if(!isset($_SESSION['user']))
    {
        header('Location: index.php');
    }
    
    $user = $_SESSION['user'];
    
?>
<!Dotcype html>
<html>
    <head>
       <!--<link media = "screen and (max-device-width: 600px)" href="css/mobileStyle.css" rel = "stylesheet" type="text/css"/>
        <link media = "screen and (max-device-width: 768px)" href="css/tabletStyle.css" rel = "stylesheet" type="text/css"/>
        <link media = "screen and (max-device-width: 1200px)" href="css/laptopStyle.css" rel = "stylesheet" type="text/css"/>
        <link media = "screen and (max-device-width: 1800px)" href="css/desktopStyle.css" rel = "stylesheet" type="text/css"/>-->
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <!--<script src = "https://code.jquery.com/jquery-3.3.1.min.js"></script>-->
        <script src="jquerySubstitute.js"></script>
    </head>
    
    <body>
        <div id = "profileModalContainer">
            <div id = "deleteModal">
                <div id = "messageContainer">
                    <p id = "modalWarningMessage">Are You Sure You Want To Delete Your Account?</p>
                </div>
                <div id = "buttonContainer">
                <button class = "customizeButton modalButton">Yes</button><button class = "customizeButton modalButton">No</button>
                </div>
            </div>
        </div>
        <div id="pContainerContainer">
            <div class="ad"></div>
            <div class = "pContainer">
                <div id = "profilePicContainer">
                    <img src = <?php echo "\"" . $user->getProfilePic() . "\"";?>/> <br/>
                    <div class="notLabel">
                        <form class = "pForm profilePicForm" enctype="multipart/form-data">
                            <input type = "file" id = "pFile" name = "newProfilePic" />
                        </form>
                        <div class="chngeButtonContainer">
                            <input id = "changeProfile" type = "button" value = "Change" class = "customizeButton pButton"/>
                            <input type="button" value="Cancel" class="customizeButton pCancel" />
                        </div>
                    </div>
                </div>
                <div id = "profileInfoContainer">
                    <div class = "profileInfoClass">
                        <label>Username: <?php echo $user->getName(); ?></label>
                        <div class="notLabel">
                            <form class = "pForm usernameForm">
                                <input type = "text" placeholder = "New Username" class = "customizeInput pInput" name = "new_username"/>
                            </form>
                            <div class="chngeButtonContainer">
                                <input type="button" value = "Change" class = "customizeButton pButton"/>
                                <input type="button" value="Cancel" class="customizeButton pCancel" />
                            </div>
                        </div>
                    </div><br/>
                    <div class = "profileInfoClass">
                        <label>Email: <?php echo $user->getEmail(); ?></label>
                        <div class="notLabel">
                            <form class = "pForm emailForm">
                                <input type = "text" placeholder = "New Email" class = "customizeInput pInput" name = "new_email"/>
                            </form>
                            <div class="chngeButtonContainer">
                                <input type="button" value = "Change" class = "customizeButton pButton"/>
                                <input type="button" value="Cancel" class="customizeButton pCancel" />
                            </div>
                        </div>
                    </div><br/>
                    <div class = "profileInfoClass">
                        <label>Password:</label>
                        <div class="notLabel">
                            <form class = "pForm passwordForm">
                                <input type = "password" placeholder = "New Password" class = "customizeInput pInput" name = "new_password"/>
                                <input type = "password" placeholder = "Confirm Password" class = "customizeInput pInput" name = "confirm_password"/>
                            </form>
                            <div class="chngeButtonContainer">
                                <input type="button" value = "Change" class = "customizeButton pButton"/>
                                <input type="button" value="Cancel" class="customizeButton pCancel" />
                            </div>
                        </div>
                    </div><br/>
                    <div class = "profileInfoClass">
                        <label>Phone Number: <?php echo $user->getPhoneNum(); ?></label>
                        <div class="notLabel">
                            <form class = "pForm phoneNumForm">
                                <input type = "text" placeholder = "New Phone Number" class = "customizeInput pInput" name = "new_phone_number"/>
                            </form>
                            <div class="chngeButtonContainer">
                                <input type="button" value = "Change" class = "customizeButton pButton" />
                                <input type="button" value="Cancel" class="customizeButton pCancel" />
                            </div>
                        </div>
                    </div><br/>
                    <input type="button" value = "Delete Account" class = "customizeButton greatDeleteButton"/>
                </div>
            </div>
            <div class="ad"></div>
        </div>
        <div id="pFooter">
            <input type="button" value="Back" class="customizeButton pBackButton"/>
        </div>
        <script src = "js/profile.js"></script>
    </body>
</html>