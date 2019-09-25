<!DOCTYPE html>
<html>
<head>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px;
        }
    </style>
</head>
<body>

<a href="index.php">Import Data</a>
<hr>
<br>
<h1>Normalized Data</h1>
<table style="width:100%">
    <tr>
        <th>TicketID</th>
        <th>ClientName</th>
        <th>Mobile Number</th>
        <th>StoreName</th>
        <th>QuestionType</th>
        <th>QuestionSubType</th>
        <th>Date Created</th>
    </tr>

    <?php
    include 'displayData.php';
    $data = new Display();
    $results = $data->displayData();
    if ($results > 0) {
        foreach ($results as $result) {
            echo "<tr> <td>" . $result['ticketID'] . "</td><td>" . $result['clientName'] . "</td> <td>" . $result['mobileNo'] .
                "</td> <td>" . $result['storeName'] . "</td> <td>" . $result['questionType'] . "</td><td>" . $result['questionSubType'] .
                "</td><td>" . $result['dateCreated'] . "</td></tr>";
        }
    } else {
        echo "<h1>No records available</h1>";
    }
    ?>

</table>

</body>
</html>
