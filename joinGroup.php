<html>
    <head>
        <!--<link media = "screen and (max-device-width: 600px)" href="css/mobileStyle.css" rel = "stylesheet" type="text/css"/>
        <link media = "screen and (max-device-width: 768px)" href="css/tabletStyle.css" rel = "stylesheet" type="text/css"/>
        <link media = "screen and (max-device-width: 1200px)" href="css/laptopStyle.css" rel = "stylesheet" type="text/css"/>
        <link media = "screen and (max-device-width: 1800px)" href="css/desktopStyle.css" rel = "stylesheet" type="text/css"/>-->
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src = "https://code.jquery.com/jquery-3.3.1.min.js"></script>
    </head>
    
    <body>
        <div class = "jgContainer">
            <div id = "jgHeader">
                <img class = "searchIcon" src = "images/search.png"/>
                <input type = "text" placeholder = "Class Ex. ABC 123" class = "customizeInput jgInput"/>
            </div>
            <div id="jgBody">
                <div class="ad">
                </div>
                <div id = "searchResults">
                <!--Results of search loaded here via ajax-->
                </div>
                <div class="ad">
                </div>
            </div>
            <div id = "jgFooter">
                <button class = "customizeButton jgButton">Back</button>
            </div>
        </div>
        <script src = "js/joinGroup.js"></script>
    </body>
</html>
