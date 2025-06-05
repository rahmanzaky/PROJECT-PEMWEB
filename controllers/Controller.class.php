<?php

class Controller {

    function loadModel($model = ''){
        require_once('models/Model.class.php');
        require_once('models/' . $model . '.class.php');
        return new $model;
    }
    function loadView($view = '', $data = []){
        foreach($data as $key => $val)
            $$key = $val;
        include 'views/' . $view;
    }
    

}

