
function getClassesJoined()
{
    var unjoinButtonClicked = false;
    $.ajax({
        method: 'POST',
        url: '../phpScripts/getJoinedGroups.php',
        success: function(data)
        {
            var groupData = [];
            var groups = "";

            try
            {
                groupData = JSON.parse(data);
                for(var i = 0; i < groupData.length; i++)
                {
                    groups += "<div id = \"" + i + "\" class = \"group\">\
                                                    <div class = \"liOuter\">\
                                                        <div class = \"lInner\">\
                                                            <div class = \"liContainer\">\
                                                                <br/>\
                                                                <li>Class: " + groupData[i]['class'] +"</li>\
                                                                <li>Creator: " + groupData[i]['creator'] +"</li>\
                                                                <li>Location: " + groupData[i]['location'] +"</li>\
                                                                <li>Date: " + groupData[i]['date'] +"</li>\
                                                                <li>Start: " + groupData[i]['start'] +"</li>\
                                                                <li>End: " + groupData[i]['end'] +"</li>\
                                                            </div>\
                                                        </div>\
                                                    </div>\
                                                    <div class = \"groupButtonContainer\">\
                                                        <button class =\"customizeButton unjoinButton\" name = \"" + i + "\">Unjoin</button>\
                                                    </div>\
                                                </div>";
                }
            }
            catch(e)
            {
                console.log("I caught this " + e);
                groups = "<p>You Haven't Joined Any Groups</p>";
            }
            console.log("groups: " + groups);
            $("#userGroupContainer").html(groups);  
            var groupDivs = document.getElementsByClassName("group");
            for(var i = 0; i < groupDivs.length; i++)
            {
             groupDivs[i].addEventListener("click", function()
             {
                if(!unjoinButtonClicked)
                {
                console.log(unjoinButtonClicked);
                $(".group").off("click"); //off everything
                $(".unjoinButton").off("click");
                var localId = $(this).attr("id");
                $("#userGroupContainer").html("<div id = \"infoContainer\">\
                                                <span> Class: " + groupData[localId]['class'] + "</span><br/>\
                                                <span> Creator: " + groupData[localId]['creator'] + "</span><br/>\
                                                <span> Location: " + groupData[localId]['location'] + "</span><br/>\
                                                <div id = \"joinedGroupMap\"></div>\
                                                <span> Date: " + groupData[localId]['date'] + "</span><br/>\
                                                <span> Start: " + groupData[localId]['start'] + "</span><br/>\
                                                <span> End: " + groupData[localId]['end'] + "</span><br/>\
                                               </div><br/>\
                                               <div id = \"memberContainer\">\
                                                Members: <br/>\
                                               </div>");

                $(".container").css({'grid-template-rows':'12% 76% 12%'});
                $("#bubbleContainer").css({'display':'none'});
                $("#body").css({'display': 'block'});
                $(".container").append("<div id = \"jgFooter\">\
                                            <button class = \"customizeButton jgButton\">Back</button>\
                                        </div>");
                   
                  var groupId = groupData[localId]['id'];
                  $.ajax({
                      url: '../phpScripts/getGroupMembers.php',
                      method: "POST",
                      data: {groupid: groupId},
                      success: function(data)
                      {
                          var memberData = JSON.parse(data);
                          var membersRendered = "";
                          
                          for(var i = 0; i < memberData.length; i++) //for future reference, all members are in a div called memberContainer...the view is such that each member is a div of id member+index, and within each such div is an image with their profile in it and a bunch of identifying text
                          {
                              membersRendered += "<div id=\"member" + i +"\" class=\"groupMember\">\
                                                        <img src=\"" + memberData[i]['profile_pic'] + "\">\
                                                        <div class=\"memberOuter\">\
                                                            <div class=\"memberInner\">\
                                                                    <li>Name: " + memberData[i]['uname']+ "</li>\
                                                                    <li>Email: " + memberData[i]['email'] + "</li>\
                                                                    <li>Phone Number: " + memberData[i]['phone_number'] + "</li>\
                                                            </div>\
                                                        </div>\
                                                    </div><br/>";
                          }
                          $("#memberContainer").append(membersRendered);
                      }
                  });
                }
                else
                {
                    unjoinButtonClicked = false;
                }
                                             
             }, false);
            }
            
            unjoinButtons = document.getElementsByClassName("unjoinButton");
            for(var i = 0; i < unjoinButtons.length; i++)
            {
             unjoinButtons[i].addEventListener("click", function()
                {
                    unjoinButtonClicked = true;
                    var groupDivId = $(this).attr("name");
                    var groupId = groupData[groupDivId]['id'];
                    var currentGroup = $("#"+groupDivId);
                    
                    $.ajax({
                        method: 'POST',
                        url: '../phpScripts/unjoinGroup.php',
                        data: {groupid: groupId},
                        success: function(data)
                        {
                            console.log(data);
                            if(data !== "Something went wrong")
                            {
                                currentGroup.remove();
                            }
                        } 
                    });
                }, false); //figure out this useCapture bullsh!t
            }
        }
    });
}

getClassesJoined();


var MutationObserver = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;
    
    var observer = new MutationObserver(function(mutations)
    {
        mutations.forEach(function(mutation)
        {
            if(mutation.target.id === "userGroupContainer")
            {
                
                if(document.getElementById(mutation.target.id).firstElementChild.id === "infoContainer" && document.getElementById(mutation.target.id).firstElementChild.id !== null && document.getElementById(mutation.target.id).firstElementChild.id !== undefined)
                {
                    console.log("Current Page: 2");
                    $(".jgButton").click(function()
                    {
                        $(".jgButton").off("click");
                        $("#userGroupContainer").html("");
                        $("#jgFooter").remove();
                        $(".container").css({'grid-template-rows':'12% 88%'});
                        $("#body").css({'display':'grid'});
                        $("#bubbleContainer").css({'display':'grid'});
                        getClassesJoined();
                    });
                }
                else
                {
                    console.log("Current Page: 1");
                }
            }
        });
    });
    
    
observer.observe(document, {childList: true, characterData: true, attributes: true, subtree: true});

$("#bubble1").click(function()
{
    $(this).css({'background-color':'#fff'});
    $("#bubble2").css({'background-color':'transparent'});
    $("#mainButtonContainer").css({'display':'grid'});
    $("#userGroupContainer").css({'display':'none'});
});

$("#bubble2").click(function()
{
    $(this).css({'background-color':'#fff'});
    $("#bubble1").css({'background-color':'transparent'});
    $("#userGroupContainer").css({'display':'block'});
    $("#mainButtonContainer").css({'display':'none'});
});

