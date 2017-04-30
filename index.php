<?php
require_once('/controllers/XMLParserController.php');
$controller = new XMLParserController;
if(isset($_POST['submit'])) {
  $controller->xmlToCSV(file_get_contents($_FILES['inputFile']['tmp_name']));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  <meta charset="utf-8">
  <title>XML Parser</title>
</head>
<body>
  <div class="container">
    <div class="jumbotron">
      <h1>XML Parser</h1>
      <p>This is a quick example of how to implement an XML Parser usign PHP.</p>
      <p>All information about XML can be checked in <a href="https://www.w3.org/XML/">W3C Official Documentation</a>.</p>
    </div>
    <p>This example parses <strong>TOUR</strong> elements such as:</p>
    <pre>
      &lt;?xml version="1.0"?&gt;
      &lt;TOURS&gt;
        &lt;TOUR&gt;
          &nbsp;&nbsp;&lt;Title&gt;&lt;![CDATA[Anzac &amp; Egypt Combo Tour]]&gt;&lt;/Title&gt;
          &nbsp;&nbsp;&lt;Code&gt;AE-19&lt;/Code&gt;
          &nbsp;&nbsp;&lt;Duration&gt;18&lt;/Duration&gt;
          &nbsp;&nbsp;&lt;Start&gt;Istanbul&lt;/Start&gt;
          &nbsp;&nbsp;&lt;End&gt;Cairo&lt;/End&gt;
          &nbsp;&nbsp;&lt;Inclusions&gt;
            &nbsp;&nbsp;&nbsp;&lt;![CDATA[&lt;div style="margin: 1px 0px; padding: 1px 0px; border: 0px; outline: 0px; font-size: 14px; vertical-align: baseline; text-align: justify; line-height: 19px; color: rgb(6, 119, 179);"&gt;The tour price&nbsp; cover the following services: &lt;b style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background-color: transparent;"&gt;Accommodation&lt;/b&gt;; 5, 4&nbsp;and&nbsp;3 star hotels&nbsp;&nbsp;&lt;/div&gt;]]&gt;
          &nbsp;&nbsp;&lt;/Inclusions&gt;
          &nbsp;&nbsp;&lt;DEP DepartureCode="AN-17" Starts="04/19/2015" GBP="1458" EUR="1724" USD="2350" DISCOUNT="15%" /&gt;
          &nbsp;&nbsp;&lt;DEP DepartureCode="AN-18" Starts="04/22/2015" GBP="1558" EUR="1784" USD="2550" DISCOUNT="20%" /&gt;
          &nbsp;&nbsp;&lt;DEP DepartureCode="AN-19" Starts="04/25/2015" GBP="1558" EUR="1784" USD="2550" /&gt;
        &nbsp;&lt;/TOUR&gt;
      &lt;/TOURS&gt;
    </pre>
    <form action="index.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="inputFile">Insert xml file:</label>
        <input class="form-control" type="file" name="inputFile" required>
      </div>
      <input class="btn btn-default" type="submit" name="submit" value="Submit">
    </form>
  </div>
</body>
</html>
