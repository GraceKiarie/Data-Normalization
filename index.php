<!DOCTYPE html>
<html>
<head>
    <title>Data Import</title>
</head>
<body>
<form action="data.php" method="POST" enctype="multipart/form-data">
    <label for="file">Filename:</label>
    <input type="file" name="jsonfile" id="file">
    <input type="submit" value="Import" name="submit">
</form>
</body>
</html>
