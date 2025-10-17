<?php	session_start();
	include( '../config.php' );
	valida();
	$tpl->assign( 'menu', gera_menu( $_SESSION['user_id'] ) );

	/************************************************************************************/
$body			=	'onLoad="document.form1.fornecedor.focus()"';
	$id_fornecedor	=	$_GET['id_fornecedor'];

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
			if ( mysql_query( "update fornecedores set fornecedor='$fornecedor', alterado=now() where (id='$id_fornecedor')" ) )
			{
				$_SESSION['msg']	=	'Fornecedor alterado com sucesso!';
				header( 'Location: fornecedores.php' );
			}
			else
			{
				$msg	=	'Ocorreu um erro ao alterar dados!<br />Certifique-se que o nome do fornecedor não ficou duplicado.';
			}
		}
		
		$tpl->assign( 'nome', $nome );
	}

	//////////////////////////////////////////////////////////////////////////////////////
	// Dados para o form /////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $result = mysql_query( "Select fornecedores.fornecedor, fornecedores.incluido, fornecedores.alterado From fornecedores Where fornecedores.id = '$id_fornecedor'" ) )
	{
		$tpl->assign( 'fornecedor', mysql_result( $result, 0, 'fornecedor' ) );
		$tpl->assign( 'incluido', mysql_result( $result, 0, 'incluido' ) );
		$tpl->assign( 'alterado', mysql_result( $result, 0, 'alterado' ) );
	}
	else
	{
		$msg	=	'Ocorreu um erro ao recuperar dados!';
	}

	//////////////////////////////////////////////////////////////////////////////////////
	
	$tpl->assign( 'body', $body );
	$tpl->assign( 'msg', $msg );

	/************************************************************************************/

	$tpl->assign( 'conteudo', 'fornecedores_editar.html' );
	$tpl->display( 'layout.html' );
?>