var changeClickedOnce = false;

var mainDiv, mainDivHeight, thisButton, thisButtonHeight, thisForm, thisCancel, prevButton, prevDiv, prevDivHeight, prevForm, prevCancel, standardDivHeight;

standardDivHeight = $(".profileInfoClass").height();

$(".pBackButton").click(function(e)
{
    e.preventDefault();
    
    window.location.href = "home.php";
});

$(".pButton").click(change);
$(".picButton").click(changePic);

function change(e)
{
    mainDiv = $(this).parent();               //definitions
    mainDivHeight = mainDiv.height();
    thisButton = $(this);
    thisButtonHeight = thisButton.height();
    thisForm = mainDiv.find("form");
    thisCancel = mainDiv.find(".pCancel");
        
    if(changeClickedOnce)                          //if other div open, close it
    {
        console.log("prevHeight before: " + prevDivHeight);
        prevForm.off("submit");
        prevForm.css({"display":"none"});
        prevCancel.off("click");
        prevCancel.css({"display":"none"});
        prevDivHeight -= standardDivHeight;            
        prevDiv.height(prevDivHeight);
        prevButton.off("click");
        if(prevButton.hasClass("picButton"))
        {
            prevButton.click(changePic);
        }
        else
        {
            prevButton.click(change);
        }
        console.log("prevHeight after: " + prevDivHeight);
    }
    
    changeClickedOnce = true;
    
    mainDivHeight += standardDivHeight;                          //expand this div
    mainDiv.height(mainDivHeight);
    thisButton.height(thisButtonHeight);
    thisForm.css({"display":"block"});
    thisCancel.css({"display":"block"});
    thisCancel.height(thisButtonHeight);
            
    prevDiv = mainDiv;
    prevDivHeight = mainDivHeight;
    prevForm = thisForm;
    prevButton = thisButton;
    prevCancel = thisCancel;
    
    thisButton.click(function(e){e.preventDefault(); thisForm.submit();});
    
    $("input[type = 'password']").keypress(function(e)
    {
        if(e.which == 13)
        {
            thisForm.submit();
        }
    });
    
    thisCancel.click(function() //add and subtract by standard height
            {
                thisButton.off("click");
                thisCancel.off("click");
                thisCancel.css({"display":"none"});
                thisForm.off("submit");
                thisForm.css({"display":"none"});
                $("input[type = 'password']").off("keypress");
                console.log(mainDivHeight);
                mainDivHeight -= standardDivHeight;
                console.log(mainDivHeight);
                mainDiv.height(mainDivHeight);
                console.log(mainDiv.height());
                changeClickedOnce = false;
                thisButton.click(change);
            });
            
            thisForm.submit(function(eventt)
            {
                eventt.preventDefault();
                
                console.log("Submit Occurred!");
                //send data to the php file
                $.ajax({
                    method: 'POST',
                    url: '../phpScripts/editProfile.php',
					data: new FormData(this),
					contentType: false,
                    cache: false,
					processData: false,
                    success: function(data)
                    {
                        alert(data);
                        location.reload();
                    }
                });
                
                //hide the form once more
                thisButton.off("click");
                thisCancel.off("click");
                thisCancel.css({"display":"none"});
                $("input[type = 'password']").off("keypress");
                thisForm.off("submit");
                thisForm.css({"display":"none"});
                mainDivHeight -= standardDivHeight;
                mainDiv.height(mainDivHeight);
                changeClickedOnce = false;
                thisButton.click(change);
            });
}

function changePic(e)
{
    mainDiv = $(this).parent();              //definitions
    mainDivHeight = mainDiv.height();
    thisButton = $(this);
    thisButtonHeight = thisButton.height();
    thisForm = mainDiv.find("form");
    thisCancel = mainDiv.find(".pCancel");
    
    var profilePic = $(this).parent().find("img");
    var profilePicHeight = profilePic.height();
    
    if(changeClickedOnce)
    {
        
        prevForm.off("submit");
        prevForm.css({"display":"none"});
        prevCancel.off("click");
        prevCancel.css({"display":"none"});
        prevDivHeight -= standardDivHeight;
        prevButton.off("click");
        prevButton.click(change);
        prevDiv.height(prevDivHeight);
    }
    
    changeClickedOnce = true;
    
    mainDivHeight += standardDivHeight;                          //expand this div
    mainDiv.height(mainDivHeight);
    thisButton.height(thisButtonHeight);
    thisForm.css({"display":"block"});
    thisCancel.css({"display":"block"});
    thisCancel.height(thisButtonHeight);
    profilePic.height(profilePicHeight);
            
    prevDiv = mainDiv;
    prevDivHeight = mainDivHeight;
    prevForm = thisForm;
    prevButton = thisButton;
    prevCancel = thisCancel;
    
    thisButton.click(function(e){e.preventDefault(); thisForm.submit();});
    
    thisCancel.click(function() //add and subtract by standard height
            {
                thisButton.off("click");
                thisCancel.off("click");
                thisCancel.css({"display":"none"});
                thisForm.off("submit");
                thisForm.css({"display":"none"});
                console.log(mainDivHeight);
                mainDivHeight -= standardDivHeight;
                console.log(mainDivHeight);
                mainDiv.height(mainDivHeight);
                console.log(mainDiv.height());
                changeClickedOnce = false;
                thisButton.click(changePic);
            });
            
    thisForm.submit(function(eventt)
            {
                eventt.preventDefault();
                
                console.log("Submit Occurred!");
                console.log(thisForm);
                //send data to the php file
                $.ajax({
                    method: 'POST',
                    url: '../phpScripts/editProfile.php',
					data: new FormData(this),
					contentType: false,
                    cache: false,
					processData: false,
                    success: function(data)
                    {
                        alert(data);
                        //location.reload();
                    }
                });
                
                //hide the form once more
                thisButton.off("click");
                thisCancel.off("click");
                thisCancel.css({"display":"none"});
                thisForm.off("submit");
                thisForm.css({"display":"none"});
                mainDivHeight -= standardDivHeight;
                mainDiv.height(mainDivHeight);
                changeClickedOnce = false;
                thisButton.click(changePic);
            });
}
$(".greatDeleteButton").off("click");

$(".greatDeleteButton").click(function()
{
    $("#profileModalContainer").css({"display": "block"});
});

$(".modalButton").click(function()
{
    if($(this).text() === "No")
    {
        cancelDelete();
    }
    else
    {
        deleteAccount();
    }
});

function cancelDelete()
{
    $("#profileModalContainer").css({"display": "none"});
}

function deleteAccount()
{
    $.ajax({
        method: "POST",
        url: "../phpScripts/deleteAccount.php",
        success: function(data)
        {
            console.log(data);
            if(data === "Success")
            {
                location.href = "index.php";
            }
            else
            {
                console.log("Something went wrong in the delete process");
            }
        }
    });
}



