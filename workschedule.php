<?php 
include('server_workplaces.php');
include('server.php');
function get_schools(){    
    $db = mysqli_connect('localhost', 'root', '', 'registration'); 
    // Check connection
    if (!$db) {
      die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT id, school_name FROM workplaces";
    $result = mysqli_query($db, $sql);

    $rows = [];
    while ($row = mysqli_fetch_row($result)) {
        array_push($rows, $row);  
    }
    return $rows;
}

 ?>
<!DOCTYPE html>
<html>
<head>
    <title>Assign hours</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    
    <script type="text/javascript">
        function showHint() {
            var id = document.getElementById("schoolSelect").value;
            
            document.getElementById("output").innerHTML = "";

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
              if (this.readyState === 4 && this.status === 200) {
                document.getElementById("output").innerHTML = this.responseText;
              }
            };
            xmlhttp.open("GET", "test.php?id=" + id, true);
            xmlhttp.send();
        }
    </script>
</head>
<body>
    <div class="header">
        <h2>Your work hours</h2>
    </div>
    <form><!-- method="post" action="insert_hours.php" -->
        School name: 
        <select id="schoolSelect">
            <option selected="selected" value>School</option>	
            <?php
            $schools = get_schools();

            foreach ($schools as &$item) {
                echo "<option value='$item[0]'>$item[1]</option>";
            }
            ?>

        </select>
        <input type="button" value="Submit" onclick="showHint()">
        
        <div id="output"></div>

    <div class="input-group">
        <p>
            Return to homepage: <a href="index_admin.php">Back</a>
        </p>
    </div>		
    </form>
    
</body>
</html>