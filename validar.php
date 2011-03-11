<?php
require("minit.php");
require("mhtmlspec.php");

if(isset($_POST[confirmar]))
{ // votos (id_pauta, id_postagem, id_autor, data, voto)
    $query="INSERT INTO `validacoes` (`id_pauta`, `id_autor`, `data`)
                VALUES ('$_GET[id]','$_SESSION[id_usuario]',CURDATE())";
    mysql_query($query);
}
?>

<body onunload="opener.location.reload();">
<?php
if(isset($_POST[confirmar]))
{
?>
    <p>Operação Realizada com Sucesso</p>
    <p><a href="javascript:window.close()">Fechar Janela</a></p>
<?php
}
else
{
?>
    <form action="" method="post" enctype="multipart/form-data" >
<?php

    $query = "SELECT * FROM validacoes WHERE `id_pauta`='$_GET[id]'";
    $res=mysql_query($query);
    while($a=mysql_fetch_assoc($res))
    {
        echo autor($a[id_autor])."<br />";
    }
?>
        <br />
        Os usuários acima já contribuiram para a validação desta pauta.<br />

<?php

    $query = "SELECT * FROM validacoes WHERE `id_pauta`='$_GET[id]' AND `id_autor`='$_SESSION[id_usuario]';";
    $res=mysql_query($query);
    $num=mysql_num_rows($res);
    if($num==0)
    {
        if($_SESSION[nivel]==1)
        {
?>
        Confirma sua contribuição para a validação desta pauta?
        <input name="confirmar" type="submit" value="Confirmar" />
<?php
        }
        else
        {
?>
        Faça login e requeira credenciamento para poder votar.
<?
        }
    }
    else
    {
?>
        Seu voto está registrado e seu usuário já consta como votante para esta validação!
<?php
    }
?>
    </form>
<?php
}
?>

</body>
</html>