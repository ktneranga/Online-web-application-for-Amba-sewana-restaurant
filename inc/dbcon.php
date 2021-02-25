<?php


class dbcon
{
        public $servername;
        public $username;
        public $password;
        public $dbname;
        public $tablename;
        public $con;


        // class constructors
    public function __construct(
        $dbname = "restdb",
        $tablename = "foods",
        $servername = "localhost",
        $username = "root",
        $password = ""
    )
    {

      // create connection
        $this->con = mysqli_connect('localhost','root','','restdb');

    }

    // get product from the database
    public function getData(){
        $sql = "SELECT * FROM foods";

        $result = mysqli_query($this->con, $sql);

        if(mysqli_num_rows($result) > 0){
            return $result;
        }else{
            echo "Error!!!";
        }
    }
}






