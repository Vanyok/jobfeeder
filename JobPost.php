<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 9/28/18
 * Time: 7:37 PM
 */
include_once('JobPost.php');
class JobPost
{
    public $projectId;
    public $applyUrl;
    public $name;
    public $title;
    public $ingress;
    public $body;
    public $numPositions;
    public $startDate;
    public $endDate;
    public $logo;
    public $deadline;
    public $departmentId;
    public $facebook;
    public $linkedin;
    public $twitter;
    public $address1;
    public $address2;
    public $postalCode;
    public $city;
    public $country;
    public $web;
    public $salary;
    public $skills;


    public function setAttributes($data){
        foreach ($data as $key => $val){
            if(property_exists(JobPost::class,$key)){
                $this->$key = $val;
            }
        }
    }
}