<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 9/28/18
 * Time: 7:38 PM
 */
include_once('JobPost.php');
include_once('APIService.php');

class DBService
{

    private $numRecordsOnPage = 10;


    private $servername = "localhost";
    private $username = "short_u";
    private $password = "Short_u1@";
    private $dbname = "job_feeder";
    private $table = "jobPosts";
    private $connection;

    /**
     * @return int
     */
    public function getNumRecordsOnPage(): int
    {
        return $this->numRecordsOnPage;
    }

    /**
     * @return int
     */
    public function getCountJobFeeds()
    {
        $cnt = 0;
        $sql = "SELECT count(*) FROM " . $this->table;
        $conn = $this->getConnection();
        $sql = $conn->prepare($sql);
        if ($sql) {
            $sql->execute();
            $sql->bind_result($cnt);
            $sql->fetch();
            $sql->close();
        }

        return $cnt;
    }

    /**
     * @param $page
     * @return JobPost[]
     */
    public function getJobFeed($page)
    {
        $feed = array();
        if ($page == 1)
            $this->updateInfo();
        $sql = "SELECT `projectId`, `applyUrl`, `name`, `title`, `ingress`, `body`, `numPositions`, `startDate`, `endDate`, 
           `logo`, `deadline`, `departmentId`, `facebook`, `linkedin`, `twitter`, `address1`, `address2`, 
           `postalCode`, `city`, `country`, `web`, `salary`, `skills` FROM " . $this->table . " LIMIT " . $this->numRecordsOnPage . " OFFSET " . ($this->numRecordsOnPage * ($page - 1));

        $conn = $this->getConnection();
        $sql = $conn->prepare($sql);
        if ($sql) {

            $sql->execute();
            $sql->bind_result($projectId,
                $applyUrl,
                $name,
                $title,
                $ingress,
                $body,
                $numPositions,
                $startDate,
                $endDate,
                $logo,
                $deadline,
                $departmentId,
                $facebook,
                $linkedin,
                $twitter,
                $address1,
                $address2,
                $postalCode,
                $city,
                $country,
                $web,
                $salary,
                $skills);

            while ($sql->fetch()) {

                $post = new JobPost();
                $post->projectId = $projectId;
                $post->applyUrl = $applyUrl;
                $post->name = $name;
                $post->title = $title;
                $post->ingress = $ingress;
                $post->body = $body;
                $post->numPositions;
                $post->startDate = $startDate;
                $post->endDate = $endDate;
                $post->logo = $logo;
                $post->deadline = $deadline;
                $post->departmentId = $departmentId;
                $post->facebook = $facebook;
                $post->linkedin = $linkedin;
                $post->twitter = $twitter;
                $post->address1 = $address1;
                $post->address2 = $address2;
                $post->postalCode = $postalCode;
                $post->city = $city;
                $post->country = $country;
                $post->web = $web;
                $post->salary = $salary;
                $post->skills = json_encode($skills);
                $feed[] = $post;
            }
            $sql->close();
        }
        return $feed;
    }

    private function getConnection()
    {
        if (!isset($this->connection)) {
            $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            if ($this->connection->connect_error) {
                die("Connection with DB failed: " . $this->connection->connect_error);
            }
            $this->connection->set_charset("utf8");
        }
        return $this->connection;
    }

    private function updateInfo()
    {
        $jobs = APIService::getJobs();
        $conn = $this->getConnection();
        $conn->query('LOCK TABLES ' . $this->table);
        $conn->query("DELETE FROM " . $this->table);
        foreach ($jobs as $job) {
            //  var_dump($job);

            $conn->query("INSERT INTO " . $this->table . "(
           `projectId`, `applyUrl`, `name`, `title`,  `body`, `numPositions`, `startDate`, `endDate`, 
           `logo`, `deadline`, `departmentId`, `facebook`, `linkedin`, `twitter`, `address1`, `address2`, 
           `postalCode`, `city`, `country`, `web`, `salary`, `skills`) 
           VALUES ('" . $job->projectId . " ', '" . $job->applyUrl . " ', '" . $job->name . " ', '" . $job->title . " ',  
           '" . $job->body . " ', '" . $job->numPositions . " ', '" . $job->startDate . " ', '" . $job->endDate . " ', '" . $job->logo . " ', 
           '" . $job->deadline . " ', '" . $job->departmentId . " ', '" . $job->facebook . " ', '" . $job->linkedin . " ', '" . $job->twitter . " ', 
           '" . $job->address1 . "', '" . $job->address2 . "', '" . $job->postalCode . "', '" . $job->city . "', '" . $job->country . "', 
           '" . $job->web . " ', '" . $job->salary . " ', '" . json_encode($job->skills) . " ')"
            );

        }

        echo $conn->error;
        $conn->query('UNLOCK TABLES');

    }
}