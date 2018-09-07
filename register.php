<?php
    session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Registration</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


</head>
<body>
    <div class="divider"></div>
    <div id="container">
        <form method="POST" enctype="multipart/form-data" action='<?php echo htmlspecialchars ($_SERVER["PHP_SELF"]) ?>' >
            <p id="register">Register.</p>
            <input type='text' name='teamname' placeholder="team name" required >
            <input type='text' name='headname' placeholder="team leader" required>
            <input type="number" name="regno" min="150000000" max ="180000000" placeholder="registration no" required title="Invalid">
            <input type="text" name="branch" placeholder="branch" required>   
            <input type="number" name="semester" min="1" max ="8" placeholder="semester" required>
            <input type="text" name="institution" placeholder="institution" required>
            <input type="number" name="phone" min="1000000000" max="9999999999" placeholder="phone no" required>
            <input type="email" name="email" placeholder="email" required>
            <input type="file" name="fileToUpload" id="fileToUpload" required>
            <input id="browse-click" type="button" class="button" value="Browse files"/>
            <p id="filename" style="height: 0px; margin: 0;"></p>
            <input type="submit" name="submit" id="submit" >
        </form>
       
    </div>
</body>

<script>
    var textbody=document.getElementById("filename");
    file=document.getElementById("fileToUpload");
    actualbutton=document.getElementById ("browse-click")
    actualbutton.addEventListener ("click", function()
    {
        file.click();
    });

    document.addEventListener("DOMContentLoaded", function() {
    var elements = document.getElementsByTagName("INPUT");
    for (var i = 0; i < elements.length; i++) {
        elements[i].oninvalid = function(e) {
            e.target.setCustomValidity("");
            if (!e.target.validity.valid) {
                e.target.setCustomValidity("Please enter valid data");
            }
        };
        elements[i].oninput = function(e) {
            e.target.setCustomValidity("");
        };
    }
})


    setInterval (function()
    {
        //textbody=document.getElementById("filename");
        file=document.getElementById("fileToUpload");
        console.log(file.value.lastIndexOf('\\'));
        
        if (file.value!="")
            textbody.style="height: auto"
            textbody.innerHTML=file.value.slice (file.value.lastIndexOf('\\')+1);
    }, 500);
</script>
</html>

<?php
    include_once 'config.php';
    $conn=mysqli_connect($dbServername,$dbUsername,$dbPassword, $dbName);
    if(isset($_POST['submit']))
    {   
        $teamname=$_POST['teamname'];
        $headname=$_POST['headname'];
        $regno=$_POST['regno'];
        $branch=$_POST['branch'];
        $semester=$_POST['semester'];
        $institution=$_POST['institution'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];

    }
        if (empty($teamname) || empty($headname) || empty($regno) || empty($branch) || empty($semester) || empty($institution) || empty($phone) ||empty($email))
            {
                echo "All the fields are required to be filled!";
            }
        else
            {
                $sql="INSERT INTO users (team_name,headname,regno,
                branch,semester,institution,phone,email) VALUES ('$teamname','$headname','$regno','$branch','$semester','$institution','$phone','$email');";
                mysqli_query($conn,$sql);

                header("Location:register.php?success");

            }            

?>
