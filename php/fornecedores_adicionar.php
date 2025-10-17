<?php	session_start();
	include( '../config.php' );
	valida();
	$tpl->assign( 'menu', gera_menu( $_SESSION['user_id'] ) );

	/************************************************************************************/
$body	=	'onLoad="document.form1.fornecedor.focus()"';

	//////////////////////////////////////////////////////////////////////////////////////
	// Cancelar //////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $_POST['cancelar'] )
	{
		header( 'Location: fornecedores.php' );
	}

	//////////////////////////////////////////////////////////////////////////////////////
	// Salvar ////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $_POST['salvar'] )
	{
		$fornecedor	=	addslashes( strtoupper( trim( $_POST['fornecedor'] ) ) );

		if ( !$fornecedor )
		{
			$msg	=	'Informe o nome/razão social!';
		}
		else
		{
			if ( mysql_query( "insert into fornecedores (id, fornecedor, incluido, alterado) VALUES (null, '$fornecedor', now(), now())" ) )
			{
				$_SESSION['msg']	=	'Fornecedor adicionado com sucesso!';
				header( 'Location: fornecedores.php' );
			}
			else
			{
				$msg	=	'Ocorreu um erro ao adicionar o fornecedor!<br />Certifique-se que este fornecedor ainda não está cadastrado.';
			}
		}
		
		$tpl->assign( 'fornecedor', $fornecedor );
	}

	//////////////////////////////////////////////////////////////////////////////////////
	
	$tpl->assign( 'body', $body );
	$tpl->assign( 'msg', $msg );

	/************************************************************************************/

	$tpl->assign( 'conteudo', 'fornecedores_adicionar.html' );
	$tpl->display( 'layout.html' );
?>