<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 9/28/18
 * Time: 7:38 PM
 */
include_once ('JobPost.php');
class APIService
{
    CONST API_URL = 'https://api.recman.no/v2/get/';
    CONST API_KEY = '180413023455kb1d5c1223d347c115f78c6daaa9bd426252042511';

    /**
     * @return JobPost[]
     */
    public static function getJobs()
    {
        $jobs = array();
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            //   CURLOPT_URL => 'http://ip-api.com/json/'.$_SERVER['REMOTE_ADDR'],
            CURLOPT_URL => APIService::API_URL.'?key='.APIService::API_KEY.'&scope=jobPost&fields=projectId,applyUrl,name,title,ingress,body,startDate,endDate,logo,deadline,departmentId,facebook,linkedin,twitter,address1,address2,postalCode,city,country,web,salary,skills',
            CURLOPT_FAILONERROR => true,
            CURLOPT_TIMEOUT => 5

        ));

        // Send the request & save response to $resp
        // return $countryCode;
        $resp = curl_exec($curl);/**/
        // return $countryCode;
        // Close request to clear up some resources
        curl_close($curl);
        if ($resp) {
            $code_data = json_decode($resp, true);

        foreach ($code_data['data'] as $datum) {
            $job = new JobPost();
            $job->setAttributes($datum);
            $jobs[] = $job;
        }
        }
        return $jobs;
    }
}