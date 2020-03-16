<?php
class ApiActions{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function read($id = null)
    {
        //read single taak
        if (isset($id)) {
            //clean input
            $id = htmlentities($id);

            // make querry string
            $query = 'SELECT * FROM apitaken where taa_id = :taa_id';

            //prepare statement
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':taa_id', $id);

        //read all taken
        } else {
            // make querry string
            $query = 'SELECT * FROM apitaken';

            //prepare statement
            $stmt = $this->pdo->prepare($query);
        }

        //execute statement
        $stmt->execute();

        //get row count
        $rowcount = $stmt->rowCount();

        if ($rowcount > 0){

            //fetch data from database
            $taak_arr = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($taak_arr, $row);
            }

            //encode data to json
            echo json_encode($taak_arr);

        } else {
            echo 'no taak found';
        }

    }

    public function create(){

        // make querry string
        $query = 'INSERT INTO apitaken SET taa_title = :taa_title, taa_date = :taa_date';

        //get raw posted data
        $data = json_decode(file_get_contents('php://input'));

        //prepare statement
        $stmt = $this->pdo->prepare($query);

        //check if fields are sett
        if (!isset($data->taa_title) or !isset($data->taa_date)) {
            echo 'fill in all necessary fields';
            die();
        //clean user-input
        } else {
            $taa_title    = htmlentities($data->taa_title);
            $taa_date     = htmlentities($data->taa_date);
        }

        //bind parameters
        $stmt->bindParam(':taa_title', $taa_title);
        $stmt->bindParam(':taa_date', $taa_date);


        //create new taak in db
        if ($stmt->execute()) echo 'taak created.';
        else {
            echo $stmt->errorInfo();
            echo 'taak creation failed';
        }


    }

    public function update($id){
        // make querry string
        $query = 'UPDATE apitaken SET taa_title = :taa_title, taa_date = :taa_date where taa_id = :taa_id';

        //get raw posted data
        $data = json_decode(file_get_contents('php://input'));

        //prepare statement
        $stmt = $this->pdo->prepare($query);

        //clean user-input
        $taa_id       = htmlentities($id);
        $taa_title    = htmlentities($data->taa_title);
        $taa_date     = htmlentities($data->taa_date);

        //bind parameters
        $stmt->bindParam(':taa_id', $taa_id);
        $stmt->bindParam(':taa_title', $taa_title);
        $stmt->bindParam(':taa_date', $taa_date);

        //update taak in db
        if ($stmt->execute()) echo 'taak updated.';
        else {
            echo $stmt->errorInfo();
            echo 'taak update failed';
        }
    }

    public function delete($id)
    {
        // make querry string
        $query = 'DELETE FROM apitaken where taa_id = :taa_id';

        //prepare statement
        $stmt = $this->pdo->prepare($query);

        //clean user-input
        $taa_id = htmlentities($id);

        //bind parameters
        $stmt->bindParam(':taa_id', $taa_id);

        //delete taak in db
        if ($stmt->execute()) echo 'taak deleted.';
        else {
            echo $stmt->errorInfo();
            echo 'taak deletion failed';
        }
    }
}