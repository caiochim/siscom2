<?php	session_start();
	include( '../config.php' );
	valida();
	$tpl->assign( 'menu', gera_menu( $_SESSION['user_id'] ) );

	/************************************************************************************/
//	$msg	=	$_SESSION['msg'];
//	$_SESSION['msg']	=	false;
//	$body	=	'onLoad=document.form1.q.focus()';
//
//	//////////////////////////////////////////////////////////////////////////////////////
//	// Busca por código //////////////////////////////////////////////////////////////////
//	//////////////////////////////////////////////////////////////////////////////////////
//	if ( $_POST['q'] )
//	{
//		$q	=	$_POST['q'];
//
//		if ( $result = mysql_query( "Select produtos.id From produtos Where produtos.codigo = '$q'" ) )
//		{
//			if ( mysql_num_rows( $result ) == 1 )
//			{
//				$id_produto	=	mysql_result( $result, 0, 'id' );
//				header( 'Location: produtos_editar.php?id_produto=' . $id_produto );
//			}
//			else
//			{
//				$msg	=	'Produto não cadastrado!';
//			}
//		}
//		else
//		{
//			$msg	=	'Erro ao buscar produto pelo código!';
//		}
//	}
//
//	//////////////////////////////////////////////////////////////////////////////////////
//	// Adicionar fornecedor //////////////////////////////////////////////////////////////
//	//////////////////////////////////////////////////////////////////////////////////////
//	if ( $_POST['adicionar'] )
//	{
//		header( 'Location: produtos_adicionar.php' );
//	}
//
//	//////////////////////////////////////////////////////////////////////////////////////
//	// Lista fornecedores ////////////////////////////////////////////////////////////////
//	//////////////////////////////////////////////////////////////////////////////////////
//	if ( $result = mysql_query( "Select produtos.id, produtos.codigo, produtos.descricao From produtos Order By produtos.descricao Asc" ) )
//	{
//		for ( $i = 0; $i < mysql_num_rows( $result ); $i++ )
//		{
//			$id_produto	=	mysql_result( $result, $i, 'id' );
//			$codigo		=	mysql_result( $result, $i, 'codigo' );
//			$descricao	=	mysql_result( $result, $i, 'descricao' );
//			
//			$linhas	.=	'      <tr>
//        <td align="right" class="lista_linhas">' . ( $i + 1 ) . '</td>
//        <td class="lista_linhas"><a href="produtos_editar.php?id_produto=' . $id_produto . '" class="lista_link">' . $codigo . '</a></td>
//        <td class="lista_linhas"><a href="produtos_editar.php?id_produto=' . $id_produto . '" class="lista_link">' . $descricao . '</a></td>
//      </tr>
//';
//		}
//		
//		$tpl->assign( 'linhas', $linhas );
//		
//		$tpl->assign( 'total', mysql_num_rows( $result ) );
//	}
//	else
//	{
//		$msg	=	'Ocorreu um erro ao listar os produtos!';
//	}
//
//	//////////////////////////////////////////////////////////////////////////////////////
//	
//	$tpl->assign( 'msg', $msg );
//	$tpl->assign( 'body', $body );
//
	/************************************************************************************/

	$tpl->assign( 'conteudo', 'relatorios.html' );
	$tpl->display( 'layout.html' );
?>