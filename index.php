<?php

require_once('./include/php/basic_defines.inc');
require_once('./include/php/db_connect.inc');

session_start();
$_SESSION['intervid'] = 250;

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Ερωτηματολόγιο E.M.E.N.O.</title>
        <link rel="stylesheet" href="include/bootstrap/css/bootstrap.min.css" type="text/css" />
        <link rel="stylesheet" href="include/bootstrap/css/bootstrap-responsive.min.css" type="text/css" />
        <link rel="stylesheet" href="include/css/redmond/jquery-ui-1.8.23.css" type="text/css" />
        <style type="text/css" media="screen">
            body {
                font-size: 8pt;
                background-color: #DEEDF7;
            }
            .center_shadow {
                -webkit-box-shadow: 0px 0px 5px #888;
                -moz-box-shadow: 0px 0px 5px #888;
                -box-shadow: 0 x 0px 5px #888;
            }
            .add_shadow_tabs {
                -webkit-box-shadow: 2px 2px 3px #888;
                -moz-box-shadow: 2px 2px 3px #888;
                -box-shadow: 2px 2px 3px #888;
            }
            .header-top {
                z-index: 2;
                position: fixed;
                width: 101%;    
                -webkit-box-shadow: 0px 0px 10px #888;
                -moz-box-shadow: 0px 0px 10px #888;
                -box-shadow: 0 x 0px 10px #888;
            }
            .main-tabs {
                z-index: 1;
                position: relative;
                top: 155px;
            }
        </style>
    </head>
    
<body>
<!-- 
<div class="row">
  <div class="span8 offset1">
      
  </div>
</div>   -->

<div class="row well well-small header-top center_shadow">
    <div class="span3 offset2">
        <img src="images/emeno_logo.png" alt="Emeno Logo" style="width: 60%" class="center_shadow" />
    </div>
    <div class="span4">
        <h3 style="text-align: center"> Online Ερωτηματολόγιο </h3>
        <h4 style="text-align: center">Ποσοστό συμπλήρωσης: 0%</h4>
        <div class="add_shadow_tabs ui-corner-all">
            <div class="progress progress-success progress-striped active">
                <div class="bar" style="width: 0%;"></div>
            </div>     
        </div>
    </div>
    <div class="span4 offset1">
        <br />
        <!-- <button class="btn btn-primary" id="save_btn"> Αποθήκευση & Κρυπτογράφηση </button> -->
        <button class="btn btn-primary disabled" id="prev_btn"><i class="icon-chevron-left icon-white"></i> Προηγούμενο </button>
        <button class="btn btn-primary" id="next_btn"> Επόμενο <i class="icon-chevron-right icon-white"></i></button>
        <br /><br />
        <!-- <button class="btn btn-danger"> Καθαρισμός Φόρμας </button> -->
    </div>
</div>

<div class="container main-tabs">
    <div id="survey_tabs" class="add_shadow_tabs">
        <ul>
            <li> <a href="#sensitive_data">Αρχή</a> </li>
            <li> <a href="#basic_data">Βασικά Στοιχεία</a> </li>
            <li> <a href="#health_status">Κατάσταση Υγείας</a> </li>
            <li> <a href="#health_system">Σύστημα Υγείας</a> </li>
            <li> <a href="#health_factors">Παράγοντες που επηρεάζουν την Υγεία</a> </li>
            <li> <a href="#contagious_diseases">Μεταδιδόμενα Νοσήματα</a> </li>
        </ul>
        <div id="sensitive_data"></div>
        <div id="basic_data"></div>
        <div id="health_status"></div>
        <div id="health_system"></div>
        <div id="health_factors"></div>
        <div id="contagious_diseases"></div>
    </div>
</div>

<div id="finalize_window" title="Διεξαγωγή Συνέντευξης" style="display:none;">
  <form id="finalize_frm">
      
      <div class="control-group">
        <label class="control-label"><h4>Αποτέλεσμα συνέντευξης</h4></label>    
        <div class="controls">
            <label class="radio">
              <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
              Η συνέντευξη πραγματοποιήθηκε
            </label>
            <label class="radio">
              <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
              Η συνέντευξη αναβλήθηκε
            </label>  
            <label class="radio">
              <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
              Η συνέντευξη ακυρώθηκε 
            </label>  
            <label class="radio">
              <input type="radio" name="optionsRadios" id="optionsRadios4" value="option4">
              Η συνέντευξη διεκόπη
            </label>  
            <label class="radio">
              <input type="radio" name="optionsRadios" id="optionsRadios5" value="option5">
              Το νοικοκυριό έχει αντικατασταθεί
            </label>  
        </div>
      </div>

      <div class="control-group">
        <label class="control-label"><h4>Λόγοι αναβολής, ακύρωσης ή διακοπής της συνέντευξης</h4></label>    
        <div class="controls">
            <label class="radio">
              <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
              Η κατοικία δεν μπόρεσε να εντοπισθεί με τα υπάρχοντα στοιχεία (περιοχή, οδός, αριθμός κλπ)
            </label>
            <label class="radio">
              <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
              Δεν ήταν δυνατή η πρόσβαση στη συγκεκριμένη κατοικία (π.χ. λόγω  πλημύρας, χιονιών,  μη προσπελάσιμων δρόμων)
            </label>  
            <label class="radio">
              <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
              Τα μέλη του νοικοκυριού αρνήθηκαν να συμμετάσχουν
            </label>  
            <label class="radio">
              <input type="radio" name="optionsRadios" id="optionsRadios4" value="option4">
              Τα μέλη του νοικοκυριού απουσιάζουν 
            </label>  
            <label class="radio">
              <input type="radio" name="optionsRadios" id="optionsRadios5" value="option5">
              Τα μέλη του νοικοκυριού ήταν υπό την επήρεια αλκοόλ ή ναρκωτικών ουσιών
            </label>  
            <label class="radio">
              <input type="radio" name="optionsRadios" id="optionsRadios6" value="option6">
              Οι ερευνητές δέχτηκαν λεκτική ή σωματική επιθετικότητα
            </label>  
        </div>
      </div>
  </form>
</div>    
    
<!-- Scripts -->
<script src="include/js/jquery-1.8.1.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="include/js/jquery-ui-1.8.23.min.js"></script>
<script src="include/bootstrap/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
    
<script type="text/javascript" charset="utf-8">
    // Load Forms
<?php

if (!isset($_GET['emenoid'])) {
    $emenoid = -1;
} else {
    $emenoid = $_GET['emenoid'];    
}

?>
    $('#sensitive_data').load('sensitive_data.php?emenoid=<? echo $emenoid ?>', function() {});
/*
    $('#basic_data').load('basic_data.php', function() {});
    $('#health_status').load('health_status.php', function() {});
    $('#health_system').load('draw_questions.php?c=3', function() {});
    $('#health_factors').load('draw_questions.php?c=4', function() {});
    $('#contagious_diseases').load('draw_questions.php?c=5', function() {});
*/    
    // End Load Forms

	$(document).ready(function() {
	    $("#survey_tabs").tabs();
	    $("#save_btn").click(function() {
	       $("#finalize_window").dialog({
                modal: true,
                title: "Διεξαγωγή Συνέντευξης",
                width: 860,
                height: 500,
                buttons: {
                    OK: function() {
                            $( this ).dialog( "close" );
                        },
                    "Άκυρο": function() {
                                $( this ).dialog( "close" );
                             }                        
                }
           }); 
	    });
	})
</script>
<!-- End Scripts -->    
</body>
</html>