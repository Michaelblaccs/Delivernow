<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <title>Document</title>
</head>
<body>
    <form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post">
    
<input type = "number" name = "num1" placeholder ="number">
<Select name = "operator">
    <option value = "add">+</option>
    <option value = "subtract">-</option>
    <option value = "multiply">x</option>
    <option value = "divide">/</option>
</Select>

<input type = "number" name = "num2" placeholder ="number">  
<button>Calculate</button>

    </form>
    
   <?php
 if($_SERVER["REQUEST_METHOD"]=="POST"){
    $num1 = filter_input(INPUT_POST, "num1",FILTER_SANITIZE_NUMBER_FLOAT);
    $num2 = filter_input(INPUT_POST, "num2",FILTER_SANITIZE_NUMBER_FLOAT);
    $operator = htmlspecialchars($_POST["operator"]);
    //error handlers
    $errors = false;
    if(empty($num1) || empty($num2) || empty($operator)){
        echo "<p class= 'calc error'> Please fill in all fields</p>";
        $errors = true;
    }
        if (!is_numeric($num1)||!is_numeric($num2)){

 echo "<p class= 'calc error'> only input numbers</p>";
 $errors = true;
        }
        //calc the numbersbif no errors 
        if (!$errors){
            $value=0;
            
            switch ($operator) {
                case "add":
                    $value = $num1 + $num2;
                    break;
                    case "subtract":
                        $value = $num1 - $num2;
                        break;
                        case "multiply":
                            $value = $num1 * $num2;
                            break;
                            case "divide":
                                $value = $num1 / $num2;
                                break;
                                default: echo"<br> oopps sth id wrong";
                            }
                            echo"<p class ='calc_result'>Result = " . $value ." </p>";
                        }

}

   ?>
 </body>
 </html>
