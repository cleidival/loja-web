<?php

$lojaExiste = false;
$url_cliente = "sem_identificacao";

if(isset($_GET["loja"])){
    $baseURL = "http://".$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']);        
    $url_cliente = $_GET['loja'];
    $url_loja = $baseURL."/".$url_cliente;
    $lojaExiste = true;    
}else{
    $baseURL = "http://".$_SERVER['SERVER_NAME'];
    $url_loja = "";
}

//echo $baseURL;



$con = mysql_connect("186.202.165.58","perolaclass","pcl0914");
mysql_select_db("perolaclass", $con);

$sql = "SELECT * FROM cliente WHERE site='{$baseURL}'";
//echo $sql."<br>";
$result = mysql_query($sql) or die(mysql_error());
$num_registros = mysql_num_rows($result);

//echo "Loclizados: ".$num_registros;

if(mysql_num_rows($result)>0){
    $lojaExiste = true;
}

//$baseURL = "http://".$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']);    

/**
busca dados da loja
**/
// require_once("autoload.php");





if($lojaExiste){

    //echo "loja existe";

    $sqlLoja = "SELECT * FROM cliente WHERE id_tipo_cliente='2' AND (url_cliente='".$url_cliente."' or site='".$baseURL."')";
    $resultLoja = mysql_query($sqlLoja) or die(mysql_error());
   
    while ($dadosLoja = mysql_fetch_array($resultLoja)) {
        $Loja_id = $dadosLoja["id"];
        $Loja_Nome = $dadosLoja["nome"];
        $Loja_Localizacao = $dadosLoja["localizacao"];
        $Loja_CPF = $dadosLoja["cpf"];
        $Loja_Email = $dadosLoja["email"];
        $Loja_Imagem = $dadosLoja["imagem"];
        $Loja_Imagem2 = $dadosLoja["imagem2"];
        $Loja_Site = $dadosLoja["site"];
        $Loja_Cor_fundo_pagina = $dadosLoja["cor_fundo_pagina"];
        $Loja_Cor_fundo_topo = $dadosLoja["cor_fundo_topo"];
        $Loja_Cor_fundo_produtos = $dadosLoja["cor_fundo_produtos"];
        $Loja_Cor_fundo_destaques = $dadosLoja["cor_fundo_destaques"];
        $Loja_Cor_fundo_rodape = $dadosLoja["cor_fundo_rodape"];
        $Loja_Cor_fundo_menu = $dadosLoja["cor_fundo_menu"];
        $Loja_Cor_fundo_menu_hover = $dadosLoja["cor_fundo_menu_hover"];
        $Loja_Cor_texto_geral = $dadosLoja["cor_texto_geral"];
        $Loja_Cor_texto_menu = $dadosLoja["cor_texto_menu"];
        $Loja_Cor_texto_menu_hover = $dadosLoja["cor_texto_menu_hover"];
        $Loja_Cor_texto_preco_de = $dadosLoja["cor_texto_preco_de"];
        $Loja_Cor_texto_parcelas = $dadosLoja["cor_texto_parcelas"];
        $Loja_Cor_texto_preco = $dadosLoja["cor_texto_preco"];
        $Loja_Telefone = $dadosLoja["telefone"];
        $Loja_Telefone1 = $dadosLoja["telefone1"];
        $Loja_Telefone2 = $dadosLoja["telefone2"];
        $Loja_imagem_fundo_pagina = "http://perolanegocio.com/imagens/cliente/".$dadosLoja["imagem_fundo_pagina"];        
        $Loja_imagem_fundo_topo = "http://perolanegocio.com/imagens/cliente/".$dadosLoja["imagem_fundo_topo"];        
        $Loja_imagem_fundo_repetir = $dadosLoja["imagem_fundo_repetir"];
        $Loja_Logomarca = $dadosLoja["logomarca"];
        $Loja_Logomarca_rodape = $dadosLoja["logomarca_rodape"];
        $Loja_Banner1 = $dadosLoja["banner1"];
        $Loja_Banner2 = $dadosLoja["banner2"];
        $Loja_Banner3 = $dadosLoja["banner3"];
        $Loja_Banner4 = $dadosLoja["banner4"];
        $Loja_Nivel_Menu = $dadosLoja["nivel_menu"];
        $Loja_Responsabilidades = $dadosLoja["responsabilidades"];
        $Loja_Informacoes_Rodape = $dadosLoja["informacoes_rodape"];
    $Loja_Link_Banner1 = $dadosLoja["link_banner1"];
    $Loja_Link_Banner2 = $dadosLoja["link_banner2"];
    $Loja_Link_Banner3 = $dadosLoja["link_banner3"];
    $Loja_Link_Banner4 = $dadosLoja["link_banner4"];
    }

    
    $sqlProdutos = "SELECT distinct a.id, a.titulo, a.preco, a.preco_de, a.topo_negociar_preco, a.id_tipo_anuncio, a.parcelas, a.url_amigavel, a.descricao, a.pasta, a.oferta, f.imagem, f.legenda FROM anuncio a inner join foto f on a.id=f.id_anuncio WHERE a.id_cliente='{$Loja_id}'";        
    $sql = "";
    $pagina_busca = false;
    if(isset($_GET["palavra_chave"])){             
        $pagina_busca = true;
        $palavras = explode(" ", $_GET["palavra_chave"]);
        if(count($palavras)>0){
            for($i=0; $i<count($palavras);$i++){

                $sql .= (strlen($sql)>0?" OR ":" AND (")."(a.titulo like '%{$palavras[$i]}%' OR a.descricao like '%{$palavras[$i]}%') ".($i==(count($palavras)-1)?")":"");
            }    
        }else{
            
            $sql .= " AND (a.titulo like '%{$_GET["palavra_chave"]}%' OR a.descricao like '%{$_GET["palavra_chave"]}%') ";
        }        

    }

    $total_por_pagina = 12;
    $inicio = 0;

    $sqlProdutos.=$sql . " GROUP BY a.id LIMIT {$inicio}, {$total_por_pagina}";
    //echo $sqlProdutos;

    if(isset($_GET["nivel3_slug"])){   

        if($Loja_Nivel_Menu == '1'){
            $sqlProdutos = "select                                                 
                            a.id, a.titulo, a.preco, a.preco_de, a.topo_negociar_preco, a.id_tipo_anuncio, a.parcelas, a.url_amigavel, a.descricao, a.pasta, a.oferta, f.imagem, f.legenda
                            from
                            categoria_produto_nivel1 n1 
                            inner join produto pr on n1.id=pr.id_categoria_produto_nivel1
                            left join anuncio a on pr.id_anuncio=a.id 
                            left join cliente cl on a.id_cliente=cl.id
                            left join foto f on a.id=f.id_anuncio
                            where cl.id='{$Loja_id}' and n1.slug='{$_GET["nivel3_slug"]}'"; 
        }else
        if($Loja_Nivel_Menu == '2'){
                $sqlProdutos = "select                                                 
                            a.id, a.titulo, a.preco, a.preco_de, a.topo_negociar_preco, a.id_tipo_anuncio, a.parcelas, a.url_amigavel, a.descricao, a.pasta, a.oferta, f.imagem, f.legenda
                            from
                            categoria_produto_nivel2 n2
                            inner join produto pr on n2.id=pr.id_categoria_produto_nivel2
                            left join anuncio a on pr.id_anuncio=a.id 
                            left join cliente cl on a.id_cliente=cl.id
                            left join foto f on a.id=f.id_anuncio
                            where cl.id='{$Loja_id}' and n2.slug='{$_GET["nivel3_slug"]}'"; 
        }else
        if($Loja_Nivel_Menu == '3'){

            $sqlProdutos = "select                                                 
                            a.id, a.titulo, a.preco, a.preco_de, a.topo_negociar_preco, a.id_tipo_anuncio, a.parcelas, a.url_amigavel, a.descricao, a.pasta, a.oferta, f.imagem, f.legenda
                            from
                            categoria_produto_nivel3 n3 
                            inner join produto pr on n3.id=pr.id_categoria_produto_nivel3
                            left join anuncio a on pr.id_anuncio=a.id 
                            left join cliente cl on a.id_cliente=cl.id
                            left join foto f on a.id=f.id_anuncio
                            where cl.id='{$Loja_id}' and n3.slug='{$_GET["nivel3_slug"]}'"; 
        }
              

    }

    //$sqlProdutos = "SELECT a.id, a.titulo, a.preco, a.preco_de, a.topo_negociar_preco, a.id_tipo_anuncio, a.parcelas, a.url_amigavel, a.descricao, a.pasta, a.oferta, f.imagem, f.legenda FROM anuncio a inner join foto f on a.id=f.id_anuncio WHERE a.id_cliente='{$id_loja}'";        
    $resultProdutos = mysql_query($sqlProdutos) or die(mysql_error());
    $total_produtos = mysql_num_rows($resultProdutos);
    $items_por_pagina = 4;
    $total_paginas= ceil($total_produtos/$items_por_pagina);

    $sqlProdutosCarrossel = "SELECT a.id, a.titulo, a.preco, a.preco_de, a.topo_negociar_preco, a.id_tipo_anuncio, a.parcelas, a.url_amigavel, a.descricao, a.pasta, a.oferta, f.imagem, f.legenda FROM anuncio a inner join foto f on a.id=f.id_anuncio WHERE a.carrossel='S' and a.id_cliente='{$Loja_id}' group by a.id";        
    $resultProdutosCarrossel = mysql_query($sqlProdutosCarrossel) or die(mysql_error());
    $numeroItemsCarrossel = mysql_num_rows($resultProdutosCarrossel);

    if($Loja_Nivel_Menu == '1'){    
        $sqlMenu = "select 
                distinct n1.id, n1.nome, n1.slug
                from
                categoria_produto_nivel1 n1 
                inner join produto pr on n1.id=pr.id_categoria_produto_nivel1
                left join anuncio an on pr.id_anuncio=an.id 
                left join cliente cl on an.id_cliente=cl.id
                where cl.id='{$Loja_id}'";
    }else
    if($Loja_Nivel_Menu == '2'){

        $sqlMenu = "select 
                    distinct n2.id, n2.nome, n2.slug
                    from
                    categoria_produto_nivel2 n2 
                    inner join produto pr on n2.id=pr.id_categoria_produto_nivel2
                    left join anuncio an on pr.id_anuncio=an.id 
                    left join cliente cl on an.id_cliente=cl.id
                    where cl.id='{$Loja_id}'";
    }else
    if($Loja_Nivel_Menu == '3'){
        $sqlMenu = "select 
                    distinct n3.id, n3.nome, n3.slug
                    from
                    categoria_produto_nivel3 n3 
                    inner join produto pr on n3.id=pr.id_categoria_produto_nivel3
                    left join anuncio an on pr.id_anuncio=an.id 
                    left join cliente cl on an.id_cliente=cl.id
                    where cl.id='{$Loja_id}'";
    }
    $resultMenu = mysql_query($sqlMenu) or die(mysql_error());

    function getTipoAnuncio($id_tipo_anuncio){
        $sqlTipoAnuncio = "SELECT * FROM tipo_anuncio WHERE id='".$id_tipo_anuncio."'";
        $resultTipoAnuncio = mysql_query($sqlTipoAnuncio) or die(mysql_error());
        $dadosTipoAnuncio = mysql_fetch_array($resultTipoAnuncio);
        return $dadosTipoAnuncio["tipo"];
    }


?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <base href="<?php echo $baseURL;?>" />
        <meta charset="charset=iso-8859-1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $Loja_Nome;?>  - Classificados de Produtos E Serviços - Perola Guia</title>
        <meta name="description" content="Aqui tem o carro que você procura!!" /> 
        <!-- Bootstrap -->
        <link href="<?php echo $baseURL;?>/css/normalize.css" rel="stylesheet">

        <link href="<?php echo $baseURL;?>/css/bootstrap.min.css" rel="stylesheet">        
        <link href="<?php echo $baseURL;?>/css/estilo.css" rel="stylesheet">        
        <link href="<?php echo $baseURL;?>/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link rel="icon" type="image/png" href="http://perolanegocio.com/imagens/cliente82201602032920160203icon-yasmin.png"/>
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]--> 

       
        <link href="<?php echo $baseURL;?>/estilo-css.php?Loja_id=<?php echo $Loja_id;?>" rel="stylesheet">


   </head>
    <body>

        <?php include("modals.php");?>



        <div class="container page">
            <div class="row topo">
                <div class="logomarca">
                    <a href="<?php echo $url_loja;?>">
                        <img src="http://www.perolanegocio.com/imagens/cliente/<?php echo $Loja_Logomarca;?>"/> 
                    </a>
                </div>
                <div class="pesquisa">
                    <div class="pesquisa-form">                        
                        <form id="formPesquisa">                        
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="procurar..." id="palavra_chave" name="palavra_chave">
                          <span class="input-group-btn">
                            <button class="btn btn-default btn-busca" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                          </span>
                        </div>
                        </form>
                    </div>
                    <div class="menu-topo">
                        <ul>
                            <li><a href="#" data-toggle="modal" data-target="#localizacao"><span class="glyphicon glyphicon-pushpin"></span> Localização</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#contato"><span class="glyphicon glyphicon-phone-alt"></span> Contato</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        
            <!--PAGINA INICIAL-->
        
            <?php if(!$pagina_busca){ ?>
            <div class="row ofertas margin-top-10">
                <div class="col-2 menu">
                    <h4>NAVEGAÇÃO</h4>                
                    
                    <ul>
                    <?php
                    while ($linhaMenu = mysql_fetch_array($resultMenu)) {
                    ?>
                        <li class="item-menu"><a href="<?php echo $url_loja."/".$linhaMenu["slug"];?>#inicio"><?php echo $linhaMenu["nome"];?></a></li>                        
                    <?php
                    }
                    ?>  
                    </ul>                  
                </div>
                <div class="col-10 destaques">
                       
                    <!--INICIO CAROUSSEL-->
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                      <!-- Indicators -->
                      <ol class="carousel-indicators">
                        <?php
                        for($i = 0; $i<$numeroItemsCarrossel; $i++){
                            if($i==0)    {
                                echo "<li data-target=\"#carousel-example-generic\" data-slide-to=\"0\" class=\"active\"></li>";
                            }else{
                                echo "<li data-target=\"#carousel-example-generic\" data-slide-to=\"{$i}\" ></li>";
                            }
                        }
                        ?>                        
                      </ol>

                      <!-- Wrapper for slides -->
                      <div class="carousel-inner" role="listbox">
                        <?php
                            $i = 0;
                            while($itemCarrossel = mysql_fetch_array($resultProdutosCarrossel)){

                                $imagem = "http://perolanegocio.com/imagens/anuncio/".$itemCarrossel["pasta"]."/grande/".$itemCarrossel["imagem"];
                        ?>
                            <div class="item<?php echo $i==0?' active':''?>">
                                <span class="item-imagem">                                    
                                    <a href="<?php echo $url_loja;?>/produto/<?php echo $itemCarrossel["url_amigavel"].'-'.$itemCarrossel["id"];?>.html">                             
                                        <center>
                                            <img src="<?php echo $imagem;?>" alt="<?php echo $itemCarrossel["titulo"];?>" width="350px;">
                                        </center>
                                    </a>
                                </span>
                                <span class="item-descricao">
                                    <a href="<?php echo $url_loja;?>/produto/<?php echo $itemCarrossel["url_amigavel"].'-'.$itemCarrossel["id"];?>.html" class="link-descricao">
                                        <span>
                                            <h3><?php echo $itemCarrossel["titulo"];?></h3>                                            
                                            <?php if($itemCarrossel["preco_de"]!=0){?><p>De: R$ <strike><?php echo number_format($itemCarrossel["preco_de"],2,',','.');?></strike></p><?php } ?>                                                
                                            <h1><?php if($itemCarrossel["preco"]!=0){?>R$ <?php echo number_format($itemCarrossel["preco"],2,',','.'); } else{ echo "À combinar";}?></h1>
                                            <?php if($itemCarrossel["parcelas"]>0 && $itemCarrossel["parcelas"]!=""){ ?>
                                            <p>ou em <?php echo $itemCarrossel["parcelas"];?>x de <?php echo number_format(($itemCarrossel["preco"]/$itemCarrossel["parcelas"]),2,',','');?> sem juros</p>
                                            <?php } ?>
                                            <p><?php echo str_replace("\n", "<br>", $itemCarrossel["descricao"]); ?></p>
                                        </span>           
                                    </a>                 
                                </span>
                            </div>
                           
                        <?php $i++; }?>                        
                      </div>

                      <!-- Controls -->
                      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                    <!--FIM CAROUSSEL-->
                </div>
            </div>            
            <?php if($Loja_Banner1!="" && $Loja_Banner2!="" && $Loja_Banner3!=""){ ?>
            <div class="row propaganda margin-top-10">
                <ul class="lista_banners">
                    <li class="items">                  
                    <?php if($Loja_Link_Banner1!='#'){?>
                    <a href="<?php echo $Loja_Link_Banner1;?>">      
                                <img src="http://perolanegocio.com/imagens/cliente/<?php echo $Loja_Banner1;?>" class = "img-responsive"/>                        
                    </a>
                    <?php } else{?>
                    <img src="http://perolanegocio.com/imagens/cliente/<?php echo $Loja_Banner1;?>" class="img-responsive" />
                    <?php }?>
                    </li>
                    <li class="items margem-l-10">                        
                    <?php if($Loja_Link_Banner2!='#'){?>
                    <a href="<?php echo $Loja_Link_Banner2;?>">      
                                <img src="http://perolanegocio.com/imagens/cliente/<?php echo $Loja_Banner2;?>" class = "img-responsive"/>                        
                    </a>
                    <?php } else{?>
                    <img src="http://perolanegocio.com/imagens/cliente/<?php echo $Loja_Banner2;?>" class="img-responsive" />
                    <?php }?>
            
                    </li>
                    <li class="items margem-l-10">                        
                     <?php if($Loja_Link_Banner3!='#'){?>
                    <a href="<?php echo $Loja_Link_Banner3;?>">      
                                <img src="http://perolanegocio.com/imagens/cliente/<?php echo $Loja_Banner3;?>" class = "img-responsive"/>                        
                    </a>
                    <?php } else{?>
                    <img src="http://perolanegocio.com/imagens/cliente/<?php echo $Loja_Banner3;?>" class="img-responsive" />
                    <?php }?>
                    </li>
                </ul>
            </div>
            <?php } ?>
            <div class="row conteudo margin-top-10">
                <a name="inicio"></a>
                <h3>Recomendações para você</h3>
                <ul class="lista_produtos">
                    <?php
                    while($itemProdutos = mysql_fetch_array($resultProdutos)){

                        $imagem = "http://perolanegocio.com/imagens/anuncio/".$itemProdutos["pasta"]."/media/".$itemProdutos["imagem"];
                    ?>
                    <li class="items">  
                        <a href="<?php echo $url_loja;?>/produto/<?php echo $itemProdutos["url_amigavel"].'-'.$itemProdutos["id"];?>.html">                             
                            <div class="imagem_produto"><img src="<?php echo $imagem;?>" align="center" /></div>                            
                            <span class="nome_produto"><?php echo $itemProdutos["titulo"]?></span>                                                                                    
                            <span class="preco_de"><?php echo ($itemProdutos["preco_de"]!=0?"De: <strike>R$ ".number_format($itemProdutos["preco_de"], 2, ',', '.')."</strike>":"");?></span>                        
                            <span class="preco_novo"><?php echo ($itemProdutos["preco"]!=0?"R$ ".number_format($itemProdutos["preco"], 2, ',', '.'):"À combinar");?></span>                                                    
                            <span class="parcelas"><?php if($itemProdutos["parcelas"]>0 && $itemProdutos["parcelas"]!=""){ ?>Parcele em <?php echo $itemProdutos["parcelas"];?>x de <?php echo number_format(($itemProdutos["preco"]/$itemProdutos["parcelas"]),2,',','');?> sem juros<?php } ?></span>
                            
                        </a>
                    </li>
                    <?php        
                    }
                    ?>                    
                </ul>
                <div class="animation_image" style="display:none; clear: both;" align="center"><img src="http://perolanegocio.com/loja/img/ajax-loader.gif"></div>
                <div class="mais_resultados" style="text-align: center; width: auto; padding: 10px; clear: both;">
                    <button class="btn btn-primary" id="btnMaisProdutos">Carregar Mais Produtos</button>
                </div>
            </div>         
            <!--FIM PAGINA INICIAL-->
        <?php } elseif($pagina_busca){ ?>
            <!--PAGINA BUSCA-->            
            <div class="row conteudo margin-top-10">
                <h3>Resultado da sua busca: <b><i><?php echo $_GET["palavra_chave"];?></b></i></h3>
                <ul class="lista_produtos">
                    <?php
                    while($itemProdutos = mysql_fetch_array($resultProdutos)){

                        $imagem = "http://perolanegocio.com/imagens/anuncio/".$itemProdutos["pasta"]."/media/".$itemProdutos["imagem"];
                    ?>
                    <li class="items">  
                        <a href="<?php echo $url_loja;?>/produto/<?php echo $itemProdutos["url_amigavel"].'-'.$itemProdutos["id"];?>.html">                             
                            <div class="imagem_produto"><img src="<?php echo $imagem;?>" align="center" /></div>
                            <span class="nome_produto"><?php echo $itemProdutos["titulo"]?></span>                            
                            <span class="preco_de"><? echo getTipoAnuncio($itemProdutos["preco_de"]);?></span>                        
                            <span class="preco_novo"><?php echo ($itemProdutos["preco"]!=0?"R$ ".number_format($itemProdutos["preco"], 2, ',', '.'):"À combinar");?></span>                                                    
                            <span class="parcelas"><?php if($itemProdutos["parcelas"]>0 && $itemProdutos["parcelas"]!=""){ ?>Parcele em <?php echo $itemProdutos["parcelas"];?>x de <?php echo number_format(($itemProdutos["preco"]/$itemProdutos["parcelas"]),2,',','');?> sem juros<?php } ?></span>
                        </a>
                    </li>
                    <?php        
                    }
                    ?>                    
                </ul>
            </div>
            <!--FIM PAGINA BUSCA-->
            <?php } ?>
            <?php if($Loja_Banner4!=""){ ?>
             <div class="row propaganda margin-top-10">
                <ul class="lista_superbanner">
                    <li class="items">                        
                     <?php if($Loja_Link_Banner4!='#'){?>
                    <a href="<?php echo $Loja_Link_Banner4;?>">      
                                <img src="http://perolanegocio.com/imagens/cliente/<?php echo $Loja_Banner4;?>" class = "img-responsive"/>                        
                    </a>
                    <?php } else{?>
                    <img src="http://perolanegocio.com/imagens/cliente/<?php echo $Loja_Banner4;?>" class="img-responsive" />
                    <?php }?>
                    </li>
                </ul>
            </div>
            <?php } ?>
            <div class="row rodape margin-top-10">                          
                <?php include("rodape.php");?>                
            </div>
        </div>


         <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="http://perolanegocio.com/js/bootstrap.min.js"></script>
    
    <script type="text/javascript">
            var pagina = 1;
            var itens_por_pagina = 12;
            var total_paginas = <?php echo ($total_paginas>0)?$total_paginas:0;?>;
    
    
        $( "#formPesquisa" ).submit(function(ev) {                      
            ev.preventDefault();
            var palavra_chave = $("#palavra_chave").val();
            window.location.href = "<?php echo $url_loja;?>/busca/"+palavra_chave;            
        });

        $("#btnMaisProdutos").click(function(){

            var Loja_id = '<?php echo $Loja_id;?>';
            var url_loja = '<?php echo $url_loja;?>';
            var palavra_chave = '<?php echo isset($palavra_chave)?$palavra_chave:"0";?>';
            $.ajax({
                url:"<?php echo $baseURL; ?>/auto_load.php",
                type:"POST",
                data:{"pagina":pagina, "itens_por_pagina":itens_por_pagina, "Loja_id":Loja_id, "url_loja":url_loja},
                success:function(data){
                    pagina++;                        
                    $('.animation_image').hide();                    
                    $('.lista_produtos').append(data);
                    console.log('pagina:'+pagina +'total pagina:'+total_paginas);
                    if(pagina>total_paginas){
                        $('#btnMaisProdutos').hide();
                    }
                },
                beforeSend:function(){
                    $('.animation_image').show();
                }
            });
        });

        $("#btnEnviarFormularioContato").click(function(){
            var to = '<?php echo $Loja_Email;?>';
            var from = $("#txtEmail").val();
            var nome = $("#txtNome").val();
            var fone = $("#txtFone").val();
            var mensagem = $("#txtMensagem").val();
            $.ajax({
                url:"<?php echo $baseURL;?>/enviar_email.php",
                type:"POST",
                data:{"to":to, "from":from, "nome":nome, "fone":fone, "mensagem":mensagem},
                success:function(data){                    
                    alert("Mensagem enviada com sucesso!");
                },
                beforeSend:function(){                    
                }
            });
        });
 
    </script>

    </body>
</html>
<?php
}else{echo "nenhuma loja identificada";}
?>
