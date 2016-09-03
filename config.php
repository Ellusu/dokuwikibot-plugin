<?php
/**
 *  titolo: DokuWikiBot
 *  autore: Matteo Enna (http://matteoenna.it)
 *  licenza: GPL3
 **/

    $json_data = file_get_contents('conf/conf.json');
    $array = json_decode($json_data,true);

    define(BOT_TOKEN,$array['conf']['BOT_TOKEN']);
    
    define($array['default_message'][$key],$array['default_message'][$value]);
    
    define(type_error_message,$array['default_message']['type_error_message']);
    define(welcome_message,$array['default_message']['welcome_message']);
    define(help_message,$array['default_message']['help_message']);
    define(unknown_request,$array['default_message']['unknown_request']);
    define(unknown_page,$array['default_message']['unknown_page']);
    define(unknown_column,$array['default_message']['unknown_column']);
    define(data_null,$array['default_message']['data_null']);
    define(search_null,$array['default_message']['search_null']);
    
    define(dir_doku,$array['conf']['dir_doku']);
    define(doku_data,$array['conf']['doku_data']);

   
    define('API_URL','https://api.telegram.org/bot'.BOT_TOKEN.'/' );
   
    define('API_URL','https://api.telegram.org/bot'.BOT_TOKEN.'/' );
    define('acapo', "\n");

