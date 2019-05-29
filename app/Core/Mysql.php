<?php

class Mysql
{

    private $db;

    public function __construct()
    {
        $this->db = new mysqli('mysql', 'root', 'root', 'wp3');
    }

    /**
     * Job by id
     *
     * @param int $id
     * @return mixed
     */

    public function getById(int $id)
    {
        $result = $this->db->query('SELECT * FROM jobs where id = '.$id);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return new Error('job not found');
        }
    }


    /**
     * Get last created job
     *
     * @return mixed
     */

    public function getLast()
    {
        $result = $this->db->query('SELECT * FROM jobs ORDER BY id DESC LIMIT 1');
        if ($result->num_rows > 0) {
            return ($result->fetch_all(MYSQLI_ASSOC))[0];
        } else {
            return new Error('Not exist any jobs');
        }
    }


    /**
     * Save job
     *
     * @param array $job
     * @return bool
     */

    public function store(array $job) :bool
    {

        $sql = 'INSERT INTO jobs (name, email, text)VALUES ("'.$job['name'].'", "'.$job['email'].'", "'.$job['text'].'" )';
        return $this->db->query($sql);

    }

    /**
     * Get job list by page
     *
     * @param int $page
     * @param string $sort
     * @param string $order
     * @return mixed
     */
    public function getJobs(int $page, string $sort, string $order)
    {

        $offset = 3 * ($page - 1);

        $result = $this->db->query('SELECT * FROM jobs ORDER BY '.$sort.' '.$order.' LIMIT 3 offset '.$offset);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return new Error('Not exist any jobs');
        }

    }

    public function countJobs()
    {
        $result = $this->db->query('SELECT COUNT(*) FROM jobs');
        if ($result->num_rows > 0) {
            return ($result->fetch_all())[0][0];
        } else {
            return new Error('Not exist any jobs');
        }

    }

    /**
     * Get db error
     *
     * @return string
     */

    public function getLastError()
    {
        return $this->db->error;
    }

    /**
     * Update job
     *
     * @param int $id
     * @param string $text
     * @param $status
     * @return bool
     */

    public function update(int $id, string $text, $status)
    {
        $result = $this->db->query('UPDATE jobs SET text="'.$text.'", status='.$status.' WHERE id='.$id);
        return $result??false;
    }


}