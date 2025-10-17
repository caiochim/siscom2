<?php	session_start();
	include( '../config.php' );
	valida();
	$tpl->assign( 'menu', gera_menu( $_SESSION['user_id'] ) );

	/************************************************************************************/
	$msg	=	$_SESSION['msg'];
	$_SESSION['msg']	=	false;

	//////////////////////////////////////////////////////////////////////////////////////
	// ADICIONAR USUÁRIO /////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $_POST['adicionar'] )
	{
		header( 'Location: usuarios_adicionar.php' );
	}

	//////////////////////////////////////////////////////////////////////////////////////
	// Lista usuários ////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $result = mysql_query( "Select usuarios.id, usuarios.nome, usuarios.`user` From usuarios Order By usuarios.nome Asc" ) )
	{
		for ( $i = 0; $i < mysql_num_rows( $result ); $i++ )
		{
			$id_user	=	mysql_result( $result, $i, 'id' );
			$nome		=	mysql_result( $result, $i, 'nome' );
			$user		=	mysql_result( $result, $i, 'user' );
			
			$linhas	.=	'      <tr>
        <td align="right" class="lista_linhas">' . ( $i + 1 ) . '</td>
        <td class="lista_linhas"><a href="usuarios_editar.php?id_user=' . $id_user . '" class="lista_link">' . $nome . '</a></td>
        <td class="lista_linhas"><a href="usuarios_editar.php?id_user=' . $id_user . '" class="lista_link">' . $user . '</a></td>
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

	$tpl->assign( 'conteudo', 'usuarios.html' );
	$tpl->display( 'layout.html' );
?>