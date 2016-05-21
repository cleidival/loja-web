<?
$con = mysql_connect("186.202.165.58","perolaclass","pcl0914");
mysql_select_db("perolaclass", $con);
mysql_query("SET CHARACTER SET utf8 ");


function cleanURI($input)
{
	return ereg_replace(
		'[^a-z0-9-]',
		'', 
		ereg_replace(
			' +',
			'_',
			strtr(
				strtolower($input), 
				'ÀÁÃÂÉÊÍÓÕÔÚÜÇàáãâéêíóõôúüç', 
				'AAAAEEIOOOUUCaaaaeeiooouuc'
			)
		)
	);
}

$sql = "SELECT * FROM anuncio";
$result = mysql_query($sql);
$sql2 = "";
while($linha = mysql_fetch_array($result)){
	$sql2 = "update anuncio set url_amigavel='".cleanURI($linha["titulo"])."' where id='".$linha["id"]."';";
	mysql_query($sql2) or die(mysql_error());	
}
echo $sql2;
//mysql_query($sql2) or die(mysql_error());
//print cleanURI($_GET["t"]);
?>