<?php

require_once('./include/php/basic_defines.inc');
require_once('./include/php/db_connect.inc');

$questions_result = mysql_query("SELECT * FROM questions WHERE category=2 AND headertype!=1");
$questions = array();
for ($i=0; $i<mysql_num_rows($questions_result); $i++) {
    $questions[] = mysql_fetch_assoc($questions_result);
}

$datatypes_result = mysql_query("SELECT * FROM datatypes");
$datatypes = array();
for ($i=0; $i<mysql_num_rows($datatypes_result); $i++) {
    $row = mysql_fetch_assoc($datatypes_result);
    $datatypes[$row['typeid']][] = array('val' => $row['val'], 'description' => $row['description'], 'has_text' => $row['has_text']);
//    $datatypes[$row['typeid']]['val'] = $row['val'];
//    $datatypes[$row['typeid']]['description'] = $row['description']; 
}

?>

<!-- <form class="form-horizontal"> -->

<form id="basic_data_frm">

<? 
for ($i=0; $i<count($questions); $i++){
    if ($questions[$i]['headertype'] == '1') {
//        echo "<h4> ".$questions[$i]['question']." </h4>\n";
//        continue;
    }
    if ($questions[$i]['headertype'] == '2') {
        echo "<h5> ".$questions[$i]['question']." </h5>\n";
        continue;
    }
    $qid = $questions[$i]['qid'];
    $question = $questions[$i]['question'];
    $typeid = $questions[$i]['typeid'];
    switch ($typeid) {
        case 'INT2':
?>
  <div class="control-group">
    <label class="control-label" for="inputPassword"><u><? echo $qid.". ".$question ?></u></label>    
    <div class="controls">
      &nbsp; &nbsp; &nbsp; <input type="text" id="inputPassword" placeholder="" style="width: 20px">
    </div>
  </div>
<?            
            break;
        case 'INT3':
?>
  <div class="control-group">
    <label class="control-label" for="inputPassword"><u><? echo $qid.". ".$question ?></u></label>    
    <div class="controls">
      &nbsp; &nbsp; &nbsp; <input type="text" id="inputPassword" placeholder="" style="width: 30px">
    </div>
  </div>
<?            
            break;
        case 'TXT':
?>
  <div class="control-group">
    <label class="control-label" for="inputPassword"><u><? echo $qid.". ".$question ?></u></label>    
    <div class="controls">
      &nbsp; &nbsp; &nbsp; <textarea cols="5" id="inputEmail" placeholder="" />
    </div>
  </div>
<?            
            break;
        case 'DATE':
?>
  <div class="control-group">
    <label class="control-label" for="inputPassword"><u><? echo $qid.". ".$question ?></u></label>    
    <div class="controls">
      &nbsp; &nbsp; &nbsp; <input type="text" id="birthdate" class="date_input" placeholder="DD/ΜΜ/YYYY">
    </div>
  </div>
<?            
            break;
        case 'COUNTRIES':
?>
  <div class="control-group">
    <label class="control-label" for="inputPassword"><u><? echo $qid.". ".$question ?></u></label>    
    <div class="controls">
      &nbsp; &nbsp; &nbsp;
      <select>
          <option value=""> - Επιλέξτε - </option>
<?
        $countries_result = mysql_query("SELECT isocode, country_gr FROM countries");
        while ($country = mysql_fetch_assoc($countries_result)){
?>
          <option value="<? echo $country['isocode']; ?>"><? echo $country['country_gr']; ?></option>           
<?                     
        }
?>          
      </select>
    </div>
  </div>
<?            
            break;                    
        default:
?>
  <div class="control-group">  
    <label class="control-label" for="inputPassword"><u><? echo $qid.". ".$question ?></u></label>    
    <div class="controls row-fluid">
<?
    for ($j=0; $j<count($datatypes[$typeid]); $j++) {
        $val = $datatypes[$typeid][$j]['val'];
        $description = $datatypes[$typeid][$j]['description'];
        $has_text = $datatypes[$typeid][$j]['has_text'];
?>            
            <div style="">
            <label class="radio">
              &nbsp; &nbsp; &nbsp; <input type="radio" name="optionsRadios" id="optionsRadios_<? echo $j; ?>" value="<? echo $val; ?>">
              <? echo $description; ?>
<?
        if ($has_text) {
?>
            &nbsp; &nbsp; <input type="text" id="inputPassword" placeholder="">
<?            
        }
?>              
            </label>
            </div>
<?
    }
?>            
    </div>
  </div>                
<?            
            break;
    }
?>


<?   
}
?>

</form>

<script type="text/javascript" charset="utf-8">
	$(".date_input").datepicker({
	   dateFormat: "dd/mm/yy",
	   altFormat: "yy-mm-dd"
	});
</script>