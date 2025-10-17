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
		if ( $result = mysql_query( "Select Sum(vendas1.total) AS avista From vendas1 Where vendas1.id_cliente = '0' AND date(vendas1.datahora) >= '$inicio' AND date(vendas1.datahora) <= '$fim'" ) )
		{
			$avista	=	mysql_result( $result, 0, 'avista' );
		}
		else
		{
			$msg	=	'Erro ao obter venda a vista!';
		}

		////////////////////////////////////////////////////////////////////////////////////////////
		// VENDA A PRAZO ///////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////
		if ( $result = mysql_query( "Select Sum(vendas1.total) AS aprazo From vendas1 Where vendas1.pago = 'N' AND date(vendas1.datahora) >= '$inicio' AND date(vendas1.datahora) <= '$fim'" ) )
		{
			$aprazo	=	mysql_result( $result, 0, 'aprazo' );
		}
		else
		{
			$msg	=	'Erro ao obter venda a prazo!';
		}

		////////////////////////////////////////////////////////////////////////////////////////////
		// RECEBIMENTO DE CONTAS ///////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////
		if ( $result = mysql_query( "Select Sum(vendas1.total) AS contas From vendas1 , vendas2 Where vendas1.id = vendas2.id_venda AND vendas2.codigo = '9999999999999' AND date(vendas1.datahora) >= '$inicio' AND date(vendas1.datahora) <= '$fim'" ) )
		{
			$contas	=	mysql_result( $result, 0, 'contas' );
		}
		else
		{
			$msg	=	'Erro ao obter recebimento de contas!';
		}
		
		$tpl->assign( 'avista', number_format( $avista, 2, ',', '.' ) );
		$tpl->assign( 'aprazo', number_format( $aprazo, 2, ',', '.' ) );
		$tpl->assign( 'contas', number_format( $contas, 2, ',', '.' ) );
	}
	
	$tpl->assign( 'inicio', formata_data( $inicio ) );
	$tpl->assign( 'fim', formata_data( $fim ) );
	
	/************************************************************************************/

	$tpl->assign( 'msg', $msg );

	/************************************************************************************/

	$tpl->assign( 'conteudo', 'relFatPeriodo.html' );
	$tpl->display( 'layout.html' );
?>