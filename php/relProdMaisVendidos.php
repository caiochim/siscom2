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
	
	// Gera Relatório ///////////////////////////////////////////////////////////////////////
	if ( $_POST['gerar_relatorio'] )
	{
		$inicio	=	$_POST['ano_inicio'] . '-' . $_POST['mes_inicio'] . '-' . $_POST['dia_inicio'];
		$fim	=	$_POST['ano_fim'] . '-' . $_POST['mes_fim'] . '-' . $_POST['dia_fim'];
		$ordem		=	$_POST['ordem'];
		
		if ( $result = mysql_query( "Select vendas2.codigo, vendas2.descricao, Sum(vendas2.qtde) AS qtde, Sum(vendas2.subtotal) AS subtotal From vendas1 , vendas2 Where vendas1.id = vendas2.id_venda AND date(vendas1.datahora) Between '$inicio' AND '$fim' Group By vendas2.codigo, vendas2.descricao Order By $ordem Desc" ) )
		{
			for ( $i = 0; $i < mysql_num_rows( $result ); $i++ )
			{
				$n			=	( $i + 1 );
				$codigo		=	mysql_result( $result, $i, 'codigo' );
				$descricao	=	mysql_result( $result, $i, 'descricao' );
				$qtde		=	number_format( mysql_result( $result, $i, 'qtde' ), 2, ',', '.' );
				$subtotal	=	number_format( mysql_result( $result, $i, 'subtotal' ), 2, ',', '.' );
				
				if ( count( $mes ) < 2 ) { $mes = 0 . $mes; }
				
				$linhas	.=	'      <tr>
        <td align="right" class="lista_linhas">' . $n . '</td>
        <td class="lista_linhas">' . $codigo . '</td>
        <td class="lista_linhas">' . $descricao . '</td>
        <td align="right" class="lista_linhas">' . $qtde . '</td>
        <td align="right" class="lista_linhas">' . $subtotal . '</td>
      </tr>
';
			}
			
			$tpl->assign( 'linhas', $linhas );
			
			$tpl->assign( 'inicio', formata_data( $inicio ) );
			$tpl->assign( 'fim', formata_data( $fim ) );
		}
		else
		{
			$msg	=	'Erro ao gerar relatório!';
		}
	}
	
	/************************************************************************************/

	$tpl->assign( 'msg', $msg );

	/************************************************************************************/

	$tpl->assign( 'conteudo', 'relProdMaisVendidos.html' );
	$tpl->display( 'layout.html' );
?>