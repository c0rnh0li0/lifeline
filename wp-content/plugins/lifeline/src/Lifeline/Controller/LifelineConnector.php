<?php
    namespace Lifeline\Controller;

use PDO;
use PDOException;

class LifelineConnector {
    protected $host;
    public $view;
    protected $user;
    protected $pass;
    protected $port;
    protected $dbname;

    protected $conn_string;

    protected $db;

    private $connection;

    private static $options = array(
        PDO::ATTR_EMULATE_PREPARES => FALSE, 
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );

    public function __construct() {
        global $wpdb, $table_prefix;
        $ll_settings = $wpdb->get_row("SELECT * FROM " . $table_prefix . LIFELINE_SETTINGS_DB);

        if (is_object($ll_settings)) {
            $this->host = $ll_settings->mklek_db_host;
            $this->view = $ll_settings->mklek_db_view;
            $this->user = $ll_settings->mklek_db_user;
            $this->pass = $ll_settings->mklek_db_pass;
            $this->port = $ll_settings->mklek_db_port;
            $this->dbname = $ll_settings->mklek_db_dbname;
    
            try {
                $dsn = "pgsql:host=$this->host;port=$this->port;dbname=$this->dbname";
                $username = $this->user;
                $password = $this->pass;
                $connection = new PDO($dsn, $username, $password, self::$options);

                $this->connection = $connection;

                return $connection;      
            } catch (PDOException    $e) {
                $this->log([
                    'inserted' => 0,
                    'updated' => 0,
                    'deleted' => 0,
                    'logs' => 'There was a problem connecting to the database: ' . $e->getMessage(),
                    'old_restore' => 0
                ]);
    
                // exit($e->getMessage());
            }
        }
    }
    
    public function query($query) {
        if (!$this->connection)
            return [];
        
        $result = $this->connection->query($query);

        $data = [];

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $data[] = (object) $row;
        }

        return $data;
    }

    public function log($args) {
        global $table_prefix, $wpdb;

        $tbl_logs = $table_prefix . LIFELINE_SYNC_LOG_DB;

        return $wpdb->insert($tbl_logs, $args);
    }
}