<?php
//NOTE: NEED TO ADJUST THIS TO PRODUCTION SPECIFIC PATH
function convert_path($path, $to_absolute_url){
    // convert_path()
    // Converts a directory path to url compatible (t_a_u=true)
    // Converts a url path to a directory path (t_a_u=false)
    $public_filepath = "/home/goldemat/public_html/spectrum";
    $public_url = "/~goldemat/spectrum";
    $new_path = "";

    $trailing_path = explode("spectrum", $path)[1]; // Split URL in twain on common subfolder

    // Convert to a url friendly path
    if($to_absolute_url){
        $new_path = $public_url.$trailing_path;
    }
    // Convert to a file directory path
    else{
    $new_path = $public_filepath.$trailing_path;
    }

    return $new_path;
}
?>
