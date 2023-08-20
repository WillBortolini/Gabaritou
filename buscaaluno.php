<?php
require_once("conexao.php");
session_start();

$pesquisa = $_POST["pesquisa"];
$turma = $_POST["turma"];
//comando sql
if ($turma == 0) {
    $sql = "SELECT * 
    FROM aluno
    where nome like '%$pesquisa%' 
    order by nome";
} else {
    $sql = "SELECT * 
    FROM aluno
    where nome like '%$pesquisa%' 
    and turma_idturma = $turma 
    order by turma_idturma, nome";
}
//echo $sql;
//executar o comando
$dadosAluno = $conn->query($sql);

//se número de registro retornados for maior que 0
if ($dadosAluno->num_rows > 0) {
?>
    <table class="table table-bordered table-striped">
        <tr>

            <th>RA</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Turma</th>
            <?php
            if ($_SESSION["tipo"] === 'A') {
            ?>
                <th>Editar</th>
                <th>Excluir</th>
            <?php
            }
            ?>
        </tr>
        <?php
        while ($exibir = $dadosAluno->fetch_assoc()) {
        ?>
            <tr>
                <td><?php echo $exibir["RA"] ?></td>
                <td><?php echo $exibir["nome"] ?> </td>
                <td><?php echo $exibir["email"] ?> </td>
                <?php
                //busca o estado civil de acordo com o código da tabela tbpessoa
                $sqlTurma = "SELECT * FROM turma WHERE idturma = " . $exibir["turma_idturma"];
                $dadosTurma = $conn->query($sqlTurma);
                $turma = $dadosTurma->fetch_assoc();
                ?>
                <td><?php echo $turma["nomeTurma"] ?> </td>

                <?php
                if ($_SESSION["tipo"] === 'A') {

                ?>
                    <td><a href="editaraluno.php?RA=<?php echo $exibir["RA"]?>" style="color: green;" title="Editar registro"><i class="fa fa-edit"></i></a></td>


                    <td>
                        <a href="#" title="Excluir registro" style="color: green;" onclick="confirmarExclusao(
                    '<?php echo $exibir["RA"] ?>',
                    '<?php echo $exibir["nome"] ?>')">
                    <i class="fa fa-trash"></i>
                        </a>
                    </td>
                <?php
                }
                ?>
            </tr>
        <?php
        }
        ?>
    </table>
<?php
} else {
    echo "<h4>Nenhum registro retornado!</h4";
}
?>