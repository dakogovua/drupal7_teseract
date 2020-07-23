var arreurusd;
// убираем обратный скроллинг из-за добавления чекбокса
var flag_scroll = 0;
/**
 * [ajax запрос для получения курсов НБУ]
 * @return {[array]} [возвращает масcив с курсами валют USD и EUR на текущий момент]
 */
var $ = jQuery.noConflict();
$(document).on('ready', function() {
	$("#file_strah, #file_strah1, #file_strah2, #file_strah3, #file_strah4").fileinput({
		browseClass: "btn btn-primary btn-block",
		showCaption: false,
		showCancel: false,
		showRemove: false,
		showUpload: false
	});
});
document.addEventListener("DOMContentLoaded", function(event) {

	var xhttp = new XMLHttpRequest();
  	xhttp.open("POST", "/sites/all/modules/travel/get_rate.php", false);
  	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  	xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
      		rate_string = this.responseText;
	    	arreurusd  =  rate_string.split(";");
		console.log("arreurusd "+ arreurusd);
			return arreurusd;
    	}else
    		console.log("Missed get_rate.php");
  	};

	xhttp.send("qwe=" + currency);
});
//update 03.11.17 start
	/*
	//копирует значения даты рождения из верхнего блока в блок
	//ввода персональных данных

	function set_date(element_id, par_el_id) {
		document.getElementById(element_id).value = document.getElementById(par_el_id).value;
	}
	*/
//update 03.11.17 end


// $(document).ready(function(){


// 	//////////////////////////////////////////////

// });



window.onload = function() {
	var dayend ; // --- перемнная для работы с мультивизой, на ее значение нужно увеличивать выбранную дату
	var days = 0;
	var days30 = 30;
	var $ = jQuery.noConflict();
		// ------------------------------------------- минус 30 лет с нынешней даты
	var minus30 = new Date();
	var minusday = minus30.getDate();
	var minusmonth = minus30.getMonth() + 1;
	var minusyear = (minus30.getFullYear() - 30);
	if (minusmonth < 10) minusmonth = "0" + minusmonth;
	if (minusday < 10) minusday = "0" + minusday;
	var mydayteminus30 = minusday + '.' + minusmonth + '.' + minusyear;


	/*function min_max_dateBirth() {
		var date_new = new Date();
		var min_date = new Date(date_new.setFullYear(date_new.getFullYear() - 70));
		var max_date = new Date(date_new.setFullYear(date_new.getFullYear() - 1));
		set_min_max_period("birth_date_1", "min_date", "max_date");
	}*/


	var eur = arreurusd[0];
	var usd = arreurusd[1];

	var currency = "USD";
	document.getElementById("currency").innerHTML = " " + currency;
	var insSum = document.getElementById("insSum").value;
	var insSum_selected = document.getElementById("insSum").value;
	var Kpr = document.getElementById("Kpr").value;
	var Kfr = document.getElementById("Kfr").value;

	var Kter = 1;
	document.getElementById("Kter").value = Kter;
	document.getElementById("strah_flag").value = 0;
	var dateStart = koss_increase(0,new Date(),0,0, true);



	// set_min_max_period("birth_date_1",koss_increase(0,new Date(),0,-25550, true), koss_increase(0,new Date(),0,-365, true));
	// set_min_max_period("birth_date_2",koss_increase(0,new Date(),0,-25550, true), koss_increase(0,new Date(),0,-365, true));
	// set_min_max_period("birth_date_3",koss_increase(0,new Date(),0,-25550, true), koss_increase(0,new Date(),0,-365, true));
	// set_min_max_period("birth_date_4",koss_increase(0,new Date(),0,-25550, true), koss_increase(0,new Date(),0,-365, true));

	var dateStop = "";
	var SPb = "";
	var multi_visa_period = 1;
	var SP = "";
	var SPb_accident = "";
	var years;
	var qwe;
	var K1 = 1;
	var K2 = 1;
	var K3 = 1;
	var K4_1 = 1;
	var K4_2 = 1;
	var K4_3 = 1;
	var K4_4 = 1;
	var K5 = 1;
	var tourists = 1;
	var rate = 1;
	var rate_arr;
	var SSnv = 0;
	var SPtr = 0;
	var SPnv = 0;
	var SPzag = 0;
	var flag = 0;
	var flag_acc = 0;
	var regName = new RegExp("^[A-z]+$");
	var regpass_series = new RegExp("^[A-Z]{2}$");
	var regpass_num = new RegExp("^[0-9]{6}$");
	var regpass_inn = new RegExp("^[0-9]{10}$");
	var reg_pass = new RegExp("^[A-z]{2}[0-9]{6}$");
	// Коригуючі коефіцієнти розміру комісійної винагороди (Ккв)
	// 25%
	var Kkv = 1.347;
	//Kkv = 1;

	var insurancePaymentForOneDay_oneTrip = [
												[0.24, 0.22, 0.2, 0.18, 0.16, 0.14],
												[0.26, 0.24, 0.21, 0.19, 0.17, 0.15],
												[0.35, 0.32, 0.29, 0.25, 0.22, 0.19]
											];
	var insurancePaymentForOneDay_muliTrip = [
												[4, 4, 8, 15, 19, 10, 17, 20, 30],
												[5, 5, 10, 17, 23, 12, 20, 25, 40],
											];
	var insurancePaymentForOneDay_oneTrip_acc = [0.045, 0.07, 0.127, 0.303, 0.61, 0.956];
	var insurancePaymentForOneDay_muliTrip_acc = [0.1, 0.13, 0.215, 0.456, 0.530, 0.368, 0.629, 0.783, 1.278];
	var K5_factor = [1, 0.95, 0.9, 0.85, 0.8];
	var rex = 0;
	var rexdays = 0;

$('#date0, #date1, #date2, #date3, #date4, #birth_date_1, #birth_date_2, #birth_date_3, #birth_date_4').attr('value', mydayteminus30);
	// ------------------------------------------------ энд
	$('#date0').dateRangePicker({
		monthSelect: true,
    yearSelect: [moment().get('year')-65, moment().get('year')],
		format: 'DD.MM.YYYY',
		autoClose: true,
		singleDate : true,
		showShortcuts: false,
		singleMonth: true
	}).bind('datepicker-change',function(event,obj){
		K4_1 = rate;
		if(document.getElementById("strah_flag").value == 0){
			$("#birth_date_1").val(obj.value);
		}else{
			$("#birth_date_1").val(obj.value);
		}
	});
	$('#date1').dateRangePicker({
		monthSelect: true,
    yearSelect: [moment().get('year')-65, moment().get('year')],
		format: 'DD.MM.YYYY',
		autoClose: true,
		singleDate : true,
		showShortcuts: false,
		singleMonth: true
	}).bind('datepicker-change',function(event,obj){
		K4_1 = rate;
		if(document.getElementById("strah_flag").value == 1){
			$("#birth_date_1").val(obj.value);
		}else{
		}
	});
	$('#date2').dateRangePicker({
		monthSelect: true,
    yearSelect: [moment().get('year')-65, moment().get('year')],
		format: 'DD.MM.YYYY',
		autoClose: true,
		singleDate : true,
		showShortcuts: false,
		singleMonth: true
	}).bind('datepicker-change',function(event,obj){
		$("#birth_date_2").val(obj.value);
	});
	$('#date3').dateRangePicker({
		monthSelect: true,
    yearSelect: [moment().get('year')-65, moment().get('year')],
		format: 'DD.MM.YYYY',
		autoClose: true,
		singleDate : true,
		showShortcuts: false,
		singleMonth: true
	}).bind('datepicker-change',function(event,obj){
		$("#birth_date_3").val(obj.value);
	});
	$('#date4').dateRangePicker({
		monthSelect: true,
    yearSelect: [moment().get('year')-65, moment().get('year')],
		format: 'DD.MM.YYYY',
		autoClose: true,
		singleDate : true,
		showShortcuts: false,
		singleMonth: true
	}).bind('datepicker-change',function(event,obj){
		$("#birth_date_4").val(obj.value);
	});
	$('#birth_date_1').dateRangePicker({
		monthSelect: true,
    yearSelect: [moment().get('year')-65, moment().get('year')],
		format: 'DD.MM.YYYY',
		autoClose: true,
		singleDate : true,
		showShortcuts: false,
		singleMonth: true
	}).bind('datepicker-change',function(event,obj){
				K4_1 = rate;
				if(document.getElementById("strah_flag").value == 0){
					$("#date0").val(obj.value);
				}else{
					$("#date1").val(obj.value);
				}
	});
	$('#birth_date_2').dateRangePicker({
		monthSelect: true,
    yearSelect: [moment().get('year')-65, moment().get('year')],
		monthSelect: true,
		format: 'DD.MM.YYYY',
		autoClose: true,
		singleDate : true,
		showShortcuts: false,
		singleMonth: true
	}).bind('datepicker-change',function(event,obj){
		$("#date2").val(obj.value);
	});
	$('#birth_date_3').dateRangePicker({
		monthSelect: true,
    yearSelect: [moment().get('year')-65, moment().get('year')],
		format: 'DD.MM.YYYY',
		autoClose: true,
		singleDate : true,
		showShortcuts: false,
		singleMonth: true
	}).bind('datepicker-change',function(event,obj){
		$("#date3").val(obj.value);
	});
	$('#birth_date_4').dateRangePicker({
		monthSelect: true,
    yearSelect: [moment().get('year')-65, moment().get('year')],
		format: 'DD.MM.YYYY',
		autoClose: true,
		singleDate : true,
		showShortcuts: false,
		singleMonth: true
	}).bind('datepicker-change',function(event,obj){
		$("#date4").val(obj.value);
	});

	//Коригуючі коефіцієнти в залежності від кількості Застрахованих осіб
	function change_datebirth(count){
		for(var i = 4; i > count; i--){
			document.getElementById("date"+i).value = mydayteminus30;
			document.getElementById("birth_date_"+i).value = mydayteminus30;
		}
	}
	/**
	 * [onclick: - меняет видимость полей для заполнения в зависимочти от количества туристов
	 * 			 - меняет параметр required полей необходимых для заполнения
	 * 			 - устанавливает значения коефициента K5 при изменении количества туристов]
	 */
	document.getElementById("tourists").onclick = function() {

		tourists = document.getElementById("tourists").value;
		change_datebirth(tourists);
		K4_2_div = document.getElementById("K4_2_div");
		K4_3_div = document.getElementById("K4_3_div");
		K4_4_div = document.getElementById("K4_4_div");
		person2 = document.getElementById("person2");
		person3 = document.getElementById("person3");
		person4 = document.getElementById("person4");

		var required2 = document.getElementsByClassName("required2");
		var required3 = document.getElementsByClassName("required3");
		var required4 = document.getElementsByClassName("required4");

		if (tourists == 1) {
			K4_2_div.style.display = "none";
			K4_3_div.style.display = "none";
			K4_4_div.style.display = "none";

			person2.style.display = "none";
			person3.style.display = "none";
			person4.style.display = "none";

			for (var i = 0; i < required2.length; i++) {
				required2[i].required = false;
				required3[i].required = false;
				required4[i].required = false;
			}
		}
		if (tourists == 2) {
			K4_2_div.style.display = "inline-block";
			K4_3_div.style.display = "none";
			K4_4_div.style.display = "none";

			person2.style.display = "inline-block";
			person3.style.display = "none";;
			person4.style.display = "none";
			// document.getElementById("birth_date_2").value = "1987-01-01";
			// document.getElementById("date2").value = document.getElementById("birth_date_2").value;
			for (var i = 0; i < required2.length; i++) {
				required2[i].required = true;
				required3[i].required = false;
				required4[i].required = false;
			}
		}
		if (tourists == 3) {
			K4_2_div.style.display = "inline-block";
			K4_3_div.style.display = "inline-block";
			K4_4_div.style.display = "none";

			person2.style.display = "inline-block";
			person3.style.display = "inline-block";
			person4.style.display = "none";
			// document.getElementById("birth_date_3").value = "1987-01-01";
			// document.getElementById("date3").value = document.getElementById("birth_date_3").value;
			for (var i = 0; i < required2.length; i++) {
				required2[i].required = true;
				required3[i].required = true;
				required4[i].required = false;
			}
		}
		if (tourists == 4) {
			K4_2_div.style.display = "inline-block";
			K4_3_div.style.display = "inline-block";
			K4_4_div.style.display = "inline-block";

			person2.style.display = "inline-block";
			person3.style.display = "inline-block";
			person4.style.display = "inline-block";
	        // document.getElementById("birth_date_4").value = "1987-01-01";
	        // document.getElementById("date4").value = document.getElementById("birth_date_4").value;
			for (var i = 0; i < required2.length; i++) {
				required2[i].required = true;
				required3[i].required = true;
				required4[i].required = true;
			}
		}

		if (tourists < 3) {
			K5 = K5_factor[0];
		}
		if (tourists > 2 && tourists < 11) {
			K5 = K5_factor[1];
		}
		if (tourists > 10 && tourists < 21) {
			K5 = K5_factor[2];
		}
		if (tourists > 20 && tourists < 51) {
			K5 = K5_factor[3];
		}
		if (tourists > 50) {
			K5 = K5_factor[4];
		}
		countSPzag();
	}
	//Получение курса валюты на текущую дату
	//Валюта Страхової суми
	document.getElementById("insCur").onchange = function() {
		currency = document.getElementById("insCur").value;
		document.getElementById("currency").innerHTML = " " + currency;
		countSPzag();
	}

	/**
	 * [culculate_birthdate вычисляет возраст]
	 * @param  {[date]} value [дата рождения]
	 * @return {[int]} [возраст(количество лет от даты рождения)]
	 */
	function culculate_birthdate(value){
		var date_birth = new Date(value);
		var date = new Date();
		var years = date.getFullYear() - date_birth.getFullYear();
		return years;
	}
	//Коригуючі коефіцієнти в залежності
	//від віку Застрахованих осіб:(K4)
	var K4_div = document.getElementById("K4_div").getElementsByTagName("input");
	for (var i = 0; i < K4_div.length; i++) {
		K4_div[i].onchange = function(){
			years = culculate_birthdate(this.value);
			var rate;
			if ((years > 0 && years < 4)||(years > 59 && years < 66)) {
				rate = 1.5;
			}else if (years > 65 && years < 76) {
				rate = 2;
			}else{
				rate = 1;
			}
// код Кости---------------------------------------------------------------------------------------
			// if(this.id == "birth_date_1"){
			// 	K4_1 = rate;
			// 	if(document.getElementById("strah_flag").value == 0){
			// 		document.getElementById("date0").value = this.value;
			// 	}else{
			// 		document.getElementById("date1").value = this.value;
			// 	}
			// }

			// if(this.id == "birth_date_2"){
			// 	K4_2 = rate;
			// 	document.getElementById("date2").value = this.value;
			// }
			// if(this.id == "birth_date_3"){
			// 	K4_3 = rate;
			// 	document.getElementById("date3").value = this.value;
			// }
			// if(this.id == "birth_date_4"){
			// 	K4_4 = rate;
			// 	document.getElementById("date4").value = this.value;
			// }
//-----------------------------------------------
			countSPzag();
		}
	}

	//Страхова сума
	document.getElementById("insSum").onchange = function() {
		insSum = document.getElementById("insSum").value;
		countSPzag();
	}
	//Коефіцієнти програми страхування (Кпр)
	document.getElementById("Kpr").onchange = function() {
		Kpr = document.getElementById("Kpr").value;
		countSPzag();
	}
	//Коефіцієнти безумовної франшизи (Кфр)
	document.getElementById("Kfr").onchange = function() {
		Kfr = document.getElementById("Kfr").value;
		countSPzag();
	}
	/**
	 устанавливает датой начала действия договора текущую дату
	 */
	// document.getElementById("dateStart").value = today;
	// document.getElementById("dateStart").setAttribute("min", koss_increase(0,new Date(),0,0, true));

	var nowTemp = new Date();
	var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate() + 1, 0, 0, 0, 0);
	var $ = jQuery.noConflict();
	var mydaymate = new Date();
	mydaymate.setDate(mydaymate.getDate() + 1);


	$('#two-inputs').dateRangePicker({
		format: 'DD.MM.YYYY',
		startDate: now,
		selectForward: true,
		minDays: 1,
		maxDays: 366,
		getValue: function(){
			if ($('#dateStarted').val() && $('#dateStoped').val() )
				return $('#dateStarted').val() + $('#dateStoped').val();
			else
				return '';
		},
		setValue: function(s,s1,s2){
			$('#dateStarted').val(s1);
			$('#dateStoped').val(s2);
		}
	}).bind('datepicker-apply',function(event,obj){
		var result = (obj.date2 - obj.date1)/1000/60/60/24 + 1;
		days = Math.round(result);
		days30 = days;


		console.log("daysdays" + days + " days30days30 " + days30);
		document.getElementById("days_php").value = days30; // koss 23/01/2018
		console.log ("datepicker document.getElementById(days_php).value " + document.getElementById("days_php").value);
			countSPzag();
	});
	var date = new Date();

	var day = date.getDate() + 1;
	var month = date.getMonth() + 1;
	var year = date.getFullYear();

	if (month < 10) month = "0" + month;
	if (day < 10) day = "0" + day;

	var today = day + "." + month + "." + year;
	var mydays30 = new Date();
	var myday = mydays30.setDate(mydays30.getDate() + days30);
	var mymonth = (mydays30.getMonth()+1);
	var myyear = mydays30.getFullYear();
	var now30days = Math.round(mydays30.getDate());
		console.log("now30daysnow30days" + now30days);
	if (mymonth < 10) mymonth = "0" + mymonth;
	if (now30days < 10) now30days = "0" + now30days;
	var my30days = now30days + "." + mymonth + "." + myyear;


	var days90 = 90;

	var mydays90 = new Date();
	var my90day = mydays90.setDate(mydays90.getDate() + days90);
	var my90month = (mydays90.getMonth()+1);
	var my90year = mydays90.getFullYear();
	var now90days = Math.round(mydays90.getDate());
		console.log("now90daysnow90days" + now90days);
	if (my90month < 10) my90month = "0" + my90month;
	if (my90day < 10) my90day = "0" + my90day;
	var my90days = now90days + "." + my90month + "." + my90year;

	document.getElementById('dateStarted').value = today;
	document.getElementById('dateStoped').value = my30days;

	document.getElementById('dateStart').value = today;
	document.getElementById('dateStop').value = my90days;



		set_day_end();
		$('#dateStart').dateRangePicker({
		startDate: now,
		monthSelect: true,
		yearSelect: [moment().get('year')-65, moment().get('year')],
		monthSelect: true,
		format: 'DD.MM.YYYY',
		autoClose: true,
		singleDate : true,
		showShortcuts: false,
		singleMonth: true,
		// getValue: function()	{
		// 	return $(this).val();
		// },
		// setValue: function(s)	{
		// 	if(!$(this).attr('readonly') && !$(this).is(':disabled') && s != $(this).val())
		// 	{
		// 		$(this).val(s);
		// 	}
		// }
	}).bind('datepicker-first-date-selected', function(event, obj){
	// console.log("dayenddayend " + dayend);
	// var result = obj.date1 + parseInt(dayend);
	// console.log("resultresult " + result);
		mydaymate = obj.date1;

		set_day_end();
	// countSPzag();
	});
	//функция увеличивает на произвольный год, дни, или месяцы переданное значение и аргументы

	function koss_increase(year,val,mes, dayz, inv){

		var maxdateyear = new Date(val);
  		maxdateyear.setDate(maxdateyear.getDate() + dayz);

		monthplusone = maxdateyear.getMonth() + 1;
		dayplusone = maxdateyear.getDate();


		//название через год условно и дебильно потому что функция универсальные, а названия старые. 
		//В данном случае оно формирует новую дату на основании переданных параметров и даже инверсирует.			

		cherezgod = ((dayplusone <10 )? '0'+ dayplusone : dayplusone)+'.'+  (( monthplusone <10 ) ? '0'+ monthplusone: monthplusone) +'.'+ maxdateyear.getFullYear();

		inversegod = maxdateyear.getFullYear() +'-'+((monthplusone <10) ? '0'+ monthplusone: monthplusone) +'-'+((dayplusone<10)? '0'+dayplusone : dayplusone);

		if (inv) {

			return inversegod;
		}else {

			return cherezgod;
		}
	}
	/**
		при изменении територоии действия полиса: - устанавливает выбор(подсветку)
												  - устанавливает значение коэффициента Kter
												  - пересчитывает общую сумму полиса
	 */
	var kter_div = document.getElementById("kter_div");
	for(var i = 0; i < kter_div.childNodes.length; i++){
		kter_div.childNodes[i].onclick = function(){
			change_background(this);
			Kter = this.value;
			document.getElementById("Kter_post").value = Kter;
			countSPzag();
		}
	}
	//Дата початку договору
	document.getElementById("dateStart").onchange = function() {

		var dateStart = document.getElementById("dateStart").value;
		//set_min_max_period("dateStop",dateStart, koss_increase(0,dateStart,0, 30 , true)); 	
		set_min_max_period("dateStop",now, koss_increase(0,now,0, 366 , true)); 
		// Функция set_min_max_period устанавливает в элементе с "dateStop" значения мин
		// как dateStart, а max берет от dateStart + 366 дней, true влияет на отображение гггг-мм-дд и наоборот


		var diff = new Date(dateStop) - new Date(dateStart);
		var days = diff/1000/60/60/24 + 1;
		//update 03.11.17 start
		if (flag == 1) {
			set_day_end();
		}
		//update 03.11.17 end
		countSPzag();
	}
	//Дата кінця договору та кількість днів
	document.getElementById("dateStop").onchange = function() {
		var dateStop = document.getElementById("dateStop").value;
		console.log(dateStop);
		var diff = new Date(dateStop) - new Date(dateStart);
		days = diff/1000/60/60/24 + 1;
		countSPzag();
	}
	//Базові страхові платежі з комплексного страхування під час перебуванням за
	//кордоном (СПб)
	function countSPb() {
		if (insSum == 30000) {
			if (flag == 1) {
				if (multi_visa_period == 1) {
					SPb = insurancePaymentForOneDay_muliTrip[1][0];
					document.getElementById("SPb").value = SPb;
				}
				if (multi_visa_period == 2) {
					SPb = insurancePaymentForOneDay_muliTrip[1][1];
					document.getElementById("SPb").value = SPb;
				}
				if (multi_visa_period == 3) {
					SPb = insurancePaymentForOneDay_muliTrip[1][2];
					document.getElementById("SPb").value = SPb;
				}
				if (multi_visa_period == 4) {
					SPb = insurancePaymentForOneDay_muliTrip[1][3];
					document.getElementById("SPb").value = SPb;
				}
				if (multi_visa_period == 5) {
					SPb = insurancePaymentForOneDay_muliTrip[1][4];
					document.getElementById("SPb").value = SPb;
				}
				if (multi_visa_period == 6) {
					SPb = insurancePaymentForOneDay_muliTrip[1][5];
					document.getElementById("SPb").value = SPb;
				}
				if (multi_visa_period == 7) {
					SPb = insurancePaymentForOneDay_muliTrip[1][6];
					document.getElementById("SPb").value = SPb;
				}
				if (multi_visa_period == 8) {
					SPb = insurancePaymentForOneDay_muliTrip[1][7];
					document.getElementById("SPb").value = SPb;
				}
				if (multi_visa_period == 9) {
					SPb = insurancePaymentForOneDay_muliTrip[1][8];
					document.getElementById("SPb").value = SPb;
				}
			}else{
				if (days < 8) {
					SPb = insurancePaymentForOneDay_oneTrip[2][0];
					document.getElementById("SPb").value = SPb;
				}
				if (days > 8 && days < 16) {
					SPb = insurancePaymentForOneDay_oneTrip[2][1];
					document.getElementById("SPb").value = SPb;
				}
				if (days > 15 && days < 31) {
					SPb = insurancePaymentForOneDay_oneTrip[2][2];
					document.getElementById("SPb").value = SPb;
				}
				if (days > 30 && days < 91) {
					SPb = insurancePaymentForOneDay_oneTrip[2][3];
					document.getElementById("SPb").value = SPb;
				}
				if (days > 90 && days < 181) {
					SPb = insurancePaymentForOneDay_oneTrip[2][4];
					document.getElementById("SPb").value = SPb;
				}
				if (days > 180 && days < 367) {
					SPb = insurancePaymentForOneDay_oneTrip[2][5];
					document.getElementById("SPb").value = SPb;
				}
			}
		}else if (insSum == 15000) {
			if (flag == 1) {
				if (multi_visa_period == 1) {
					SPb = insurancePaymentForOneDay_muliTrip[0][0];
					document.getElementById("SPb").value = SPb;
				}
				if (multi_visa_period == 2) {
					SPb = insurancePaymentForOneDay_muliTrip[0][1];
					document.getElementById("SPb").value = SPb;
				}
				if (multi_visa_period == 3) {
					SPb = insurancePaymentForOneDay_muliTrip[0][2];
					document.getElementById("SPb").value = SPb;
				}
				if (multi_visa_period == 4) {
					SPb = insurancePaymentForOneDay_muliTrip[0][3];
					document.getElementById("SPb").value = SPb;
				}
				if (multi_visa_period == 5) {
					SPb = insurancePaymentForOneDay_muliTrip[0][4];
					document.getElementById("SPb").value = SPb;
				}
				if (multi_visa_period == 6) {
					SPb = insurancePaymentForOneDay_muliTrip[0][5];
					document.getElementById("SPb").value = SPb;
				}
				if (multi_visa_period == 7) {
					SPb = insurancePaymentForOneDay_muliTrip[0][6];
					document.getElementById("SPb").value = SPb;
				}
				if (multi_visa_period == 8) {
					SPb = insurancePaymentForOneDay_muliTrip[0][7];
					document.getElementById("SPb").value = SPb;
				}
				if (multi_visa_period == 9) {
					SPb = insurancePaymentForOneDay_muliTrip[0][8];
					document.getElementById("SPb").value = SPb;
				}
			}else {
				if (days < 8) {
					SPb = insurancePaymentForOneDay_oneTrip[1][0];
					document.getElementById("SPb").value = SPb;
				}
				if (days > 8 && days < 16) {
					SPb = insurancePaymentForOneDay_oneTrip[1][1];
					document.getElementById("SPb").value = SPb;
				}
				if (days > 15 && days < 31) {
					SPb = insurancePaymentForOneDay_oneTrip[1][2];
					document.getElementById("SPb").value = SPb;
				}
				if (days > 30 && days < 91) {
					SPb = insurancePaymentForOneDay_oneTrip[1][3];
					document.getElementById("SPb").value = SPb;
				}
				if (days > 90 && days < 181) {
					SPb = insurancePaymentForOneDay_oneTrip[1][4];
					document.getElementById("SPb").value = SPb;
				}
				if (days > 180 && days < 367) {
					SPb = insurancePaymentForOneDay_oneTrip[1][5];
					document.getElementById("SPb").value = SPb;
				}
			}
		} else {
			if (days < 8) {
				SPb = insurancePaymentForOneDay_oneTrip[0][0];
				document.getElementById("SPb").value = SPb;
			}
			if (days > 8 && days < 16) {
				SPb = insurancePaymentForOneDay_oneTrip[0][1];
				document.getElementById("SPb").value = SPb;
			}
			if (days > 15 && days < 31) {
				SPb = insurancePaymentForOneDay_oneTrip[0][2];
				document.getElementById("SPb").value = SPb;
			}
			if (days > 30 && days < 91) {
				SPb = insurancePaymentForOneDay_oneTrip[0][3];
				document.getElementById("SPb").value = SPb;
			}
			if (days > 90 && days < 181) {
				SPb = insurancePaymentForOneDay_oneTrip[0][4];
				document.getElementById("SPb").value = SPb;
			}
			if (days > 180 && days < 367) {
				SPb = insurancePaymentForOneDay_oneTrip[0][5];
				document.getElementById("SPb").value = SPb;
			}
		}
	}
	//Базові страхові платежі з добровільного страхування від нещасних випадків(СПб)
	function countSPb_accident() {
		if (flag_acc == 0) {
			if (days < 8) {
				SPb_accident = insurancePaymentForOneDay_oneTrip_acc[0];
				document.getElementById("SPb_accident").value = SPb_accident;
			}
			if (days > 8 && days < 16) {
				SPb_accident = insurancePaymentForOneDay_oneTrip_acc[1];
				document.getElementById("SPb_accident").value = SPb_accident;
			}
			if (days > 15 && days < 31) {
				SPb_accident = insurancePaymentForOneDay_oneTrip_acc[2];
				document.getElementById("SPb_accident").value = SPb_accident;
			}
			if (days > 30 && days < 91) {
				SPb_accident = insurancePaymentForOneDay_oneTrip_acc[3];
				document.getElementById("SPb_accident").value = SPb_accident;
			}
			if (days > 90 && days < 181) {
				SPb_accident = insurancePaymentForOneDay_oneTrip_acc[4];
				document.getElementById("SPb_accident").value = SPb_accident;
			}
			if (days > 180 && days < 367) {
				SPb_accident = insurancePaymentForOneDay_oneTrip_acc[5];
				document.getElementById("SPb_accident").value = SPb_accident;
			}
		} else {
			if (multi_visa_period == 1) {
				SPb_accident = insurancePaymentForOneDay_muliTrip_acc[0];
				document.getElementById("SPb_accident").value = SPb_accident;
			}
			if (multi_visa_period == 2) {
				SPb_accident = insurancePaymentForOneDay_muliTrip_acc[1];
				document.getElementById("SPb_accident").value = SPb_accident;
			}
			if (multi_visa_period == 3) {
				SPb_accident = insurancePaymentForOneDay_muliTrip_acc[2];
				document.getElementById("SPb_accident").value = SPb_accident;
			}
			if (multi_visa_period == 4) {
				SPb_accident = insurancePaymentForOneDay_muliTrip_acc[3];
				document.getElementById("SPb_accident").value = SPb_accident;
			}
			if (multi_visa_period == 5) {
				SPb_accident = insurancePaymentForOneDay_muliTrip_acc[4];
				document.getElementById("SPb_accident").value = SPb_accident;
			}
			if (multi_visa_period == 6) {
				SPb_accident = insurancePaymentForOneDay_muliTrip_acc[5];
				document.getElementById("SPb_accident").value = SPb_accident;
			}
			if (multi_visa_period == 7) {
				SPb_accident = insurancePaymentForOneDay_muliTrip_acc[6];
				document.getElementById("SPb_accident").value = SPb_accident;
			}
			if (multi_visa_period == 8) {
				SPb_accident = insurancePaymentForOneDay_muliTrip_acc[7];
				document.getElementById("SPb_accident").value = SPb_accident;
			}
			if (multi_visa_period == 9) {
				SPb_accident = insurancePaymentForOneDay_muliTrip_acc[8];
				document.getElementById("SPb_accident").value = SPb_accident;
			}
		}
	}
	//Мультивіза
	/*Если поставить галку "Мультивіза":
	1 - появляется select с выбором "Термін дії Договору/строк дії Договору";
	2 - пропадает значение 10000 в select "Розмір страхової суми"(id="multi");
	3 - устанавливается flag = 1, для пересчета коефициентов для мультивизы;
	4 - Если убрать галку "Мультивіза", пропадает select с выбором "Термін дії Договору/строк дії Договору",
		устанавливается flag = 0, для пересчета коефициентов для одноразовой визы,
		появляется значение 10000 в select "Розмір страхової суми"(id="multi")
	*/
	/**
	 * [koss_disable меняет параметр disabled переданного элемента]
	 * @param  {[type]} element [элемент которому нужно поменять параметр disabled]
	 */
	function koss_disable(element){
		var el = document.getElementById(element);
		el.disabled = (el.disabled == true) ? false : true;

	//	return el.disabled;

		//update 03.11.17 start
		//var val = document.getElementById("dateStart").value;
		////update 03.11.17 end
		//document.getElementById("dateStop").value = koss_increase(0,val,0, 30, true);
	}
	/**
	 * [set_day_end устанавливает дату окончания поездки при выборе мульти визы]
	 * return [int] days - при выборе режима мультивизы days всегда давно 1 для правильного расчета общей суммы полиса
	 */
	function set_day_end(){
		var multi_visa_option = document.getElementById('multi_visa_period');
		var selectedIndex = multi_visa_option.selectedIndex;

		if(selectedIndex != -1) {
			var selectedOption = multi_visa_option.options[selectedIndex];
			var optionInnerHtml = selectedOption.innerHTML;
			dayend = optionInnerHtml.substr(optionInnerHtml.indexOf("/")+1, optionInnerHtml.length);
			daylast= optionInnerHtml.substr(0 ,optionInnerHtml.indexOf("/") );

			// var dateStart_val = document.getElementById("dateStart").value;
			document.getElementById("dateStop").value = koss_increase(0,mydaymate,0, parseInt(dayend) , false)  ;
			console.log('mydaymate ' + mydaymate);
			console.log ("document.getElementById(dateStop).value " + document.getElementById("dateStop").value);
			//document.getElementById("dateStop_php").value = koss_increase(0,dateStart_val,0, parseInt(dayend) , true) ;
			//update 03.11.17 start
			//days = dayend;
			console.log("dayend " + dayend);

			days = 1;
			document.getElementById("days_php").value = dayend;
			//update 03.11.17 end

			console.log ("set_days-end document.getElementById(days_php).value "+ document.getElementById("days_php").value);
			return days;
		}
	}
	/**
	 * [onclick переключает на режим расчета одноразовой поездки]
	 */
	document.getElementById("onetime_visa").onclick = function() {
		if (flag == 1) {
			change_background(document.getElementById("onetime_visa"))
			document.getElementById("multi_visa_period_hidden").style.display = "none";
			document.getElementById("two-inputs").style.display = "block";
			document.getElementById("firstdate").style.display = "none";
			koss_disable("dateStop");
			document.getElementById("multi").disabled = false;
			insSum = document.getElementById("insSum").value;
	    	flag = 0;

	//		set_min_max_period("dateStop",document.getElementById("dateStart").value, koss_increase(0,dateStart,0, 366 , true));
		 //update 03.11.17 start
	//		document.getElementById("dateStop").value = koss_increase(0, new Date(),0,30, true);
	//document.getElementById('dateStarted').value = today;
	//document.getElementById('dateStoped').value = my30days;
			//console.log ("new Date(document.getElementById('birth_date_1').value) "+ new Date(document.getElementById('birth_date_1').value) );
	/*		var diff = new Date(my30days) - new Date(today);

			console.log("diff = " + diff);
			days = diff/1000/60/60/24 + 1 ;
			console.log("days = " + days);*/
			days = days30;
			document.getElementById("days_php").value = days; // koss 23/01/2018

			countSPzag();
		 //update 03.11.17 end
	    }
	}
	/**
	 * [onclick переключает на режим расчета многоразовой поездки]
	 */
	document.getElementById("multi_visa").onclick = function() {
		if (flag == 0) {
			change_background(document.getElementById("multi_visa"))
			document.getElementById("multi_visa_period_hidden").style.display = "block";
			document.getElementById("two-inputs").style.display = "none";
			document.getElementById("firstdate").style.display = "block";
			koss_disable("dateStoped");
			flag = 1;
	    	//2
	    	document.getElementById("multi").disabled = true;
	    	if (document.getElementById("insSum").value == 10000) {
	    		document.getElementById("insSum").value = insSum_selected;
	    		insSum = insSum_selected;
	    	}
	    	//3
	    	set_day_end();
	    	countSPzag();
	    	document.getElementById("multi_visa_period").onchange = function() {
	    	    multi_visa_period = document.getElementById("multi_visa_period").value;
				set_day_end();
				countSPzag();
	    	}
	    }
	}
	//Виконання небезпечної роботи
	/*Если поставить галку "Виконання небезпечної роботи",
	появляется select с выбором "Групи ризику в залежності від виду діяльності"
	и идет пересчет согласно выбранному пункту,
	а если убрать галку все значения возвращаются на значения по умолчанию
	и идет соответсвующий перерасчет
	*/

	/**
	 * [change_background меняет фон выбранного элемента]
	 * @param  {[type]} obj [элемент которому необходимо поменять фон]
	 */
	function change_background(obj){
		var x = obj.parentNode;
			var y = x.querySelectorAll("button");
			for (var i = 0; i < y.length; i++) {
				y[i].classList.remove("koss-background","active");
			}
			obj.classList.add("koss-background");
	}

	/**
	 * [onclick меняет значение коэффициента К1]
	 */
	var K1_flag = 0;
	var K1_div = document.getElementById("K1_div");
	document.getElementById("K1").onclick = function() {
		 if(K1_flag == 0){
		  	K1_flag = 1;
		  	for(var i = 0; i < K1_div.childNodes.length; i++){
				K1_div.childNodes[i].onclick = function(){
				change_background(this);
				K1 = this.value;
				document.getElementById("post_k1").value = K1;
				countSPzag();
				}
			}
		}else{
	        K1 = 1;
	        K1_flag = 0;
	        countSPzag();
	    }
	}
	//Непрофесійний спорт
	/*Если поставить галку "Зайняття масовим непрофесійним спортом або звичайне зайняття активним відпочинком",
	появляется select с выбором "Групи ризику в залежності від виду спорту"
	и идет пересчет согласно выбранному пункту,
	а если убрать галку все значения возвращаются на значения по умолчанию
	и идет соответсвующий перерасчет
	*/

	var K2_flag = 0;
	var K2_div = document.getElementById("K2_div");
	document.getElementById("K2").onclick = function() {
		 if(K2_flag == 0){
		  	K2_flag = 1;
		  	for(var i = 0; i < K2_div.childNodes.length; i++){
				K2_div.childNodes[i].onclick = function(){
				change_background(this);
				K2 = this.value;
				countSPzag();
				}
			}
		}else{
	        K2 = 1;
	        K2_flag = 0;
	        countSPzag();
	    }
	}
  	//Професійний спорт
  	/*Если поставить галку "Зайняття професійним спортом, а також масовим спортом на період проведення змагань",
	появляется select с выбором "Групи ризику в залежності від виду спорту"
	и идет пересчет согласно выбранному пункту,
	а если убрать галку все значения возвращаются на значения по умолчанию
	и идет соответсвующий перерасчет
	*/
	var K3_flag = 0;
	var K3_div = document.getElementById("K3_div");
	document.getElementById("K3").onclick = function() {
		 if(K3_flag == 0){
		  	K3_flag = 1;
		  	for(var i = 0; i < K3_div.childNodes.length; i++){
				K3_div.childNodes[i].onclick = function(){
				change_background(this);
				K3 = this.value;
				countSPzag();
				}
			}
		}else{
	        K3 = 1;
	        K3_flag = 0;
	        countSPzag();
	    }
	}

	//ДОБРОВІЛЬНЕ СТРАХУВАННЯ ВІД НЕЩАСНИХ ВИПАДКІВ
	/*Если поставить галку "Добровільне страхування від нещасних випадків",
	появляется select с выбором "Добровільне страхування від нещасних випадків"
	и идет посчет согласно выбранному пункту и соответсвующей функции,
	а если убрать галку все значения возвращаются на значения по умолчанию
	и идет соответсвующий перерасчет;
	*/
	document.getElementById("accident").onclick = function() {
		 if(flag_acc == 0){
	   		flag_acc = 1;
	        	countSPzag();
	   		document.getElementById("SSnv").onchange = function() {
	        	SSnv = document.getElementById("SSnv").value;
	        	document.getElementById("SSnv_php").value = SSnv;
			countSPzag();
	        }
		}else{
	        	flag_acc = 0;
	        	SSnv = 0;
	        	document.getElementById("SSnv_php").value = SSnv;
	        	countSPzag();
	    		setTimeout(function(){
	    				   		document.getElementById('SSnv').getElementsByTagName('option')[0].selected = 'selected'
	    				    }, 100);
	    }
	}
	/*Страховий платіж (СПтр) з комплексного страхування під час
	перебуванням зкордоном відповідно до обраної Опції (програми страхування), грн*/
	function countSPtr() {
		if (currency == "USD") {
			rate = usd;
		}else{
			rate = eur;
		}
		countSPb();
		var Sptr_ret = 0;
		for (var i = 0; i < tourists; i++) {
			var K4;
			if (i == 0) {
				K4 = K4_1;
			}
			if (i == 1) {
				K4 = K4_2;
			}
			if (i == 2) {
				K4 = K4_3;
			}
			if (i == 3) {
				K4 = K4_4;
			}
			Sptr_ret += SPb*days*Kpr*Kfr*Kter*K1*K2*K3*K4*K5*rate*Kkv;
		}
		SPtr = Sptr_ret;
	}
	/*Страховий платіж (СПнв) з добровільного страхуванням від нещасних випадків, грн.*/
	function countSPnv(){
		countSPb_accident();
		var Spnv_ret = 0;
		for (var i = 0; i < tourists; i++) {
			var K4;
			if (i == 0) {
				K4 = K4_1;
			}
			if (i == 1) {
				K4 = K4_2;
			}
			if (i == 2) {
				K4 = K4_3;
			}
			if (i == 3) {
				K4 = K4_4;
			}
			Spnv_ret += SSnv*SPb_accident*K1*K2*K3*K4*K5*Kkv;
		}
		SPnv = Spnv_ret;
	}
	//Розрахунок загального страхового платежу за Міжнародним договоро
	//добровільного комплексного страхування під час перебування за кордоном
	function countSPzag() {
		countSPtr();
		countSPnv();
		SPzag = SPtr + SPnv;
		if (!SPzag) {
			document.getElementById("sum").innerHTML = "0,00 &#8372;";
		}else{
			SPzag = SPzag.toFixed(2);
			document.getElementById("sum").innerHTML = SPzag + " &#8372;";
			document.getElementById("SPzag").value = SPzag;
			document.getElementById("SPtr").value = SPtr.toFixed(2);
			document.getElementById("SPnv").value = SPnv;
			console.log("CounTpzag document.getElementById(days_php).value "+ document.getElementById("days_php").value);
			//document.getElementById("days_php").value = days;
		}	
	}



	//Проверка согласия с правилами сервиса
		document.getElementById("myCheck").onchange = function enbldsblbtn(){
				var $ = jQuery.noConflict();
				var isExpanded = $('#personal_data_hidden').hasClass('in');

				//	console.log(" document.getElementById(continue).disabled " + document.getElementById("continue").disabled)
				//	console.log("isExpanded pre if " + isExpanded);

				if( isExpanded == false)
					{

						koss_disable("continue");
						document.getElementById("continue").click();

						var zastrahdate = document.getElementById("birth_date_1").value;
						document.getElementById("date0").value = zastrahdate;

					}
				else {
					console.log("isExpanded else" + isExpanded);
					if (!document.getElementById("continue").disabled)
					{

						document.getElementById("continue").click();
						koss_disable("continue");
					}
				}
		}
	//Кнопка для отображения формы личных данных
	document.getElementById("continue").onclick = function clickbtn() {


	 /*
		document.getElementById("date0").value = document.getElementById("birth_date_1").value;
		document.getElementById("date2").value = document.getElementById("birth_date_2").value;
		document.getElementById("date3").value = document.getElementById("birth_date_3").value;
		document.getElementById("date4").value = document.getElementById("birth_date_4").value;
	*/
	//Скролим туда-сюда
		var $ = jQuery.noConflict();

		if (flag_scroll == 0) {

			$.scrollTo("#continue", 800, {easing:'swing'});
			flag_scroll = null;
		}else {

			$.scrollTo("#Kpr", 800, {easing:'swing'});
			flag_scroll = 0;
		}

		var person1 = document.getElementById("person1").getElementsByTagName("input");
		var strah = document.getElementById("strah").getElementsByTagName("input");

		document.getElementById("strah_check").onchange = function() {

			for (var i = 0; i < person1.length-1; i++) {
					person1[i].value = "";
					//person1[i].required = true;
					person1[i].required = (person1[i].required == true) ? false : true;
					//var required1 = document.getElementsByClassName("required1");
					/*for (var i = 0; i < required1.length; i++) {
						required1[i].required = true;
					}*/
				}
				person1[3].required = false;


			if(document.getElementById("strah_check").checked){



				document.getElementById("person1").style.display = "inline-block";
				document.getElementById("h3").innerHTML = "Страхувальник";
				// document.getElementById("date0").value = "";


				document.getElementById("date1").value = document.getElementById("birth_date_1").value;

				countSPzag();


				document.getElementById("strah_flag").value = 1;
				document.getElementById("paddingid").classList.remove("padding");
			}else{
				document.getElementById("date0").value = document.getElementById("birth_date_1").value;
				document.getElementById("person1").style.display = "none";
				document.getElementById("h3").innerHTML = "Страхувальник/Застрахована особа 1";

	    		document.getElementById("name1").value = document.getElementById("name0").value;
				document.getElementById("surname1").value = document.getElementById("surname0").value;
				var date0val = document.getElementById("date0").value;
				document.getElementById("date1").value = date0val;
				document.getElementById("pass1").value = document.getElementById("pass0").value;

				document.getElementById("strah_flag").value = 0;
				document.getElementById("paddingid").classList.add("padding");
			}
		}

		document.getElementById("date0").onchange = function() {
			if(document.getElementById("strah_flag").value == 0) {
				document.getElementById("birth_date_1").value = document.getElementById("date0").value;

			}
		}
		//номер телефона
		var tel_div = document.getElementById("personal_data").getElementsByClassName("tel");
		for (var i = 0; i < tel_div.length; i++) {
			tel_div[i].oninput = function(){
				var value = this.value;
				var id = this.id.substr(this.id.length - 1);

				var x = value.replace(/\D/g, "").match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
				value = !x[2] ? x[1] : "(" + x[1] + ") " + x[2] + (x[3] ? "-" + x[3] : "");
				document.getElementById("tel"+id).value = value;
			}
		}
		//Имя
		var name_div = document.getElementById("personal_data").getElementsByClassName("name");
		for (var i = 0; i < name_div.length; i++) {
			name_div[i].onkeyup = function(){
				var value = this.value;
				var id = this.id.substr(this.id.length - 1);
				
				
				
				if (!regName.test(value)) {
					document.getElementById("name"+id).setCustomValidity("Invalid field.");
					
					
					document.getElementById("name"+id+"_error").innerHTML = "Дозволені тільки латинські літери";
				}else{
					document.getElementById("name"+id).setCustomValidity('');
					document.getElementById("name"+id+"_error").innerHTML = "";
				}
			}
		}
		//Фамилия
		var surname_div = document.getElementById("personal_data").getElementsByClassName("surname");
		for (var i = 0; i < surname_div.length; i++) {
			surname_div[i].onkeyup = function(){
				var value = this.value;
				var id = this.id.substr(this.id.length - 1);

				if (!regName.test(value)) {
					document.getElementById("surname"+id).setCustomValidity("Invalid field.");
					document.getElementById("surname"+id+"_error").innerHTML = "Дозволені тільки латинські літери";
				}else{
					document.getElementById("surname"+id+"_error").innerHTML = "";
					document.getElementById("surname"+id).setCustomValidity("");
				}
			}
		}


		/*var K4_div = document.getElementById("K4_div").getElementsByTagName("input");
		for (var i = 0; i < K4_div.length; i++) {
		K4_div[i].onchange = function(){
			years = culculate_birthdate(this.value);
			var rate;
			if ((years > 0 && years < 4)||(years > 59 && years < 66)) {
				rate = 1.5;
			}else if (years > 65 && years < 76) {
				rate = 2;
			}else{
				rate = 1;
			}
			if(this.id == "birth_date_1"){
				K4_1 = rate;
				if(document.getElementById("strah_flag").value == 0){
					document.getElementById("date0").value = this.value;
				}else{
					document.getElementById("date1").value = this.value;
				}
			}
			if(this.id == "birth_date_2"){
				K4_2 = rate;
				document.getElementById("date2").value = this.value;
			}
			if(this.id == "birth_date_3"){
				K4_3 = rate;
				document.getElementById("date3").value = this.value;
			}
			if(this.id == "birth_date_4"){
				K4_4 = rate;
				document.getElementById("date4").value = this.value;
			}
			countSPzag();
		}
	}*/
		//Дата рождения
		var date_div = document.getElementById("personal_data").getElementsByClassName("date");
		for (var i = 0; i < date_div.length; i++) {
			date_div[i].onchange = function() {
				years = culculate_birthdate(this.value);
				var rate;
				if ((years > 0 && years < 4)||(years > 59 && years < 66)) {
					rate = 1.5;
				}else if (years > 65 && years < 76) {
					rate = 2;
				}else{
					rate = 1;
				}
				birth_date_1
				console.log(this.id);
				if(this.id == "date0"){
					if(document.getElementById("strah_flag").value == 0){
						document.getElementById("birth_date_1").value = this.value;
						K4_1 = rate;
					}
				}
				if(this.id == "date1"){
					if(document.getElementById("strah_flag").value == 1){
						document.getElementById("birth_date_1").value = this.value;
						K4_1 = rate;
					}
				}
				if(this.id == "date2"){
					K4_2 = rate;
					document.getElementById("birth_date_2").value = this.value;
				}
				if(this.id == "date3"){
					K4_3 = rate;
					document.getElementById("birth_date_3").value = this.value;
				}
				if(this.id == "date4"){
					K4_4 = rate;
					document.getElementById("birth_date_4").value = this.value;
				}
				countSPzag();
			}
		}
		//Серия та номер паспорта
		var pass_div = document.getElementById("personal_data").getElementsByClassName("pass_series");


		for (var i = 0; i < pass_div.length; i++) {
			pass_div[i].onkeyup = function(){
				var value = this.value;
				var id = this.id.substr(this.id.length - 1);
		///////////////////////////////////////////////
			var divparrent = this.parentNode;
			var checks = divparrent.querySelectorAll('input[type=checkbox]');

			//	console.log(checks[0].checked);




		//////////////////////////////////////////////
				if (!reg_pass.test(value) && !checks[0].checked) {
					document.getElementById("pass"+id+"_error").innerHTML = "Дві латинські літери та шість цифер";
				}else{
					document.getElementById("pass"+id+"_error").innerHTML = "";
				}
			}
		}
		//ІПН
		var inn_div = document.getElementById("personal_data").getElementsByClassName("inn");
		for (var i = 0; i < inn_div.length; i++) {
			inn_div[i].onkeyup = function(){
				var value = this.value;
				var id = this.id.substr(this.id.length - 1);
		////////////////////////////////////////////////////////////////
		var divparrent2 = this.parentNode.parentNode;
		var checks2 = divparrent2.querySelectorAll('input[type=checkbox]');

		console.log(checks2[0].checked);

		//////////////////////////////////////////////////////////////
				if (!regpass_inn.test(value) && !checks2[0].checked) {
					document.getElementById("inn"+id+"_error").innerHTML = "Десять цифер";

				}else{
					document.getElementById("inn"+id+"_error").innerHTML = "";
				}
			}
		}
	}

	//устанавливает какому-нибудь несчастному элементу мин и макс, элемент вызывать в кавычках
	function set_min_max_period(elemid,minidper,maxidper){
		document.getElementById(elemid).setAttribute("min", minidper);
		document.getElementById(elemid).setAttribute("max", maxidper);
	}

	// Кликает по кнопке чтобы первым выставить мультивизы
	function clicker() {
		document.getElementById("multi_visa").click();
		change_background(document.getElementById("multi_visa"));
	}
	clicker();

//////// Блок отработки флага резмден/нерезидент.
//Вначале выюираем все с резидент чеком.
		var checkbox = document.querySelectorAll(".rezident_check"), i;
//Циклом перебираем всех резидентов и савим отработку на изменение
		for (i = 0; i < checkbox.length; i++) {
				checkbox[i].onchange = function (){

// Выходим из дива дважды т.к. структура такая конченная
				var pass_ser_par = this.parentNode.parentNode;


				// console.log("pass_ser_par.getElementsByClassName('pass_series')[0].placeholder " + pass_ser_par.getElementsByClassName('pass_series')[0].placeholder);
				// console.log("pass_ser_par.getElementsByClassName('inn')[0].placeholder " + pass_ser_par.getElementsByClassName('inn')[0].placeholder);
//Вызываем функцию rezident, описание которой ниже
				rezident(pass_ser_par.getElementsByClassName('pass_series')[0],"AU123456");
				rezident(pass_ser_par.getElementsByClassName('inn')[0],"Введіть ІПН");

				}

			}

					// Функция, которая принимает аргументами айди, где плейсхолдер с которым работать и текст, который надо поставить если плейсхолдер пустой.	
					function rezident(elemchange,textholder){
					//console.log("elemchange.placeholder " + elemchange.placeholder);

					// (elemchange.hasAttribute("placeholder") == true) ? elemchange.removeAttribute("placeholder") : elemchange.placeholder = textholder;
					if (elemchange.hasAttribute("placeholder") == true)
					{
						elemchange.removeAttribute("placeholder");
						elemchange.maxLength +=2;
					}

					else
					{
						elemchange.placeholder = textholder;
						elemchange.maxLength -=2;
					}

				elemchange.value = "";
				elemchange.nextSibling.innerHTML = "";

			}
						/////////////////////// инициализация датапикера в калькуляторе

							$("#submit").on("click", function() {
								$('.preloader-but').css('opacity', '1');
								setTimeout(function() {
									$('.preloader-but').css('opacity', '0');
								}, 2000);
							});


//Юрыны потуги...     var rotate = document.createElement("button.rotate");
//////////////////////////////////////////////////
var createAllErrors = function() {
        var form = $( this ),
            errorList = $( "ul.errorMessages", form );

        var showAllErrorMessages = function() {
            errorList.empty();

            // Find all invalid fields within the form.
            var invalidFields = form.find( ":invalid" ).each( function( index, node ) {

                // Find the field's corresponding label
                var label = $( "label[for=" + node.id + "] "),
                    // Opera incorrectly does not fill the validationMessage property.
                    message = node.validationMessage || 'Invalid value.';

                errorList
                    .show()
                    .append( "<li><span>" + label.html() + "</span> " + message + "</li>" );
            });
        };



 $( "input[type=button]", form ).on( "click", showAllErrorMessages);

        $( "input", form ).on( "keypress", function( event ) {
            var type = $( this ).attr( "type" );
            if ( /date|email|month|number|search|tel|text|time|url|week/.test ( type )
              && event.keyCode == 13 ) {
                showAllErrorMessages();
            }
        });
    };
    
    $( "form" ).each( createAllErrors );


// Get the modal
var modal = document.getElementById('kmyModal');

// Get the button that opens the modal
var kmyBtn = document.getElementById("kmyBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("kclose")[0];

// When the user clicks the button, open the modal 
kmyBtn.onclick = function() {
	//Проверяет все ли поля с required заполнены 
	    $( "form" ).each( createAllErrors );
	if (!document.getElementById('calcform').checkValidity()){
		console.log("validationMessagevalidationMessage");
		
		//document.getElementsByClassName('kossdivnone').style.visibility = "visible";
	}
	else
	{
	
    modal.style.display = "block";
	
	calcrex();
	
	var seconds = 500,
	interval = setInterval(countDown, 1000);

	function countDown(){
        seconds--;
		//console.log ("seconds--seconds--" + seconds);
        $("#seconds").text(seconds);
        if (seconds === 0){
          //console.log ("seconds === 0 ");
          clearInterval(interval);
		  document.getElementById('submit').click();
        }
      } //end countDown
	}  // end else 

		
}
////////////////////



// When the user clicks on <span> (x), close the modal
span.onclick = closemodal;
document.getElementById('rexno').onclick = closemodal;

////Функция закрывает модалку и отправляет все на пхп
function closemodal() {
    modal.style.display = "none";
	document.getElementById('submit').click();
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
		document.getElementById('submit').click();
    }
}

///////////////////REX CALC///////////


function calcrex (){
//	if (flag = 1) console.log("flag = 1flag = 1");
//	else 
		console.log ("rexdays " + days);
		console.log ("flagflag " + flag);
		
		rexdays = document.getElementById('days_php').value
		console.log ("rexdays " + days);
		
		if (rexdays < 7)
		rex = 100;
		
		else if (rexdays >=7 && rexdays < 31) 
		rex = rexdays * 5;
		
		else if (rexdays >= 31 && rexdays < 90) 
		rex = rexdays * 3.5;
		
		else if (rexdays >= 90 && rexdays < 270)
		rex = rexdays * 2.5;
		
		else rex = rexdays * 1.7;
		
		console.log ("rexrex " + rex);
		document.getElementById('rexstart').innerHTML=document.getElementById('dateStart').value;
		document.getElementById('rexstop').innerHTML=document.getElementById('dateStop').value;
		document.getElementById('rexsum').innerHTML=rex;
		//document.getElementById('submit_hidden').click();
		
		document.getElementById('rexyes').onclick = function(){
			document.getElementById('post_rex').value = rex;
			modal.style.display = "none";
			document.getElementById('submit').click();
			}
	}
/////////////////REX


} // конец window onload
//////////////////////////////////////////////////////////////



//https://htmlacademy.ru/blog/95-form-validation-techniques
//https://www.tjvantoll.com/2012/08/05/html5-form-validation-showing-all-error-messages/