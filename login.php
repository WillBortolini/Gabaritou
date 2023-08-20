<?php
    require_once("conexao.php"); //inclui o arquivo de conexão
    session_start(); //starta a session
    //receber user e senha vindo do login
    $user = $conn->real_escape_string($_POST["txtUser"]);
    $senha = $_POST["txtPassword"];

    $sql1 = "SELECT * 
            from aluno 
            where RA = $user and 
            senha = '$senha'";


    //echo $sql1;

    $resultado1 = $conn->query($sql1);

    $sql2 = "SELECT * 
            from professor 
            where email = $user and 
            senha = '$senha'";

    //echo $sql2;

    $resultado2 = $conn->query($sql2);

    if($resultado1->num_rows > 0){
        $dados_aluno = $resultado1->fetch_assoc();
        //preencher a session com os dados do aluno
        $_SESSION["RA"] = $dados_aluno["RA"];
        $_SESSION["nome"] = $dados_aluno["nome"];
        $_SESSION["tipo"] = "B";
        header("location: inicial.php");
    }
    
    else if($resultado2->num_rows > 0){
        $dados_professor = $resultado2->fetch_assoc();
        //preencher a session com os dados do professor
        $_SESSION["CPF"] = $dados_professor["CPF"];
        $_SESSION["nome"] = $dados_professor["nome"];
        $_SESSION["tipo"] = "A";
        header("location: inicio.php");
    }

    else{
        //se ocorrer erro, carrega uma session com erro    
        $_SESSION["erro"] = "Erro";
        ?>
        <script>window.history.back();</script>
        <?php
    }
?>