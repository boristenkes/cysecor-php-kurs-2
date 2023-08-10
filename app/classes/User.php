<?php

class User
{
  protected $conn;

  public function __construct()
  {
    global $conn;
    $this->conn = $conn;
  }

  public function get($id)
  {
    $stmt = $this->conn->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    return $user;
  }

  public function get_all()
  {
    $query = "SELECT * FROM users WHERE is_admin = 0";
    $result = $this->conn->query($query);
    $users = $result->fetch_all(MYSQLI_ASSOC);

    return $users;
  }

  public function create($name, $username, $email, $password)
  {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, username, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $this->conn->prepare($sql);

    $stmt->bind_param("ssss", $name, $username, $email, $hashed_password);

    $result = $stmt->execute();

    if ($result) {
      $_SESSION['user_id'] = $result->insert_id;
      return true;
    }
    return false;
  }

  public function login($username, $password)
  {

    $sql = "SELECT user_id, password FROM users WHERE username = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
      $user = $result->fetch_assoc();

      if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        return true;
      }
    }
    return false;
  }

  public function is_logged_in()
  {
    return boolval(isset($_SESSION['user_id']));
  }

  public function is_admin()
  {
    $sql = "SELECT is_admin FROM users WHERE user_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param('i', $_SESSION['user_id']);
    $stmt->execute();

    $result = $stmt->get_result();
    $result = $result->fetch_assoc();
    $is_admin = $result['is_admin'];

    return boolval($is_admin);
  }

  public function logout()
  {
    unset($_SESSION['user_id']);
  }

  public function delete($id)
  {
    $stmt = $this->conn->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->bind_param('i', $id);
    return $stmt->execute();
  }
}

?>