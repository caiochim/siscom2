<?php	session_start();
	include( '../config.php' );
	valida();
	$tpl->assign( 'menu', gera_menu( $_SESSION['user_id'] ) );

	/************************************************************************************/
	$msg	=	$_SESSION['msg'];
	$_SESSION['msg']	=	false;

	//////////////////////////////////////////////////////////////////////////////////////
	// ADICIONAR CLIENTE /////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $_POST['adicionar'] )
	{
		header( 'Location: clientes_adicionar.php' );
	}

	//////////////////////////////////////////////////////////////////////////////////////
	// LISTA CLIENTES ////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $result = mysql_query( "Select clientes.id, clientes.`status`, clientes.nome From clientes Order By clientes.nome Asc" ) )
	{
		for ( $i = 0; $i < mysql_num_rows( $result ); $i++ )
		{
			$id_cliente	=	mysql_result( $result, $i, 'id' );
			$status		=	mysql_result( $result, $i, 'status' );
			$nome		=	mysql_result( $result, $i, 'nome' );
			
			if ( $status == 'A' ) $status = 'ATIVO'; elseif ( $status == 'I' ) $status = 'INATIVO';
			
			$linhas	.=	'      <tr>
        <td align="right" class="lista_linhas">' . ( $i + 1 ) . '</td>
        <td class="lista_linhas"><a href="clientes_editar.php?id_cliente=' . $id_cliente . '" class="lista_link">' . $nome . '</a></td>
        <td class="lista_linhas">' . $status . '</td>
      </tr>
';
		}
		
		$tpl->assign( 'linhas', $linhas );
		
		$tpl->assign( 'total', mysql_num_rows( $result ) );
	}
	else
	{
		$msg	=	'Ocorreu um erro ao listar clientes!';
	}

	//////////////////////////////////////////////////////////////////////////////////////
	
	$tpl->assign( 'msg', $msg );

	/************************************************************************************/

	$tpl->assign( 'conteudo', 'clientes.html' );
	$tpl->display( 'layout.html' );
?>