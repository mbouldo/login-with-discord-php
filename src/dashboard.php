<?php
session_start();

if(!$_SESSION['logged_in']){
  header('Location: error.php');
  exit();
}
extract($_SESSION['userData']);

$avatar_url = "https://cdn.discordapp.com/avatars/$discord_id/$avatar.jpg";


?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../dist/output.css" rel="stylesheet">
</head>
<body>
    <div class="flex items-center justify-center h-screen bg-discord-gray flex-col">
      <div class="text-white text-3xl">Welcome to the dashboard, </div>
      <div class="flex items-center mt-4">
        <img class="rounded-full w-12 h-12 mr-3" src="<?php echo $avatar_url?>" />
        <span class="text-3xl text-white font-semibold"><?php echo $name;?></span>
      </div>
      <a href="logout.php" class="mt-5 text-gray-300">Logout</a>
    </div>

</body>
</html>