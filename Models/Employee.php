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

    //Read all employees
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

    //Update employee
    public function update(){
        $query = 'UPDATE '. $this->table .'
         SET 
            firstname = :firstname,
            surname = :surname,
            dob = :dob,
            salary = :salary
         WHERE id = :id';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->firstname = htmlspecialchars(strip_tags($this->firstname));
        $this->surname = htmlspecialchars(strip_tags($this->surname));
        $this->dob = htmlspecialchars(strip_tags($this->dob));
        $this->salary = htmlspecialchars(strip_tags($this->salary));
        $this->id = htmlspecialchars(strip_tags($this->id));


        //Bind data
        $stmt->bindParam(':firstname', $this->firstname);
        $stmt->bindParam(':surname', $this->surname);
        $stmt->bindParam(':dob', $this->dob);
        $stmt->bindParam(':salary', $this->salary);
        $stmt->bindParam(':id', $this->id);





        //Execute query
        if ($stmt->execute()){

            $count = $stmt->rowCount();
            if($count > 0){
                return true;
            }
        }

        //Print any errors
        printf("Error: %s.\n", $stmt->error);

        return false;

    }

    //Delete Employee
    public function delete(){
        $query = 'DELETE FROM ' .$this->table . ' where id = :id';

        //Prepare Statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        //Bind data
        $stmt->bindParam(':id', $this->id);

        //Execute query
        if($stmt->execute()){
            return true;
        }

        //Print error is something goes wring
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}