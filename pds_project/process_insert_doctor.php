<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $foto = $_POST['foto'];
    
    $registered = $_POST[''];
    
    if (isset($_POST["options"])) {
      $selectedOptions = $_POST["options"];
      
      // Loop through the selected options
      foreach ($selectedOptions as $option) {
        echo "Selected option: " . $option . "<br>";
      }
    } else {
      echo "No options selected.";
    }

  }
?>