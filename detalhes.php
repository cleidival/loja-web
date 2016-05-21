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


$con = mysql_connect("186.202.165.58","perolaclass","pcl0914");
mysql_select_db("perolaclass", $con);

$sql = "SELECT * FROM cliente WHERE site='{$baseURL}'";
//echo $sql."<br>";
$result = mysql_query($sql) or die(mysql_error());
$num_registros = mysql_num_rows($result);

if(mysql_num_rows($result)>0){
    $lojaExiste = true;
}


if($lojaExiste){


    //$sqlLoja = "SELECT * FROM cliente WHERE id_tipo_cliente='2' AND url_cliente='".$url_cliente."'";
    $sqlLoja = "SELECT * FROM cliente WHERE id_tipo_cliente='2' AND (url_cliente='".$url_cliente."' or site='".$baseURL."')";
    //echo $sqlLoja;
    $resultLoja = mysql_query($sqlLoja) or die(mysql_error());
    
    while ($dadosLoja = mysql_fetch_array($resultLoja)) {
        $Loja_id = $dadosLoja["id"];
        $Loja_Nome = $dadosLoja["nome"];
        $Loja_Descricao = $dadosLoja["descricao"];
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
        

        $Loja_Responsabilidades = $dadosLoja["responsabilidades"];
        $Loja_Informacoes_Rodape = $dadosLoja["informacoes_rodape"];
    }
    
    $url_amigavel = "";
    $id_produto = "0";
    //echo $_GET["produto"];
    if(isset($_GET["produto"])){
        $link = explode("-", $_GET["produto"]);
        $url_amigavel = "";
        $id_produto = "0";
        if(isset($link)){
            for($i=0; $i<count($link); $i++){
                $url_amigavel .= $link[$i];    
            }
            $id_produto = $link[$i-1];
        }
        
    }   


    //$sqlProdutos = "SELECT a.id, a.titulo, a.preco, a.preco_de, a.topo_negociar_preco, a.id_tipo_anuncio, a.parcelas, a.url_amigavel, a.descricao, a.pasta, a.oferta, f.imagem, f.legenda FROM anuncio a inner join foto f on a.id=f.id_anuncio WHERE a.id_cliente='{$Loja_id}'";        
    $sqlProdutos = "SELECT distinct a.id, a.titulo, a.preco, a.preco_de, a.topo_negociar_preco, a.id_tipo_anuncio, a.parcelas, a.url_amigavel, a.descricao, a.pasta, a.oferta, f.imagem, f.legenda FROM anuncio a inner join foto f on a.id=f.id_anuncio WHERE a.id_cliente='{$Loja_id}' GROUP BY a.id";
    $resultProdutos = mysql_query($sqlProdutos) or die(mysql_error());

    /*$sqlProdutos = "SELECT * FROM anuncio WHERE id_cliente='{$id_loja}' AND id<>'{id_produto}'";    
    $resultProdutos = mysql_query($sqlProdutos) or die(mysql_error());*/
           
    $sqlProdutoSelecionado = "SELECT * FROM anuncio a inner join foto f on a.id=f.id_anuncio WHERE a.id_cliente='{$Loja_id}' AND a.id='{$id_produto}'";
    $resultProdutoSelecionado = mysql_query($sqlProdutoSelecionado) or die(mysql_error());
    $dadosProdutoSelecionado = mysql_fetch_array($resultProdutoSelecionado);
    
    $sqlProdutoSelecionadoFotos = "SELECT* FROM foto WHERE id_anuncio='{$id_produto}'";
    $resultProdutoSelecionadoFotos = mysql_query($sqlProdutoSelecionadoFotos) or die(mysql_error());
    
    $detalhesProduto = "";
    $imagemProduto = "";

    if(mysql_num_rows($resultProdutoSelecionadoFotos)){                        
        $detalhesProduto = '<div id="galeria">';

        $i = 0;
        while($fotos = mysql_fetch_array($resultProdutoSelecionadoFotos)){
            if($i==0){$imagemProduto = 'http://perolanegocio.com/imagens/anuncio/'.$dadosProdutoSelecionado["pasta"].'/grande/'.$fotos["imagem"];}
            $detalhesProduto .= '<a class="elevatezoom-gallery '.($i==0?'active':'').'" href="#" data-image="http://perolanegocio.com/imagens/anuncio/'.$dadosProdutoSelecionado["pasta"].'/grande/'.$fotos["imagem"].'" data-zoom-image="http://perolanegocio.com/imagens/anuncio/'.$dadosProdutoSelecionado["pasta"].'/'.$fotos["imagem"].'">';
            $detalhesProduto .= '<img class="img-rounded" src="http://perolanegocio.com/imagens/anuncio/'.$dadosProdutoSelecionado["pasta"].'/thumbnails/'.$fotos["imagem"].'" width="480px" height="360px" />';
            $detalhesProduto .= '</a>';            
            $i++;
        }        
        $detalhesProduto .= '</div>';        
        $detalhesProduto .= '<img id="zoom" src="http://perolanegocio.com/imagens/anuncio/'.$dadosProdutoSelecionado["pasta"].'/grande/'.$dadosProdutoSelecionado["imagem"].'" class="img-thumbnail img-responsive"  data-zoom-image="http://perolanegocio.com/imagens/anuncio/'.$dadosProdutoSelecionado["pasta"].'/'.$dadosProdutoSelecionado["imagem"].'"/>';
    }else{
        $detalhesProduto = '<img src="http://perolanegocio.com/img/sem-imagem.jpg" class="img-thumbnail">';
    }
    

    $sqlProdutosCarrossel = "SELECT * FROM anuncio a inner join foto f on a.id=f.id_anuncio WHERE a.carrossel='S' and a.id_cliente='{$Loja_id}' group by a.id";            
    $resultProdutosCarrossel = mysql_query($sqlProdutosCarrossel) or die(mysql_error());
    $numeroItemsCarrossel = mysql_num_rows($resultProdutosCarrossel);

    function getTipoAnuncio($id_tipo_anuncio){
        $sqlTipoAnuncio = "SELECT * FROM tipo_anuncio WHERE id='".$id_tipo_anuncio."'";
        $resultTipoAnuncio = mysql_query($sqlTipoAnuncio) or die(mysql_error());
        $dadosTipoAnuncio = mysql_fetch_array($resultTipoAnuncio);
        return $dadosTipoAnuncio["tipo"];
    }

    function redesSociais($pagina, $negociar){
        $code = '
        <div class="negociar-shared">
            ';
        if($negociar == 1){
           /* $code .= '
                <div class="topo-negociar" style="margin-bottom:15px;">
                    <span class="label label-default">Topo negociar o valor</span>
                </div>
            ';*/
        }
        $code .= '
            <div class="shared-box">
                <div class="fb-like" data-href="'.$pagina.'" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
                            
                <div style="margin-top:1px; float:left;">
                
                <a href="https://twitter.com/share" class="twitter-share-button" data-lang="en">Tweet</a>            
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                
                <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
                <g:plusone size="medium"></g:plusone></div>
            </div>
            <div class="clear"></div>
        </div>';
    
            return $code;
    }

    
    $pagina = "http://".$_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <base href="<?php echo $baseURL;?>" />
        <meta charset="charset=iso-8859-1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $Loja_Nome.' - '.$dadosProdutoSelecionado["titulo"];?></title>                
        <meta name="description" content="<?php echo $Loja_Descricao;?>"/>

        <meta property="og:image" content="<?php echo $imagemProduto;?>"/>
        <meta property="og:title" content="<?php echo $Loja_Nome.' - '.$dadosProdutoSelecionado["titulo"];?>"/>
        <meta property="og:url" content="<?php echo $pagina;?>"/>
        <meta property="og:site_name" content="<?php echo $Loja_Nome;?>"/>                
        <meta property="og:description" content="<?php echo $Loja_Descricao;?>"/>


        <!-- Bootstrap -->
        <link href="<?php echo $baseURL;?>/css/normalize.css" rel="stylesheet">

        <link href="<?php echo $baseURL;?>/css/bootstrap.min.css" rel="stylesheet">        
        <link href="<?php echo $baseURL;?>/css/estilo.css" rel="stylesheet">        
        <link href="<?php echo $baseURL;?>/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link rel="icon" type="image/png" href="../img/icone.png"/>

        <link href="<?php echo $baseURL;?>/estilo-css.php?Loja_id=<?php echo $Loja_id;?>" rel="stylesheet">
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]--> 
   


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

        <?php include("modals.php"); ?>

        
        <div style="width:auto;" class="modal fade" id="modalQueroComprar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Fechar</span></button>
                    <h4 class="modal-title n" id="myModalLabel">Quero Comprar - <?php echo $dadosProdutoSelecionado["titulo"]?></h4>
                  </div>
                  
                  <div class="modal-body">
                    
                   <p class="text-right">Os campos com * são obrigatórios</p> 
                    
                    <div class="form-group">
                      <label for="txtComprarNome">Nome Completo *</label>
                      <input name="txtComprarNome" type="text" required="" class="form-control" id="txtComprarNome" placeholder="Nome Completo" aria-required="true">
                    </div>
                    
                    <div class="form-group">
                      <label for="txtComprarEmail">Endereço de E-mail *</label>
                      <input name="txtComprarEmail" type="email" required="" class="form-control" id="txtComprarEmail" placeholder="Endereço de E-mail" aria-required="true">
                    </div>
                    
                    <div class="form-group">
                      <label for="txtComprarFone">Telefone *</label>
                      <input name="txtComprarFone" type="text" class="form-control telefone" id="txtComprarFone" placeholder="Informe o seu Telefone" required="" aria-required="true">
                    </div>
                    
                    
                  </div>
                  <div class="modal-footer">                    
                    <button type="button" id="btnEnviarFormularioCompra" class="btn btn-primary">Enviar</button>
                  </div>
                  
                </div>
              </div>
            </div>



        <div class="container page">
            <div class="row topo">
                <div class="logomarca">
                    <a href="<?php echo $url_loja;?>">
                        <img src="http://www.perolanegocio.com/imagens/cliente/<?php echo $Loja_Logomarca;?>" /> 
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
           
            <div class="row detalhes-view margin-top-10">
                <div id="produto-fotos">
                    <?php echo $detalhesProduto; ?>                    
                </div>

                <div id="produto-detalhes">
                    <h4><?php echo $dadosProdutoSelecionado["titulo"];?></h4>        
                    <div style="display: block; border-top: 1px solid #CCC;">
                        <div class="grupo-precos">            
                            <span class="preco_de"><?php echo ($dadosProdutoSelecionado["preco_de"]!=0?"De: <strike>R$ ".number_format($dadosProdutoSelecionado["preco_de"], 2, ',', '.')."</strike>":"");?></span>                                     
                            <span class="preco_novo"><?php echo ($dadosProdutoSelecionado["preco"]!=0?"R$ ".number_format($dadosProdutoSelecionado["preco"], 2, ',', '.'):"À combinar");?></span>                    
                            <?php if($dadosProdutoSelecionado["parcelas"]>0 && $dadosProdutoSelecionado["parcelas"]!=""){ ?>
                            <span class="parcelas">Parcele em <?php echo $dadosProdutoSelecionado["parcelas"];?>x de <?php echo number_format(($dadosProdutoSelecionado["preco"]/$dadosProdutoSelecionado["parcelas"]),2,',','');?> sem juros</span>
                            <?php } ?>                                                        
                        </div>      
                    
                        <div class="grupo-btnComprar">                    
                          <button class="btn btn-orange" data-toggle="modal" data-target="#modalQueroComprar">Quero Comprar</button>
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="pull-right">
                      <?php 
                            $pagina = "http://".$_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                                                      
                            echo redesSociais($pagina, $dadosProdutoSelecionado["topo_negociar_preco"]);
                       ?>
                    </div>                    
                    <div style="padding: 20px; font-size: 10pt; clear: both; overflow: hidden; width: 470px; heigth: 200px;">
                    <?php 
                        $sqlCaracteristicas = "select 
                                distinct ca.id, ca.nome
                                from 
                                anuncio_caracteristica ac 
                                inner join caracteristica ca on ac.id_caracteristica=ca.id
                                left join anuncio an on ac.id_anuncio=an.id
                                where ac.id_anuncio={$id_produto}";
                                
                        /*$resultCaracteristicas = mysql_query($sqlCaracteristicas);
                        if(mysql_num_rows($resultCaracteristicas)!=0){
                            echo "<ul>";
                            while ($linhaCaracteristicas = mysql_fetch_array($resultCaracteristicas)) {
                                echo "<li>".$linhaCaracteristicas["nome"]."</li>";
                            }
                            echo "</ul>";
                        }else{*/
                            echo str_ireplace("\n", "<br>", $dadosProdutoSelecionado["descricao"]);    
                        //}
                    ?>                    
                    </div>
                </div>
                <span class="clear"></span>
            </div>
            <?php
            if(strlen($dadosProdutoSelecionado["descricao2"])!=0){
            ?>
            <div class="row conteudo margin-top-10">
                <h3>Informações do Produto</h3>
                <div style="padding: 20px; font-size: 10pt; clear: both;">
                <?php echo str_ireplace("\n", "<br>", $dadosProdutoSelecionado["descricao2"]);?>
                </div>
            </div>
            <?php } ?>
             <?php if($Loja_Banner4!=""){ ?>
             <div class="row propaganda margin-top-10">
                <ul class="lista_superbanner">
                    <li class="items">                        
                        <img src="http://perolanegocio.com/imagens/cliente/<?php echo $Loja_Banner4;?>" class = "img-responsive"/>                        
                    </li>
                </ul>
            </div>
            <?php } ?>
            
            <div class="row conteudo margin-top-10">
                <h3>Outros Produtos</h3>
                <ul class="lista_produtos">
                    <?php
                    while($itemProdutos = mysql_fetch_array($resultProdutos)){

                        $imagem = "http://perolanegocio.com/imagens/anuncio/".$itemProdutos["pasta"]."/media/".$itemProdutos["imagem"];
                    ?>
                    <li class="items">  
                        <!--<a href="<?php echo $baseURL;?>/produto/<?php echo $itemProdutos["url_amigavel"].'-'.$itemProdutos["id"];?>.html">                             -->
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
              <div class="row rodape margin-top-10">                          
                <?php include("rodape.php");?>                
            </div>
        </div>


         <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="http://www.perolanegocio.com/js/bootstrap.min.js"></script>


    <script src="http://www.perolanegocio.com/js/jquery.elevateZoom-3.0.8.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){


/*        $("#zoom_03").elevateZoom({
            constrainType:"height", 
            constrainSize:274, 
            zoomType: "lens", 
            containLensZoom: true, 
            gallery:'gallery_01', 
            cursor: 'pointer', 
            galleryActiveClass: "active"}
            );
        $("#zoom_03").bind("click", function(e) { 
            var ez = $('#zoom_03').data('elevateZoom');  
        $.fancybox(ez.getGalleryList()); return false; }); 
*/

            $("#zoom").elevateZoom({                                                    
                gallery:'galeria', 
                cursor: 'crosshair',    
                scrollZoom: true,
                borderSize: 1,                             
                galleryActiveClass: "active",
                zoomWindowPosition: "produto-detalhes",
                zoomWindowWidth:507, 
                zoomWindowHeight:430,
                imageCrossfade: true 
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
         $("#btnEnviarFormularioCompra").click(function(){
            var to = '<?php echo $Loja_Email;?>';
            var from = $("#txtComprarEmail").val();
            var nome = $("#txtComprarNome").val();
            var fone = $("#txtComprarFone").val();
            var mensagem = "Seu anuncio <b><?php echo $dadosProdutoSelecionado["titulo"]?></b>, foi visualizado por "+nome;
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
