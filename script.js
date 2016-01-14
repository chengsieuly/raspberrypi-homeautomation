var toggleOutlet = function(buttonClicked) {
    // Status
    var outlet = buttonClicked.attr('data-outletId');
    var status = buttonClicked.attr('data-outletStatus');    
    document.getElementById(outlet).innerHTML = status;

    if (status === "on") {
      var timer = document.getElementById("timer").value;
      var timerr = timer * 60;
    }

    $.post('toggle.php', {
            outletId: buttonClicked.attr('data-outletId'),
            outletStatus: buttonClicked.attr('data-outletStatus'),
            outletTimer: timerr
        },
        function(data, status) {
           //console.log(data);
        } 
)};


$(function() {
    $('.toggleOutlet').click(function() {
        toggleOutlet($(this));
    });
});


function loadJSON(path, success, error)
{
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function()
    {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                if (success)
                    success(JSON.parse(xhr.responseText));
            } else {
                if (error)
                    error(xhr);
            }
        }
    };
    xhr.open("GET", path, true);
    xhr.send();
} 

loadJSON('data.json',
         function(data) { 
           document.getElementById("two").innerHTML = data.two;
           document.getElementById("three").innerHTML = data.three;
           document.getElementById("four").innerHTML = data.four;
           document.getElementById("five").innerHTML = data.five;    
         },
         function(xhr) { console.error(xhr); }
);
