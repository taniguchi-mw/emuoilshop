var calObj = new Array();

calObj[0] = new Object();
calObj[0].defaultMonth = 0;
calObj[0].daysClass = new Object();

calObj[0].xDaysLater = new Array();
calObj[0].xDaysLater[0] = 'Today';

//※振替休日も手動で設定してください
//↓固定祝日
//↓今年
calObj[0].daysClass["1/1"] = 'Holyday;冬季休業(12/30～1/3)';//★変更
calObj[0].daysClass["1/2"] = 'Holyday;冬季休業(12/30～1/3)';//★変更
calObj[0].daysClass["1/3"] = 'Holyday;冬季休業(12/30～1/3)';//★変更
calObj[0].daysClass["2/11"] = 'Holyday;建国記念日';
calObj[0].daysClass["2/12"] = 'Holyday;振替休日';//★変更
calObj[0].daysClass["3/20"] = 'Holyday;春分の日';
calObj[0].daysClass["4/29"] = 'Holyday;昭和の日';
calObj[0].daysClass["4/30"] = 'Holyday;振替休日';//★変更
calObj[0].daysClass["5/3"] = 'Holyday;憲法記念日';
calObj[0].daysClass["5/4"] = 'Holyday;みどりの日';
calObj[0].daysClass["5/5"] = 'Holyday;こどもの日';
calObj[0].daysClass["8/11"] = 'Holyday;山の日';
calObj[0].daysClass["8/12"] = 'Holyday;夏季休業(8/12～8/15)';//★変更
calObj[0].daysClass["8/13"] = 'Holyday;夏季休業(8/12～8/15)';//★変更
calObj[0].daysClass["8/14"] = 'Holyday;夏季休業(8/12～8/15)';//★変更
calObj[0].daysClass["8/15"] = 'Holyday;夏季休業(8/12～8/15)';//★変更
calObj[0].daysClass["9/23"] = 'Holyday;秋分の日';//★2017～19年は23日、2020年は22日
calObj[0].daysClass["9/24"] = 'Holyday;振替休日';//★変更
calObj[0].daysClass["10/22"] = 'Holyday;即位礼正殿の儀';//★2019年のみ
calObj[0].daysClass["11/3"] = 'Holyday;文化の日';
calObj[0].daysClass["11/23"] = 'Holyday;勤労感謝の日';
calObj[0].daysClass["12/23"] = 'Holyday;天皇誕生日';
calObj[0].daysClass["12/24"] = 'Holyday;振替休日';//★変更
//↓来年度
calObj[0].daysClass["12/29"] = 'Holyday;冬季休業(12/29～1/3)';//★変更
calObj[0].daysClass["12/30"] = 'Holyday;冬季休業(12/29～1/3)';//★変更
calObj[0].daysClass["12/31"] = 'Holyday;冬季休業(12/29～1/3)';//★変更

calObj[0].xDays = new Array();

calObj[0].week = new Array();
calObj[0].week[0] = "Sun";
calObj[0].week[1];
calObj[0].week[2];
calObj[0].week[3];
calObj[0].week[4];
calObj[0].week[5];
calObj[0].week[6] = "Sat";

calObj[0].month = new Object();

//↓移動祝日　[月-曜日(月=1)-第何週]
calObj[0].month["1-1-2"] = 'Holyday;成人の日';
calObj[0].month["7-1-3"] = 'Holyday;海の日';
calObj[0].month["9-1-3"] = 'Holyday;敬老の日';
calObj[0].month["10-1-2"] = 'Holyday;体育の日';

calObj[0].backward = 'backward';

calObj[0].click = false;

calObj[0].clickURI = 'https://www.yahoo.co.jp/?year=_YEAR_&month=_MONTH_&day=_DAY_';

calObj[0].clickClassName = "";

calObj[0].priority = new Array('week','xDay','xDaysLater','day','backward');


calObj[1] = new Object();
calObj[1] = cal_clone(calObj[0]);
calObj[1].defaultMonth = 1;

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

calObj.calendars = new Array();
calObj.days = new Array(0,31,28,31,30,31,30,31,31,30,31,30,31);
calObj.weekName = new Array("日","月","火","水","木","金","土");
calObj.monthName = new Array('','1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月');
calObj.date = new Date();
calObj.date = new Date(calObj.date.getFullYear() + "/" + (calObj.date.getMonth() + 1) + "/" + calObj.date.getDate() + " 00:00:00");
calObj.day = calObj.date.getDate();
calObj.month = calObj.date.getMonth() + 1;
calObj.year = calObj.date.getFullYear();
calObj.currentList = null;

function cal_init(){
	var d = window.document;
	var tagObj = d.getElementsByTagName("div");
	var calToday = new Date();
	for(var i=0;i<tagObj.length;i++){
		if(tagObj[i].className == "cal_wrapper"){
			var calId = Number(tagObj[i].id.substring(3,tagObj[i].id.length));
			calObj.calendars.push(calId);
			if(0 < (calObj.month + calObj[calId].defaultMonth) && (calObj.month + calObj[calId].defaultMonth) < 13)
				calObj[calId].currentMonth = new Date(calObj.year+"/"+(calObj.month + calObj[calId].defaultMonth)+"/"+"1 00:00:00");
			else 
				calObj[calId].currentMonth = new Date((calObj.year+1)+"/"+((calObj.month + calObj[calId].defaultMonth)%12)+"/"+"1 00:00:00");
			cal_create(calId);
		}
	}
}
function cal_create(calId){
	var d = window.document;
	var day = calObj[calId].currentMonth.getDate();
	var month = calObj[calId].currentMonth.getMonth() + 1;
	var year = calObj[calId].currentMonth.getFullYear();
	var week = calObj[calId].currentMonth.getDay();
	var tdTextListArr = new Array();
	var bisDay = 0;
	var MonthDays = calObj.days[month];
	var WeekCnt = new Array();
	if(month == 2){
		if(year % 100 == 0 || year % 4 != 0){
			if(year % 400 != 0)
				bisDay = 0;
			else
				bisDay = 1;
		}
		else if(year % 4 == 0)
			bisDay = 1;
		else
			bisDay = 0;
	}
	MonthDays += bisDay;
	var calHTML = "<table border='0' cellspacing='0' cellpadding='0' class='cal'>";
	calHTML += "<tr><th colspan='7'>";
	calHTML += "<div class='cal_ui'>";
	calHTML += "<input type='button' onclick='cal_move("+calId+",-1);' value='&lt; prev' />";
	calHTML += "<input type='button' onclick='cal_move("+calId+",null);' value='-' />";
	calHTML += "<input type='button' onclick='cal_move("+calId+",1);' value='next &gt;' />";
	calHTML += "</div>";
	calHTML += "<p>" + year + "年" + calObj.monthName[month] + "</p></th></tr>";
	calHTML += "<tr class='headline'>";
	for(var i=0;i<calObj.weekName.length;i++)
		calHTML += "<td>" + calObj.weekName[i] + "</td>";
	calHTML += "</tr><tr>";
	for(var i=0;i<week;i++)
		calHTML += "<td>&nbsp;</td>";
	for(dayCnt=1;dayCnt<=(calObj.days[month]+bisDay);dayCnt++){
		var dayStr = year + "/" + month + "/" + dayCnt;
		var dayStrN = month + "/" + dayCnt;
		if(WeekCnt[week] == undefined)
			WeekCnt[week] = 0;
		WeekCnt[week]++;
		
		
		
		var monStr = '' + month + '-' + week + '-' + WeekCnt[week];
		var weekStr = '' + week + '-' + WeekCnt[week];
		//alert(weekStr);
		
		var dayClass = new Object();
		var dayClassText = new Object();
		var currentDayDate = new Date(year + "/" + month + "/" + dayCnt + " 00:00:00");
		var laterDay = Math.floor((currentDayDate.getTime() - calObj.date.getTime()) / 1000 / (60 * 60 * 24));
		var tdId = "td_"+calId+"_"+year+"_"+month+"_"+dayCnt;
		
		// backward
		if(calObj[calId].backward != null && currentDayDate.getTime() < calObj.date.getTime())
			dayClass["backward"] = calObj[calId].backward;
		
		// week
		if(calObj[calId].month[weekStr] != undefined)
			dayClass["week"] = calObj[calId].month[weekStr];
		else if(calObj[calId].month[monStr] != undefined)
			dayClass["week"] = calObj[calId].month[monStr];
		else if(calObj[calId].week[week] != undefined){
			if(typeof(calObj[calId].week[week]) == "object" && calObj[calId].week[week][WeekCnt[week]] != undefined){
				dayClass["week"] = calObj[calId].week[week][WeekCnt[week]];
			}
			else if(calObj[calId].week[week] != undefined && typeof(calObj[calId].week[week]) != "object")
				dayClass["week"] = calObj[calId].week[week];
		}
		// xDay
		if(calObj[calId].xDays[dayCnt] != undefined)
			dayClass["xDay"] = calObj[calId].xDays[dayCnt];
		
		// xDaysLater
		if(calObj[calId].xDaysLater[laterDay] != undefined)
			dayClass["xDaysLater"] = calObj[calId].xDaysLater[laterDay];
		
		// day
		if(calObj[calId].daysClass[dayStr] != undefined)
			dayClass["day"] = calObj[calId].daysClass[dayStr];
		else if(calObj[calId].daysClass[dayStrN] != undefined)
			dayClass["day"] = calObj[calId].daysClass[dayStrN];
		
		var tdClassArr = new Array();
		var tdTextArr = new Array();
		var tdLinkArr = new Array();
		var tdClassStr = "";
		var tdTextStr = "";
		var tdMouse = "";
		var tdClassNames = new Object();
		for(var ci=0;ci<calObj[calId].priority.length;ci++){
			if(dayClass[calObj[calId].priority[ci]] != undefined){
				var splitArr = new Array();
				splitArr = dayClass[calObj[calId].priority[ci]].split(';');
				tdClassArr.push(splitArr[0]);
				tdClassNames[splitArr[0]] = true;
				if(splitArr[1] != undefined){
					tdTextArr.push(splitArr[1]);
					var tdTextListLink = "";
					if(splitArr[2] != undefined)
						tdTextListLink = " onclick=\"cal_open(\'"+splitArr[2]+"\')\"";
					tdTextListArr.push('<ol><li id="'+tdId+'_li" onmouseover="cal_list2day_over(this)" onmouseout="cal_list2day_out(this)" value="'+dayCnt+'"'+tdTextListLink+'>'+splitArr[1]+'</li></ol>');
				}
				if(splitArr[2] != undefined)
					tdLinkArr.push(splitArr[2]);
			}
		}
		if(tdTextArr.length > 0){
			tdTextStr = "<span id='"+tdId+"'>" + tdTextArr[0] + "</span>";
			tdMouse = " onmouseover=\"cal_disp_text(\'"+tdId+"\')\" onmouseout=\"cal_hide_text(\'"+tdId+"\')\"";
			tdClassArr.push('pointer');
		}
		if(tdLinkArr.length > 0)
			tdMouse += " onclick=\"cal_open(\'"+tdLinkArr[0]+"\')\"";
		else if(calObj[calId].click){
			var clickOpenURI = calObj[calId].clickURI;
			clickOpenURI = clickOpenURI.replace(/_YEAR_/ig,year);
			clickOpenURI = clickOpenURI.replace(/_MONTH_/ig,month);
			clickOpenURI = clickOpenURI.replace(/_DAY_/ig,dayCnt);
			if((calObj[calId].clickClassName != "" && tdClassNames[calObj[calId].clickClassName]) || calObj[calId].clickClassName == ""){
				tdMouse += " onclick=\"cal_open(\'"+clickOpenURI+"\')\"";
				tdClassArr.push('pointer');
			}
		}
		if(tdClassArr.length > 0)
			tdClassStr = " class='" + tdClassArr.join(' ') + "'";
		calHTML += "<td id='"+tdId+"_td'><div"+tdClassStr+tdMouse+">" + dayCnt + tdTextStr + "</div></td>";
		if(week == 6){
			calHTML += "</tr>";
			if(dayCnt < calObj.days[month])
				calHTML += "<tr>";
			week = 0;
		}
		else
			week++;
	}
	while(week <= 6 && week != 0){
		calHTML += "<td>&nbsp;</td>";
		if(week == 6)
			calHTML += "</tr>";
		week++;
	}
	calHTML += "</table>";
	d.getElementById('cal'+calId).innerHTML = calHTML;
	
	// list
	if(tdTextListArr.length > 0 && d.getElementById('schedule'+calId)){
		d.getElementById('schedule'+calId).innerHTML = tdTextListArr.join('');
	}
	// /list
}
function cal_list2day_over(obj){
	var d = window.document;
	var dayId = obj.id.substring(0,obj.id.indexOf('_li'));
	if(d.getElementById(calObj.currentList))
		d.getElementById(calObj.currentList).style.backgroundColor = '#FFFFFF';
	calObj.currentList = dayId+'_td';
	if(d.getElementById(dayId+'_td'))
		d.getElementById(dayId+'_td').style.backgroundColor = '#CCCCCC';
}
function cal_list2day_out(obj){
	var d = window.document;
	var dayId = obj.id.substring(0,obj.id.indexOf('_li'));
	if(d.getElementById(calObj.currentList))
		d.getElementById(calObj.currentList).style.backgroundColor = '#FFFFFF';
}
function cal_open(uri){
	window.open(uri);
}
function cal_disp_text(textId){
	var d = window.document;
	if(navigator.userAgent.indexOf('MSIE') == -1)
		d.getElementById(textId).style.display = "block";
}
function cal_hide_text(textId){
	var d = window.document;
	d.getElementById(textId).style.display = "none";
}

function cal_move(calId,m){
	if(m == null)
		calObj[calId].currentMonth = new Date(calObj.year+"/"+(calObj.month)+"/"+"1 00:00:00");
	else {
		var day = calObj[calId].currentMonth.getDate();
		var month = calObj[calId].currentMonth.getMonth() + 1;
		var year = calObj[calId].currentMonth.getFullYear();
		if(0 < month + m && month + m < 13)
			calObj[calId].currentMonth = new Date(year+"/"+(month + m)+"/"+"1 00:00:00");
		else if((month + m) < 1){
			year--;
			month = 12;
			calObj[calId].currentMonth = new Date(year+"/"+(month)+"/"+"1 00:00:00");
		}
		else {
			year++;
			month = 1;
			calObj[calId].currentMonth = new Date(year+"/"+(month)+"/"+"1 00:00:00");
		}
	}
	cal_create(calId);
}
function cal_clone(obj) {
	var dest;
	if(typeof obj == 'object'){
		if(obj instanceof Array){
			dest = new Array();
			for(i=0;i<obj.length;i++)
				dest[i] = cal_clone(obj[i]);
		}
		else {
			dest = new Object();
			for(prop in obj)
				dest[prop] = cal_clone(obj[prop]);
		}
	}
	else
		dest = obj;
	return dest;
}
function cal_getMonth(){
	
}
cal_init();