/*First, when the user searches for a class, it goes through getResults to get all the 
results of that search, which MUST EXCLUDE GROUPS THAT WERE ALREADY JOINED BY THIS USER
and must exclude those groups where the number of people who joined is equal to the 
max capacity. This relies on getGroupsJoined (or whatever).
These methods deal with a json_encoded array (or whatever)
    Our test case is as follows: our user makes a group, and 2 other users each make a group (each the exact same class). Then, the main user searches for this class. The other 2 classes should appear, but the one he created should not. Then, he joins one group
    and the next time he searches for the group, it should not be there. Then, we login to the last user and when he searches for the class, that particular group doesn't show up because it's full (max capacity was 2).

*/

$(".jgButton").click(function()
{
    window.location.href = "../pages/home.php";
});

$(".jgInput").keypress(function(e)
{
    if(e.which === 13)
    {
        var classSearch = $(this).val();
        
        $.ajax({
            method: 'POST',
            url: '../phpScripts/getResults.php',
            data: {search: classSearch},
            success: function(data)
            {
                if(data !== "No Groups Of That Class")
                {
                    var groupData = JSON.parse(data);
                    var searchResults = "";
                    for(var i = 0; i < groupData.length; i++)
                    {
                        searchResults += "<div id = \"" + i + "\" class = \"jgroup\">\
                                            <div class = \"liOuter\">\
                                                <div class = \"lInner\">\
                                                    <div class = \"liContainer\">\
                                                        <li>Class: " + groupData[i]['class'] +"</li>\
                                                        <li>Creator: " + groupData[i]['creator'] +"</li>\
                                                        <li>Location: " + groupData[i]['location'] +"</li>\
                                                        <li>Date: " + groupData[i]['date'] +"</li>\
                                                        <li>Start: " + groupData[i]['start'] +"</li>\
                                                        <li>End: " + groupData[i]['end'] +"</li>\
                                                    </div>\
                                                </div>\
                                            </div></div></br>";
                    }
                    $("#searchResults").html(searchResults);
                    
                    /*$(".group").hover(function()
                    {
                        var currentGroup = $(this);
                        var marginRight = parseInt(currentGroup.find('.liContainer').css('marginRight'));
                        var lInnerWidth = currentGroup.find('.lInner').width();
                        console.log("marginRight: " + marginRight + " lInnerWidth " + lInnerWidth);
                        
                        lInterval = setInterval(function()
                        {
                            marginRight += 2.5;
                            currentGroup.find('.liContainer').css({'marginRight': marginRight});
                            if(marginRight >= lInnerWidth)
                            {
                                marginRight *= -1;
                            }
                        }, 30);
                    });
                    
                    $(".group").mouseleave(function()
                    {
                        $(this).find('.liContainer').css({'marginRight': '0'});
                        window.clearInterval(lInterval);
                    });*/
                    
                    $(".jgroup").click(function()
                    {
                        console.log("click");
                        var currentDiv = $(this);
                        var currentGroupId = $(this).attr("id");
                        var groupId = groupData[currentGroupId]['id'];
                        $.ajax({
                            method: 'POST',
                            url: '../phpScripts/addGroup.php',
                            data: {id: groupId},
                            success: function(data)
                            {
                                console.log(data);
                                currentDiv.off("click");
                                currentDiv.off("mouseenter");
                                currentDiv.off("mouseleave");
                                currentDiv.remove();
                                currentDiv.next().remove();
                            }
                        });
                    });
                }
                else
                {
                    console.log(data);
                    $("#searchResults").html("<p>" + data + "</p>");
                }
            }
        });
    }
});