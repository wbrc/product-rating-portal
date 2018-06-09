<?php
namespace DataLayer;

use \Domain\Product;
use \Domain\Rating;
use \Domain\User;

class DBDataLayer implements DataLayer
{
    private $server;
    private $userName;
    private $password;
    private $database;

    public function __construct($server, $userName, $password, $database)
    {
        $this->server = $server;
        $this->userName = $userName;
        $this->password = $password;
        $this->database = $database;
    }

    private function getConnection()
    {
        $conn = new \mysqli($this->server, $this->userName, $this->password, $this->database);
        if (!$conn) {
            die('Unable to connect to database: ' . mysqli_connect_error());
        }
        return $conn;
    }

    private function executeQuery($connection, $query)
    {
        $result = $connection->query($query);
        if (!$result) {
            die('Error in query `$query`: ' . $connection->error);
        }
        return $result;
    }

    private function executeStatement($connection, $query, $bindFunc)
    {
        $statement = $connection->prepare($query);
        if (!$statement) {
            die('Error in prepared statement `$query`: ' . $connection->error);
        }
        $bindFunc($statement);
        if (!$statement->execute()) {
            die('Error executing prepared statement `$query`: ' . $connection->error);
        }
        return $statement;
    }

    public function getUser($id)
    {
        $user = null;

        $conn = $this->getConnection();
        $stat = $this->executeStatement(
            $conn,
            'SELECT Username, Password FROM Users WHERE Username = ?',
            function ($s) use ($id) {
                $s->bind_param('s', $id);
            }
        );
        $stat->bind_result($userName, $password);
        if ($stat->fetch()) {
            $user = new User($userName, $userName, $password);
        }
        $stat->close();
        $conn->close();
        return $user;
    }

    public function getUserForUserNameAndPassword($userName, $password)
    {
        $user = null;
        $conn = $this->getConnection();
        $stat = $this->executeStatement(
            $conn,
            'SELECT Username, Password FROM Users WHERE Username = ?',
            function ($s) use ($userName) {
                $s->bind_param('s', $userName);
            }
        );
        $stat->bind_result($un, $pw);

        if ($stat->fetch() && $password == $pw) {
            $user = new User($un, $un, $pw);
        }
        $stat->close();
        $conn->close();
        return $user;
    }

    public function createUser($userName, $password)
    {
        if($this->getUser($userName) != null){
            return false;
        }

        $conn = $this->getConnection();
        $stat = $this->executeStatement(
            $conn,
            'INSERT INTO Users (Username, Password) VALUES (?, ?)',
            function ($s) use ($userName, $password) {
                $s->bind_param('ss', $userName, $password);
            }
        );
        return true;
    }

    public function getProducts()
    {
        $products = array();

        $conn = $this->getConnection();
        $res = $this->executeQuery($conn, 'SELECT ID, Name, Manufacturer, created_by FROM Product');
        while ($p = $res->fetch_object()) {
            $products[] = new Product($p->ID, $p->Name, $p->created_by, $p->Manufacturer);
        }
        $res->close();
        $conn->close();
        return $products;
    }

    public function getProductById($id)
    {
        $products = array();

        $conn = $this->getConnection();
        $res = $this->executeStatement($conn, 'SELECT ID, Name, Manufacturer, created_by FROM Product WHERE ID = ?',
            function ($s) use ($id) {
                $s->bind_param('i', $id);
            }
        );
        $res->bind_result($ID, $Name, $Manufacturer, $created_by);
        while ($res->fetch()) {
            $products[] = new Product($ID, $Name, $created_by, $Manufacturer);
        }
        $res->close();
        $conn->close();
        return $products[0];
    }

    public function getProductsByUser($userName)
    {
        $products = array();

        $conn = $this->getConnection();
        $res = $this->executeStatement($conn, 'SELECT ID, Name, Manufacturer, created_by FROM Product WHERE created_by = ?',
            function ($s) use ($userName) {
                $s->bind_param('s', $userName);
            }
        );
        $res->bind_result($ID, $Name, $Manufacturer, $created_by);
        while ($res->fetch()) {
            $products[] = new Product($ID, $Name, $created_by, $Manufacturer);
        }
        $res->close();
        $conn->close();
        return $products;
    }

    public function getProductsWithFilter($filter)
    {
        $sqlfilter = "%" . $filter . "%";
        $products = array();

        $conn = $this->getConnection();
        $res = $this->executeStatement($conn, 'SELECT ID, Name, Manufacturer, created_by FROM Product WHERE Name LIKE ? OR Manufacturer LIKE ?',
            function ($s) use ($sqlfilter) {
                $s->bind_param('ss', $sqlfilter, $sqlfilter);
            }
        );
        $res->bind_result($ID, $Name, $Manufacturer, $created_by);
        while ($res->fetch()) {
            $products[] = new Product($ID, $Name, $created_by, $Manufacturer);
        }
        $res->close();
        $conn->close();
        return $products;
    }

    public function createProduct($productName, $manufacturer, $uid){
        $conn = $this->getConnection();
        $res = $this->executeStatement($conn, 'INSERT INTO Product (Name, Manufacturer, created_by) VALUES (?, ?, ?)',
            function ($s) use ($productName, $manufacturer, $uid) {
                $s->bind_param('sss', $productName, $manufacturer, $uid);
            }
        );
        $pid = $res->insert_id;
        $res->close();
        $conn->close();
        return $pid;
    }

    public function createRating($pid, $uid, $score, $comment){
        $conn = $this->getConnection();
        $res = $this->executeStatement($conn, 'INSERT INTO Rating (created_by, created_for, Score, Comment) VALUES (?, ?, ?, ?)',
            function ($s) use ($uid, $pid, $score, $comment) {
                $s->bind_param('siis', $uid, $pid, $score, $comment);
            }
        );
        $res->close();
        $conn->close();
        return $pid;
    }

    public function getRatingsByProductId($productID)
    {
        $ratings = array();

        $conn = $this->getConnection();
        $res = $this->executeStatement($conn, 'SELECT ID, created_by, created_for, Score, Comment FROM Rating WHERE created_for = ?',
            function ($s) use ($productID) {
                $s->bind_param('i', $productID);
            }
        );
        $res->bind_result($ID, $created_by, $created_for, $Score, $Comment);
        while ($res->fetch()) {
            $ratings[] = new Rating($ID, $created_for, $created_by, $Score, $Comment);
        }
        $res->close();
        $conn->close();
        return $ratings;
    }

    public function getRatingsByUser($userName)
    {
        $ratings = array();

        $conn = $this->getConnection();
        $res = $this->executeStatement($conn, 'SELECT ID, created_by, created_for, Score, Comment FROM Rating WHERE created_by = ?',
            function ($s) use ($userName) {
                $s->bind_param('s', $userName);
            }
        );
        $res->bind_result($ID, $created_by, $created_for, $Score, $Comment);
        while ($res->fetch()) {
            $ratings[] = new Rating($ID, $created_for, $created_by, $Score, $Comment);
        }
        $res->close();
        $conn->close();
        return $ratings;
    }

    public function getAvarageRating($pid){
        $s = 0;
        $conn = $this->getConnection();
        $res = $this->executeStatement($conn, 'SELECT AVG(Score) FROM `Rating` WHERE created_for = ?',
            function ($s) use ($pid) {
                $s->bind_param('i', $pid);
            }
        );
        $res->bind_result($score);
        if ($res->fetch()) {
            $s = $score;
        }
        $res->close();
        $conn->close();
        return $s;
    }

    public function getNumRatings($pid){
        $s = 0;
        $conn = $this->getConnection();
        $res = $this->executeStatement($conn, 'SELECT COUNT(Score) FROM `Rating` WHERE created_for = ?',
            function ($s) use ($pid) {
                $s->bind_param('i', $pid);
            }
        );
        $res->bind_result($cnt);
        if ($res->fetch()) {
            $s = $cnt;
        }
        $res->close();
        $conn->close();
        return $s;
    }

    public function deleteRating($rid){
        $conn = $this->getConnection();
        $res = $this->executeStatement($conn, 'DELETE FROM `Rating` WHERE ID = ?',
            function ($s) use ($rid) {
                $s->bind_param('i', $rid);
            }
        );
        $res->close();
        $conn->close();
    }

    public function deleteProduct($pid){
        $conn = $this->getConnection();
        $res = $this->executeStatement($conn, 'DELETE FROM `Product` WHERE ID = ?',
            function ($s) use ($pid) {
                $s->bind_param('i', $pid);
            }
        );
        $res->close();
        $conn->close();
    }
}
