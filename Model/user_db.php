<?php

    function getUser($conn, $username) {
        $quest = 'SELECT * FROM User WHERE username = ?';
        $stmt = $conn->prepare($quest);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        return $user;
    }

        

    function registerUser($conn, $username, $password, $name, $email) {
        $quest = 'INSERT INTO User (username, password, name, email) VALUES (?, ?, ?, ?)';
        $stmt = $conn->prepare($quest);
        $stmt->bind_param("ssss", $username, $password, $name, $email);
        $stmt->execute();
        $stmt->close();
    }

    ?>