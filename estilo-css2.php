 <?php

header("Content-type: text/css");

$con = mysql_connect("186.202.165.58","perolaclass","pcl0914");
mysql_select_db("perolaclass", $con);

$sqlLoja = "SELECT * FROM cliente WHERE id_tipo_cliente='2' AND id='".$_GET["Loja_id"]."'";
$resultLoja = mysql_query($sqlLoja) or die(mysql_error());

$dadosLoja = mysql_fetch_array($resultLoja);
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
$Loja_Cor_texto_produtos  = $dadosLoja["cor_texto_produtos"];
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
$Loja_Banner1 = $dadosLoja["banner1"];
$Loja_Banner2 = $dadosLoja["banner2"];
$Loja_Banner3 = $dadosLoja["banner3"];
$Loja_Banner4 = $dadosLoja["banner4"];
$Loja_Responsabilidades = $dadosLoja["responsabilidades"];
$Loja_Informacoes_Rodape = $dadosLoja["informacoes_rodape"];


echo "
            *{margin: 0px; padding: 0px; border: 0px;}            
            body {font-family: arial,Verdana,helvetica,sans-serif; color: ".$Loja_Cor_texto_geral."; background: ".$Loja_Cor_fundo_pagina." url('".$Loja_imagem_fundo_pagina."') ".($Loja_imagem_fundo_repetir=='N'?'fixed top center no-repeat':'').";}
            a{text-decoration: none; color:".$Loja_Cor_texto_geral."; }
            a:hover{text-decoration: none; color:".$Loja_Cor_texto_geral.";}
            .page{width: 1024px; padding-top: 10px;}
            .barra_perola img{height: 40px; padding: 5px;}            
            .barra_perola .container{width: 1024px; padding-top: 0px;}            
            
            .topo{display: block; width: 1024px;  padding: 0px; margin-bottom: 10px; background: ".$Loja_Cor_fundo_topo."; url('".$Loja_imagem_fundo_topo.";') repeat-x;}
            .logomarca{display: block; float: left; width: 224px; height: 100px; padding: 0px;  background: none; overflow: hidden;}            
            .pesquisa{display: block; float: left; padding: 30px; width: 800px;}
            .pesquisa-form{float: left; display: block; width: 300px;}
            .menu-topo{float: left; display: block; width: 400px; text-align: right;}
            .menu-topo ul{list-style: none;}
            .menu-topo ul li{display: inline-block;}
            .menu-topo ul li a{color: #fff; text-decoration: underline; padding: 5px;}
            .menu-topo ul li a:hover{color: #f00; background: #fff; text-decoration: underline; padding: 5px;}

            .conteudo{background: ".$Loja_Cor_fundo_produtos.";}
            .propaganda{background: none;}
            .margin-top-10{margin-top: 10px;}
            .margin-bottom-10{margin-bottom: 10px;}
            .conteudo:after, .propaganda:after{content: ''; clear: both;}
            .conteudo h3{margin-left: 10px;}                        

            .lista_banners{list-style: none; background: ".$Loja_Cor_fundo_destaques."; display: block;padding: 0px; margin: 0px;}
            .lista_banners:after{content: ''; clear: both;}
            .lista_banners .items{display: block; width: 334px; background: #fff; float: left; padding: 0px; }
            .lista_superbanner{list-style: none; background: none; display: block;padding: 0px; margin: 0px;}
            .lista_superbanner:after{content: ''; clear: both;}            
            .lista_superbanner .items{display: block; width: 1024px; height:200px; overflow:hidden; background: #fff; float: left; padding: 0px;}
            
            .margem-l-0{margin-left: 10px;}
            .margem-l-10{margin-left: 10px;}

            .lista_produtos{list-style: none; background: ".$Loja_Cor_fundo_produtos."; display: block;padding: 10px;}                                    
            .lista_produtos:after{content: ''; clear: both;}
            .lista_produtos .items{display: block; width: 225px; height: 250px; float: left; padding: 10px; margin: 10px; text-align: center; }                        
            .lista_produtos .items .imagem_produto{ display: block; width: 203px; height: 105px;  overflow: hidden; text-align: center;}
            .lista_produtos .items .nome_produto{color: ".$Loja_Cor_texto_produtos.";font-size: 12px; text-decoration: none; -webkit-line-clamp: 2; -webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;display: -webkit-box; height: 20px; }
            .lista_produtos .items .preco_de{font-size: 11.1px; display: block; color: ".$Loja_Cor_texto_preco_de.";  overflow: hidden; height: 20px;}
            .lista_produtos .items .preco_novo{font-size: 26.4px; color: ".$Loja_Cor_texto_preco."; font-weight: bold; display: block; line-height: 33px;   overflow: hidden; height: 32px;}
            .lista_produtos .items .parcelas{font-size:11.1px;  line-height:15.125px; color: ".$Loja_Cor_texto_parcelas.";   overflow: hidden; height: 20px;}

            .grupo-precos .imagem_produto{ display: block; width: 203px; height: 105px;  overflow: hidden; text-align: center;}
            .grupo-precos .nome_produto{color: ".$Loja_Cor_texto_produtos.";font-size: 12px; text-decoration: none; -webkit-line-clamp: 2; -webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;display: -webkit-box; height: 20px; }
            .grupo-precos .preco_de{font-size: 11.1px; display: block; color: ".$Loja_Cor_texto_preco_de.";  overflow: hidden; height: 20px;}
            .grupo-precos .preco_novo{font-size: 26.4px; color: ".$Loja_Cor_texto_preco."; font-weight: bold; display: block; line-height: 33px;   overflow: hidden; height: 32px;}
            .grupo-precos .parcelas{font-size:11.1px;  line-height:15.125px; color: ".$Loja_Cor_texto_parcelas.";   overflow: hidden; height: 20px;}


            .mleft{margin-left: 0px; padding-left: 0px;}

            .ofertas{width: 1024px; margin-bottom: 10px; overflow: hidden;}
            .ofertas .menu{display: block; overflow: auto; width: 200px; height: 430px; float: left; background: ".$Loja_Cor_fundo_menu.";}
            .ofertas .destaques{display: block; width: 814px;  height: 430px; background: ".$Loja_Cor_fundo_destaques."; float: left;margin-left: 10px; border: 2px solid #fff;}
            .btn-busca{background: #900; color: #fff;}

            .rodape{background: ".$Loja_Cor_fundo_rodape."; padding: 10px; margin-bottom: 10px;}
            .rodape .descricao_empresa{font-size: 12px; text-align: center;}

            .menu ul{list-style: none;}
            .menu h4{padding: 0px 5px; font-weight: bold; border-bottom: 1px solid #ccc;}
            .menu ul li.item-menu a{display: block; padding: 5px; background: ".$Loja_Cor_fundo_menu."; color:".$Loja_Cor_texto_menu.";}
            .menu ul li.item-menu a:hover{display: block; background: ".$Loja_Cor_fundo_menu_hover."; color: ".$Loja_Cor_texto_menu_hover."; padding: 5px;}
             
            .carousel-inner .item{background: #fff;}
            .carousel-indicators li{color: #ccc;}
            .carousel-inner .item .item-imagem{display: block; float: left; width: 400px; height: 390px; margin: 20px; margin-right: 0px; position: relative;}
            .carousel-inner .item .item-imagem a{display: block; width: 395px; height: 300px; text-align: center; position: absolute; top: 50%; bottom: 50%; margin: -150px; margin-left: 0px;  overflow: hidden; }
            .carousel-inner .item .item-imagem a img{display: block; background: #000;  border: none; padding: 0px; width: 350px;}                            
            .carousel-inner .item .item-descricao{display: block; float: left; width: 370px; height: 390px; margin: 20px; padding: 30px 0px;  margin-right: 0px; position: relative;}
            .carousel-inner .item .item-descricao h1{color: ".$Loja_Cor_texto_preco."; font-weight: bold;}
            .carousel-control.right{right: 0;left: auto;background-image: none;}
            .carousel-control.left{right: auto;left: 0;background-image: none;}
            .carousel-indicators .active {width: 10px; height: 10px; margin: 1px; background-color: #ccc;}
            .carousel-indicators li {display: inline-block;width: 10px;height: 10px;margin: 1px;cursor: pointer;text-indent: -999px;background-color: #fff;background-color: rgba(0,0,0,0);border: 2px solid #ccc;border-radius: 10px;}

      
            .detalhes-view{width: 1024px; margin-bottom: 10px; overflow: hidden;}                                
            #produto-fotos, #produto-detalhes{display: block; width: 507px;  height: 430px; float: left;  background: #fff; border: 1px solid #fff;}
            #produto-detalhes{margin-left: 10px; padding: 20px;}
            #produto-detalhes .grupo-precos{padding: 0px; display: block; float: left; width: 300px; height: 75px;}
            #produto-detalhes .grupo-btnComprar{padding: 10px; display: block; float: right; width: 150px; height: 75px;   text-align: right;}
            #produto-detalhes .grupo-btnComprar .btn-orange{background: #FF9D47; color: #fff;}
            #produto-fotos img{width: 500px; height: 300px; display: block; overflow: hidden;}
            
            #galeria{display: block; width: 500px; height: 70px; overflow: hidden; border-bottom: 1px solid #f1f1f1;}
            #galeria a img{width: 50px; height: 50px; float: left;}             
            #zoom{width: 500px; height: 375px; display: block;}
            .zoomContainer{width: 500px; height: 375px; display: block;}
            .preco_novo{
                color: ".$Loja_Cor_texto_preco.";
                font-size: 2.8em;
                font-weight: bold;
                display: block;
                width: auto;
            }
            .parcelas{display: block; color: }
            .animation_image {background: #F9FFFF;border: 1px solid #E1FFFF;padding: 10px;width: 500px;margin-right: auto;margin-left: auto;}
            
            .clear{clear: both; content: '';}

            .negociar-shared{display: block; width: 470px; height: 25px;}
            .topo-negociar{display: block; width: 120px; height: 25px; float: left;}
            .shared-box{display: block; width: 340px; height: 25px; margin-left: 5px; float: left;}

            ";
?>

