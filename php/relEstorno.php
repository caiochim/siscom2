<?php
session_start();
include( '../config.php' );
valida();
$tpl->assign( 'menu', gera_menu( $_SESSION['user_id'] ) );

/************************************************************************************/
// Select Data ///////////////////////////////////////////////////////////////////////
$tpl->assign( 'select_data', select_data( date( 'd' ), date( 'm' ), date( 'Y' ), 2008) );

/*************************************************************************************************/
/*************************************************************************************************/
/*************************************************************************************************/
if ( $_POST['gerar_relatorio'] )
{
	$ano	=	$_POST['ano'];
	$mes	=	$_POST['mes'];
	$dia	=	$_POST['dia'];
	$data	=	$dia . '/' . $mes . '/' . $ano;
	$dataq	=	$ano.'-'.$mes.'-'.$dia;
	$tpl->assign( 'data', $data );
	if ($result = mysql_query("SELECT usuarios.nome, Sum(estorno.subtotal) AS subtotal FROM estorno , usuarios WHERE estorno.id_user =  usuarios.id AND estorno.datahora LIKE  '$dataq%' GROUP BY usuarios.`user` "))
	{
		if (mysql_num_rows($result) > 0)
		{
			for ($i = 0; $i < mysql_num_rows($result); $i++)
			{
				$nome	=	mysql_result($result, $i, 'nome');
				$subtotal	=	mysql_result($result, $i, 'subtotal');
				$total	=	($total + $subtotal);
				$linhas	.=	'<tr>
        <td class="lista_linhas">'.$nome.'</td>
        <td align="right" class="lista_linhas">'.number_format($subtotal, 2, ',', '.').'</td>
      </tr>';
			}
			$tpl->assign('linhas', $linhas);
			$tpl->assign('total', number_format($total, 2, ',', '.'));
		}
		else
		{
			$msg	=	'Nenhum registro encontrado para a data informada.';
		}
	}
	else
	{
		$msg	=	'Erro ao consultar banco de dados.';
	}
}


/************************************************************************************/

$tpl->assign( 'msg', $msg );

/************************************************************************************/

$tpl->assign( 'conteudo', 'relEstorno.html' );
$tpl->display( 'layout.html' );
?>