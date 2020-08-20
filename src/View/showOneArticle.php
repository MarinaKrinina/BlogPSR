<?php
    echo "<h1>".$data["title"]."</h1>";
    echo "<div>".$data["date"]."</div>";
    echo "<div>".$data["text"]."</div>";
    echo "<div class='articleRate'> Оценка ".$data["rate"]."</div>";
    if (isset($_SESSION["user"])) {
        echo "<form action='article/changeRate.php' method='post'>
        <input type='hidden' value='".$data["id"]."' name='id'>
        <input type='range' min='1' max='5' id='rateRange' name='newRate'/>
        <input type='submit' value='Оценить'/>
        </form>";
    }
