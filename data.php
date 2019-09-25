<?php
require 'connection.php';
$db = new Database();
$conn = $db->connect();

class Data
{

    public function importFile()
    {
        if (isset($_POST['submit'])) {
            //read the json file content
            $data = file_get_contents($_FILES['jsonfile']['tmp_name']);

            //convert json data into an array
            $data_array = json_decode($data, true);
        } else {
            echo $_FILES['jsonfile']['error'] . "there was an error";
        }

        return $data_array;
    }

    //save the raw data into raw_data table
    public function saveRawData()
    {
        try {
            global $conn;
            $data_array = $this->importFile();

            //save data in the raw_data table
            foreach ($data_array as $row) {
                $query = $conn->prepare('INSERT INTO `raw_data`(`ticketID`,`clientName`,`mobileNo`,`contactType`,`callType`,`sourceName`,`storeName`,
		         `questionType`,`questionSubType`,`dispositionName`,`dateCreated`) VALUES (:ticketID, :clientName,:mobileNo, :contactType, :callType, :sourceName, :storeName,
		         :questionType, :questionSubType, :dispositionName, :dateCreated)');

                $query->bindValue('ticketID', $row['ticketID']);
                $query->bindValue('clientName', $row['clientName']);
                $query->bindValue('mobileNo', $row['mobileNo']);
                $query->bindValue('contactType', $row['contactType']);
                $query->bindValue('callType', $row['callType']);
                $query->bindValue('sourceName', $row['sourceName']);
                $query->bindValue('storeName', $row['storeName']);
                $query->bindValue('questionType', $row['questionType']);
                $query->bindValue('questionSubType', $row['questionSubType']);
                $query->bindValue('dispositionName', $row['dispositionName']);
                $query->bindValue('dateCreated', $row['dateCreated']);

                $query->execute();


            }


        } catch (Exception $e) {
            echo "ERROR: " . $e->getMessage();
        }


    }

    /*
     normalize data by creating 4 tables: stores, questiontypes,questionsubtypes and normalized_data. 

     Insert distinct values into the tables.
    */
    public function storesTable()
    {
        try {
            global $conn;
            $query = $conn->query("SELECT DISTINCT `storeName`  FROM `raw_data` ");
            $query->execute();
            $result = $query->fetchAll();
            //print_r($result);

            foreach ($result as $row) {
                $stores = $conn->prepare("INSERT INTO stores(`storeName`) VALUES(:name) ");
                $stores->bindValue('name', $row[0]);
                $stores->execute();


            }


        } catch (Exception $e) {
            echo "ERROR: " . $e->getMessage();
        }


    }

    public function questionTypesTable()
    {
        try {
            global $conn;
            $query = $conn->query("SELECT DISTINCT  `questionType` FROM `raw_data` ");
            $query->execute();
            $result = $query->fetchAll();
            //print_r($result);

            foreach ($result as $row) {
                $query = $conn->prepare("INSERT INTO question_types(`questionType`) VALUES(:name) ");
                $query->bindValue('name', $row[0]);
                $query->execute();
            }

        } catch (Exception $e) {
            echo "ERROR: " . $e->getMessage();
        }


    }

    public function questionSubTypesTable()
    {
        try {
            global $conn;
            $query = $conn->query("SELECT DISTINCT `questionSubType` FROM `raw_data` ");
            $query->execute();
            $result = $query->fetchAll();

            foreach ($result as $row) {
                $stores = $conn->prepare("INSERT INTO question_sub_types(`questionSubType`) VALUES(:name) ");
                $stores->bindValue('name', $row[0]);
                $stores->execute();
            }
        } catch (Exception $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }

    //save data into the tickets table
    public function saveNormalizedData()
    {
        try {
            global $conn;
            $sql = $conn->query("SELECT * FROM `raw_data` ");
            $sql->execute();
            $results = $sql->fetchAll();

            foreach ($results as $row) {
                $query = $conn->prepare('INSERT INTO normalized_data SET ticketID = :ticketID,clientName = :clientName,
                mobileNo = :mobileNo, contactType = :contactType, callType = :callType, sourceName= :sourceName,  
                storeID = (SELECT id from stores where storeName= :storeName), 
                questionTypeID = (SELECT id from question_types where questionType= :questionType),
                questionSubTypeID = (SELECT id from question_sub_types where questionSubType= :questionSubType),
                 dispositionName = :dispositionName, dateCreated = :dateCreated');

                $query->bindValue('ticketID', $row['ticketID']);
                $query->bindValue('clientName', $row['clientName']);
                $query->bindValue('mobileNo', $row['mobileNo']);
                $query->bindValue('contactType', $row['contactType']);
                $query->bindValue('callType', $row['callType']);
                $query->bindValue('storeName', $row['storeName']);
                $query->bindValue('sourceName', $row['sourceName']);
                $query->bindValue('questionType', $row['questionType']);
                $query->bindValue('questionSubType', $row['questionSubType']);
                $query->bindValue('dispositionName', $row['dispositionName']);
                $query->bindValue('dateCreated', $row['dateCreated']);

                $query->execute();
            }
        } catch (Exception $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }


}

$run = new Data();
$run->importFile();
$run->saveRawData();
$run->storesTable();
$run->questionTypesTable();
$run->questionSubTypesTable();
$run->saveNormalizedData();
header('Location: /Data-Normalization/viewData.php');










