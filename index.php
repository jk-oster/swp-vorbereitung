<?php
require_once("inc_db_config.php");
session_start();
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>Quotes</title>
    </head>
    <body>
    <?php
    //============================================================
    $action = $_REQUEST['action'] ?? '';
    $inputName = $_REQUEST['username'] ?? '';

    if ($action === 'logout') {
        unset($_SESSION['user']);
        showLoginForm($inputName);
    } else if ($action === 'login' || isset($_SESSION['user'])) {
        if (isset($_SESSION['user']) || checkLogin()) {
            $inputName = $_REQUEST['username'] ?? $_SESSION['user'];
            $_SESSION['user'] = $inputName;
            echo "<h1>Hello, user $inputName</h1>";
            echo getRandQuoteString();
            showLogoutForm();
        } else {
            showLoginForm($inputName);
        }
    } else {
        showLoginForm($inputName);
    }

    function queryDB(string $sqlQuery): bool|mysqli_result
    {
        $DB = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        if ($DB->connect_error) {
            die ("Could not establish database connection: " . $DB->connect_error);
        }
        $result = $DB->query($sqlQuery);
        if (!$DB->close()) {
            throw new Exception("Error: Cold not close db connection!");
        } else if (!$result) {
            throw new Exception("Error: Failed to execute query! $sqlQuery");
        }
        return $result;
    }

    function getRandQuoteString(): string
    {
        $allQuotes = queryDB("SELECT * FROM quotes")->fetch_all(MYSQLI_ASSOC);
        $rand = rand(0, count($allQuotes) - 1);
        $quote = $allQuotes[$rand];
        return '<i>"' . $quote['text'] . '"</i><br>' . $quote['author'];
    }

    function checkLogin(): bool
    {
        $inputName = $_REQUEST['username'] ?? '';
        $user = queryDB("SELECT username FROM users WHERE username = '$inputName'");
        return $user && count($user->fetch_all(MYSQLI_ASSOC)) === 1;
    }

    // $mysqli_result->fetch_all(MYSQLI_ASSOC) -> [ 0 -> [ id -> '...', name -> '...'], 1 -> [ id -> '...', name -> '...']]
    // $mysqli_result->fetch_assoc -> next item in results -> [ id -> '...', name -> '...']
    // $mysqli_result->fetch_row -> next item in results -> [ 0 -> '...', 1 -> '...']
    // $mysqli->real_escape_string(...)
    // password_hash('password1234', PASSWORD_DEFAULT)
    // password_verify('password1234', $passwordHashFromDB)

    //============================================================
    ?>
    </body>
    </html>
<?php
function showLoginForm($sCurrentUsername = ""): void
{
    ?>
    <b>Login:</b><br>
    <form action="index.php" method="post" name="login">
        <label for="usernameLogin">Username: </label><input
                id="usernameLogin" name="username" type="text" value="<?php
        echo $sCurrentUsername; ?>"><br>
        <input type="hidden" name="action" value="login">
        <input type="submit" value="Login">
    </form>
    <br>
    <?php
}

function showLogoutForm(): void
{
    ?>
    <form action="index.php" method="post" name="logout">
        <input type="hidden" name="action" value="logout">
        <input type="submit" value="Logout">
    </form>
    <?php
}

include("arrays.php");
include("parse.php");
include("magic-methods.php");

?>