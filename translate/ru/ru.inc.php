<?php
$block['content'] = '
			
			<div id="insuranceCalculator">
			RURURURURURURURURURU	
				<form enctype="multipart/form-data" action="/sites/all/modules/travel/payment.php" method="post" >
					<div class="container butvisa">	
						<div class="my-btn-group" role="group">
							<button id="multi_visa" class="btn btn-info" type="button" data-toggle="button">
									Мультивіза
							</button>
							<button id="onetime_visa" class="btn btn-info" type="button" data-toggle="button">
									Одноразова подорож
							</button>
						</div>
					</div> 
					<br>
					<div class="container">
						<div class="row">
							<!--- <div class="col-sm-4" id="firstdate">
								<div class="col-sm-6">
									<label for="dateStart">Початок дії договору</label>	
									<input type="date" id="dateStart" name="dateStart" required class="form-control">
								</div>
								<div class="col-sm-6">
									<label for="dateStop">Кінець дії договору </label>	
									<input type="date" id="dateStop" name="dateStop" required class="form-control">
								</div>
							</div> --->
							<div class="col-sm-8 col-md-6 col-lg-4" id="firstdate">
								<div class="col-sm-6 pl0">
									<label for="dateStart">Початок дії договору</label>	
									<input id="dateStart" name="dateStart" required class="form-control" value="">
								</div>
								<div class="col-sm-6 pl0">
									<label for="dateStop">Кінець дії договору </label>	
									<input id="dateStop" name="dateStop" required class="form-control" value="">
								</div>
							</div>
							<div class="col-sm-4" id="two-inputs">
									<div class="col-sm-6 pl0">
										<label for="dateStart">Початок дії договору</label>	
										<input type="text" id="dateStarted" class="input-sm form-control" name="dateStart" />
									</div>
									<div class="col-sm-6 pl0">
										<label for="dateStop">Кінець дії договору </label>
										<input id="dateStoped" type="text" class="input-sm form-control" name="dateStop" />
									</div>
							</div>
			
							<div id="multi_visa_period_hidden">
								<div class="col-sm-11 col-md-4 kossnowrap">
									<label for="multi_visa_period" style="font-weight: 500;">
										Термін дії Договору/строк дії Договору
									</label>
									<select id="multi_visa_period" name="multi_visa_period" required class=" form-control">
									<!--	<option value="1">15/30</option> -->
										<option value="2" selected>15/90</option>
										<option value="3">30/90</option>
										<option value="4">60/180</option>
										<option value="5">90/180</option>
										<option value="6">30/365</option>
										<option value="7">60/365</option>
										<option value="8">90/365</option>
										<option value="9">180/365</option>
									</select>
								</div>
							</div>
						</div>
					</div>
			
					<div class="container">
						<div class="row">
							<div class="col-sm-6 col-md-2">
								<div div class="form-group">
									<label for="tourists">Кількість застрахованих осіб</label>
									<input id="tourists" class="form-control bfh-number" name="tourists" type="number" value="1" required onkeydown="return false" max="4" min="1">
								</div>
							</div>
						</div>
					</div>
					
					<div class="container" id="K4_div">
						<div class="row">
							<!--- <div class="col-sm-2">	
								<label for="K4">Рік народження застрохованої особи</label><br>
								<input type="date" id="birth_date_1" name="birth_date_1" class="form-control" value="1987-01-01">
							</div>
							<div class="col-sm-2" id="K4_2_div" style="display:none">
								<label for="K4_2">Рік народження 2-ї застрохованої особи</label><br>
								<input type="date" id="birth_date_2" name="birth_date_2" class="form-control" value="1987-01-01">
							</div>
							<div class="col-sm-2" id="K4_3_div" style="display:none">
								<label for="K4_3">Рік народження 3-ї застрохованої особи</label><br>
								<input type="date" id="birth_date_3" name="birth_date_3" class="form-control" value="1987-01-01">
							</div>
							<div class="col-sm-2" id="K4_4_div" style="display:none">
								<label for="K4_4">Рік народження 4-ї застрохованої особи</label><br>
								<input type="date" id="birth_date_4" name="birth_date_4" class="form-control" value="1987-01-01">
							</div> --->
							<div class="col-sm-3 col-md-2">	
								<label for="K4">Рік народження застрохованої особи</label><br>
								<input id="birth_date_1" name="birth_date_1" class="form-control" value="">
							</div>
							<div class="col-sm-3 col-md-2" id="K4_2_div" style="display:none">
								<label for="K4_2">Рік народження 2-ї застрохованої особи</label><br>
								<input id="birth_date_2" name="birth_date_2" class="form-control" value="">
							</div>
							<div class="col-sm-3 col-md-2" id="K4_3_div" style="display:none">
								<label for="K4_3">Рік народження 3-ї застрохованої особи</label><br>
								<input id="birth_date_3" name="birth_date_3" class="form-control" value="">
							</div>
							<div class="col-sm-3 col-md-2" id="K4_4_div" style="display:none">
								<label for="K4_4">Рік народження 4-ї застрохованої особи</label><br>
								<input id="birth_date_4" name="birth_date_4" class="form-control" value="">
							</div>
						</div>
					</div>	
					
					<div class="container">
						<div  data-target="#Kter">
							Територія дії
						</div>
						<div id="Kter">
							<div class="btn-group" id="kter_div">
								<button type="button" class="btn btn-default btn-sm btn-age1 koss-background" style="text-align:left" value="1" onclick="get_Kter(this.value)">ЄВРОПА<br>окрім України та країни постійного проживання.
								</button>
								<button  type="button" class="btn btn-default btn-sm btn-age2" style="text-align:left" value="1.5" onclick="get_Kter(this.value)">ВЕСЬ СВІТ<br>
									за виключенням країн: Північної та Південної Америки,
									Африки, Азії, Австралії та Океанії 
									та крім України та країни постійного проживання.
								</button>
								<button  type="button" class="btn btn-default btn-sm btn-age3" style="text-align:left" value="2.3" onclick="get_Kter(this.value)">ВЕСЬ СВІТ*<br>
									включаючи країни: Північної та Південної Америки, 
									Африки, Азії, Австралії та Океанії,
									але окрім України та країни постійного проживання.
								</button>
							</div>
						</div>
					</div>
					
					<br>
					<div class="container">
						<div class="row">
							<div class="col-sm-4 col-md-4 col-lg-2">
								<label for="Kpr">
									Програма страхування
								</label>
								<select id="Kpr" name="Kpr" required class="form-control" >
									<option value="1" selected>А (Standart)</option>
									<option value="1.38">В (Business)</option>
									<option value="1.9">С (Comfort)</option>
									<option value="3">E (Elite)</option>
								</select>
							</div>
						</div>
					</div>
					<br>
					<div class="container">
						<div class="row">
							<div class="col-sm-4 col-md-2">
								<label for="insSum">
									Розмір страхової суми
								</label>
								<select id="insSum" name="insSum" required class="form-control">
									<option value="10000" id="multi">10 000</option>
									<option value="15000">15 000</option>
									<option value="30000" selected>30 000</option>
								</select>
							</div>
							<div class="col-sm-4 col-md-2">
								<label for="insCur">
									Валюта страхової суми
								</label>
								<select id="insCur" name="insCur" required class="form-control">
									<option value="USD">USD</option>
									<option value="EUR">EUR</option>	
								</select>
							</div>	
						</div>	
					</div>
					<br>
					<div class="container">
						<label for="Kfr" >
							Розмір безумовної франшизи
						</label>
						<div class="row">	
							<div class="col-sm-4 col-md-2">	
								<select id="Kfr" name="Kfr" required class="form-control">
									<option value="1">0</option>
									<option value="0.95">50</option>
									<option value="0.85">100</option>
									<option value="0.8">150</option>
									<option value="0.75">200</option>
									<option value="0.7">250</option>
								</select>
							</div>
							<div class="col-sm-4 col-md-2">
								<span id="currency" style="font-weight: 700;"></span>
							</div>
						</div>	
					</div>
					<br>
					<div class="container strahinfo">	
						<div class="strah-collapse">
							<button id="K1" class="btn btn-info" type="button" data-toggle="collapse" data-target="#K1_hidden" >Виконання небезпечної роботи</button>
						</div>
						<!--Появляется после галочки id="K1"-->
						<div id="K1_hidden" class="collapse">
							Групи ризику в залежності від виду діяльності:<br>
							<div class="btn-group" id="K1_div">
								<button type="button"  class="btn btn-default btn-sm" style="text-align:left" value="2.5">Особи, праця яких пов’язана<br> з особливим (підвищеним) ризиком
								</button>
								<button type="button" class="btn btn-default btn-sm" style="text-align:left" value="1.5">Категорії працюючих безпосередньо<br> зайнятi в процесі виробництва
								</button>
								<button type="button" class="btn btn-default btn-sm" style="text-align:left" value="1">Категорії громадян, що безпосередньо<br>не зайнятi у процесі виробництва
								</button>
							</div>
						</div>
					</div>
					<div class="container strahinfo">
						<div class="strah-collapse">
							<button id="K2" class="btn btn-info" type="button" data-toggle="collapse" data-target="#K2_hidden">Зайняття масовим непрофесійним спортом або звичайне зайняття активним відпочинком</button>
						</div
						<!--Появляется после галочки id="K2"-->
						<div id="K2_hidden" class="collapse">
							Групи ризику в залежності від виду спорту:<br>
							<div class="btn-group" role="group" id="K2_div">
								<button type="button"  class="btn btn-default btn-sm" style="text-align:left" value="1">
									Подорожі (походи піші) - із спокійним ландшафтом, шахи, шашки, більярд, спортивний бридж, радіоспорт, а також види спорту з аналогічними фізичними навантаженнями, тощо
								</button>
								<button type="button" class="btn btn-default btn-sm" style="text-align:left" value="1.1">
									Аеробіка, бадмінтон, біатлон, буєрний спорт, вітрильний спорт, волейбол, гімнастика художня, лижні гонки, орієнтувальний спорт, плавання, перетягування канату, тренування в тренажерних залах, фітнес, шейпінг, спортивні танці; спортивна аеробіка; акробатичний рок-н-рол, настільний теніс, тощо
								</button>
								<button type="button" class="btn btn-default btn-sm" style="text-align:left" value="1.3">
									Акробатика, армспорт, бейсбол, єдиноборства, велоспорт, веслування, вінсерфінг, водне поло, водні лижі, гандбол, гирьовий спорт, лижнедвоборство, легка атлетика, пауерліфтінт, планерний спорт, пейнтбол, пожежно-прикладний спорт, стрибки на батуті, стрибки у воду, стрільба, триатлон, теніс (крімнастільного), фехтування, фігурне катання, футбол, подорожі (походи піші) –із гірським ландшафтом, тощо
								</button>
								<button type="button" class="btn btn-default btn-sm" style="text-align:left" value="2">
									Автомобільний спорт, альпінізм, багатоборство, баскетбол, бобслей, бокс, дайвінг, важка атлетика, гімнастика спортивна, гірськолижний спорт, дельтапланеризм, кінний спорт, картинт, карате, ковзанярський спорт, літаковий спорт, мотобол, мотоциклетний спорт, парашутний спорт, підводний спорт, планернийспорт, поло, ралі, регбі, санний спорт,скелелазіння, стрибки на лижах із трампліну, сноуборд, спідвей, хокей, фрістайл, тощо
								</button>
								<button type="button" class="btn btn-default btn-sm" style="text-align:left" value="1.15">
									Активний відпочинок
								</button>
							</div>
						</div>	
					</div>
					<div class="container strahinfo">
						<div class="strah-collapse">
							<button id="K3" class="btn btn-info" type="button" data-toggle="collapse" data-target="#K3_hidden">Зайняття професійним спортом, а також масовим спортом на період проведення змагань</button>
						</div>
						<!--Появляется после галочки id="K3"-->
						<div id="K3_hidden" class="collapse">
							Групи ризику в залежності від виду спорту<br>
							<div class="btn-group" role="group" id="K3_div">
								<button type="button" class="btn btn-default btn-sm" style="text-align:left" value="1">
									Подорожі (походи піші) - із спокійним ландшафтом, шахи, шашки, більярд, спортивний бридж, радіоспорт, а також види спорту з аналогічними фізичними навантаженнями, тощо
								</button>
								<button type="button" class="btn btn-default btn-sm" style="text-align:left" value="2">
									Аеробіка, бадмінтон, біатлон, буєрний спорт, вітрильний спорт, волейбол, гімнастика художня, лижні гонки, орієнтувальний спорт, плавання, перетягування канату, тренування в тренажерних залах, фітнес, шейпінг, спортивні танці; спортивна аеробіка; акробатичний рок-н-рол, настільний теніс, тощо
								</button>
								<button type="button" class="btn btn-default btn-sm" style="text-align:left" value="3">
									Акробатика, армспорт, бейсбол, єдиноборства, велоспорт, веслування, вінсерфінг, водне поло, водні лижі, гандбол, гирьовий спорт, лижнедвоборство, легка атлетика, пауерліфтінт, планерний спорт, пейнтбол, пожежно-прикладний спорт, стрибки на батуті, стрибки у воду, стрільба, триатлон, теніс (крімнастільного), фехтування, фігурне катання, футбол, подорожі (походи піші) – із гірським ландшафтом, тощо
								</button>
								<button type="button" class="btn btn-default btn-sm" style="text-align:left" value="3">
									Автомобільний спорт, альпінізм, багатоборство, баскетбол, бобслей, бокс, дайвінг, важка атлетика, гімнастика спортивна, гірськолижний спорт, дельтапланеризм, кінний спорт, картинт, карате, ковзанярський спорт, літаковий спорт, мотобол, мотоциклетний спорт, парашутний спорт, підводний спорт, планернийспорт, поло, ралі, регбі, санний спорт, скелелазіння, стрибки на лижах із трампліну, сноуборд, спідвей, хокей, фрістайл, тощо
								</button>
							</div>
						</div>
					</div>
					<div class="container strahinfo">
						<div class="strah-collapse">
							<button id="accident" class="btn btn-info" type="button" data-toggle="collapse" data-target="#accident_hidden">Добровільне страхування від нещасних випадків</button>
						</div>
						<!--Появляется после галочки id="accident"-->
							<div id="accident_hidden" class="collapse">
								<div class="row">	
									<div class="col-sm-2">
										<label for="SSnv" style="font-weight: 500;">
											Розмір страхової суми
										</label>
									</div>
									<div class="col-sm-3 cost-ua">
										<select id="SSnv" required class=" form-control">
											<option disabled selected value="0">Виберіть елемент із списку</option>
											<option value="5000" id="default">5 000</option>
											<option value="10000">10 000</option>
											<option value="20000">20 000</option>
										</select>
										<span> &#8372;</span>
									</div>
								</div>
							</div>
			
					<div class="container">
						<input type="text" id="SPb" name="SPb" style="display:none">
						<input type="text" id="SPb_accident" name="SPb_accident" style="display:none">
						<input type="text" id="dateStop_php" name="dateStop_php" style="display:none">
						<input type="text" id="days_php" name="days_php" style="display:none">
						<input type="text" id="SPtr" name="SPtr" style="display:none">
						<input type="text" id="SPnv" name="SPnv" style="display:none">
						<input type="text" id="SPzag" name="SPzag" style="display:none">
						<input type="text" id="Kter_post" name="Kter_post" value=1 style="display:none">
						<input type="text" id="SSnv_php" name="SSnv_php" style="display:none">
						<input type="text" id="strah_flag" name="strah_flag" style="display:none">
						<input type="text" id="post_k1" name="post_k1" style="display:none">
					</div>
					<div class="container summ">
						<h3>Загальна сума:</h3> 
						<h3 id="sum">0,00 &#8372;</h3>
			
						<label> <input type="checkbox" id="myCheck" > 
						Я погоджуюсь з <a href="#">з публічною офертою</a> 
						</label>
						<br>
						<button class="btn btn-info" id="continue" type="button" data-toggle="collapse" data-target="#personal_data_hidden" disabled>Продовжити</button>
					</div>
					<br>
					<!--Появляется после нажатия кнопки id="continue"-->
					<div class="container collapse" id="personal_data_hidden">
						<div id="personal_data">
							<input type="checkbox" id="strah_check" name = "strah_check">  Страхувальник не їде<br>
							<div class="row">
								<div class="col-sm-3" id="strah">
									<h3 id="h3" style="font-size: 20px;">Страхувальник/Застрахована особа 1</h3>
									<div class="form-group">
										<label for="email0">Email<span>*</span></label>
										<input type="email" id="email0" name="email_strah" placeholder="Введіть ваш email" required class="form-control">
									</div>
									<div class="form-group">
										<label for="tels0">Тел.<span>*</span></label>
										<input type="text" name="tel_strah" id="tel0" placeholder="(___)___-____" required class="form-control tel">
									</div>
									<div class="form-group">
										<label for="name0">Імя<span>*</span></label>
										<input type="text" id="name0" name="name_strah" placeholder="Введіть імя на англійській мові" required class="form-control name"><span id="name0_error" class="error"></span>
									</div>
									<div class="form-group">	
										<label for="surname0">Прізвище<span>*</span></label>
										<input type="text" id="surname0" name="surname_strah" placeholder="Введіть прізвище на англійській мові" required class="form-control surname"><span id="surname0_error" class="error"></span>
									</div>	
									<!--- <div class="form-group">
										<label for="date0">Дата народження</label>
										<input type="date" id="date0" name="date_strah" required class="form-control date">
									</div> --->
									<div class="formgroup">
										<label for="date0">Дата народження</label>
										<input id="date0" name="date_strah" required class="form-control date" value="">
									</div>
									<div class="form-group">
										<label for="pass0">Серія та номер паспорта<span>*</span></label>
										<br><input type="checkbox" id="nonrezidentstrah" name="nonrezidentstrah" class="rezident_check"> Не резидент
										<input type="text" id="pass0" name="pass_strah" required class="form-control pass_series" placeholder="АА111111" maxlength="8"><span id="pass0_error" class="error"></span>
									</div>
									<div class="form-group">	
										<label for="inn0">ІПН<span>*</span></label>
										<input type="text" id="inn0" name="inn_strah" placeholder="Введіть ІПН" required maxlength="10" class="form-control inn"><span id="inn0_error" class="error"></span>	
									</div>
									<div class="form-group">
											<label for="file_strah"> Закордонний паспорт
											<br>Завантажити (необов\'язково):</label> 
											<label for="file_strah">Вложите фото паспорта
											</label>
												<input type="hidden" name="MAX_FILE_SIZE" value="3000000" /> 
												<input id="file_strah" name="pictures[strah]" type="file">
									</div>
								</div>
								<div class="col-sm-3" id="person1" style="display:none">
									<h3 style="font-size: 20px;">Застрахована особа 1</h3>
									<div class="form-group">
										<label for="name1">Імя<span>*</span></label>
										<input type="text" id="name1" name="name1" placeholder="Введіть імя на англійській мові" class="form-control name required1"><span id="name1_error" class="error"></span>
									</div>
									<div class="form-group">	
										<label for="surname1">Прізвище<span>*</span></label>
										<input type="text" id="surname1" name="surname1" placeholder="Введіть прізвище на англійській мові" class="form-control surname required1"><span id="surname1_error" class="error"></span>
									</div>	
									<!--- <div class="form-group">
										<label for="date1">Дата народження</label>	
										<input type="date" id="date1" name="date1" class="form-control required1 date" >
									</div> --->
									<div class="form-group">
										<label for="date1">Дата народження</label>	
										<input id="date1" name="date1" class="form-control required1 date" value="">
									</div>
									<div class="form-group">
										<label for="pass1">Серія та номер паспорта<span>*</span></label>
										<br><input type="checkbox" id="nonrezident1" name="nonrezident1" class="rezident_check"> Не резидент
										<input type="text" id="pass1" name="pass1" class="form-control pass_series required1" placeholder="АА111111" maxlength="8"><span id="pass1_error" class="error"></span>
									</div>
									<div class="form-group">	
										<label for="inn1">ІПН<span>*</span></label>
										<input type="text" id="inn1" name="inn1" placeholder="Введіть ІПН"  maxlength="10" class="form-control inn required1"><span id="inn1_error" class="error"></span>	
									</div>
									<div class="form-group">
											<label for="file_strah1"> Закордонний паспорт
											<br>Завантажити (необов\'язково):</label> 
											<label for="file_strah1">Вложите фото паспорта
											</label>
												<input type="hidden" name="MAX_FILE_SIZE" value="3000000" /> 
												<input id="file_strah1" name="pictures[strah1]" type="file">
									</div>
								</div>
								<div class="col-sm-3" id="person2" style="display:none">
									<h3 style="font-size: 20px;">Застрахована особа 2</h3>
									<div class="form-group padding" id="paddingid">
										<label for="name2">Імя<span>*</span></label>
										<input type="text" id="name2" name="name2" placeholder="Введіть імя на англійській мові" class="form-control required2 name"><span id="name2_error" class="error"></span>
									</div>
									<div class="form-group">	
										<label for="surname2">Прізвище<span>*</span></label>
										<input type="text" id="surname2" name="surname2" placeholder="Введіть прізвище на англійській мові" class="form-control required2 surname"><span id="surname2_error" class="error"></span>
									</div>	
									<!--- <div class="form-group">
										<label for="date2">Дата народження</label>	
										<input type="date" id="date2" name="date2" class="form-control required2 date" >	
									</div> --->
									<div class="form-group">
										<label for="date2">Дата народження</label>	
										<input id="date2" name="date2" class="form-control required2 date" value="">	
									</div>
									<div class="form-group">
										<label for="pass2">Серія та номер паспорта<span>*</span></label>
										<br><input type="checkbox" id="nonrezident2" name="nonrezident2" class="rezident_check"> Не резидент
										<input type="text" id="pass2" name="pass2"  class="form-control pass_series required2" placeholder="АА111111" maxlength="8"><span id="pass2_error" class="error"></span>
									</div>
									<div class="form-group">	
										<label for="inn2">ІПН<span>*</span></label>
										<input type="text" id="inn2" name="inn2" placeholder="Введіть ІПН" maxlength="10" class="form-control inn required2"><span id="inn2_error" class="error"></span>	
									</div>
									<div class="form-group">
											<label for="file_strah2"> Закордонний паспорт
											<br>Завантажити (необов\'язково):</label> 
											<label for="file_strah2">Вложите фото паспорта
											</label>
												<input type="hidden" name="MAX_FILE_SIZE" value="3000000" /> 
												<input id="file_strah2" name="pictures[strah2]" type="file">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3" id="person3" style="display:none">
								<h3 style="font-size: 20px;">Застрахована особа 3</h3>
									<div class="form-group">
										<label for="name3">Імя<span>*</span></label>
										<input type="text" id="name3" name="name3" placeholder="Введіть імя на англійській мові" class="form-control required3 name"><span id="name3_error" class="error"></span>
									</div>
									<div class="form-group">	
										<label for="surname3">Прізвище<span>*</span></label>
										<input type="text" id="surname3" name="surname3" placeholder="Введіть прізвище на англійській мові" class="form-control required3 surname"><span id="surname3_error" class="error"></span>
									</div>	
									<!--- <div class="form-group">
										<label for="date3">Дата народження</label>	
										<input type="date" id="date3" name="date3" class="form-control required3 date" >
									</div> --->
									<div class="form-group">
										<label for="date3">Дата народження</label>	
										<input id="date3" name="date3" class="form-control required3 date" value="">
									</div>
									<div class="form-group"> 
										<label for="pass3">Серія та номер паспорта<span>*</span></label>
										<br><input type="checkbox" id="nonrezident3" name="nonrezident3" class="rezident_check"> Не резидент
										<input type="text" id="pass2" name="pass3"  class="form-control pass_series required3" placeholder="АА111111" maxlength="8"><span id="pass3_error" class="error"></span>
									</div>
									<div class="form-group">	
										<label for="inn3">ІПН<span>*</span></label>
										<input type="text" id="inn3" name="inn3" placeholder="Введіть ІПН"  maxlength="10" class="form-control inn required3"><span id="inn3_error" class="error"></span>	
									</div>
									<div class="form-group">
											<label for="file_strah3"> Закордонний паспорт
											<br>Завантажити (необов\'язково):</label> 
											<label for="file_strah3">Вложите фото паспорта
											</label>
												<input type="hidden" name="MAX_FILE_SIZE" value="3000000" /> 
												<input id="file_strah3" name="pictures[strah3]" type="file">
									</div>
								</div>
								<div class="col-sm-3" id="person4" style="display:none">
									<h3 style="font-size: 20px;">Застрахована особа 4</h3>
									<div class="form-group">
										<label for="name4">Імя<span>*</span></label>
										<input type="text" id="name4" name="name4" placeholder="Введіть імя на англійській мові" class="form-control required4 name"><span id="name4_error" class="error"></span>
									</div>
									<div class="form-group">	
										<label for="surname4">Прізвище<span>*</span></label>
										<input type="text" id="surname4" name="surname4" placeholder="Введіть прізвище на англійській мові" class="form-control required4 surname"><span id="surname4_error" class="error"></span>
									</div>	
									<!--- <div class="form-group">
										<label for="date4">Дата народження</label>	
										<input type="date" id="date4" name="date4" class="form-control required4 date" >
									</div> --->
									<div class="form-group">
										<label for="date4">Дата народження</label>	
										<input id="date4" name="date4" class="form-control required4 date" value="">
									</div>
									<div class="form-group">
										<label for="pass4">Серія та номер паспорта<span>*</span></label>
										<br><input type="checkbox" id="nonrezident4" name="nonrezident4" class="rezident_check"> Не резидент
										<input type="text" id="pass4" name="pass4"  class="form-control pass_series required4" placeholder="АА111111" maxlength="8"><span id="pass4_error" class="error"></span>
									</div>
									<div class="form-group">	
										<label for="inn4">ІПН<span>*</span></label>
										<input type="text" id="inn4" name="inn4" placeholder="Введіть ІПН"  maxlength="10" class="form-control inn required4"><span id="inn4_error" class="error"></span>	
									</div>
									<div class="form-group">
											<label for="file_strah4"> Закордонний паспорт
											<br>Завантажити (необов\'язково):</label> 
											<label for="file_strah4">Вложите фото паспорта
											</label>
												<input type="hidden" name="MAX_FILE_SIZE" value="3000000" /> 
												<input id="file_strah4" name="pictures[strah4]" type="file">
									</div>
								</div>
							</div>
						</div>
						<div class="group-submit-input">
							<input class="btn btn-info" type="submit" id="submit" value="Оплатить">
							<div class="preloader-but">
								<div class="page-loader-circle"></div>
							</div>
						</div>
					</div>			
				</form>	
			</div>
					';
?>