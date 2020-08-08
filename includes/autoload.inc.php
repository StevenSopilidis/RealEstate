<?php

spl_autoload_register('myAutoLoad');

function myAutoLoad($class){
    $path = 'classes/';
    $ext = '.class.php';
    $fileName = $path . $class . $ext;

    if(!file_exists($fileName)){//if the file we are calling it is inside a folder
        $path = '../classes/';
        $fileName = $path . $class . $ext;
    }
    if(!file_exists($fileName)){
        $path = '../../classes/';
        $fileName = $path . $class . $ext;
    }

    include $fileName;
}