<?php
require_once __DIR__ . '/../../common/DatabaseClient.php';
require_once __DIR__ . '/UserRepository.php';
require_once __DIR__ . '/UserBuilder.php';
require_once __DIR__ . '/User.php';

class DatabaseUserRepository implements UserRepository
{
  private $database;

  public function __construct()
  {
    $this->database = DatabaseClient::getDatabase();
  }

  public function checkUserExistence(string $username, string $password): bool
  {
    $request = $this->database->prepare('SELECT password,count(*) AS numberOfUsers FROM user WHERE username = :username GROUP BY password');
    $request->execute([
      'username' => $username
    ]);
    $res = $request->fetch(PDO::FETCH_OBJ);
    $count = $res->numberOfUsers;
    

    
    return $count > 0 && password_verify($password,$res->password);
  }

  public function getUserByUsername(string $username): ?User
  {
    $request = $this->database->prepare('SELECT firstname, lastname, username FROM user WHERE username = :username');
    $request->execute(['username' => $username]);
    $user = $request->fetch(PDO::FETCH_OBJ);

    if (!$user) {
      return null;
    }

    $userBuilder = new UserBuilder();
    return $userBuilder
      ->withFirstName($user->firstname)
      ->withLastName($user->lastname)
      ->withUsername($user->username)
      ->build();
  }


  public function getUserId(string $username){
    $request = $this->database->prepare('SELECT id FROM user where username=?');
    $request->execute([$username]);
    $res = $request->fetch(PDO::FETCH_OBJ);
    return $res->id;
  } 
  
  public function createUser($firstName, $lastName, $username, $password): void
  {
    $request = $this->database->prepare('INSERT INTO user(firstname, lastname, username, password) VALUES (:firstname, :lastname, :username, :password)');
    $request->execute([
      'firstname' => $firstName,
      'lastname' => $lastName,
      'username' => $username,
      'password' => $password
    ]);
  }

  public function isAdmin($username){
    $request = $this->database->prepare("SELECT id,booladmin as val FROM user WHERE username = ? ");
    $request->execute([$username]);
    $val = $request->fetch(PDO::FETCH_OBJ)->val;
    return $val == 1;
  
  }
}
