<!-- Para onde vai este link de ver detalhes? Que conteúdo será disposto nele? -->
<?php
$pressed=3;
require("cabecalho.php");
?>

<h1>Deliberações Online</h1>

<?php
$query = "SELECT * FROM pautas WHERE `estado` == '-1';";
$res = mysql_query($query);
while($pauta=mysql_fetch_assoc($res))
{
    if(estado_pauta($pauta[data_validacao])=="finalizada")
    {
        $fim=data_brasil_adiante($pauta[data_validacao],28);
        $query="SELECT * FROM postagens WHERE `tipo`='1' AND `id_pauta`='$pauta[id_pauta]'";
        $res2=mysql_query($query);
?>
    <div>
        <h2>Pauta: <?php echo $pauta[titulo]; ?></h2>
        <p><?php echo $pauta[pauta]; ?></p>
        <a href="ver-pauta.php?id=<?php echo $pauta[id_pauta]; ?>">Ver detalhes</a>
        Encerrada: <?php echo $fim; ?>
    </div>
    <div>
        <h3>Deliberações:</h3>
        <ol>
<?php
        while($delib=mysql_fetch_assoc($res2))
        {
            $querya = "SELECT * FROM votos WHERE `id_postagem`='$delib[id_postagem]' AND `voto`='1'";
            $queryc = "SELECT * FROM votos WHERE `id_postagem`='$delib[id_postagem]' AND `voto`='0'";
            $resa=mysql_query($querya);
            $resc=mysql_query($quertc);
            $numa=mysql_num_rows($resa);
            $numc=mysql_num_rows($resc);
            if($numa>$numc)
            {
?>
                <li><?php echo $delib[postagem];?></li>
<?php                
            }
        }
?>
<?php
    }
}
?>
</body>
</html>