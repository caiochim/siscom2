<?php	session_start();
	include( '../config.php' );
	valida();
	$tpl->assign( 'menu', gera_menu( $_SESSION['user_id'] ) );

	/************************************************************************************/
	$body		=	'onLoad="document.form1.senha1.focus()"';
	$user_id	=	$_SESSION['id_user_senha'];
	
	//////////////////////////////////////////////////////////////////////////////////////
	// Cancelar //////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $_POST['cancelar'] )
	{
		header( 'Location: usuarios_editar.php?id_user=' . $user_id );
	}

	//////////////////////////////////////////////////////////////////////////////////////
	// Salvar ////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $_POST['salvar'] )
	{
		$senha1	=	$_POST['senha1'];
		$senha2	=	$_POST['senha2'];
		
		if ( !$senha1 )
		{
			$msg	=	'Informe a senha!';
		}
		elseif ( !$senha2 )
		{
			$msg	=	'Repita a senha!';
			$body	=	'onLoad="document.form1.senha2.focus()"';
		}
		elseif ( $senha1 != $senha2 )
		{
			$msg	=	'As senhas digitadas são diferentes!';
		}
		else
		{
			if ( mysql_query( "update usuarios set pass=encode('$senha1','') where (id='$user_id')" ) )
			{
				$_SESSION['msg']			=	'Senha alterada com sucesso!';
				$_SESSION['id_user_senha']	=	false;
				header( 'Location: usuarios_editar.php?id_user=' . $user_id );
			}
			else
			{
				$msg	=	'Erro ao alterar a senha!';
			}
		}
		
		$tpl->assign( 'senha1', $senha1 );
		$tpl->assign( 'senha2', $senha2 );
	}

	//////////////////////////////////////////////////////////////////////////////////////
	// Dados para o form /////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $result = mysql_query( "Select usuarios.nome, usuarios.`user` From usuarios Where usuarios.id = '$user_id'" ) )
	{
		$tpl->assign( 'nome', mysql_result( $result, 0, 'nome' ) );
		$tpl->assign( 'user', mysql_result( $result, 0, 'user' ) );
	}
	else
	{
		$msg	=	'Ocorreu um erro ao recuperar dados!';
	}
	
	
	//////////////////////////////////////////////////////////////////////////////////////
	
	$tpl->assign( 'body', $body );
	$tpl->assign( 'msg', $msg );

	/************************************************************************************/

	$tpl->assign( 'conteudo', 'usuarios_senha.html' );
	$tpl->display( 'layout.html' );
?>