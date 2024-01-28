<?php
    namespace Lifeline\Controller;

    class LifelineConnector {
        protected $host;
        protected $view;
        protected $user;
        protected $pass;

        protected $db;

        public function __construct() {
            global $wpdb, $table_prefix;
            $ll_settings = $wpdb->get_row("SELECT * FROM " . $table_prefix . LIFELINE_SETTINGS_DB);

            $this->host = $ll_settings->mklek_db_host;
            $this->view = $ll_settings->mklek_db_view;
            $this->user = $ll_settings->mklek_db_user;
            $this->pass = $ll_settings->mklek_db_pass;

            $this->connect();
        }

        public function connect() {
            $this->db = new PDO("pgsql:host=$this->host user=$this->user dbname=$this->view password=$this->pass");
        }
        
        public function query($query) {
            if (!$this->db)
                $this->connect();
            
            $result = pg_query($query) or die('Error message: ' . pg_last_error());

            $data = [];

            while ($row = pg_fetch_row($result))
                $data[] = $row;

            pg_free_result($result);

            pg_close($this->db);

            return $data;
        }
    }