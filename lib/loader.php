<?php
const base_dir = 'src';
spl_autoload_register(function ($class_name){
    include base_dir.DIRECTORY_SEPARATOR.$class_name.'.php';
});
