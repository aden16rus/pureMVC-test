<?php

    include_once('../app/Core/Mysql.php');

    class Model
    {

        private $mysql;

        private $data;

        /**
         * Model constructor.
         * @param $mysql
         */
        public function __construct()
        {
            $this->mysql = new Mysql;
        }


        /**
         * Data for save to db
         */

        public function fillFields($request)
        {
            $data = $this->checkData($request);

            $this->data = $data;

            if (count($data['errors'])>0) {
                return false;
            } else {
                return true;
            }


        }


        /**
         * Simple data validation before save
         */

        private function checkData($request)
        {

            $data = [];

            if(!isset($request['name']) | (strlen($request['name']) < 3) ) {
                $data['errors']['name'] = "Please enter correct name";
            }
            if(!isset($request['email']) | (filter_var($request['email'], FILTER_VALIDATE_EMAIL) === false) ) {
                $data['errors']['email'] = "Please enter correct email";
            }
            if(!isset($request['text'])) {
                $data['errors']['text'] = "Please enter text";
            }

            $data['name'] = filter_var($request['name'], FILTER_SANITIZE_STRING);
            $data['email'] = filter_var($request['email'], FILTER_SANITIZE_EMAIL);
            $data['text'] = filter_var($request['text'], FILTER_SANITIZE_STRING);

            return $data;
        }


        /**
         * Create new job
         *
         * @return mixed
         * @throws Exception
         */

        public function save()
        {
            if (!$this->mysql->store($this->data)) {
                throw new Exception($this->mysql->getLastError());
            } else {
                return $this->mysql->getLast();
            }
        }


        /**
         * @return mixed
         */
        public function getdata()
        {
            return $this->data;
        }


        /**
         * Get job list from db
         *
         * @param int $page
         * @param string $sort
         * @param string $order
         * @return mixed
         */

        public function getJobs($page, $sort = 'id', $order = 'asc')
        {
            return $this->mysql->getJobs($page, $sort, $order);
        }


        /**
         * Pages count for pagenator
         *
         * @return mixed
         */

        public function getPages()
        {
            return $this->mysql->countJobs();
        }


        /**
         * Get one job
         *
         * @param int $id
         * @return mixed
         */

        public function getById($id)
        {
            return ($this->mysql->getById($id))[0];
        }


        /**
         * Write updated job
         *
         * @param int $id
         * @return bool|mysqli_result
         */

        public function update($id)
        {

            $text = Helper::postString('text');
            $status = Helper::postInt('status');
            return $this->mysql->update($id, $text, $status);

        }


        /**
         * Get last mysql query error
         *
         * @return string
         */

        public function getLastError()
        {
            return $this->mysql->getLastError();
        }


    }