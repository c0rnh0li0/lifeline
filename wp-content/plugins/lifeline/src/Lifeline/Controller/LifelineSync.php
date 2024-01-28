<?php
    namespace Lifeline\Controller;

    class LifelineSync extends LifelineConnector {
        public function __construct() {
            parent::__construct();
        }

        public function get_products() {
            $sql = "SELECT * FROM web_prodazba";

            $data = $this->query($sql);

            
        }
    }