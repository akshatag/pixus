<?php


function getAPIRequest(){

    $req_method = $_SERVER['REQUEST_METHOD'];

    if($req_method != 'GET' && $req_method != 'POST'){
        return API_REQ_FAIL_INVAL_URL;
    }

    if(!isset($_SERVER['REQUEST_URI'])){
        return API_REQ_FAIL_INVAL_URL;
    }

    return '/'.$_GET['request'];
}

function parseAPIRequest($req, $patternTable){

    //If request length is zero, invalid parse
    if(strlen($req) <= 0){
        return API_PARSE_FAIL_INVAL;
    }

    //If not alpha numeric after replacing exception characters, invalid parse
    if(!ctype_alnum(str_replace(array('/', '?', '=', '%', '_', '&'), '', $req))){
        return API_PARSE_FAIL_INVAL;
    }

    //If request doesn't begin with a slash, invalid parse
    if($req{0} !== '/'){
        return API_PARSE_FAIL_INVAL;
    }

    $req_parts = preg_split('/\//', $req, -1, PREG_SPLIT_NO_EMPTY);

    //If request has zero parts, invalid parse
    if(count($req_parts) <= 0){
        return API_PARSE_FAIL_INVAL;
    }


    foreach($patternTable as $pattern => $handle){

        $params = array();
        $match = true;

        //Will assume pattern table is correct, no error checking here
        $pattern_parts = preg_split('/\//', $pattern, -1, PREG_SPLIT_NO_EMPTY);

        //If not same number of parts, this pattern doesn't match the request
        if(count($req_parts) != count($pattern_parts)){
            continue;
        }

        //If not same HTTP action (POST, GET, etc.), not this pattern
        if($_SERVER['REQUEST_METHOD'] !== $handle[2]){
            continue;
        }

        for($i = 0; $i < count($pattern_parts) && $match; $i++){
            if($pattern_parts[$i] == '$'){
                array_push($params, $req_parts[$i]);
            }else{
                if($pattern_parts[$i] == $req_parts[$i]){
                    continue;
                }else{
                    $match = false;
                }
            }
        }

        if($match){
            array_push($handle, $params);
            return $handle;
        }

    }

    return false;



}


?>