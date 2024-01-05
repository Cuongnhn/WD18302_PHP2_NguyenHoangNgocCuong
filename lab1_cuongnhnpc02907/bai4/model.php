<?php
function get_user($email) {
    include 'config.php';
    $connection = pdo_get_connection();
    $sql = "SELECT * FROM student WHERE email = :email";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {
        return $result[0];
    }

}
?>
