<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script type="text/javascript" src="include/js/jquery-1.8.1.min.js"></script>
		<script type="text/javascript" src="include/js/jquery-ui-1.8.23.min.js"></script>
		<!-- 		<script type="text/javascript" src="include/js/jquery.notify.js"></script> -->
		<!-- 		<script type="text/javascript" src="include/js/autosave.js"></script> -->
		<link type="text/css" rel="stylesheet"
		href="include/css/cupertino/jquery-ui-1.8.9.css" />
		<!--<link type="text/css" rel="Stylesheet"
		<!-- 		href="include/css/jquery.ui.notify.css" /> -->
		<style>
			body {
				font-size: 9pt;
				background-color: #DEEDF7;
			}
			h1 {
				font-family: Calibri;
			}
			label {
				font-size: 11pt;
				display: block;
				float: left;
				padding-top: 7px;
			}
			input, textarea {
				margin-top: 4px;
				padding: 5px;
				text-shadow: 0px 1px 0px #fff;
				outline: none;
				-webkit-border-radius: 3px;
				-moz-border-radius: 3px;
				border-radius: 3px;
				border: 1px solid #ccc;
				-webkit-transition: .1s ease-in-out;
				-moz-transition: .1s ease-in-out;
			}
			.highlight {
				-webkit-border-radius: 3px;
				-moz-border-radius: 3px;
				border-radius: 3px;
				border: 1px solid red;
				-webkit-box-shadow: 0px 0px 4px red;
				-moz-box-shadow: 0px 0px 4px red;
				-box-shadow: 0px 0px 4px red;
				-webkit-transition: .2s ease-in-out;
				-moz-transition: .2s ease-in-out;
			}
			input:focus, textarea:focus {
				border: 1px solid #fafafa;
				-webkit-box-shadow: 0px 0px 6px #007eff;
				-moz-box-shadow: 0px 0px 6px #007eff;
				-box-shadow: 0px 0px 6px #007eff;
			}
			select {
				background-color: #FFF;
				border: 1px solid #7F9DB9;
				margin: 4px 1px 0px 2px;
				-webkit-border-radius: 3px;
				-moz-border-radius: 3px;
				border-radius: 3px;
			}
			/*	select {
			 background-color: #FFF;
			 border: 1px solid #7F9DB9;
			 color: #000;
			 height: 20px;
			 font-size: 9pt;
			 margin: 3px;
			 padding: 4px 1px 0px 2px;
			 } */ /*	#tabs { margin-top: 2px; }
			 .tabs-bottom { position: relative; }
			 .tabs-bottom .ui-tabs-panel { height: 140px; overflow: auto; }
			 .tabs-bottom .ui-tabs-nav { position: absolute !important; left: 0; bottom: 0; right:0; padding: 0 0.2em 0.2em 0; }
			 .tabs-bottom .ui-tabs-nav li { margin-top: -2px !important; margin-bottom: 1px !important; border-top: none; border-bottom-width: 1px;}
			 .ui-tabs-selected { margin-top: -3px !important; }
			 .ui-tabs-nav {margin-left: -2px; -webkit-border-radius: 0px 0px 0px 0px; }
			 /*	.ui-tabs {height: 550px;} */ /*	.ui-corner-bottom {height: 30px;}

			 /*	.ui-progressbar-value { background-image: url(images/pbar-ani.gif); } */

			fieldset {
				padding: 0px 0px 0px 20px;
				border: 1;
				margin-top: 0px;
				margin-left: 10px;
			}
			.add_shadow {
				text-align: center;
				-webkit-box-shadow: 2px 2px 3px #888;
				-moz-box-shadow: 2px 2px 3px #888;
				-box-shadow: 2px 2px 3px #888;
			}
			.add_shadow_tabs {
				-webkit-box-shadow: 2px 2px 3px #888;
				-moz-box-shadow: 2px 2px 3px #888;
				-box-shadow: 2px 2px 3px #888;
			}
			.img_shadow {
				-webkit-box-shadow: 0px 0px 3px #888;
				-moz-box-shadow: 0px 0px 3px #888;
				-box-shadow: 0 x 0px 0px #888;
			}
		</style>
		<title>EuroCoord WP4: Data Inventory Survey</title>
	</head>
	<body>
		<div id="dialog">
			<form>
				<label> Please wait ...</label>
				<br />
				<br />
				<br />
				<div id="progress"></div>
			</form>
		</div>
		<!-- 		<div id="restoredlg">
		<form>
		<label> Please wait ...</label>
		<br />
		<div id="restore_progress"></div>
		</form>
		</div>		-->
		<img src="logo.gif" style="display:block;" class="img_shadow"/>
		<h1> &nbsp; &nbsp; &nbsp; EuroCoord Work Package 4: Data Inventory Survey <span id="progress_percent" style="display: block; float:right; margin-top: 3px; font-size:11pt">&nbsp; &nbsp; 0.00%</span><div id="totalprogress" style="display: block; float:right; height: 20px; width: 100px;"></div> &nbsp; &nbsp; &nbsp; &nbsp; <span style="display: block; float:right; margin-top: 3px; font-size:11pt">Completed: &nbsp; &nbsp; </span></h1>
		<div id="surveytabs" class="add_shadow_tabs" style="width: 99%; height: 100%">
			<ul>
				<li>
					<a href="#cohortdesc">Cohort Description</a>
				</li>
				<li>
					<a href="#sumstat">Summary Statistics</a>
				</li>
				<li>
					<a href="#overlap">Overlap</a>
				</li>
				<li>
					<a href="#hicdep">Data Collection (HICDEP)</a>
				</li>
				<li>
					<a href="#nonhicdep">Data Collection (Non-HICDEP)</a>
				</li>
				<li>
					<a href="#extra">Additional Info</a>
				</li>
			</ul>
			<div id="cohortdesc">
				<form id="fcohortdesc">
					<label for="cohortname"> Cohort Name: </label>
					<input type="text" id="cohortname" name="cohortname" data-important="1" />
					<br>
					<label for="datamanager"> Data Manager: </label>
					<input type="text" id="datamanager" name="datamanager" data-important="1"/>
					<br>
					<label for="pinames"> Principal investigator(s): </label>
					<input	type="text" id="pinames" name="pinames" data-important="1" />
					<br>
					<label for="creation_year"> Year of creation of the cohort: </label>
					<input type="text" id="creation_year" name="creation_year" onblur="check_num(this);" onkeypress="return check_number(this, event);" data-important="1" />
					<br>
					<label for="inclusion"> Inclusion criteria: </label>
					<textarea id="inclusion" name="inclusion" cols="50" data-important="1"></textarea>
					<br>
					<label for="exclusion"> Exclusion criteria (if any): </label>
					<textarea id="exclusion" name="exclusion" cols="50" data-important="1"></textarea>
					<br>
					<label for="datacollectionmethod"> <u>Data Collection Method</u>
						<br>
						Please describe briefly the method you use to collect the data
						<br>
						(e.g. through questionaires filled by the collaborating clinics biannually;
						<br>
						by inputting the data into a database after each patient's clinical visit  etc.)
						<br>
						Please also specify (if applicable) whether there are specific study
						<br>
						visits or information is taken from routine clinic visits.
						<br>
						Finally, indicate if data are collected only prospectively or some of them
						<br>
						have been retrospectively collected (before when?) </label>
					<textarea id="datacollectionmethod" name="datacollectionmethod" cols="50" style="height: 140px" data-important="1"></textarea>
					<br>
					<label for="registriescrosscheck"> <u>Registries cross-checks</u>
						<br>
						Are any cross-checks done with external registeries/studies to establish
						<br>
						vital status for people who become lost to follow-up?
						<br>
						Does this include AIDS registration, death registration or any other
						<br>
						study at a national level? </label>
					<textarea id="registriescrosscheck" name="registriescrosscheck" cols="50" style="height: 80px" data-important="1"></textarea>
					<br>
					<label for="closing_date"> What is the closing date of the database you use to answer the questions in this survey: </label>
					<input type="text" id="closing_date" name="closing_date" data-important="1" />
					<br>
					<label for="recent_update"> Date of most recent data update: </label>
					<input type="text" id="recent_update" name="recent_update" data-important="1" />
					<br>
					<label for="selection_bias"> Do you think that there are any issues with selection bias in the way you recruit patients: </label>
					<span style="padding-top: 5px; margin-top: 4px;">
						<input type='radio' name='selection_bias' id='selection_bias' data-important="1" value='1' onchange="bias(this.value)" />
						YES &nbsp;
						<input type='radio' name='selection_bias' id='selection_bias' data-important="1" value='0' onchange="bias(this.value)" />
						NO &nbsp;
						<input type='radio' name='selection_bias' id='selection_bias' data-important="1" value='-1' onchange="bias(this.value)" checked='checked' />
						N/A </span>
					<br />
					<br />
					<span id="bias_show" style="display:none"> <label for="bias_extra" > &nbsp; &nbsp; &nbsp; &nbsp; Please explain: </label> 						<textarea
						id="bias_extra" name="bias_extra" cols="50" ></textarea>
						<br />
					</span>
				</form>
			</div>
			<div id="sumstat"></div>
			<div id="overlap"></div>
			<div id="hicdep"></div>
			<div id="nonhicdep"></div>
			<div id="extra">
				<form id="fextra">
					<h2>Are there any other items you collect not mentioned in this survey?</h2>
					<label> Please specify in the text box below or, if more convenient, send us a copy of the questionnaire you use to collect
						<br />
						the data or a description of your electronic database (preferably with highlighted the additional items) using the upload tool below.
						<br />
						(Note: If you upload multiple files, only the LAST FILE will be saved). </label>
					<br />
					<br />
					<br />
					<br />
					<table>
						<tr>
							<td>							<textarea name="extra_info" id="extra_info" rows="8" cols="60"></textarea>
</form>				</td> <td valign="top">
				<form id="fupload" action="upload.php?id=<? echo $_GET['id'];?>" method="post" enctype="multipart/form-data" target="upload_target" >
					<input name="myfile" type="file" />
					<input type="button" id="filebtn" value="Upload" />
				</form><iframe name="upload_target" id="upload_target" src="upload.php?id=<? echo $_GET['id'];?>" class="add_shadow_tabs" style="border-radius: 3px; margin: 3px; border: 1px solid #ccc; width:370px; height: 50px"></iframe></td>
				</tr>
				</table>
			</div>
		</div>
		<p>
			&nbsp;
		</p>
		<span style="display:block; float:left; width: 100px">&nbsp;</span>
		<button id="savebtn">
			Save Data
		</button>
		&nbsp; &nbsp;
		<button id="highlightbtn">
			Highlight Missing Fields On/Off
		</button>
		&nbsp; &nbsp;
		<button id="finalizebtn">
			Finalize
		</button>
		<input type="hidden" id="highlighted" value="0" />
		<?
		// echo "		<pre>";
		// print_r($data);
	?>			
		
		<script type="text/javascript">

			var unsaved_data = false;
			var completed = false;
			var tabpanel;

			$(document).ready( function() {

				$("#surveytabs").tabs();
				$("#filebtn").button().addClass("add_shadow").click(function() { 
					$("#upload_target").contents().find("html").html("<pre>Please wait ... </pre>");
					$("#fupload").submit(); 
				});
				$("#highlightbtn").button().addClass("add_shadow").click(function() {
					toggle_important_fields();
				});
				$("#finalizebtn").addClass("add_shadow").button().click(function() {
					response = confirm("Are you sure?\nNo changes can be made after that step.");
					if (response) {
						savedata();
						$.ajax({
							type: "POST",
							url: "savetodb.php",
							async: false,
							data: "id=" + id + "&table=users",
							success: function(msg) {
								$("#finalizebtn").attr('disabled', 'disabled').addClass( 'ui-state-disabled' );
								$("#highlightbtn").attr('disabled', 'disabled').addClass( 'ui-state-disabled' );
								$("#filebtn").attr('disabled', 'disabled').addClass( 'ui-state-disabled' );
								$("#savebtn").attr('disabled', 'disabled').addClass( 'ui-state-disabled' );
								completed = true;
								$("input, select, textarea").attr('disabled', 'disabled').addClass( 'ui-state-disabled' );
								alert("No more changes can be made to the data.\nThank you for your participation!")
							}
						});
					}					
				});
				$("#totalprogress").progressbar();
				
				$("#recent_update, #closing_date").datepicker({
					changeMonth: true,
					changeYear: true,
					dateFormat: "yy-mm-dd"
				}).blur(function() { check_date(this); }); //.keypress(function() {return false});

				var state = "";
				var id = "<? echo $_GET['id'];?>";
		
				$.getJSON("getdatafromdb.php", {
					"id": id,
					"table": "getstate"							
				}, function(data) {
						if (data.state == "closed") {
							$("#finalizebtn").attr('disabled', 'disabled').addClass( 'ui-state-disabled' );
							$("#highlightbtn").attr('disabled', 'disabled').addClass( 'ui-state-disabled' );
							$("#filebtn").attr('disabled', 'disabled').addClass( 'ui-state-disabled' );
							$("#savebtn").attr('disabled', 'disabled').addClass( 'ui-state-disabled' );
							completed = true;
							$("input, select, textarea").attr('disabled', 'disabled').addClass( 'ui-state-disabled' );
						}
				});	

				//	$( "#loading-progressbar" ).progressbar({ value: 0 });

				
				restoredata("cohort_description");				
				$('#sumstat').load('sumstat.php', function() {
					setTimeout(function() {	restoredata("sumstat"); }, 1);
					// $("#fsumstat").autosave();
				});
				$('#overlap').load('overlap.php', function() {
//					$("#foverlap").autosave();
					setTimeout(function() {	restoredata("overlap"); }, 1);
				});
				$('#hicdep').load('hicdep.php', function() {
					$("#hicdep_tabs").tabs();
					setTimeout(function() {	restoredata("hicdep"); }, 500);
					// $("#fhicdep").autosave();
				});
				$('#nonhicdep').load('nonhicdep.php', function() {
//					$("#fnonhicdep").autosave();
					setTimeout(function() {	restoredata("nonhicdep"); }, 1);
				});

				// Set labels to max width
				$("#cohortdesc").each( function() {
					var max_label_width = 400;
					var w = 0;
					$("label", this).each( function() {
						if ($(this).width() > max_label_width) {
							max_label_width = $(this).width();
						}
					});
					max_label_width += 10;
					$("label", this).width(max_label_width);
				});
				
				$("#selection_bias").show();

				//				$(window).unload( function() {
				//					alert('Save data to the database!');
				//				});

				$("#progress").progressbar({ value: 0 });
				$("#dialog").hide();

/*				
				$('#fcohortdesc').change(function(event) {
					$el = $(event.srcElement);
					console.log(event.srcElement);
					if ($el.data('important') == '1') {
						alert($el.attr('id'));
					}					
				});
*/
				$("#fcohortdesc").change(function() {
					calculate_progress();
				});
				$("#fsumstat").change(function() {
					calculate_progress();
				});
				$("#foverlap").change(function() {
					calculate_progress();
				});
				$("#fhicdep").change(function() {
					calculate_progress();
				});
				$("#fnonhicdep").change(function() {
					calculate_progress();
				});
				function savedata() {
					
					$("#dialog").dialog({
						modal: true,
						title: "Saving Data"
					});
				
					var id = "<? echo $_GET['id'];?>";
					cohortdesc_data = $("#fcohortdesc").serialize();
					cohortdesc_data += "&extra_info="+$("#extra_info").val();
					sumstat_data = $("#fsumstat").serialize();
					overlap_data = $("#foverlap").serialize();
					hicdep_data = $("#fhicdep").serialize();
					nonhicdep_data = $("#fnonhicdep").serialize();
					$.ajax({
						type: "POST",
						url: "savetodb.php",
						async: false,
						data: "id=" + id + "&table=cohort_description&" + cohortdesc_data,
						success: function(msg) {
							$("#progress").progressbar({ value: 10 });
						}
					});
					$.ajax({
						type: "POST",
						url: "savetodb.php",
						async: false,
						data: "id=" + id + "&table=sumstat&" + sumstat_data,
						success: function(msg) {
							$("#progress").progressbar({ value: 30 });
						}
					});
					$.ajax({
						type: "POST",
						url: "savetodb.php",
						async: false,
						data: "id=" + id + "&table=overlap&" + overlap_data,
						success: function(msg) {
							$("#progress").progressbar({ value: 40 });
						}
					});										
					$.ajax({
						type: "POST",
						url: "savetodb.php",
						async: false,
						data: "id=" + id + "&table=nonhicdep&" + nonhicdep_data,
						success: function(msg) {
							$("#progress").progressbar({ value: 70 });
						}
					});
					$.ajax({
						type: "POST",
						url: "savetodb.php",
						async: false,
						data: "id=" + id + "&table=hicdep&" + hicdep_data,
						success: function(msg) {
							$("#progress").progressbar({ value: 100 });
						}
					});
					
					// $("#highlighted").val("1");
					// toggle_important_fields();
					
					setTimeout(function() {
						$("#dialog").dialog("destroy");
						$("#dialog").hide();
					}, 300);
					
					unsaved_data = false;
				}
				
				function restoredata(table) {
									
					var id = "<? echo $_GET['id'];?>
										";

										$.getJSON("getdatafromdb.php", {
											"id" : id,
											"table" : table
										}, function(data) {
											// debug = "Table: " + table + ", Length: " + data.length;
											// console.log(debug);
											for( i = 0; i < data.length; i++) {
												// el = $("[name='" + data[i].name + "']");
												// el_dom = $("[name='" + data[i].name + "']")[0];

												el = $("[id='" + data[i].name + "']");
												el_dom = el[0];
												v = data[i].value;
												if(el.is('[type=radio]')) {
													// el = $("[name='" + data[i].name + "']");
													// el_dom = el[0];

													el.prop('checked', false);
													// $("[name='" + data[i].name + "'][value='" + v + "']").prop('checked', true);
													el.parent().children("[value='" + v + "']").prop('checked', true);
													if(data[i].name == "selection_bias") {
														bias(v);
													} else {
														toggleradio2(el_dom, v);
													}
												} else if(el.is('[type=checkbox]')) {
													if(v == "on") {
														el.prop("checked", true);
														togglebox(el_dom, true)
													}
												} else {
													el.val(v);
													try {
														if(el[0].tagName == "SELECT") {
															toggle2(el_dom, v);
														}
													} catch(e) {
													}
												}
											}
											pval = $("#progress").progressbar("value");
											pval += 25;
											switch (table) {
												case 'cohort_description':
													$("#progress").progressbar({
														value : pval
													});
													// setTimeout(function() {
													// $("#dialog").dialog("destroy");
													// $("#dialog").hide();
													// }, 300);
													break;
												case 'sumstat':
													$("#progress").progressbar({
														value : pval
													});
													break;
												case 'overlap':
													$("#progress").progressbar({
														value : pval
													});
													break;
												case 'hicdep':
													$("#progress").progressbar({
														value : pval
													});
													setTimeout(function() {
														calculate_progress();
														unsaved_data = false;
														$("#dialog").dialog("destroy");
														$("#dialog").hide();
													}, 300);
													break;
												case 'nonhicdep':
													$("#progress").progressbar({
														value : pval
													});
													setTimeout(function() {
														// $("#dialog").dialog("destroy");
														// $("#dialog").hide();
													}, 300);
													break;
											}
										});
										}

										$("#savebtn").button().addClass("add_shadow").click(function() {
											savedata();
										});

										$(window).bind('beforeunload', function() {
											// var savetodb = confirm("Do you want to save the data in the database?");
											// if(savetodb) {
												// savedata();
											// }
											if (unsaved_data && !completed) {
												return "Make sure you have saved the data in the database! If not, all changes will be lost.";	
											}											
										});

										$("#dialog").dialog({
											modal : true,
											title : "Loading Data"
										});

										});

										function progress(val) {
											$("#loading-progressbar").progressbar({
												value : val
											});
										}

										function growl(template, vars, opts) {
											return $growl_container.notify("create", template, vars, opts);
										}
		</script>
		<script type="text/javascript">
			//$("[id ^= 'text_']").hide();

			function bias(val) {
				if(val == 1) {
					$("#bias_show").show();
				} else {
					$("#bias_show").hide();
				}
			}

			function toggle(el, val) {
				var id = $(el).attr("id");
				//	var textid = $(el).attr("id").replace("q_", "text_").replace(".", "\\\\.");
				var textid = $(el).attr("id").replace("q_", "text_");
				//	alert(val);
				$("[id ^= '" + id + "_sub_']").hide();
				$("[id ^= '" + id + ".']").hide();
				$("[id = '" + id + ".1']").show();
				$("[id = '" + id + ".2']").show();
				$("[id = '" + id + ".3']").show();
				$("[id = '" + id + ".4']").show();
				$("[id = '" + id + ".5']").show();
				$("[id = '" + id + ".6']").show();
				$("[id = '" + id + ".7']").show();
				$("[id = '" + id + ".8']").show();
				$("[id = '" + id + ".9']").show();
				$("[id ^= '" + id + "_sub_" + val + "']").show();

				if($(el).val() != "99") {
					document.getElementById(textid).style.display = "none";
				} else {
					document.getElementById(textid).style.display = "";
				}
				if($highlighted.val() == "1" && $(el).data('important') == '1') {
					if(val == -1) {
						$(el).addClass('highlight');
					} else {
						$(el).removeClass('highlight');
					}
				}

				calculate_progress();
			}

			function togglebox(el, checked) {
				var id = $(el).attr("id");
				var textid = $(el).attr("id").replace("q_", "text_");
				//	alert(id + " " + checked);
				if(checked) {
					//		$("[id ^= '" + id + "_sub_']").hide();
					$("[id ^= '" + id + ".']").hide();
					$("[id = '" + id + ".1']").show();
					$("[id = '" + id + ".2']").show();
					$("[id = '" + id + ".3']").show();
					$("[id = '" + id + ".4']").show();
					$("[id = '" + id + ".5']").show();
					$("[id = '" + id + ".6']").show();
					$("[id = '" + id + ".7']").show();
					$("[id = '" + id + ".8']").show();
					$("[id = '" + id + ".9']").show();
					$("[id ^= '" + id + "_sub_']").show();
					//		$("[id ^= '" + id + "_sub_" + val + "']").show();
				} else {
					$("[id ^= '" + id + "_sub_']").hide();
					$("[id = '" + id + ".1']").hide();
					$("[id = '" + id + ".2']").hide();
					$("[id = '" + id + ".3']").hide();
					$("[id = '" + id + ".4']").hide();
					$("[id = '" + id + ".5']").hide();
					$("[id = '" + id + ".6']").hide();
					$("[id = '" + id + ".7']").hide();
					$("[id = '" + id + ".8']").hide();
					$("[id = '" + id + ".9']").hide();
				}
				//
				//	if ($(el).val() != "99") {
				//		document.getElementById(textid).style.display = "none";
				//	} else {
				//		document.getElementById(textid).style.display = "";
				//	}
			}

			function toggleradio(el, val) {
				var id = $(el).attr("name");
				if(val == "2") {
					val = "1";
				}
				$("[id ^= '" + id + "_sub_']").hide();
				$("[id ^= '" + id + ".']").hide();
				$("[id = '" + id + ".1']").show();
				$("[id = '" + id + ".2']").show();
				$("[id = '" + id + ".3']").show();
				$("[id = '" + id + ".4']").show();
				$("[id = '" + id + ".5']").show();
				$("[id = '" + id + ".6']").show();
				$("[id = '" + id + ".7']").show();
				$("[id = '" + id + ".8']").show();
				$("[id = '" + id + ".9']").show();
				$("[id ^= '" + id + "_sub_" + val + "']").show();
				// console.log($(el));
				// console.log($(el).parent);
				if($highlighted.val() == "1" && $(el).data('important') == '1') {
					if(val == -1) {
						$(el).parent().addClass('highlight');
					} else {
						$(el).parent().removeClass('highlight');
					}
				}
				calculate_progress();
			}

			function toggle2(el, val) {// MODIFIED VERSION THAT DOES NOT CALCULATE PROGRESS - FOR USE IN DATA LOADING ONLY!
				var id = $(el).attr("id");
				//	var textid = $(el).attr("id").replace("q_", "text_").replace(".", "\\\\.");
				var textid = $(el).attr("id").replace("q_", "text_");
				//	alert(val);
				$("[id ^= '" + id + "_sub_']").hide();
				$("[id ^= '" + id + ".']").hide();
				$("[id = '" + id + ".1']").show();
				$("[id = '" + id + ".2']").show();
				$("[id = '" + id + ".3']").show();
				$("[id = '" + id + ".4']").show();
				$("[id = '" + id + ".5']").show();
				$("[id = '" + id + ".6']").show();
				$("[id = '" + id + ".7']").show();
				$("[id = '" + id + ".8']").show();
				$("[id = '" + id + ".9']").show();
				$("[id ^= '" + id + "_sub_" + val + "']").show();
				//	alert(val);
				//	alert(textid);

				//$("#" + textid).toggle();
				//
				////if ($("#" + textid).length > 0) {
				////	alert($("#" + textid).attr("id"));
				// if (textid = "text_1.10") {alert(textid); alert(val);}
				if(val != 99) {
					//		alert("other");
					document.getElementById(textid).style.display = "none";
				} else {
					//		alert("99");
					document.getElementById(textid).style.display = "";
				}
				////}
				// calculate_progress();
			}

			function toggleradio2(el, val) {// MODIFIED VERSION THAT DOES NOT CALCULATE PROGRESS - FOR USE IN DATA LOADING ONLY!
				var id = $(el).attr("name");
				if(val == "2") {
					val = "1";
				}
				$("[id ^= '" + id + "_sub_']").hide();
				$("[id ^= '" + id + ".']").hide();
				$("[id = '" + id + ".1']").show();
				$("[id = '" + id + ".2']").show();
				$("[id = '" + id + ".3']").show();
				$("[id = '" + id + ".4']").show();
				$("[id = '" + id + ".5']").show();
				$("[id = '" + id + ".6']").show();
				$("[id = '" + id + ".7']").show();
				$("[id = '" + id + ".8']").show();
				$("[id = '" + id + ".9']").show();
				$("[id ^= '" + id + "_sub_" + val + "']").show();

				// calculate_progress();
			}

			function calculate_progress() {
				var important_all = 0;
				var important_completed = 0;
				$("input:text, textarea, select, input:radio:checked").each(function() {
					if($(this).data('important') == '1') {
						important_all++;
						if(($(this).val() != "") && ($(this).val() != "-1")) {
							important_completed++;
						}
					}
				});
				//				alert(important_all + ", c: " + important_completed);
				current_progress = important_completed * 100 / important_all;
				$("#progress_percent").html("&nbsp; &nbsp; " + current_progress.toFixed(2) + "%");
				$("#totalprogress").progressbar({
					value : current_progress
				});
				unsaved_data = true;
			}

			var $highlighted = $("#highlighted");

			function toggle_important_fields() {
				$("input:text, textarea, select, input:radio:checked").each(function() {
					$(this).removeClass('highlight');
					$("#foverlap").removeClass('highlight');
					$(this).parent().removeClass('highlight');
					if($highlighted.val() == "0") {
						if($(this).data('important') == '1') {
							if(($(this).val() != "") && ($(this).val() != "-1")) {

							} else {
								if($(this).is('[type=radio]')) {
									$(this).parent().addClass('highlight');
								} else {
									$(this).addClass('highlight');
								}
							}
						}
					}
				});
				if($highlighted.val() == "0") {
					$highlighted.val("1");
				} else {
					$highlighted.val("0");
				}
			}

			//$(document).ready(function(){
			//
			//	$("[id ^= 'text_']").hide();
			//
			////$("select").multiselect({
			////	   multiple: false,
			////	   header: "- Select an Option -",
			////	   noneSelectedText: "- Select an Option -",
			////	   selectedList: 1
			////});
			//
			//});
		</script>
<script type="text/javascript">
	function check_number(obj, e) {
		var c = String.fromCharCode(e.which);
		//		if ((("0123456789.").indexOf(c) > -1)){
		return true;
		//		} else {
		//			return false;
		//		}
	}

	function check_date(e) {
		var datePatISO8601 = /^(\d{4})(\/|-)(\d{2})(\/|-)(\d{2})$/;
		var dateStr = e.value;
		var matchArray = dateStr.match(datePatISO8601);
		if((matchArray == null) && (dateStr != "")) {
			alert("The date you typed is incorrect!\nPlease make sure you enter it in \nthe format YYYY-MM-DD, i.e. 2011-08-31")
			e.value = "";
		}
	}

	function check_num(e) {
		var n = e.value;
		if(n != "") {
			if(!isNaN(parseFloat(n)) && isFinite(n) && (parseFloat(n) >= 0)) {
				// Is a number
			} else {
				alert("Please type in a non negative number!");
				e.value = "";
			}
		}
	}
</script>

</body></html>
