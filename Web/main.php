<?php
    include "base.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mini-Twitter Four</title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<div id="main">

<?php

$user_id = (int) $_SESSION['user_id'];

if (!empty($_SESSION['loggedin']) && !empty($_POST['tweet'])) {    
    
    $tweet_text = mysql_real_escape_string($_POST['new_tweet']);
    var_dump($user_id);
    var_dump($tweet_text);
    $newtweet = mysql_query("INSERT INTO tweets (Users_user_id, tweet_text) VALUES(".$user_id.", '".$tweet_text."')");  
        if ($newtweet) {
            echo "<meta http-equiv='refresh' content='0;main.php' />";
        } else {
            echo "<h1>Mini-Twitter Four</h1>";
            echo "<br />";
            echo "<p>Tweet failed. Please <a href=\"main.php\">try again</a>.</p>";
        }
        
} else if (!empty($_SESSION['loggedin']) && empty($_POST['tweet'])) {
    ?>
    
    <h1>Mini-Twitter Four</h1>
    <p><a href="profile.php">Profile</a>&nbsp;<a href="logout.php">Logout</a></p>
    <br />
    <p>Welcome, <b><?=$_SESSION['first_name']?></b>.</p>    
    
    <br />
    <form method="post" action="main.php" name="tweetform" id="tweetform">
    <fieldset>
        <label for="new_tweet_label">Write a new tweet</label><br />
        <textarea name="new_tweet" id="new_tweet" maxlength=<?=$maxlength_tweet?> style="resize: none;"
                  rows=5 cols=100 placeholder="max 140 characters" required></textarea><br />
        
        <input type="submit" name="tweet" id="tweet" value="Tweet" />
    </fieldset>
    </form>
    <br /><br />
    
    <?php
    $tweets = mysql_query("SELECT tweet_date, tweet_text FROM tweets WHERE Users_user_id=".$user_id."");
    while( $row = mysql_fetch_array($tweets) ){
    ?>
    
    <form method="post" action="main.php" name="tweet_1" id="tweet_1">
    <fieldset>
        <label><?=$row['tweet_date']?></label>
        <input type="submit" name="delete_1" id="delete_1" value="Delete" /><br />
        <textarea name="tweet" id="new_tweet" disabled rows=2 cols=100
                  align=left style="resize: none;"><?=$row['tweet_text']?>
        </textarea>
        <br /><br /><br />        
    </fieldset>
    </form>
    <?php
    }
} else {
    ?>

    <h1>Mini-Twitter Four</h1>
    <br />
    <p>You have not logged in yet. Please go to <a href="index.php">login</a>, or <a href="register.php">register</a> a new account.</p>
    <br>
    
    <?php
}
?>

</div>
</body>
</html>