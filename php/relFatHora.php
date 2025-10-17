<?php
session_start();
include( '../config.php' );
valida();
$tpl->assign( 'menu', gera_menu( $_SESSION['user_id'] ) );

/************************************************************************************/
// SELECT INICIO ///////////////////////////////////////////////////////////////////////
$tpl->assign( 'select_inicio', select_data( date( 'd' ), date( 'm' ), date( 'Y' ), 2008, 'inicio' ) );

// SELECT FIM ///////////////////////////////////////////////////////////////////////
$tpl->assign( 'select_fim', select_data( date( 'd' ), date( 'm' ), date( 'Y' ), 2008, 'fim' ) );

////////////////////////////////////////////////////////////////////////////////////////////////
// Gera Relatório //////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
if ( $_POST['gerar_relatorio'] )
{
	$inicio	=	$_POST['ano_inicio'] . '-' . $_POST['mes_inicio'] . '-' . $_POST['dia_inicio'];
	$fim	=	$_POST['ano_fim'] . '-' . $_POST['mes_fim'] . '-' . $_POST['dia_fim'];
	////////////////////////////////////////////////////////////////////////////////////////////
	// VENDA A VISTA ///////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////
	if ( $result = mysql_query( "SELECT hour(vendas1.datahora) AS hora, Sum(vendas1.total) AS subtotal FROM vendas1 WHERE date(vendas1.datahora) BETWEEN  '$inicio' AND '$fim' GROUP BY hour(vendas1.datahora) " ) )
	{
		if (mysql_num_rows($result) > 0)
		{
			for ($i = 0; $i < mysql_num_rows($result); $i++)
			{
				$hora		=	mysql_result($result, $i, 'hora');
				$subtotal	=	mysql_result($result, $i, 'subtotal');
				$linhas	.=	'<tr>
        <td align="right" class="lista_linhas">'.$hora.'</td>
        <td align="right" class="lista_linhas">'.number_format($subtotal, 2, ',', '.').'</td>
      </tr>';
			}
			$tpl->assign('linhas', $linhas);
		}
		else
		{
			$msg	=	'Nenhum registro para o período informado.';
		}
	}
	else
	{
		$msg	=	'Erro ao gerar relatório!';
	}


	$tpl->assign( 'inicio', formata_data( $inicio ) );
	$tpl->assign( 'fim', formata_data( $fim ) );
}
/************************************************************************************/

$tpl->assign( 'msg', $msg );

/************************************************************************************/

$tpl->assign( 'conteudo', 'relFatHora.html' );
$tpl->display( 'layout.html' );
?>