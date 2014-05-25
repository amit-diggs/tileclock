function currenttime(div,name)
{
    var currentTime = new Date();
    var hours = ("0" +currentTime.getHours()).slice(-2);
    var minutes =("0" + currentTime.getMinutes()).slice(-2);
    var seconds=("0" +currentTime.getSeconds()).slice(-2);

    $(div).html(name+hours+':'+minutes+':'+seconds);
}

function process(finish_time)
{

    var n1=new Array();
    var time=new Array();
    n1=finish_time.split(":");
    if(n1[1].length>1)
    {

        time[0]=n1[1];
        time[1] =n1[2];
        time[2]= n1[3];
        return time
    }
    else
    {
        time[0]=0
        time[1] =0;
        time[2]= 0;
        return time;
    }
}

function elment_remove(array,ind)
{


    var newArray=new Array();
    var k=0;

    for(var i=0;i<array.length;i++)
    {
        if(array[i]!=ind)
        {
            newArray[k++]=array[i];
        }

    }

    return newArray;
}

function systemtime()
{
    var currentTime = new Date();
    var hours = currentTime.getHours();
    var minutes = currentTime.getMinutes();
    var seconds=currentTime.getSeconds();
    return(hours+':'+minutes+':'+seconds);
}

(function($) {
    $.fn.stopwatch = function(theme,id,userID) {
        var newArr=new Object();
        var part=0;
        var participant=new Array();
        userID = JSON.parse(userID);


        timer = setInterval(function() {
            currenttime('.current_time','Current Time :');
        }, 1000);
        var stopwatch = $(this);
        stopwatch.addClass('stopwatch').addClass(theme);
        var end_time=0;
        var time_difference=0;
        var start_time=0;
        var event_id=id;
        stopwatch.each(function() {
            var instance = $(this);
            var timer = 0;
            var h=0;
            var m=0;
            var s=0;
            var mi=0;
            var stopwatchFace = $('<div>').addClass('the-time');
            var timeHour = $('<span>').addClass('hr').text('00');
            var timeMin = $('<span>').addClass('min').text('00');
            var timeSec = $('<span>').addClass('sec').text('00');
            var timemiliSec = $('<span>').addClass('milli').text('00');
            var startStopBtn = $('<a>').attr('href', '').addClass('start-stop').text('Start');
            var resetBtn = $('<a>').attr('href', '').addClass('reset').text('Reset');
            stopwatchFace = stopwatchFace.append(timeHour).append(timeMin).append(timeSec).append(timemiliSec);
            instance.html('').append(stopwatchFace).append(startStopBtn).append(resetBtn);

            startStopBtn.bind('click', function(e) {
                e.preventDefault();
                var button = $(this);
                if(button.text() === 'Start') {
                    timer = setInterval(runStopwatch, 10);
                    button.text('Stop');
                    h= parseFloat(timeHour.text());
                    m = parseFloat(timeMin.text());
                    s = parseFloat(timeSec.text());
                    mi= parseFloat(timemiliSec.text());

                    start_t=$("#currenttime_div").text();

                    currenttime("#start_time","Start Time :");

                } else {

                    currenttime('#finish_time',"Finish Time :");

                   var n2=new Array();
                    start_time=$("#start_time").text();
                    var start_time=process(start_time);

                    var end_time=process($("#finish_time").text());

                    time_difference=Math.abs(start_time[0]-end_time[0])+':'+Math.abs(start_time[1]-end_time[1])+':'+Math.abs(start_time[2]-end_time[2]);//+':'+Math.abs(millisec2-mi);

                    clearInterval(timer);
                    button.text('Start');
                    $('#elapsed_time').html(('Elapsed Time:'+time_difference));
                }
            });

            resetBtn.bind('click', function(e) {
                e.preventDefault();
                clearInterval(timer);
                startStopBtn.text('Stop');
                timer = 0;
                timeHour.text('00');
                timeMin.text('00');
                timeSec.text('00');
                timemiliSec.text(00)
            });

            function runStopwatch() {

                // We need to get the current time value within the widget.
                var hour = parseFloat(timeHour.text());
                var minute = parseFloat(timeMin.text());
                var second = parseFloat(timeSec.text());
                var millisec = parseFloat(timemiliSec.text());
                m=millisec;
                s=second;
                h=hour;
                s=second;
                millisec++;
                if(millisec > 59)
                {
                    millisec=0;
                    second=second+1;
                }

                if(second > 59) {
                    second = 0;
                    minute = minute + 1;
                }

                if(minute > 59) {
                    minute = 0;
                    hour = hour + 1;

                }


                timeHour.html("0".substring(hour >= 10) + hour);
                timeMin.html("0".substring(minute >= 10) + minute);
                timeSec.html("0".substring(second >= 10) + second);
                timemiliSec.html("0".substring(millisec >= 10) + millisec);


                end_time=hour+':'+minute+':'+second+':'+millisec;
            }

            $('.stop').bind('click', function(e) {
				//alert("Test Ajax");
                e.preventDefault();
                var start_t=new Array();
                var end_t=new Array();


                start_t=process($("#start_time").text());
				//alert("Start Time :-"+start_t);
                end_time=systemtime();

                var nuID=$(this).attr("value");
                participant[part++]=nuID;
                var  newArrray=new Array();
                userID=elment_remove(userID,nuID);



                var tthis=    $(this);
                tthis.css("pointer-events","none");
                tthis.css("background","Green");
                end_t=end_time.split(":");
                time_difference=Math.abs(end_t[0]-start_t[0])+':'+Math.abs(end_t[1]-start_t[1])+':'+Math.abs(end_t[2]-start_t[2])
				
				if(start_t=='0,0,0')
				{
					alert("Please select start button to begin race");
					window.location.reload();
				}
				else
				{
					$.ajax({
						type: "GET",
						url: "../ajax_race",//event controller
						data: {
							start:start_t[0]+':'+start_t[1]+':'+start_t[2],
							end:end_time,
							diff:time_difference,
							id:$(this).attr("value"),
							event_id:event_id
							//alert(data);
						}
					}).done(function(msg) {
	
						tthis.remove()
					})
				}
            });

            $('#finish').bind('click', function(e) {
                e.preventDefault();
                $.ajax({
                    type: "GET",
                    url: "../paddlersNotRaced",//event controller
                    data: {
                        race:userID,
                        event:event_id
                    }
                }).done(function(msg) {
                    //  window.location = "../result?User="+participant;
                    window.location = "../result/"+event_id;
                });



            });
        });
    }
})(jQuery);