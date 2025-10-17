<?php	session_start();
include( '../config.php' );
valida();
$tpl->assign( 'menu', gera_menu( $_SESSION['user_id'] ) );

/************************************************************************************/
$id_cliente	=	$_GET['id_cliente'];

//////////////////////////////////////////////////////////////////////////////////////
// SALDO DO CLIENTE //////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
if ($result = mysql_query("SELECT Sum(vendas1.total) AS debito FROM vendas1 WHERE vendas1.id_cliente =  '$id_cliente' AND vendas1.pago =  'N' "))
{
	$debito	=	mysql_result($result, 0, 'debito');
	if ($result = mysql_query("SELECT Sum(vendas1.total) AS credito FROM vendas1 WHERE vendas1.id_cliente =  '$id_cliente' AND vendas1.pago =  'S' "))
	{
		$credito	=	mysql_result($result, 0, 'credito');
		$saldo	=	$credito - $debito;
		if ($saldo > 0)
		{
			$saldo	=	'<font color="blue">'.number_format($saldo, 2, ',', '.').' C</font>';
		}
		elseif ($saldo < 0)
		{
			$saldo	=	'<font color="red">'.number_format(($saldo * -1), 2, ',', '.').' D</font>';
		}
		$tpl->assign('saldo', $saldo);
	}
	else
	{
		$msg	=	'Erro ao obter crédito total.';
	}
}
else
{
	$msg	=	'Erro ao obter débito total.';
}

//////////////////////////////////////////////////////////////////////////////////////
// NOME DO CLIENTE ///////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
if ($result = mysql_query("SELECT clientes.nome FROM clientes WHERE clientes.id =  '$id_cliente' LIMIT 1 "))
{
	$cliente	=	mysql_result($result, 0, 'nome');
	$tpl->assign('cliente', $cliente);
}
else
{
	$msg	=	'Erro ao obter nome do cliente.';
}

//////////////////////////////////////////////////////////////////////////////////////
// LISTA /////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
if ($result = mysql_query("SELECT vendas1.id, vendas1.datahora FROM vendas1 WHERE vendas1.id_cliente =  '$id_cliente' ORDER BY vendas1.datahora DESC limit 50 "))
{
	if (mysql_num_rows($result))
	{
		for ($i = 0; $i < mysql_num_rows($result); $i++)
		{
			$id_venda	=	mysql_result($result, $i, 'id');
			$data	=	mysql_result($result, $i, 'datahora');
			$linhas	.=	'	<tr>
		<td colspan="5" class="lista_cabecalho"><strong>&raquo;
		'.formata_data_hora($data).' &laquo;</strong></td>
	</tr>
';
			$result2	=	mysql_query("SELECT vendas2.codigo, vendas2.descricao, vendas2.unitario, vendas2.qtde, vendas2.subtotal FROM vendas2 WHERE vendas2.id_venda =  '$id_venda' ORDER BY vendas2.id ASC ");
			for ($j = 0; $j < mysql_num_rows($result2); $j++)
			{
				$codigo	=	mysql_result($result2, $j, 'codigo');
				$descricao	=	mysql_result($result2, $j, 'descricao');
				$unitario	=	mysql_result($result2, $j, 'unitario');
				$qtde	=	mysql_result($result2, $j, 'qtde');
				$subtotal	=	mysql_result($result2, $j, 'subtotal');
				$linhas	.=	'	<tr>
		<td class="lista_linhas">'.$codigo.'</td>
		<td class="lista_linhas">'.$descricao.'</td>
		<td class="lista_linhas" align="right">'.number_format($qtde, 2, ',', '.').'</td>
		<td class="lista_linhas" align="right">'.number_format($unitario, 2, ',', '.').'</td>
		<td class="lista_linhas" align="right">'.number_format($subtotal, 2, ',', '.').'</td>
	</tr>
				';
			}
		}
	}
	else
	{
		$msg	=	'Nenhum registro localizado.';
	}
}
else
{
	$msg	=	'Erro ao obter registros!';
}
$tpl->assign('linhas', $linhas);

//////////////////////////////////////////////////////////////////////////////////////

$tpl->assign( 'body', $body );
$tpl->assign( 'msg', $msg );

/************************************************************************************/

$tpl->assign( 'conteudo', 'clientes_historico.html' );
$tpl->display( 'layout.html' );
?>