<?php

class Mysql
{

    private $db;

    public function __construct()
    {
        $this->db = new mysqli('mysql', 'root', 'root', 'wp3');
    }

    public function getById(int $id)
    {
        $result = $this->db->query('SELECT * FROM jobs where id = '.$id);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }

    public function getLast()
    {
        $result = $this->db->query('SELECT * FROM jobs ORDER BY id DESC LIMIT 1');
        if ($result->num_rows > 0) {
            return ($result->fetch_all(MYSQLI_ASSOC))[0];
        }
    }

    public function store(array $job) :bool
    {

        $sql = 'INSERT INTO jobs (name, email, text)VALUES ("'.$job['name'].'", "'.$job['email'].'", "'.$job['text'].'" )';
        return $this->db->query($sql);

    }

    public function getJobs($page, $sort, $order)
    {

        $offset = 3 * ($page - 1);

        $result = $this->db->query('SELECT * FROM jobs ORDER BY '.$sort.' '.$order.' LIMIT 3 offset '.$offset);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }

    }

    public function countJobs()
    {
        $result = $this->db->query('SELECT COUNT(*) FROM jobs');
        if ($result->num_rows > 0) {
            return ($result->fetch_all())[0][0];
        }

    }

    public function getLastError()
    {
        return $this->db->error;
    }

    public function update($id, $text, $status)
    {
        return $result = $this->db->query('UPDATE jobs SET text="'.$text.'", status='.$status.' WHERE id='.$id);
    }


}