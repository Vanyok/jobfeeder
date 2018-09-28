<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 9/28/18
 * Time: 7:40 PM
 */
include_once ('AppController.php');
class FeederApp
{
    /**
     * bind request values
     * run controller action.
     */
    public function run(){
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1 ;
        $controller = new AppController();
        $controller->feedAction($page);
    }


}