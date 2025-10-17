<?php	session_start();
	include( '../config.php' );
	valida();

	/************************************************************************************/
	$body	=	'onLoad="document.form1.codigo.focus()"';
	
//	$esc	=	$_GET['esc'];
//
	if ( $_POST['concluir_venda'] ) { header( 'Location: pre2.php' ); }
//	
//	if ( $_SESSION['codp'] ) { $tpl->assign( 'codigo', $_SESSION['codp'] ); $_SESSION['codp'] = false; }
//	
//	//////////////////////////////////////////////////////////////////////////////////////
//	// Cancela a venda ///////////////////////////////////////////////////////////////////
//	//////////////////////////////////////////////////////////////////////////////////////
//	if ( $esc )
//	{
//		if ( mysql_query( "delete from vendas2 where (id_venda='0')" ) )
//		{
//			header( 'Location: ' . $_SESSION['user_home'] );
//		}
//		else
//		{
//			$msg	=	'Erro ao processar cancelamento da venda!';
//		}
//	}
//
	//////////////////////////////////////////////////////////////////////////////////////
	// Adiciona produtos /////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $_POST['adicionar_produto'] )
	{
		$codigo	=	$_POST['codigo'];
		$qtde	=	str_replace( ',', '.', str_replace( '.', '', trim( $_POST['qtde'] ) ) );
		
		if ( $result = mysql_query( "Select produtos.codigo, produtos.descricao, produtos.venda From produtos Where produtos.codigo = '$codigo'" ) )
		{
			if ( mysql_num_rows( $result ) == 1 )
			{
				$descricao	=	mysql_result( $result, 0, 'descricao' );
				$venda		=	mysql_result( $result, 0, 'venda' );
				$subtotal_item	=	( $qtde * $venda );
				
				$tpl->assign( 'preco_unitario', number_format( $venda, 2, ',', '.' ) );
				$tpl->assign( 'descricao', $descricao );
				
				if ( mysql_query( "insert into atendimento (cartao, codigo, descricao, unitario, qtde, subtotal) VALUES ('$cartao', '$codigo', '$descricao', '$venda', '$qtde', '$subtotal_item')" ) )
				{
					$tpl->assign( 'preco_unitario', number_format( $venda, 2, ',', '.' ) );
					$tpl->assign( 'descricao', $descricao );
				}
				else
				{
					$descricao	=	'ERRO AO REGISTRAR A VENDA DO ÍTEM!';
				}
			}
			else
			{
				$descricao	=	'PRODUTO NÃO CADASTRADO!';
			}
		}
		else
		{
			$descricao	=	'ERRO AO PROCURAR CÓDIGO NO BANCO DE DADOS!';
		}
	}

//	//////////////////////////////////////////////////////////////////////////////////////
//	// Cancelar ítens ////////////////////////////////////////////////////////////////////
//	//////////////////////////////////////////////////////////////////////////////////////
//	if ( $_POST['cancela_item'] )
//	{
//		$id_item	=	$_POST['id_item'];
//		
//		if ( count( $id_item ) > 0 )
//		{
//			for( $i = 0; $i < count( $id_item ); $i++ )
//			{
//				if ( mysql_query( "delete from vendas2 where (id='$id_item[$i]')" ) )
//				{
//					$descricao	=	'ÍTENS CANCELADOS COM SUCESSO!';
//				}
//				else
//				{
//					$descricao	=	'ERRO AO CANCELAR ÍTEM!';
//				}
//			}
//		}
//		else
//		{
//			$descricao	=	'NENHUM ÍTEM SELECIONADO PARA CANCELAMENTO!';
//		}
//	}
//	
//	//////////////////////////////////////////////////////////////////////////////////////
//	// Lista produtos ////////////////////////////////////////////////////////////////////
//	//////////////////////////////////////////////////////////////////////////////////////
//	if ( $result = mysql_query( "Select vendas2.id, vendas2.codigo, vendas2.descricao, vendas2.unitario, vendas2.qtde, vendas2.subtotal From vendas2 Where vendas2.id_venda = '0' Order By vendas2.id Asc" ) )
//	{
//		for ( $i = 0; $i < mysql_num_rows( $result ); $i++ )
//		{
//			$lista	.=	'                <tr>
//					  <td class="linhas"><input name="id_item[]" type="checkbox" id="id_item[]" value="' . mysql_result( $result, $i, 'id' ) . '"></td>
//					  <td class="linhas">' . mysql_result( $result, $i, 'codigo' ) . '</td>
//					  <td class="linhas">' . mysql_result( $result, $i, 'descricao' ) . '</td>
//					  <td align="right" class="linhas">' . number_format( mysql_result( $result, $i, 'unitario' ), 2, ',', '.' ) . '</td>
//					  <td align="right" class="linhas">' . number_format( mysql_result( $result, $i, 'qtde' ), 2, ',', '.' ) . '</td>
//					  <td align="right" class="linhas">' . number_format( mysql_result( $result, $i, 'subtotal' ), 2, ',', '.' ) . '</td>
//					</tr>
//	';
//		}
//		$tpl->assign( 'lista', $lista );
//	}
//	else
//	{
//		$descricao	=	'ERRO AO GERAR LISTA DE PRODUTOS VENDIDOS!';
//	}
//	
//	//////////////////////////////////////////////////////////////////////////////////////
//	// Subtotal //////////////////////////////////////////////////////////////////////////
//	//////////////////////////////////////////////////////////////////////////////////////
//	if ( $result = mysql_query( "Select Sum(vendas2.subtotal) AS total From vendas2 Where vendas2.id_venda = '0'" ) )
//	{
//		$tpl->assign( 'subtotal', number_format( mysql_result( $result, 0, 'total' ), 2, ',', '.' ) );
//	}
//	else
//	{
//		$descricao	=	'ERRO AO OBTER O SUBTOTAL!';
//	}
//
//	//////////////////////////////////////////////////////////////////////////////////////
	$tpl->assign( 'descricao', $descricao );
	$tpl->assign( 'body', $body );

	/************************************************************************************/

	$tpl->assign( 'conteudo', 'pre.html' );
	$tpl->display( 'pre_layout.html' );
?>