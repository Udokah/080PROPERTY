<?php

/// Upload image
function Upload_image( $name , $size , $tmp , $path){
	        list($txt, $ext) = explode(".", $name);
			$ext = mb_strtolower($ext);   // change all extensgion to lowercase
			$newName = get_random().time().'.'.$ext;// Create Random Name
			if(move_uploaded_file($tmp, $path.$newName)){
            $status = $newName ;
			}
			else{
				$status = false ;
			}
			
			return  $status ;
}

function time_since ($start){
       $start = strtotime($start) ;
        $end = strtotime(date('Y-m-d H:i:s'));
	
    $diff = $end - $start;
    $days = floor ( $diff/86400 ); //calculate the days
    $diff = $diff - ($days*86400); // subtract the days
    $hours = floor ( $diff/3600 ); // calculate the hours
    $diff = $diff - ($hours*3600); // subtract the hours
    $mins = floor ( $diff/60 ); // calculate the minutes
    $diff = $diff - ($mins*60); // subtract the mins
    $secs = $diff; // what's left is the seconds;
	
    if ($secs!=0) 
    {
        $secs .= " seconds";
        if ($secs=="1 seconds") $secs = "1 second"; 
    }
    else $secs = '';
    if ($mins!=0) 
    {
        $mins .= " mins ";
        if ($mins=="1 mins ") $mins = "1 min "; 
        $secs = '';
    }
    else $mins = '';
    if ($hours!=0) 
    {
        $hours .= " hours ";
        if ($hours=="1 hours ") $hours = "1 hour ";             
        $secs = '';
    }
    else $hours = '';
    if ($days!=0) 
    {
        $days .= " days "; 
        if ($days=="1 days ") $days = "1 day ";                 
        $mins = '';
        $secs = '';
        if ($days == "-1 days ") {
            $days = $hours = $mins = '';
            $secs = "less than 10 seconds";
        }
    }
    else $days = '';
	
    $return  = "$days $hours $mins $secs ago";
	
	return $return;
}

function cleanInput($input){
 
  $search = array(
    '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
    '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
    '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
    '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
  );
 
    $output = preg_replace($search, '', $input);
    return $output;
  }

function sanitize($input) {
    if (is_array($input)) {
        foreach($input as $var=>$val) {
            $output[$var] = sanitize($val);
        }
    }
    else {
        if (get_magic_quotes_gpc()) {
            $input = stripslashes($input);
        }
        $input  = cleanInput($input);
        $output = mysql_real_escape_string(strip_tags(trim($input)));
    }
    return $output;
}

// function to generate random numbers
function get_random(){
/// get unique code 
//To Pull 8 Unique Random Values Out Of AlphaNumeric

//removed number 0, capital o, number 1 and small L
//Total: keys = 32, elements = 33
$characters = array(
"A","B","C","D","E","F","G","H","J","K","L","M",
"N","P","Q","R","S","T","U","V","W","X","Y","Z",
"1","2","3","4","5","6","7","8","9","0");

//make an "empty container" or array for our keys
$keys = array();

//first count of $keys is empty so "1", remaining count is 1-7 = total 8 times
while(count($keys) < 8) {
    //"0" because we use this to FIND ARRAY KEYS which has a 0 value
    //"-1" because were only concerned of number of keys which is 32 not 33
    //count($characters) = 33
    $x = mt_rand(0, count($characters));
    if(!in_array($x, $keys)) {
       $keys[] = $x ;
    }
}
@$random_chars = '' ;
foreach($keys as $key){
   @$random_chars .= $characters[$key];
}
return $random_chars;
}
?>