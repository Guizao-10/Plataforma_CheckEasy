<?php
    session_start();
    include("conexao.php");

	$email = $_POST["email"];
	$senha = $_POST["senha"];

    $nomeCompleto = $_POST["nomeCompleto"];
    $nomeUser = $_POST["nome_user"];
    $instituicao = $_POST["instituicao"];
    $cidade = $_POST["cidade"];
    $cep = $_POST["cep"];
    $estado = $_POST["estado"];
    $curriculo = $_POST["curriculo"];
    $confirSenha = $_POST["confirm_senha"];

    $primeiro_nome = substr($nomeCompleto, 0, strpos($nomeCompleto," "));
    $sobrenome = substr($nomeCompleto, strpos($nomeCompleto," "), strlen($nomeCompleto) - strpos($nomeCompleto," "));

    $sql = "INSERT INTO MyGuests (firstname, lastname, email)
    VALUES ('John', 'Doe', 'john@example.com')";

    $sql = "INSERT INTO professor(primeiro_nome,sobrenome,nome_user,email,instituicao,cidade,cep,curriculo,senha) VALUES('$primeiro_nome','$sobrenome','$nomeUser','$email','$instituicao','$cidade','$cep','$curriculo','$senha')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        
        $sql="SELECT * FROM professor WHERE email='$email' AND senha='$senha'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $_SESSION["id_user"] = $row["idprofessor"];
            $_SESSION["email"] = $email;
            $_SESSION["nome"] = $row["primeiro_nome"];
            header("Location: home.php");
        }else{
            echo "Erro ao fazer login.";
        }
        
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    
?>
