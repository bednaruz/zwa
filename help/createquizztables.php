<?php
    require_once "connect.php";

    $sql = "CREATE TABLE IF NOT EXISTS quizz1(
        id INT(255) AUTO_INCREMENT, Unique(id),
        question VARCHAR(50) NOT NULL,
        answer VARCHAR(50) DEFAULT NULL
    )";

    if ($conn->query($sql)) {
        $sql = "INSERT INTO
                    quizz1(question, answer)
                VALUES 
                    ('Kolik je 1+1?', 2),
                    ('A co 12*25?', 300),
                    ('Kolik je 2^10', 1024),
                    ('3*3 + 1 - 80/4 = ', -10)";
        if (!$conn->query($sql)) {
            $conn->close();
            header("location: ../img/marvin.png");
            die();
        }  
    } else {
        $conn->close();
        header("location: ../img/marvin.png");
        die();
    }

    $sql = "CREATE TABLE IF NOT EXISTS quizz2(
        id INT(255) AUTO_INCREMENT, Unique(id),
        question VARCHAR(255) NOT NULL,
        answer VARCHAR(50) DEFAULT NULL
    )";
    
    if ($conn->query($sql)) {
        $code = 'while(True):print("Hello world")';
        $sql = "INSERT INTO
                    quizz2(question, answer)
                VALUES 
                    ('Co je dvojice slov reprezentující podmínku v programování (první slovo-druhé slovo)?', 'if-else'),
                    ('Napište program, který bude v pythonu donekonečna vypisovat Hello world (program napište bez mezer a enterů).', '$code'),
                    ('a = 1, b = a, a = 2. Jakou číselnou hodnotu má b?', 1),
                    ('Jakou dvojici klíčových slov můžete použít, když chcete vyzkoušet část kódu, ale zároveň nechcete, aby program v případě neúspěšnosti skočil chybou? (první slovo-druhé slovo)', 'try-except')";
        if (!$conn->query($sql)) {
            $conn->close();
            header("location: ../img/marvin.png");
            die();
        }      
    } else {
        $conn->close();
        header("location: ../img/marvin.png");
        die();
    }

    $sql = "CREATE TABLE IF NOT EXISTS quizz3(
        id INT(255) AUTO_INCREMENT, Unique(id),
        question VARCHAR(255) NOT NULL,
        answer VARCHAR(50) DEFAULT NULL
    )";
    
    if ($conn->query($sql)) {
        $sql = "INSERT INTO
                    quizz3(question, answer)
                VALUES 
                    ('Jaké číslo se používá pro error Not found', 404),
                    ('Co znamená zkratka WWW? (začněte vždy velkým písmenem, ostatní malá)', 'World Wide Web'),
                    ('Jaká je zkratka pro internetový protokol, který najdete na začátku většiny dnešních URL? (velkými písmeny)', 'HTTPS'),
                    ('Co znamená kód 200? (velkými písmeny)', 'OK')";
        if (!$conn->query($sql)) {
            $conn->close();
            header("location: ../img/marvin.png");
            die();
        }      
    } else {
        $conn->close();
        header("location: ../img/marvin.png");
        die();
    }

    $sql = "CREATE TABLE IF NOT EXISTS quizz4(
        id INT(255) AUTO_INCREMENT, Unique(id),
        question VARCHAR(255) NOT NULL,
        answer VARCHAR(50) DEFAULT NULL
    )";
    
    if ($conn->query($sql)) {
        $sql = "INSERT INTO
                    quizz4(question, answer)
                VALUES 
                    ('Jak se spočítá napětí pomocí Ohmova zákona?', 'U=R*I'),
                    ('Kolik Hz je frekvence střídavého napětí v zásuvkách v Evropě?', 50),
                    ('A co v USA?', 60),
                    ('Který druh proudu je pro člověka nebezpečnější? Stejnosměrný (DC) nebo střídavý (AC)?', 'AC')";
        if (!$conn->query($sql)) {
            $conn->close();
            header("location: ../img/marvin.png");
            die();
        }    
    } else {
        $conn->close();
        header("location: ../img/marvin.png");
        die();
    }

    $sql = "CREATE TABLE IF NOT EXISTS quizz5(
        id INT(255) AUTO_INCREMENT, Unique(id),
        question VARCHAR(255) NOT NULL,
        answer VARCHAR(50) DEFAULT NULL
    )";
    
    if ($conn->query($sql)) {
        $sql = "INSERT INTO
                    quizz5(question, answer)
                VALUES 
                    ('Jaká je chemická zkratka pro kyselinu, která je nebezpečná tím, že na sebe velmi rychle navazuje vápník a v malém množství ji můžeme najít i v Coca-Cole?', 'H3PO4'),
                    ('Jaká je chemická zkratka pro nebezpečný plyn, který se místo kyslíku naváže na hemoglobin a vzniká špatným spalováním např. v karmě?', 'CO'),
                    ('Co je lehčí a bude se tak držet více při zemi? Molekula kyslíku (O2) nebo oxid uhličitý (CO2)?', 'O2'),
                    ('Jak se jmenuje nejznámější chemický indikátor růžové barvy? (malými písmeny)', 'fenolftalein')";
        if (!$conn->query($sql)) {
            $conn->close();
            header("location: ../img/marvin.png");
            die();
        }
    } else {
        $conn->close();
        header("location: ../img/marvin.png");
        die();
    }

    $_SESSION["tables"] = 1;
?>