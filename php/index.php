<?php
	session_start();
	include( '../config.php' );

	/************************************************************************************/
	//////////////////////////////////////////////////////////////////////////////////////
	// Verifica se a session jс estс aberta //////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $_SESSION['id_session'] === session_id() ) {
		header( 'Location: ' . $_SESSION['user_home'] );
	}
	//////////////////////////////////////////////////////////////////////////////////////
	$body	=	'onLoad="document.form1.user.focus()"';
	//////////////////////////////////////////////////////////////////////////////////////
	// Autenticaчуo //////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ($_POST['entrar'] )	{
		$user	=	$_POST['user'];
		$pass	=	$_POST['pass'];
		if ( !$user ) {
			$msg	=	'Informe o usuсrio!';
		} elseif ( !$pass ) {
			$body	=	'onLoad="document.form1.pass.focus()"';
			$msg	=	'Informe a senha!';
		} else {
			if ($result = mysql_query("Select 
											usuarios.id, 
											usuarios.nome, 
											usuarios.`user`, 
											areas.arquivo 
										From 
											usuarios, 
											areas 
										Where 
											usuarios.`user` = '$user' AND 
											usuarios.pass = encode('$pass','') AND 
											usuarios.home = areas.id"))	{
				if (mysql_num_rows($result) == 1 ) {
					$_SESSION['user_id']	=	mysql_result( $result, 0, 'id' );
					$_SESSION['user_nome']	=	mysql_result( $result, 0, 'nome' );
					$_SESSION['user_user']	=	mysql_result( $result, 0, 'user' );
					$_SESSION['user_home']	=	mysql_result( $result, 0, 'arquivo' );
					$_SESSION['id_session']	=	session_id();

					header( 'Location: ' . $_SESSION['user_home'] );
				} else {
					$msg	=	'Usuсrio ou senha invсlido!';
				}
			} else {
				$msg	=	'Erro ao autenticar usuсrio!';
			}
		}
		$tpl->assign( 'user', $user );
	}

	//////////////////////////////////////////////////////////////////////////////////////
	$tpl->assign( 'msg', $msg );
	$tpl->assign( 'body', $body );
	/************************************************************************************/

	$tpl->assign( 'conteudo', 'index.html' );
	$tpl->display( 'layout.html' );
?>