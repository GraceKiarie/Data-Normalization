<?php
require 'connection.php';

$db = new Database();
$conn = $db->connect();

class Display
{
    //display data
    public function displayData()
    {
        try {
            global $conn;

            $query = $conn->prepare('SELECT normalized_data.ticketID, normalized_data.clientName, 
            normalized_data.mobileNo,normalized_data.contactType,normalized_data.callType,  
            normalized_data.sourceName,
            stores.storeName,question_types.questionType,question_sub_types.questionSubType,normalized_data.dispositionName,normalized_data.dateCreated
            FROM normalized_data
            INNER JOIN stores ON normalized_data.storeID=stores.id
            INNER JOIN question_types ON normalized_data.questionTypeID=question_types.id
            INNER JOIN question_sub_types ON normalized_data.questionSubTypeID=question_sub_types.id');
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_ASSOC);
            // print_r($results);
            return $results;

        } catch (Exception $e) {
            echo "ERROR: " . $e->getMessage();


        }
    }

}