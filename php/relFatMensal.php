<?php
	session_start();
	include( '../config.php' );
	valida();
	$tpl->assign( 'menu', gera_menu( $_SESSION['user_id'] ) );

	/************************************************************************************/
	// Select Mes inicial ///////////////////////////////////////////////////////////////////////
	$tpl->assign( 'select_inicio', select_mesAno( date( 'm' ), date( 'Y' ), 2008, 'inicio' ) );
	
	// Select Mes final ///////////////////////////////////////////////////////////////////////
	$tpl->assign( 'select_fim', select_mesAno( date( 'm' ), date( 'Y' ), 2008, 'fim' ) );
	
	// Gera Relatório ///////////////////////////////////////////////////////////////////////
	if ( $_POST['gerar_relatorio'] )
	{
		$ano_inicio	=	$_POST['ano_inicio'];
		$mes_inicio	=	$_POST['mes_inicio'];
		$ano_fim	=	$_POST['ano_fim'];
		$mes_fim	=	$_POST['mes_fim'];
		
		if ( $result = mysql_query( "Select Month(vendas1.datahora) AS mes, Year(vendas1.datahora) AS ano, Sum(vendas1.total) AS total From vendas1 Where vendas1.datahora Between '$ano_inicio-$mes_inicio-01 00:00:00' AND '$ano_fim-$mes_fim-31 23:59:59' Group By Year(vendas1.datahora), Month(vendas1.datahora) Order By vendas1.datahora Desc" ) )
		{
			for ( $i = 0; $i < mysql_num_rows( $result ); $i++ )
			{
				$mes	=	mysql_result( $result, $i, 'mes' );
				$ano	=	mysql_result( $result, $i, 'ano' );
				$total	=	number_format( mysql_result( $result, $i, 'total' ), 2, ',', '.' );
				
				if ( count( $mes ) < 2 ) { $mes = 0 . $mes; }
				
				$linhas	.=	'      <tr>
        <td align="right" class="lista_linhas">' . $mes . '/' . $ano . '</td>
        <td align="right" class="lista_linhas">R$' . $total . '</td>
      </tr>
';
			}
			
			$tpl->assign( 'linhas', $linhas );
		}
		else
		{
			$msg	=	'Erro ao gerar relatório!';
		}
	}
	
	/************************************************************************************/

	$tpl->assign( 'msg', $msg );

	/************************************************************************************/

	$tpl->assign( 'conteudo', 'relFatMensal.html' );
	$tpl->display( 'layout.html' );
?>