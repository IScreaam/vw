<?php
// define variables and set to empty values
$noteTitleErr = $noteBodyErr = "";
$noteTitle = $noteBody = "";
$errorsCount = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["note_title"])) {
     $noteTitleErr = "Title is required";
     $errorsCount++;
   } else {
     $noteTitle = test_input($_POST["note_title"]);
   }
  
   if (empty($_POST["note-body"])) {
    $noteBodyErr = "Note body is required";
   	$errorsCount++;
   } else {
     $noteBody = test_input($_POST["note-body"]);
   }

    if ($errorsCount == 0){
			$host = "localhost";
			$username = "root";
			$password = "alebastr";
			$db="vw_polo"; 
			try {
			  $dbh = new PDO("mysql:host=$host;dbname=$db", $username, $password);
			  // set the PDO error mode to exception
			  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		    $sql = $dbh->prepare("INSERT INTO notes (note_title, note_body) VALUES (:title, :body);");
		    // use exec() because no results are returned
		    $dbh->exec($sql);
		    $sql->execute(array('title' => $noteTitle, 'body' => $noteBody));

			}
			catch(PDOException $e)
			  {
			    echo $sql . "<br>" . $e->getMessage();
			  }
			$dbh = null;
	 
   		echo "<script> window.location.href = 'notes.php';</script>";
    }
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
		<title>All about VW polo</title>
		<meta charset="UTF-8">
	</head>
	<body>
		<header>
		</header>
		<div class='main'>
			<nav>
				<ul>
					<a href="index.html"><li>Домашняя страница</li></a>
					<a href="characteristics.html"><li>Общие характеристики</li></a>
					<a href="notes.php"><li>Заметки</li></a>
					<a href="add_new_note.php"><li>Добавить новую заметку</li></a>
				<ul>	
			</nav>

			<div class='content'>
				<h1 class='h-welcome'>Доавить новую заметку:</h1>
				<form id="new-note" class="new-note" method="post" accept-charset="UTF-8" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" role="form">
					<div class="row">
						<label for="note_title">Заголовок:</label>
						<input id="note_title" class="form-control text" type="text" name="note_title" placeholder="Введите заголовок ">
						  <span class="error">* <?php echo $noteTitleErr;?></span>
   						<br><br>
					</div>
					<div class="row">
						<label class="note-body" for="note-bodyl">Текст заметки:</label>
						<textarea id="note-body" class="note-body" name="note-body" placeholder="Введите текст"></textarea>
						<span class="error">* <?php echo $noteBodyErr;?></span>
   					<br><br>
					</div>
					<div class="row">				
  					<input class='submit' type="submit" value="Submit">
  				</div>
				</form>
			</div>

		</div>
			<footer>
				<div class='holder'>
				</div>
			</footer>
	</body>
</html>





