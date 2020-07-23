var currentChange, currentForm, currentCancel;
var isPicButton = false; 
var changeClickedOnce = false;

$(".pButton").click(function() //this would've worked better if I could set some sort of method to do this
{
    console.log("Click occurred!");
    console.log("changeClickedOnce: " + changeClickedOnce);

    currentChange = $(this);

    if($(this).attr("id") === "changeProfile")
    {
        isPicButton = true;
        console.log("isPicButton = " + isPicButton);
        console.log("Profile button clicked");
    }

    if(!changeClickedOnce)
    {
        expandCurrentNotLabel();
    }
    else
    {
        console.log("!changeClickedOnce = " + !changeClickedOnce);
        console.log($(this));
        console.log(currentChange);
        console.log($(this).is(currentChange));
        if($(this).is(currentChange))
        {
            //submitData();
            currentForm.submit();
            collapseNotLabel();
        }
        else
        {
            collapseNotLabel();
            expandCurrentNotLabel();
        }
    }

});

function collapseNotLabel()
{
    
    if(isPicButton)
    {
        $(".pContainer").css({"grid-template-rows": "50% 50%"});
    }
    
    currentForm.css({"display":"none"});
    currentCancel.css({"display":"none"});
    changeClickedOnce = false;
    isPicButton = false;
}

function expandCurrentNotLabel()
{
    currentForm = currentChange.parent().parent().find("form");
    currentCancel = currentChange.parent().find(".pCancel");

    if(isPicButton)
    {
        $(".pContainer").css({"grid-template-rows": "55% 50%"});
    }

    currentForm.css({"display":"grid"});
    currentCancel.css({"display":"block"});

    changeClickedOnce = true;
}

$(".pCancel").click(collapseNotLabel);

$(".pBackButton").click(function(e)
{
    e.preventDefault();
    
    window.location.href = "home.php";
});

$("form").submit(function(e)
{
    e.preventDefault();

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
            if(isPicButton)
            {
                console.log(isPicButton);
                location.reload(true);
            }
        }
    });
});

$(".greatDeleteButton").click(function()
{
    $("#profileModalContainer").css({"display": "grid"});
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