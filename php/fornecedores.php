<?php	session_start();
	include( '../config.php' );
	valida();
	$tpl->assign( 'menu', gera_menu( $_SESSION['user_id'] ) );

	/************************************************************************************/
$msg	=	$_SESSION['msg'];
	$_SESSION['msg']	=	false;

	//////////////////////////////////////////////////////////////////////////////////////
	// Adicionar fornecedor //////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $_POST['adicionar'] )
	{
		header( 'Location: fornecedores_adicionar.php' );
	}

	//////////////////////////////////////////////////////////////////////////////////////
	// Lista fornecedores ////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $result = mysql_query( "Select fornecedores.id, fornecedores.fornecedor From fornecedores Order By fornecedores.fornecedor Asc" ) )
	{
		for ( $i = 0; $i < mysql_num_rows( $result ); $i++ )
		{
			$id_fornecedor	=	mysql_result( $result, $i, 'id' );
			$fornecedor		=	mysql_result( $result, $i, 'fornecedor' );
			
			$linhas	.=	'      <tr>
        <td align="right" class="lista_linhas">' . ( $i + 1 ) . '</td>
        <td class="lista_linhas"><a href="fornecedores_editar.php?id_fornecedor=' . $id_fornecedor . '" class="lista_link">' . $fornecedor . '</a></td>
      </tr>
';
		}
		
		$tpl->assign( 'linhas', $linhas );
		
		$tpl->assign( 'total', mysql_num_rows( $result ) );
	}
	else
	{
		$msg	=	'Ocorreu um erro ao listar os fornecedores!';
	}

	//////////////////////////////////////////////////////////////////////////////////////
	
	$tpl->assign( 'msg', $msg );

	/************************************************************************************/

	$tpl->assign( 'conteudo', 'fornecedores.html' );
	$tpl->display( 'layout.html' );
?>