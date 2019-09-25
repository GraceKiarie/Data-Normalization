<!DOCTYPE html>
<html>
<head>
    <title>Data Import</title>
</head>
<body style="justify-content: center padding:20px">
<h1>Import jSon File</h1>
<hr>
<br>
<form action="data.php" method="POST" enctype="multipart/form-data">
    <label for="file">Filename:</label>
    <input type="file" name="jsonfile" id="file"><br><br>
    <input type="submit" value="Import" name="submit">
</form>
<br>
<hr>
<a href="viewData.php">View Data</a>
</body>
</html>
