<!DOCTYPE html>
<html>
<body>

<h2>Upload Test Form</h2>
<form action="http://localhost/untu_cms/client/upload.php" method="post" enctype="multipart/form-data">
  <label for="name">Name:</label>
  <input type="text" id="name" name="name"><br><br>
  <label for="userId">User ID:</label>
  <input type="text" id="userId" name="userId"><br><br>
  <input type="file" name="file" id="file"><br><br>
  <input type="submit" value="Upload">
</form>

</body>
</html>
