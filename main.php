<?php 
require_once('json.php');

$decoded_json = json_decode(json_decode($people), true);

//if error then reformat json by removing extra comma(,)
//As of now only extra comma error is handled. Can extend the format handling to specific cases
if(json_last_error() != 0){
    $people = preg_replace("/,(?!.*,)/", "", $people);
    $decoded_json = json_decode($people, true);
}
if(json_last_error() == 0){
    $concatinated_emails = '';
    $temp_input = [];
    if(isset($decoded_json['data'])){
        foreach($decoded_json['data'] as $data){
            $temp_input[$data['age']] = $data;

            $concatinated_emails .= $data['email'];
            if (next($decoded_json['data'] )) {
                $concatinated_emails .= ',';
            }
        }
    }

    //variable 1
    echo $concatinated_emails;
    krsort($temp_input);
    //variable 2
    $sorted_input = json_encode(['data' => array_values($temp_input)]);
}else{
    echo "error in json format";   
}
