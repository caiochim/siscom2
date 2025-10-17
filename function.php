<?php
/**************************************************************************/
/* function.php ***********************************************************/
/**************************************************************************/

// CANCELA ÍTEM NO PDV /////////////////////////////////////////////////////
function pdv_cancela_item($id_item)
{
	$y	=	false;
	$id_user	=	$_SESSION['user_id'];
	if($result	=	mysql_query("SELECT vendas2.codigo, vendas2.descricao, vendas2.unitario, vendas2.qtde, vendas2.subtotal FROM vendas2 WHERE vendas2.id =  '$id_item' LIMIT 1 "))
	{
		// INICIO - REGISTRA ESTORNO - CÓDIGO ADICIONADO EM 12/06/2010 //
		$ecodigo		=	mysql_result($result, 0, 'codigo');
		$edescricao		=	mysql_result($result, 0, 'descricao');
		$eunitario		=	mysql_result($result, 0, 'unitario');
		$equantidade	=	mysql_result($result, 0, 'qtde');
		$esubtotal		=	mysql_result($result, 0, 'subtotal');
		mysql_query("INSERT INTO `estorno` (`codigo`, `descricao`, `quantidade`, `unitario`, `subtotal`, `id_user`, `datahora`) VALUES ('$ecodigo', '$edescricao', '$equantidade', '$eunitario', '$esubtotal', '$id_user', now())");
		// FIM - REGISTRA ESTORNO - CÓDIGO ADICIONADO EM 12/06/2010 //
		$qtde	=	mysql_result($result, 0, 'qtde');
		$codigo	=	mysql_result($result, 0, 'codigo');
		if (mysql_query("UPDATE produtos SET estoque=(estoque+$qtde) WHERE (codigo='$codigo') LIMIT 1 "))		{
			if (mysql_query("DELETE FROM vendas2 WHERE (id='$id_item') LIMIT 1"))			{
				$y	=	true;
			}
		}
	}
	return $y;
}

/*
 * CANCELA ITEM ENTRADA DE NOTAS FISCAIS
 */
function nf_cancela_item($id_item)
{
	$r1	=	mysql_query("SELECT entrada2.codigo, entrada2.qtde FROM entrada2 WHERE entrada2.id =  '$id_item' LIMIT 1 ");
	$codigo	=	mysql_result($r1, 0, 'codigo');
	$qtde	=	mysql_result($r1, 0, 'qtde');
	mysql_query("UPDATE produtos SET estoque=estoque-$qtde WHERE (codigo='$codigo') LIMIT 1 ");
	mysql_query("DELETE FROM entrada2 WHERE (id='$id_item') LIMIT 1");
}
?>