<?php

/*
**function that echo the title of a page in 
**case the page has the variable $pageTitle set
*/

function getTitle()
{
    global $pageTitle;
    if (isset($pageTitle)) {
        echo $pageTitle;
    } else {
        echo 'Default';
    }
}

/*
**function that redirect the user to home
**page when there is any error btw it accepts parameters
**$errrorMsg = echo the error message
**$Seconds   = number of seconds before redirecting 
**$path      = where to send the user
*/

function redirectHome($theMsg, $url = null, $Seconds = 3)
{

    if ($url === null) {
        $url = "index.php";
        $link = 'Home Page';
    } elseif ($url == 'back') {
        if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != '') {
            $url = $_SERVER['HTTP_REFERER'];
            $link = 'Previous Page';
        } else {
            $url = 'index.php';
            $link = 'Home Page';
        }
    } else {
        $url = "index.php";
        $link = 'Home Page';
    }



    echo $theMsg;
    echo "<div class='alert alert-info'>You'll Be Redirected To $link In " . $Seconds . " Seconds</div>";
    header("refresh:$Seconds;url=$url");
}

/*
**checkItem that check if exists any other item 
**with the same specification (it accept three param)
**$selecte [the selected item] (it can be the column)
**$from [the from we selecte an item] (it can be the table)
**$value [the value of the item] 
**Example : 'SELECT $select FROM $from WHERE $value';
*/

function checkItem($select, $from, $value)
{
    global $pdo;
    $sql = "SELECT $select FROM $from WHERE $select = ?";
    $stm = $pdo->prepare($sql);
    $stm->execute(array($value));
    $count = $stm->rowCount();
    return $count;
}


/*
**countItems() function that count the number of items
**it accepts parameters :
**$item : the item to count
**$table : the table where this item is located
*/

function countItem($item, $table)
{
    global $pdo;
    $stm = $pdo->prepare("SELECT COUNT($item) FROM $table");
    $stm->execute();
    return $stm->fetchColumn();
}


/*
**getLatestitems() function, it gets all the latest items from a database
**it accepts parameters :
**$item : the item you want to fetch
**$table : the table where the item live :)
**$limit : simply how much ?
*/

function getLatestItems($item, $table, $order, $limit = 5)
{
    global $pdo;
    $sql = "SELECT $item FROM $table ORDER BY $order LIMIT $limit";
    $stm = $pdo->query($sql);
    $result = $stm->fetchAll();
    return $result;
}
