<?php

$con = mysql_connect("186.202.165.58","perolaclass","pcl0914");
mysql_select_db("perolaclass", $con);

$pagina = $_POST["pagina"];
$itens_por_pagina = $_POST["itens_por_pagina"];
$Loja_id = $_POST["Loja_id"];
$url_loja = $_POST["url_loja"];

//$sqlProdutos = "SELECT a.id, a.titulo, a.preco, a.preco_de, a.topo_negociar_preco, a.id_tipo_anuncio, a.parcelas, a.url_amigavel, a.descricao, a.pasta, a.oferta, f.imagem, f.legenda FROM anuncio a inner join foto f on a.id=f.id_anuncio WHERE a.id_cliente='{$Loja_id}'";        
$sqlProdutos = "SELECT distinct a.id, a.titulo, a.preco, a.preco_de, a.topo_negociar_preco, a.id_tipo_anuncio, a.parcelas, a.url_amigavel, a.descricao, a.pasta, a.oferta, f.imagem, f.legenda FROM anuncio a inner join foto f on a.id=f.id_anuncio WHERE a.id_cliente='{$Loja_id}'";        
$sql = "";
$pagina_busca = false;
if(isset($_POST["palavra_chave"])){             
    $pagina_busca = true;
    $palavras = explode(" ", $_POST["palavra_chave"]);
    if(count($palavras)>0){
        for($i=0; $i<count($palavras);$i++){

            $sql .= (strlen($sql)>0?" OR ":" AND (")."(a.titulo like '%{$palavras[$i]}%' OR a.descricao like '%{$palavras[$i]}%') ".($i==(count($palavras)-1)?")":"");
        }    
    }else{
        
        $sql .= " AND (a.titulo like '%{$_POST["palavra_chave"]}%' OR a.descricao like '%{$_POST["palavra_chave"]}%') ";
    }        

}
$posicao = ($pagina*$itens_por_pagina);
//$sqlProdutos.=$sql . " LIMIT {$posicao}, {$itens_por_pagina}";
$sqlProdutos.=$sql . " GROUP BY a.id LIMIT {$posicao}, {$itens_por_pagina}";

$resultProdutos = mysql_query($sqlProdutos) or die(mysql_error());

if(mysql_num_rows($resultProdutos)>0){

	while ($itemProdutos = mysql_fetch_array($resultProdutos)){

	$imagem = "http://perolanegocio.com/imagens/anuncio/".$itemProdutos["pasta"]."/media/".$itemProdutos["imagem"];
	$link = $url_loja."/produto/".$itemProdutos["url_amigavel"]."-".$itemProdutos["id"].".html";
	$preco_de = $itemProdutos["preco_de"]!=0?("De: <strike>R$ ".number_format($itemProdutos["preco_de"], 2, ',', '.')."</strike>"):"";
	$preco = $itemProdutos["preco"]!=0?"R$ ".number_format($itemProdutos["preco"], 2, ',', '.'):"À combinar";
	$titulo = $itemProdutos["titulo"];
	echo '
	<li class="items">  
		<a href="'.$link.'">                             
		    <div class="imagem_produto"><img src="'.$imagem.'"  align="center" /></div>
		    <span class="nome_produto">'.$titulo.'</span>                                                                                    
		    <span class="preco_de">'.$preco_de.'</span>
		    <span class="preco_novo">'.$preco.'</span>                        
		    <span class="parcelas">Parcele em '.$itemProdutos["parcelas"].'x sem juros</span>
		</a>
	</li>';
	            
	}
}
?>