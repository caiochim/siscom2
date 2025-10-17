<?php	session_start();
	include( '../config.php' );
	valida();
	$tpl->assign( 'menu', gera_menu( $_SESSION['user_id'] ) );

	/************************************************************************************/
$body	=	'onLoad="document.form1.codigo.focus()"';

	//////////////////////////////////////////////////////////////////////////////////////
	// Cancelar //////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $_POST['cancelar'] )
	{
		header( 'Location: produtos.php' );
	}

	//////////////////////////////////////////////////////////////////////////////////////
	// Sugerir Código ////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $_POST['sugere_codigo'] )
	{
		$codigo			=	time();
		$descricao		=	addslashes( strtoupper( trim( $_POST['descricao'] ) ) );
		$custo			=	str_replace( ',', '.', str_replace( '.', '', trim( $_POST['custo'] ) ) );
		$venda			=	str_replace( ',', '.', str_replace( '.', '', trim( $_POST['venda'] ) ) );
		$estoque		=	str_replace( ',', '.', str_replace( '.', '', trim( $_POST['estoque'] ) ) );
		$id_fornecedor	=	$_POST['id_fornecedor'];
	}

	//////////////////////////////////////////////////////////////////////////////////////
	// Salvar ////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $_POST['salvar'] )
	{
		$codigo			=	strtoupper( trim( $_POST['codigo'] ) );
		$descricao		=	addslashes( strtoupper( trim( $_POST['descricao'] ) ) );
		$custo			=	str_replace( ',', '.', str_replace( '.', '', trim( $_POST['custo'] ) ) );
		$venda			=	str_replace( ',', '.', str_replace( '.', '', trim( $_POST['venda'] ) ) );
		$estoque		=	str_replace( ',', '.', str_replace( '.', '', trim( $_POST['estoque'] ) ) );
		$id_fornecedor	=	$_POST['id_fornecedor'];

		if ( !$codigo )
		{
			$msg	=	'Informe o código do produto!';
		}
		elseif ( !$descricao )
		{
			$msg	=	'Informe a descrição do produto!';
			$body	=	'onLoad="document.form1.descricao.focus()"';
		}
		elseif ( $venda <= 0 )
		{
			$msg	=	'Preço de venda deve ser maior que zero!';
			$body	=	'onLoad="document.form1.venda.focus()"';
		}
		else
		{
			if ( mysql_query( "insert into produtos (codigo, descricao, custo, venda, estoque, id_fornecedor, incluido, alterado) VALUES ('$codigo', '$descricao', '$custo', '$venda', '$estoque', '$id_fornecedor', now(), now())" ) )
			{
				$_SESSION['msg']	=	'Produto adicionado com sucesso!';
				header( 'Location: produtos.php' );
			}
			else
			{
				$msg	=	'Ocorreu um erro ao adicionar o produto!<br />Certifique-se que um produto com este código ainda não está cadastrado.';
			}
		}
	}

	//////////////////////////////////////////////////////////////////////////////////////
	// Fornecedores //////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $result = mysql_query( "Select fornecedores.id, fornecedores.fornecedor From fornecedores Order By fornecedores.fornecedor Asc" ) )
	{
		for ( $i = 0; $i < mysql_num_rows( $result ); $i++ )
		{
			$l_id_fornecedor	=	mysql_result( $result, $i, 'id' );
			$l_fornecedor		=	mysql_result( $result, $i, 'fornecedor' );
			
			if ( $id_fornecedor == $l_id_fornecedor ) { $a = ' selected="selected"'; } else { $a = ''; }
			
			$fornecedores	.=	'            <option value="' . $l_id_fornecedor . '"' . $a . '>' . $l_fornecedor . '</option>
';
		}
		$tpl->assign( 'fornecedores', $fornecedores );
	}
	else
	{
		$msg	=	'Erro gerando lista de fornecedores!';
	}
	
	//////////////////////////////////////////////////////////////////////////////////////

	$tpl->assign( 'codigo', $codigo );
	$tpl->assign( 'descricao', stripslashes( $descricao ) );
	$tpl->assign( 'custo', number_format( $custo, 4, ',', '.' ) );
	$tpl->assign( 'venda', number_format( $venda, 2, ',', '.' ) );
	$tpl->assign( 'estoque', number_format( $estoque, 2, ',', '.' ) );
	
	$tpl->assign( 'body', $body );
	$tpl->assign( 'msg', $msg );

	/************************************************************************************/

	$tpl->assign( 'conteudo', 'produtos_adicionar.html' );
	$tpl->display( 'layout.html' );
?>