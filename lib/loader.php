<?php
const BASE_DIR = 'src';
spl_autoload_register(function ($class_name){
    include BASE_DIR.DIRECTORY_SEPARATOR.str_replace('\\', DIRECTORY_SEPARATOR, $class_name).'.php';
});
