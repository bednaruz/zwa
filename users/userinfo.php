<?php
    require_once "../help/testinput.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["search_form"]) && !empty($_POST["search"])) {
            $name = testInput($_POST["search"]);

            $sql = "SELECT
                        *
                    FROM
                        users
                    WHERE
                        username='$name'";

            if ($result = $conn->query($sql)) {
                if ($overall = $result->fetch_row()) {
                    
                    $sql = "SELECT
                                *
                            FROM
                                results
                            WHERE
                                id=$overall[0]";

                    if ($result = $conn->query($sql)) {
                        if ($results = $result->fetch_row()) {
                            $_SESSION["overall"] = $overall;
                            $_SESSION["score_results"] = [$results[1],$results[3],$results[5],$results[7],$results[9]];
                            $_SESSION["time_results"] = [$results[2],$results[4],$results[6],$results[8],$results[10]];
                            
                            $conn->close();
                            header("location: show.php");
                            exit;
                        } else {
                            $conn->close();
                            header("location: img/marvin.png");
                            die();
                        }
                    } else {
                        $conn->close();
                        header("location: img/marvin.png");
                        die();
                    }
                }
            } else {
                $conn->close();
                header("location: img/marvin.png");
                die();
            }
        } elseif (isset($_POST["delete_form"]) && !empty($_POST["delete"] && $_POST["delete"] != "admin")) {
            $name = testInput($_POST["delete"]);

            $sql = "SELECT
                        *
                    FROM
                        users
                    WHERE
                        username='$name'";
                    
            if ($result = $conn->query($sql)) {
                if ($overall = $result->fetch_row()) {
                    $id = $overall[0];

                    $sql = "DELETE FROM
                                users
                            WHERE
                                username='$name'";

                    if ($result = $conn->query($sql)) {
                        
                        $sql = "DELETE FROM
                                    results
                                WHERE
                                    id=$id";

                        if (!($result = $conn->query($sql))) {
                            $conn->close();
                            header("location: img/marvin.png");
                            die();
                        }

                        $conn->close();
                        header("location: adminprofile.php");
                        exit;
                    } else {
                        $conn->close();
                        header("location: img/marvin.png");
                        die();
                    }
                }
            }
        }
    }
?>