<?php

ob_start();
session_start();

?>
<?php require_once('classes/Twilio.php'); ?>
<?php

if (!empty($_POST["to"]) && !empty($_POST["reminder"])) {
  $to = $_POST["to"];
  $reminder = $_POST["reminder"];
  $date = $_POST["date"];

  $Twilio = new Twilio($to, $reminder, $date);
  $Twilio->sendSMS();

  $_SESSION["success"] = "<i class='material-icons'>sms</i> SMS has been sent ☺";
  header("Location: index.php");
  exit;
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
  <title>Web SMS</title>

  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
</head>
<body>

<div id="content">
<h1>Web SMS</h1>

<?php

if (!empty($_SESSION["success"])) {
  echo "<p class='notification success'>" . $_SESSION["success"] . "</p>";
  session_destroy();
}

?>

<form action="" method="post">
  <input type="text" name="to" placeholder="Enter your phonenumber..." />
  <input type="datetime-local" name="date" placeholder="Enter date..." />
  <textarea name="reminder" placeholder="Enter the reminder..."></textarea>

  <button>Send</button>
</form>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script>
$(".notification").delay(5000).fadeOut(2000);
</script>
</body>
</html>
