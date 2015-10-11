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
        <h1 class='h-welcome'>Заметки об автомобиле:</h1>
        <table>
          <?php
            try {
              $host = "localhost";
              $username = "root";
              $password = "alebastr";
              $db="vw_polo"; 
          
              $dbh = new PDO("mysql:host=$host;dbname=$db", $username, $password);
              // set the PDO error mode to exception
              $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
              foreach($dbh->query("select id, note_title, note_body from notes order by id desc;") as $l){
                echo "<tr><td>
                  <p class='title'><a href='note.php?id=" . $l["id"] . "'>" . $l["note_title"] . "</a></p>
                  <p class='article-content'>&nbsp;" . $l["note_body"] ."</p>
                  </td></tr>";      
                }
            }
            catch(PDOException $e){echo $sql . "<br>" . $e->getMessage(); echo'fdsafdsa';}
          ?>              
        </table>
      </div>

    </div>
      <footer>
        <div class='holder'>
        </div>
      </footer>
  </body>
</html>
