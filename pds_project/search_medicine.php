<?php  
    $connect = mysqli_connect("localhost", "root", "", "clinic");  
    
    if(isset($_POST["query"])){  
        $output = '';  
        $query = "SELECT * FROM medicine WHERE stock_medicine > 0 AND name_medicine LIKE '%".$_POST["query"]."%'";  
        $result = mysqli_query($connect, $query);  
        $output = '<ul class="list-unstyled">';  
        
        if(mysqli_num_rows($result) > 0){  
            while($row = mysqli_fetch_array($result)){  
                $output .= '<li>'.$row["name_medicine"].'-[Stock : '.$row["stock_medicine"].']</li>';  
            }  
        }
    
    $output .= '</ul>';  
    echo $output;  
    } 
?>