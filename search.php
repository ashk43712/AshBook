<?php include("includes/sessions.php");?>
<?php include("includes/db_connection.php") ?>
<?php include("functions/query_functions.php") ?>
<?php include("functions/common_functions.php") ?>

<?php
	if(!isset($_SESSION["username"])||empty($_SESSION["username"]))
		redirect_to('login.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>AshBook | Search</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/arial.js"></script>
<script type="text/javascript" src="js/cuf_run.js"></script>
</head>
<body>
<div class="main">
  <div class="main_resize">
    <div class="header">
      <div class="logo">
        <h1><a href="#"><span>Ash</span>Book<small>A Social Network</small></a></h1>
      </div>
      <div class="search">
        <form method="post" id="search" action="search.php">
          <span>
          <input type="text" placeholder="Search..." name="search_for" id="search_for" />
          <input name="searchsubmit" type="image" src="images/search.gif" value="Go" id="searchsubmit" class="btn"  />
          </span>
        </form>
        <!--/searchform -->
        <div class="clr"></div>
      </div>
      <div class="clr"></div>
      <div class="menu_nav">
        <ul>
          
			<li><?php
				if(isset($_SESSION["pic"])){
					$pic=$_SESSION["pic"];
					echo '<img src="' .PATH.$pic. '" height=30 />';
				}
				else{
					echo '<img src="images/default_pic.jpeg" height=30 />';
				}
			?></li>
			<li><a href="user_timeline.php?user_name=<?php echo $_SESSION["username"]; ?>"><?php echo $_SESSION["name"]; ?></a></li>
			<li class="active"><a href="search.php">Search</a></li>
			<li><a href="user_home.php?user_name=<?php echo $_SESSION["username"]; ?>">Home</a></li>
			<li><a href="user_profile.php?user_name=<?php echo $_SESSION["username"]; ?>">Profile</a></li>
			<li><a href="user_notifications.php?user_name=<?php echo $_SESSION["username"]; ?>">Notifications</a></li>
			<li><a href="user_friends.php?user_name=<?php echo $_SESSION["username"]; ?>">Friends</a></li>
			<li><a href="requests.php?user_name=<?php echo $_SESSION["username"]; ?>">Friend Requests</a></li>
			<li><a href="user_messages.php?user_name=<?php echo $_SESSION["username"]; ?>">Messages</a></li>
			<li><a href="logout.php">Log Out</a></li>
        </ul>
        <div class="clr"></div>
      </div>
    </div>
    <div class="content">
      <div class="content_bg">
        <div class="mainbar">
          <div class="article">
			
				<form method="post" id="search" action="search.php">
				  <span>
				  <input type="text" placeholder="Search..." name="search_for" id="search_for" />
				  <input name="searchsubmit" type="image" src="images/search.gif" value="Go" id="searchsubmit" class="btn"  />
				  </span>
				</form>
				<!--/searchform -->
				<div class="clr"></div>
			  <br><br>
			
			<?php 
		
			if(isset($_POST["search_for"])&&!empty($_POST["search_for"])){
				
				
				$index="";
				$val=$_POST["search_for"];
				
				$result=get_users_for_search($val);
				
				$count=0;
				
				echo "<table>";
				while($row = mysqli_fetch_assoc($result)){
					echo "<tr><td>";
					echo $row["name"];
					echo "</td>";
					if(isset($row["profile_pic"])){
						$pic=$row["profile_pic"];
						echo '<td><img src="' .PATH.$pic. '" height=60 /></td>';
					}
					else{
						echo '<td><img src="images/default_pic.jpeg" height=60 /></td>';
					}
					echo "<td><a class=\"user_link\" href=\"user_profile.php?user_name={$row["user_name"]}\" target=\"blank\">View Profile</a>";
					echo "</td></tr>";
					$count++;
				}
				
				echo "</table>";
				
				if($count==0){
					
					echo "<div class=\"error\">Searched value doesn't exist</div>";
					
				}
		
				
			}
		
		?>
          </div>
        </div>
        
        <div class="clr"></div>
      </div>
    </div>
  </div>
</div>
<div class="footer">
  <div class="footer_resize">
    <p class="lf">&copy; Copyright <a href="#">AshBook</a>.</p>
    <p class="rf">Layout by Rocket <a href="http://www.rocketwebsitetemplates.com/">Website Templates</a></p>
    <div class="clr"></div>
  </div>
</div>
<script type="text/javascript" src="js/main.js"></script>
</html>