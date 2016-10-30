<?php
class loginHandler
{
    protected $dbinstance;
    public function __construct(PDO $dbinstance) // passed a pdo DB file to construct the object
    {
        $this->dbinstance = $dbinstance;  //each object's functions should apply to that object and not others
    }
    public function checkLogin($userTestID)
    {
        $query = $this->dbinstance->prepare("SELECT userID FROM userInfo WHERE userID=:userTestID"); //build the query
        $query->bindValue(':userTestID', $userTestID, PDO::PARAM_STR); //bind the value to a string to help protect against SQL injection
        $query->execute(); //execute query
        $results = $query->fetchAll(PDO::FETCH_ASSOC); //get resulting matches
        return $results; //return result from the query
    }
    public function checkPass($userTestID)
    {
        $query = $this->dbinstance->prepare("SELECT userPass FROM userInfo WHERE userID=:userTestID"); //build the query
        $query->bindValue(':userTestID', $userTestID, PDO::PARAM_STR); //bind the value to a string to help protect against SQL injection
        $query->execute(); //execute query
        $results = $query->fetchAll(PDO::FETCH_ASSOC); //get resulting matches
        return $results; //return result from the query
    }
    public function registerUser($userName,$hashedPass)
    {
        $stmt = $this->dbinstance->prepare("INSERT INTO userInfo(userID, userPass)VALUES(:userName,:hashedPass)");
        $stmt->bindValue(':userName',$userName,PDO::PARAM_STR);
        $stmt->bindValue(':hashedPass',$hashedPass,PDO::PARAM_STR);
        $stmt->execute();
    }
}
?>