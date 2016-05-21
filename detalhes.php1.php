<?php
 if(isset($_GET["loja"])){
    
    $baseURL = "http://".$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']);    
    
    /**
    busca dados da loja
    **/
   // require_once("autoload.php");

    
    
    $url_cliente = $_GET['loja'];

    $con = mysql_connect("186.202.165.58","perolaclass","pcl0914");
    mysql_select_db("perolaclass", $con);

    $sqlLoja = "SELECT * FROM cliente WHERE id_tipo_cliente='2' AND url_cliente='".$url_cliente."'";
    $resultLoja = mysql_query($sqlLoja) or die(mysql_error());
    $url_loja = $baseURL."/".$url_cliente;
    while ($dadosLoja = mysql_fetch_array($resultLoja)) {
        $Loja_id = $dadosLoja["id"];
        $Loja_Nome = $dadosLoja["nome"];
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
        $Loja_Cor_texto_preco_anterior = $dadosLoja["cor_texto_preco_anterior"];
        $Loja_Cor_texto_parcelas = $dadosLoja["cor_texto_parcelas"];
        $Loja_Cor_texto_preco = $dadosLoja["cor_texto_preco"];
        $Loja_Telefone = $dadosLoja["telefone"];
        $Loja_Telefone1 = $dadosLoja["telefone1"];
        $Loja_Telefone2 = $dadosLoja["telefone2"];

        $Loja_Logomarca = $dadosLoja["logomarca"];
        $Loja_Banner1 = $dadosLoja["banner1"];
        $Loja_Banner2 = $dadosLoja["banner2"];
        $Loja_Banner3 = $dadosLoja["banner3"];
        $Loja_Banner4 = $dadosLoja["banner4"];
    }

    $url_amigavel = "";
    $id_produto = "0";
    if(isset($_GET["produto"])){
        $link = explode("-", $_GET["produto"]);
        $url_amigavel = $link[0];
        $id_produto = $link[1];
    }   


    $sqlProdutos = "SELECT a.id, a.titulo, a.preco, a.preco_anterior, a.topo_negociar_preco, a.id_tipo_anuncio, a.parcelas, a.url_amigavel, a.descricao, a.pasta, a.oferta, f.imagem, f.legenda FROM anuncio a inner join foto f on a.id=f.id_anuncio WHERE a.id_cliente='{$Loja_id}'";        
    $resultProdutos = mysql_query($sqlProdutos) or die(mysql_error());

    /*$sqlProdutos = "SELECT * FROM anuncio WHERE id_cliente='{$id_loja}' AND id<>'{id_produto}'";    
    $resultProdutos = mysql_query($sqlProdutos) or die(mysql_error());*/
           
    $sqlProdutoSelecionado = "SELECT * FROM anuncio a inner join foto f on a.id=f.id_anuncio WHERE a.id_cliente='{$Loja_id}' AND a.id='{$id_produto}'";
    $resultProdutoSelecionado = mysql_query($sqlProdutoSelecionado) or die(mysql_error());
    $dadosProdutoSelecionado = mysql_fetch_array($resultProdutoSelecionado);
    
    $sqlProdutoSelecionadoFotos = "SELECT* FROM foto WHERE id_anuncio='{$id_produto}'";
    $resultProdutoSelecionadoFotos = mysql_query($sqlProdutoSelecionadoFotos) or die(mysql_error());
    
    

    $sqlProdutosCarrossel = "SELECT * FROM anuncio a inner join foto f on a.id=f.id_anuncio WHERE a.carrossel='S' and a.id_cliente='{$Loja_id}' group by a.id";            
    $resultProdutosCarrossel = mysql_query($sqlProdutosCarrossel) or die(mysql_error());
    $numeroItemsCarrossel = mysql_num_rows($resultProdutosCarrossel);

    function getTipoAnuncio($id_tipo_anuncio){
        $sqlTipoAnuncio = "SELECT * FROM tipo_anuncio WHERE id='".$id_tipo_anuncio."'";
        $resultTipoAnuncio = mysql_query($sqlTipoAnuncio) or die(mysql_error());
        $dadosTipoAnuncio = mysql_fetch_array($resultTipoAnuncio);
        return $dadosTipoAnuncio["tipo"];
    }

    function redesSociais($pagina){
        $code = '<div class="fb-like" data-href="'.$pagina.'" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div style="margin-top:1px; float:left;">
            <a href="https://twitter.com/share" class="twitter-share-button" data-lang="en">Tweet</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
            <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
            <g:plusone size="medium"></g:plusone></div>';
            
            return $code;
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
        <link rel="icon" type="image/png" href="../img/icone.png"/>
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]--> 


<style type="text/css">
            *{margin: 0px; padding: 0px; border: 0px;}            
            body {font-family: arial,Verdana,helvetica,sans-serif; color: <?php echo $Loja_Cor_texto_geral;?>; background: <?php echo $Loja_Cor_fundo_pagina;?>;}
            a{text-decoration: none;}
            a:hover{text-decoration: none;}
            .page{width: 1024px; padding-top: 10px;}
            .barra_perola img{height: 40px; padding: 5px;}            
            .barra_perola .container{width: 1024px; padding-top: 0px;}

            .topo{display: block; width: 1024px;  padding: 0px; margin-bottom: 10px; background: <?php echo $Loja_Cor_fundo_topo;?>;}
            .logomarca{display: block; width: 200px; height: 100px; padding: 0px;  background: none;}
            .logomarca img{display: block; width: 200px; height: 100px; padding: 0px; background: none;}        
            .pesquisa{padding: 30px;}

            .conteudo{background: <?php echo $Loja_Cor_fundo_produtos;?>;}
            
            .margin-top-10{margin-top: 10px;}
            .margin-bottom-10{margin-bottom: 10px;}
            .conteudo:after, .propaganda:after{content: ""; clear: both;}
            .conteudo h3{margin-left: 10px;}                        



            .lista_banners{list-style: none; background: <?php echo $Loja_Cor_fundo_destaques?>; display: block;padding: 0px; margin: 0px;}
            .lista_banners:after{content: ""; clear: both;}
            .lista_banners .items{display: block; width: 334px; background: #fff; float: left; padding: 0px; }
            .lista_superbanner{list-style: none; background: none; display: block;padding: 0px; margin: 0px;}
            .lista_superbanner:after{content: ""; clear: both;}
            .lista_superbanner .items{display: block; width: 1024px; height:200px; overflow:hidden; background: #fff; float: left; padding: 0px;}
            
            .margem-l-0{margin-left: 10px;}
            .margem-l-10{margin-left: 10px;}

            

            .lista_produtos{list-style: none; background: <?php echo $Loja_Cor_fundo_produtos;?>; display: block;padding: 10px;}                                    
            .lista_produtos:after{content: ""; clear: both;}
            .lista_produtos .items{display: block; width: 225px; height: 250px; float: left; padding: 10px; margin: 10px; }            
            .nome_produto{color: <?php echo $Loja_Cor_texto_produtos;?>; font-size: 12px; text-decoration: none; -webkit-line-clamp: 2; -webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;display: -webkit-box; min-height: 32px; }
            .preco_anterior{font-size: 11.1px; display: block; color: <?php echo $Loja_Cor_texto_preco_anterior;?>;}
            .preco_novo{font-size: 26.4px; color: <?php echo $Loja_Cor_texto_preco;?>; font-weight: bold; display: block; line-height: 33px;}
            .parcelas{font-size:11.1px;  line-height:15.125px; color: <?php echo $Loja_Cor_texto_parcelas;?>;}

            .mleft{margin-left: 0px; padding-left: 0px;}
            .ofertas{width: 1024px; margin-bottom: 10px; overflow: hidden;}
            .ofertas .menu{display: block; width: 200px; height: 430px; float: left; background: <?php echo $Loja_Cor_fundo_menu;?>;}
            .ofertas .destaques{display: block; width: 814px;  height: 430px; background: <?php echo $Loja_Cor_fundo_destaques;?>; float: left;margin-left: 10px; border: 2px solid #fff;}
            .btn-busca{background: #900; color: #fff;}

            .rodape{background: <?php echo $Loja_Cor_fundo_rodape;?>; padding: 10px; margin-bottom: 10px;}
            .rodape .descricao_empresa{font-size: 12px; text-align: center;}

            .menu ul{list-style: none;}
            .menu h4{padding: 0px 5px; font-weight: bold; border-bottom: 1px solid #ccc;}
            .menu ul li.item-menu a{display: block; padding: 5px; background: <?php echo $Loja_Cor_fundo_menu;?>; color:<?php echo $Loja_Cor_texto_menu;?>;}
            .menu ul li.item-menu a:hover{display: block; background: <?php echo $Loja_Cor_fundo_menu_hover;?>; color: <?php echo $Loja_Cor_texto_menu_hover;?>; padding: 5px;}
            
        </style>       


<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-55691533-1', 'auto');
ga('send', 'pageview');

</script>
  </head>
  <body>

  <div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

        <div class="container page">
            <div class="row topo">
                <div class="col-md-2 logomarca">
                   <a href="<?php echo $url_loja;?>"><img src="http://<?php echo $_SERVER['SERVER_NAME']."/imagens/cliente/".$Loja_Logomarca;?>" width="100%" /> </a>
                </div>
                <div class="col-md-8 pesquisa">
                    <div class="row">                      
                      <div class="col-md-6">
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
                    </div>
                </div>
            </div>
            <style type="text/css">
                .detalhes-view{width: 1024px; margin-bottom: 10px; overflow: hidden;}                                
                #produto-fotos, #produto-detalhes{display: block; width: 507px;  height: 430px; float: left;  background: #fff; border: 1px solid #fff;}            
                #produto-detalhes{margin-left: 10px;}
                #produto-fotos img{width: 500px; height: 300px; display: block; overflow: hidden;}
                #galeria{display: block; width: auto; border-bottom: 1px solid #f1f1f1;}
                #galeria a img{width: 50px; height: 50px; border:2px solid white;} 
                #zoom{width: 500px; height: 375px; display: block;}
                .zoomContainer{width: 500px; height: 375px; display: block;}
                .preco_novo{
                    color: <?php echo $Loja_Cor_texto_preco ;?>;
                    font-size: 2.8em;
                    font-weight: bold;
                    display: block;
                    width: auto;
                }
                .parcelas{display: block; color: }
            </style>
            <div class="row detalhes-view margin-top-10">
                <div id="produto-fotos">
                    <?php
                    if(mysql_num_rows($resultProdutoSelecionadoFotos)){                        
                    ?>                    
                    
                    <div id="galeria">
                        <?php
                        $i = 0;
                        while($fotos = mysql_fetch_array($resultProdutoSelecionadoFotos)){
                        ?>    
                        <a class="elevatezoom-gallery <?php if($i == 0){?>active<?php }?>" href="#" data-image="../imagens/anuncio/<?php echo $dadosProdutoSelecionado["pasta"];?>/grande/<?php echo $fotos["imagem"];?>" data-zoom-image="../imagens/anuncio/<?php echo $dadosProdutoSelecionado["pasta"];?>/<?php echo $fotos["imagem"];?>">
                            <img class="img-rounded" src="../imagens/anuncio/<?php echo $dadosProdutoSelecionado["pasta"];?>/thumbnails/<?php echo $fotos["imagem"];?>" />
                        </a>
                        <?php
                        $i++;
                        }
                        ?>
                    </div>
                    <img id="zoom" src="../imagens/anuncio/<?php echo $dadosProdutoSelecionado["pasta"];?>/grande/<?php echo $dadosProdutoSelecionado["imagem"];?>" class="img-thumbnail img-responsive"  data-zoom-image="../imagens/anuncio/<?php echo $dadosProdutoSelecionado["pasta"];?>/<?php echo $dadosProdutoSelecionado["imagem"];?>"/>
                    <?php }else{?>
                    <img src="../img/sem-imagem.jpg" class="img-thumbnail">
                    <?php }?>
                    
                </div>

                <div id="produto-detalhes">
                    <h4><?php echo $dadosProdutoSelecionado["titulo"];?></h4>
                    <hr size="1">                    
                    <span class="preco_novo"><?php echo ($dadosProdutoSelecionado["preco"]!=0?"R$ ".number_format($dadosProdutoSelecionado["preco"], 2, ',', '.'):"À combinar");?></span>
                    <span class="parcelas">Parcele em <?php echo $dadosProdutoSelecionado["parcelas"];?>x sem juros</span>                    
                    <hr size="1">                    
                    <div class="pull-right" style="margin-bottom:20px;">
                      <?php 
                            $pagina = "http://".$_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                            echo redesSociais($pagina);
                       ?>
                    </div>
                </div>
                <span class="clear"></span>
            </div>
            <div class="row conteudo margin-top-10">
                <h3>Informações do Produto</h3>
                <span style="padding: 20px; list-style:none; font-size: 10pt;"><?php echo $dadosProdutoSelecionado["descricao"];?></span>
            </div>
             <div class="row propaganda margin-top-10">
                <ul class="lista_superbanner">
                    <li class="items">                        
                        <img src="<?php echo "http://".$_SERVER['SERVER_NAME'];?>/imagens/cliente/<?php echo $Loja_Banner4;?>" class = "img-responsive"/>                        
                    </li>
                </ul>
            </div>
            <div class="row conteudo margin-top-10">
                <h3>Outros Produtos</h3>
                <ul class="lista_produtos">
                    <?php
                    while($itemProdutos = mysql_fetch_array($resultProdutos)){

                        $imagem = "http://".$_SERVER['SERVER_NAME']."/imagens/anuncio/".$itemProdutos["pasta"]."/media/".$itemProdutos["imagem"];
                    ?>
                    <li class="items">  
                        <a href="<?php echo $url_loja;?>/produto/<?php echo $itemProdutos["url_amigavel"].'-'.$itemProdutos["id"];?>.html">                             
                            <img src="<?php echo $imagem;?>" class = "img-responsive" />
                            <span class="nome_produto"><?php echo $itemProdutos["titulo"]?></span>                            
                            <span class="preco_anterior"><? echo getTipoAnuncio($itemProdutos["preco_anterior"]);?></span>                        
                            <span class="preco_novo"><?php echo ($itemProdutos["preco"]!=0?"R$ ".number_format($itemProdutos["preco"], 2, ',', '.'):"À combinar");?></span>                        
                            <span class="parcelas">Parcele em <?php echo $itemProdutos["parcelas"]?>x sem juros</span>
                        </a>
                    </li>
                    <?php        
                    }
                    ?>                    
                </ul>
            </div>  
            <div class="row rodape margin-top-10">          
                <div class="descricao_empresa">
                   <span style="text-align: justify; background: #f1f1f1; display: block; padding: 10px;">
                        <h4>Tópico de Responsabilidade</h4>
                        O Perola Classificados não se responsabiliza pelas informações aqui publicadas por terceiros, bem como não participa da negociação entre anunciantes e compradores. Apenas disponibilizamos um canal aberto para publicação de tais produtos e/ou serviços.
                    </span>
                    <span style="margin-top: 10px; display: block;">
                        <span style="float: left; width: 200px; height: 100px;"><img src="http://www.perolanegocio.com/img/perola-negocio-rodape.png"></span>
                        <span  style="float: left; width: 200px; height: 100px; text-align: justify;">
                            perolanegocio.com © 2016 <br>
                            Todos os direitos reservados.<br> 
                            Contato: (93) 9123-1160 ou 3064-5899     
                        </span>                        
                    </span>
                </div>                
            </div>
        </div>


         <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo $baseURL;?>/js/bootstrap.min.js"></script>


    <script src="http://www.perolanegocio.com/js/jquery.elevateZoom-3.0.8.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#zoom").elevateZoom({
                gallery:'galeria',
                scrollZoom : true, 
                cursor: 'pointer', 
                galleryActiveClass: 'active', 
                imageCrossfade: true, 
                loadingIcon: '../images/lightbox-ico-loading.gif',
                zoomWindowPosition: "produto-detalhes",
                zoomWindowHeight: 430,
                zoomWindowWidth:507, 
                borderSize: 0,
                responsive: true
            });
            
            $("#zoom").bind("click", function(e) { 
                var ez = $('#zoom').data('elevateZoom');    
                $.fancybox(ez.getGalleryList());
                return false;
            });

           
        });

         $( "#formPesquisa" ).submit(function(ev) {                      
            ev.preventDefault();
            var palavra_chave = $("#palavra_chave").val();
            window.location.href = "<?php echo $url_loja;?>/busca/"+palavra_chave;            
        });
    </script>

    </body>
</html>
<?php
}else{echo "nenhuma loja identificada";}
?>