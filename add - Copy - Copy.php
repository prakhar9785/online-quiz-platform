<?php include 'database.php';
if(isset($_POST['submit'])){
    $question_number = $_POST('question_number');
    $question_text = $_POST['question_text'];
    $correct_choice = $_POST['correct_choice'];
    // choice array
    $choice = array();
    $choice[1] = $_POST['choice1'];
    $choice[2] = $_POST['choice2'];
    $choice[3] = $_POST['choice3'];
    $choice[4] = $_POST['choice4'];
    // first query for question table

    $query = "INSERT INTO questions (";
    $query .= "question_number, text )";
    $query .= "VALUES {";
    $query .= " ' {$question_number}' , '{$question_text}' ";
    $query .= ")";

    $result = mysqli_query($connection,$query);

    //validate the query
    if($result){
        foreach($choice as $option => $value){
            if($value != ""){
                if($correct_choice == $option){
                    $is_correct = 1;
                }else{
                    $is_correct = 0;
                }

                // second query for choices table
                $query = "INSERT INTO options (";
                $query .= "question_number,is_correct,mcq)";
                $query .= " VALUES {";
                $query .= "'{$question_number}','{$is_correct}','{$value}' ) ";

                $insert_row  = mysqli_query($connection,$query);
                // validate insertion of choices
                if($insert_row){
                    continue;
                }else{
                    die("2nd query for choices could not be executed");
                }
            }
        }
        $message = "Question has been added successfully";
    }
}

        $query = "SELECT * from questions";
        $questions = mysqli_query($connection,$query);
        $total = mysqli_num_rows($questions);
        $next = $total+1;


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Questions</title>
</head>
<body>
    <div class="container">
        <h2>Add a Question</h2>
        <?php
        if(isset($message)){
            echo "<h4>" . $message . "$</h4>";
        }
        ?>
        <form method="POST" action="add.php">
        <p>
            <label >Question Number:</label>
            <input type="number" name="quesion_number" value="">
        </p>
        <p>
            <label >Question Text:</label>
            <input type="text" name="quesion_Text" >
        </p>
        <p>
            <label >Choice 1:</label>
            <input type="text" name="Option 1">
        </p>
        <p>
            <label >Choice 2:</label>
            <input type="text" name="Option 2">
        </p>
        <p>
            <label >Choice 3:</label>
            <input type="text" name="Option 3">
        </p>
        <p>
            <label >Choice 4:</label>
            <input type="text" name="Option 4">
        </p>
        <p>
            <label >Correct Option Number</label>
            <input type="number" name="Correct_choice">
        </p>
        <input type="submit" name="submit" value="submit">
        </form>
    </div>
</body>
</html>