<?php

session_start();

require_once('./include/php/basic_defines.inc');
require_once('./include/php/db_connect.inc');

$emenoid = $_GET['emenoid'];

if ($emenoid != -1) {
    // Get sensitive data from DB
    
}

?>

<form class="form-horizontal" id="sensitive_data_frm">

  <div class="control-group">
    <label class="control-label" for="surname">Επώνυμο</label>
    <div class="controls">
      <input type="text" id="surname" name="surname" placeholder="">
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="name">Όνομα</label>
    <div class="controls">
      <input type="text" id="name" name="name" placeholder="">
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="street">Διεύθυνση</label>
    <div class="controls">
      <input type="text" id="street" name="street" placeholder="Οδός"> 
      <input type="text" id="street" name="street" class="input-mini" placeholder="Αριθμός"> 
      <input type="text" id="street" name="street" class="input-mini" placeholder="Όροφος">
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="dimos">Δήμος/Κοινότητα</label>
    <div class="controls">
      <input type="text" id="dimos" name="dimos" placeholder="">
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="nomos">Νομός</label>
    <div class="controls">
      <input type="text" id="dimos" name="dimos" placeholder="">
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="zipcode">Ταχυδρομικός κώδικας</label>
    <div class="controls">
      <input type="text" id="zipcode" name="zipcode" class="input-mini" placeholder="">
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="homephone">Τηλέφωνα</label>
    <div class="controls">
      <input type="text" id="homephone" name="homephone" placeholder="Οικίας"> 
      <input type="text" id="workphone" name="workphone" placeholder="Εργασίας"> 
      <input type="text" id="cellphone" name="cellphone" placeholder="Κινητό"> 
    </div>
  </div>
<!--
  <div class="control-group">
    <label class="control-label" for="inputPassword">Όνομα Συνεντευκτή/τριας</label>
    <div class="controls">
      <input type="text" id="inputPassword" placeholder="">
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="inputPassword">Κωδικός Συνεντευκτή/τριας</label>
    <div class="controls">
      <input type="text" id="inputPassword" placeholder="">
    </div>
  </div>
-->

<?php

if ($emenoid == -1) {

?>

  <div class="control-group">
    <div class="controls">
      <button class="btn btn-primary" id="new_entry_button"> <i class="icon-file"></i> Δημιουργία νέας εγγραφής</button>
    </div>
  </div>

<script type="text/javascript" charset="utf-8">
	$("#new_entry_button").click(function() {
	    response = confirm(" ΠΡΟΣΟΧΗ!\n Ελέγξτε προσεκτικά τα στοιχεία που έχετε εισάγει \n επειδή ύστερα από αυτό το βήμα όλα τα στοιχεία \n θα κρυπτογραφηθούν.");
        if (response) {
            sensitiveFormData = $("#sensitive_data_frm").serialize();
            $.ajax({
                type: "POST",
                url: "save_sensitive_data.php",
                async: false,
                data: sensitiveFormData,
                success: function(msg) {
                            var data = $.parseJSON(msg);
                            if (data.success) {
                                $(".bar").css("width", '5%');
                                alert("New EmenoID is: " + data.emenoid);
                            }
                         }
            });
	    }
	    return false;
	});
</script>

<?php
    
}

?>


</form>

