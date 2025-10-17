<?php	session_start();
	include( '../config.php' );
	valida();
	$tpl->assign( 'menu', gera_menu( $_SESSION['user_id'] ) );

	/************************************************************************************/
	$body		=	'onLoad="document.form1.nome.focus()"';
	$user_id	=	$_GET['id_user'];
	
	//////////////////////////////////////////////////////////////////////////////////////
	// Cancelar //////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $_POST['cancelar'] )
	{
		header( 'Location: usuarios.php' );
	}

	//////////////////////////////////////////////////////////////////////////////////////
	// Salvar ////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $_POST['salvar'] )
	{
		$nome	=	strtoupper( trim( $_POST['nome'] ) );
		$user	=	strtolower( trim( $_POST['user'] ) );
		$senha1	=	$_POST['senha1'];
		$senha2	=	$_POST['senha2'];

		if ( !$nome )
		{
			$msg	=	'Informe o nome do usuário!';
		}
		elseif ( !$user )
		{
			$msg	=	'Informe o login do usuário!';
			$body	=	'onLoad="document.form1.user.focus()"';
		}
		elseif ( !$senha1 )
		{
			$msg	=	'Informe a senha!';
			$body	=	'onLoad="document.form1.senha1.focus()"';
		}
		elseif ( !$senha2 )
		{
			$msg	=	'Redigite a senha!';
			$body	=	'onLoad="document.form1.senha2.focus()"';
		}
		elseif ( $senha1 !== $senha2 )
		{
			$msg	=	'As senhas digitadas são diferentes!';
			$body	=	'onLoad="document.form1.senha1.focus()"';
		}
		else
		{
			if ( mysql_query( "insert into usuarios (nome, `user`, pass, home) VALUES ('$nome', '$user', encode('$senha1',''), '4')" ) )
			{
				if ( $result = mysql_query( "Select usuarios.id From usuarios Order By usuarios.id Desc Limit 1" ) )
				{
					$id_user	=	mysql_result( $result, 0, 'id' );
					
					if ( mysql_query( "insert into permissoes (id_user, id_area) VALUES ('$id_user', '4')" ) )
					{
						$_SESSION['msg']	=	'Usuário cadastrado com sucesso!<br />Defina as permissões de acesso do usuário ao sistema.';
						header( 'Location: usuarios_editar.php?id_user=' . $id_user );
					}
					else
					{
						$msg	=	'Erro ao definir permissões do usuário!';
					}
				}
				else
				{
					$msg	=	'Erro ao obter o ID do novo usuário!';
				}
			}
			else
			{
				$msg	=	'Erro ao cadastrar usuário!';
			}
		}
		
		$tpl->assign( 'nome', $nome );
		$tpl->assign( 'user', $user );
		$tpl->assign( 'senha1', $senha1 );
		$tpl->assign( 'senha2', $senha2 );
	}

	//////////////////////////////////////////////////////////////////////////////////////
	
	$tpl->assign( 'body', $body );
	$tpl->assign( 'msg', $msg );

	/************************************************************************************/

	$tpl->assign( 'conteudo', 'usuarios_adicionar.html' );
	$tpl->display( 'layout.html' );
?>