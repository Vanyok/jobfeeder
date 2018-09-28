<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 9/28/18
 * Time: 7:38 PM
 */
include_once ('DBService.php');
include_once ('View.php');
class AppController
{

    protected $view;
    protected $dbService;

    public function __construct()
    {
        $this->view = new View();
        $this->dbService = new DBService();
    }

    public function feedAction($page){
        $feed = $this->dbService->getJobFeed($page);
        $count = $this->dbService->getCountJobFeeds();
        $pageSize = $this->dbService->getNumRecordsOnPage();
        $this->view->showFeed($feed,$count,$pageSize, $page);
    }
}