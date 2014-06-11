// JavaScript Document

(function(c,v){c.clock={version:"2.0.2",locale:{}};t=[];c.fn.clock=function(a){var e={it:{weekdays:"Domenica Luned\u00ec Marted\u00ec Mercoled\u00ec Gioved\u00ec Venerd\u00ec Sabato".split(" "),months:"Gennaio Febbraio Marzo Aprile Maggio Giugno Luglio Agosto Settembre Ottobre Novembre Dicembre".split(" ")},en:{weekdays:"Sunday Monday Tuesday Wednesday Thursday Friday Saturday".split(" "),months:"January February March April May June July August September October November December".split(" ")},es:{weekdays:"Domingo Lunes Martes Mi\u00e9rcoles Jueves Viernes S\u00e1bado".split(" "),
months:"Enero Febrero Marzo Abril May junio Julio Agosto Septiembre Octubre Noviembre Diciembre".split(" ")},de:{weekdays:"Sonntag Montag Dienstag Mittwoch Donnerstag Freitag Samstag".split(" "),months:"Januar Februar M\u00e4rz April k\u00f6nnte Juni Juli August September Oktober November Dezember".split(" ")},fr:{weekdays:"Dimanche Lundi Mardi Mercredi Jeudi Vendredi Samedi".split(" "),months:"Janvier F\u00e9vrier Mars Avril May Juin Juillet Ao\u00fbt Septembre Octobre Novembre D\u00e9cembre".split(" ")},
ru:{weekdays:"\u0412\u043e\u0441\u043a\u0440\u0435\u0441\u0435\u043d\u044c\u0435 \u041f\u043e\u043d\u0435\u0434\u0435\u043b\u044c\u043d\u0438\u043a \u0412\u0442\u043e\u0440\u043d\u0438\u043a \u0421\u0440\u0435\u0434\u0430 \u0427\u0435\u0442\u0432\u0435\u0440\u0433 \u041f\u044f\u0442\u043d\u0438\u0446\u0430 \u0421\u0443\u0431\u0431\u043e\u0442\u0430".split(" "),months:"\u042f\u043d\u0432\u0430\u0440\u044c \u0424\u0435\u0432\u0440\u0430\u043b\u044c \u041c\u0430\u0440\u0442 \u0410\u043f\u0440\u0435\u043b\u044c \u041c\u0430\u0439 \u0418\u044e\u043d\u044c \u0418\u044e\u043b\u044c \u0410\u0432\u0433\u0443\u0441\u0442 \u0421\u0435\u043d\u0442\u044f\u0431\u0440\u044c \u041e\u043a\u0442\u044f\u0431\u0440\u044c \u041d\u043e\u044f\u0431\u0440\u044c \u0414\u0435\u043a\u0430\u0431\u0440\u044c".split(" ")},
nu:{months:[1,2,3,4,5,6,7,8,9,10,11,12]}};return this.each(function(){c.extend(e,c.clock.locale);a=a||{};a.timestamp=a.timestamp||"systime";systimestamp=new Date;systimestamp=systimestamp.getTime();a.sysdiff=0;"systime"!=a.timestamp&&(mytimestamp=new Date(a.timestamp),a.sysdiff=a.timestamp-systimestamp);a.langSet=a.langSet||"en";a.format=a.format||("en"!=a.langSet?"24":"12");a.calendar=a.calendar||"true";a.seconds=a.seconds||"true";c(this).hasClass("jqclock")||c(this).addClass("jqclock");var l=function(a){10>
a&&(a="0"+a);return a},u=function(k,b){var f,s=c(k).attr("id");if("destroy"==b)clearTimeout(t[s]);else{mytimestamp=new Date;mytimestamp=mytimestamp.getTime();mytimestamp+=b.sysdiff;mytimestamp=new Date(mytimestamp);var d=mytimestamp.getHours(),m=mytimestamp.getMinutes(),n=mytimestamp.getSeconds();f=mytimestamp.getDay();var g=mytimestamp.getDate(),h=mytimestamp.getMonth(),p=mytimestamp.getFullYear(),q="",r="";"12"==b.format&&(q=" AM",11<d&&(q=" PM"),12<d&&(d-=12),0==d&&(d=12));d=l(d);m=l(m);n=l(n);
"false"!=b.calendar&&(b.usenumbers?(b.langSet="nu",f=10>e[b.langSet].months[h]?"0"+e[b.langSet].months[h]:e[b.langSet].months[h],r="<span class='clockdate'>"+p+"-"+f+"-"+(10>g?"0"+g:g)+" </span>"):r="en"==b.langSet?"<span class='clockdate'>"+e[b.langSet].weekdays[f]+", "+e[b.langSet].months[h]+" "+g+", "+p+"</span>":"<span class='clockdate'>"+e[b.langSet].weekdays[f]+", "+g+" "+e[b.langSet].months[h]+" "+p+"</span>");c(k).html(r+"<span class='clocktime'>"+d+":"+m+("true"==a.seconds?":"+n:"")+q+"</span>");
t[s]=setTimeout(function(){u(c(k),b)},1E3)}};u(c(this),a)})};return this})(jQuery);


function ReloadPage() { 
   location.reload();
};

/* Now apply on document ready to jsbin page */
$(document).ready(function(){
function exportTableToCSV($table, filename) 
{
	var $rows = $table.find('tr:has(td,th)'),
	// Temporary delimiter characters unlikely to be typed by keyboard
	// This is to avoid accidentally splitting the actual contents

	tmpColDelim = String.fromCharCode(11), // vertical tab character
	tmpRowDelim = String.fromCharCode(0), // null character
	// actual delimiter characters for CSV format
	colDelim = '","',
	rowDelim = '"\r\n"',
	// Grab text from table into CSV formatted string
	csv = '"' + $rows.map(function (i, row) {
	var $row = $(row),
	$cols = $row.find('td, th');
	return $cols.map(function (j, col) {
    if(j != 7){
        var $col = $(col),
        text = $col.text();
        return text.replace('"', '""'); // escape double quotes
    }else{
        return "";
    }

    }).get().join(tmpColDelim);
	
	}).get().join(tmpRowDelim)
	.split(tmpRowDelim).join(rowDelim)
	.split(tmpColDelim).join(colDelim) + '"',
	// Data URI
	csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);
	$(this)
		.attr({
		'download': filename,
		'href': csvData,
		'target': '_blank'
	});
}
// This must be a hyperlink
$(".export").click(function(){
	var today = new Date();
	exportTableToCSV.apply(this, [$('#dvData>table'), 'export.csv']);
});

$.clock.locale = {"pt":{"weekdays":["Domingo","Segunda-feira", "Terça-feira","Quarta-feira","Quinta-feira","Sexta-feira", "Sábado"],"months":["Janeiro","Fevereiro","Março","Abril", "Maio","Junho","Julho","Agosto","Setembro","October","Novembro", "Dezembro"] } };
$(".clock1").clock({"calendar" : "false"});
$("#clock1").clock({"usenumbers" : "true"});
customtimestamp = new Date().getTime() + 1123200000+10800000+14000;
$("#clock5").clock({"timestamp":customtimestamp});
    
	$('ul li').click(function() 
	{
		    if($(this).parent().find('.job-tile').length = 1) 
			{
				$('ul li.active').removeClass('active');
		    }
			$('ul li .active').removeClass('active');
			$(this).closest('li').addClass('active');
			if($(this ).find('div').hasClass('time'))
			{
				$(this ).find('div.time').removeClass('inactive');
				$(this).prevAll().find('div.time').addClass('inactive');
				$(this).nextAll().find('div.time').addClass('inactive');
			}
    });
	
});


function timer(job_id)
{
	var time_new = $('#clock1').text();
	var in_date =  $('#in_date').val();
	var in_time =  $('.clock1').text();
	var out_date =  $('#out_date').val();
	var out_time =  $('#out_time').val();
	var status =  $('#status').val();
	var emp_id = $('#emp_id').val();
	var created_by = $("#created_by").val();
	signal=myBaseUrl+"/Admins/timer";
	$.ajax({
	  type: "post",
	  url:signal,
	  data:{job_id: job_id,emp_id: emp_id,time_new:time_new,in_date: in_date,in_time: in_time,out_date: out_date,out_time: out_time,status:status,created_by:created_by},
	  async: true,
	  success:function(result){
		 window.location.reload();
	  }});
}

function canceTimer()
{
	var time = $('#clock1').text();
	var out_date = $('.out_date').val();
	var out_time = $('.out_time').val();
	signal=myBaseUrl+"/Admins/cancelTimer";
	$.ajax({
	  type: "post",
	  url:signal,
	  data:{time: time,out_date: out_date,out_time: out_time},
	  async: true,
	success:function(result){
		alert(result);
		window.location.reload();
	}});
}

 