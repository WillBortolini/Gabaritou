<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>Menu Professor</title>
    
</head>
<body>
    <div style="height: 70px; width: 100%; padding: 10px; background-color: #21A609; text-align: right;">
        Bem-vindo(a): <b><?php echo $_SESSION["nome"]; ?></b>
        <br>
        <a style="color: black" href="sair.php" title="Logout">Sair</a>
    </div>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">    
        <ul class="navbar-nav">
            <li class="nav-item">
                <a style="color: green" class="nav-link"  href="cadastroprofessor.php">Cadastrar professor</a>
            </li>
            <li class="nav-item">
                <a style="color: green" class="nav-link" href="selecionarprofessor.php">Ver professores cadastrados</a>
            </li>
            <li class="nav-item">
                <a style="color: green" class="nav-link" href="cadastroaluno.php">Cadastrar Aluno</a>
            </li> 
            <li class="nav-item">
                <a style="color: green" class="nav-link" href="selecionaraluno.php">Ver alunos cadastrados</a>
            </li>
            <li class="nav-item">
                <a style="color: green" class="nav-link" href="criarprova.php">Criar nova prova</a>
            </li>
            <li class="nav-item">
                <a style="color: green" class="nav-link" href="selecionarprova.php">Ver provas cadastradas</a>
            </li>
            <li class="nav-item">
                <a style="color: green" class="nav-link" href="criarquestao.php">Criar nova questão</a>
            </li>
            <li class="nav-item">
                <a style="color: green" class="nav-link" href="selecionarquestao.php">Ver questões cadastradas</a>
            </li>
        </ul>
    </nav>
</body>

</html>
