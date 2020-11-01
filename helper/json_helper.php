<?php

function json_bind($data,$responsecode=200,$comment='',$status=''){

    header('Content-type: application/json');
    http_response_code($responsecode);
    echo json_encode([
        'response_code'=>$responsecode,
        'response_data'=>$data,
        'comments'=>$comment,
        'status'=> $status
    ],
    JSON_PRETTY_PRINT); 
    exit;

}

