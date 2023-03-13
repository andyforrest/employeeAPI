<?php

class Employee{

    private $conn;
    private $table = 'employees';

    //db properties
    public $id;
    public $firstname;
    public $surname;
    public $dob;
    public $salary;


    //Create constructor
    public function __construct($db){
        $this->conn = $db;
    }

    //Create Employee
    public function create(){
        $query = 'INSERT INTO ' . $this->table .
            ' SET 
            firstname = :firstname,
            surname = :surname,
            dob = :dob,
            salary = :salary';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->firstname = htmlspecialchars(strip_tags($this->firstname));
        $this->surname = htmlspecialchars(strip_tags($this->surname));
        $this->dob = htmlspecialchars(strip_tags($this->dob));
        $this->salary = htmlspecialchars(strip_tags($this->salary));

        //Bind data
        $stmt->bindParam(':firstname', $this->firstname);
        $stmt->bindParam(':surname', $this->surname);
        $stmt->bindParam(':dob', $this->dob);
        $stmt->bindParam(':salary', $this->salary);

        //Execute query
        if ($stmt->execute()){
            return true;
        }

        //Print any errors
        printf("Error: %s.\n", $stmt->error);

        return false;



    }

    public function read(){
        $query = 'SELECT * FROM  
             '. $this->table .' e
             ORDER BY
                e.id DESC';

        //Create prepared statement
        $stmt = $this->conn->prepare($query);


        //Execute query
        $stmt->execute();

        return $stmt;

    }
}