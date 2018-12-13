<?php
if (isset($_POST['submit'])){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];


    $errorEmpty = false;
    $errorEmail = false;
//Validate forms
    if (empty($first_name) || empty($last_name) || empty($email)){
        echo "<span class='form-error'>Fill in all fields!</span>";
        $errorEmpty = true;
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "<span class='form-error'>Write a valid email address!</span>";
        $errorEmail = true; 
    }
    else {
    

                   //create a connection to the database
                   $conn = mysqli_connect("localhost", "root", "Green200%");

                   //create database
                    $create_database = "CREATE DATABASE job_app";
                    mysqli_query($conn, $create_database);
                    mysqli_close($conn);
        
                    //Create Table
                    $conn = mysqli_connect("localhost", "root", "Green200%", "job_app");
                    $sql = "CREATE TABLE user_table(
                        id INT AUTO_INCREMENT NOT NULL, 
                        first_name VARCHAR(255),
                        last_name VARCHAR(255),
                        email VARCHAR(255),
                        PRIMARY KEY(id) )";
        
                    mysqli_query($conn, $sql);
                    mysqli_close($conn);
        
                    $conn = mysqli_connect("localhost", "root", "Green200%", "job_app");
        
                    $sql = "SELECT * FROM user_table WHERE email = '$email'";
        
                    
        
                    $result = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($result);
        
                     if ($num == 1){
                         echo " ". "User is already Subscribed";
                     } else{
                         $sql = "INSERT INTO user_table(first_name, last_name, email) VALUES('$first_name', '$last_name', '$email')";
                         $result = mysqli_query($conn, $sql);
        
        
                         $sql = "SELECT id FROM user_table WHERE email = '$email'";
                         $result = mysqli_query($conn, $sql);
                         while ($row = mysqli_fetch_assoc($result)){
                         
                            $id = $row['id'];
                            echo "<span class='form-success'>". " ". " You have successfully signed up! Subscription ID is " .$id ."</span>";
        
                         }
                     } 
        

    }
}
else {
    echo "There was an error";
}

?>

             <script>
                $("#first-name, #last-name, #e-mail").removeClass("input-error");
                
                    var errorEmpty = "<?php echo $errorEmpty; ?>";
                        var errorEmail = "<?php echo $errorEmail; ?>";

                 if (errorEmpty == true){
                     $("#first-name, #last-name, #e-mail").addClass("input-error");
                 }
                 if (errorEmail == true){
                     $("#e-mail").addClass("input-error");
                 }

                 if(errorEmpty == false && errorEmail == false){
                    $("#first-name, #last-name, #e-mail").val("");
                 }
             </script>s