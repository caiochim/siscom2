<?php	session_start();
	include( '../config.php' );
	valida();
	$tpl->assign( 'menu', gera_menu( $_SESSION['user_id'] ) );

	/************************************************************************************/
$body	=	'onLoad="document.form1.descricao.focus()"';
	$id_produto	=	$_GET['id_produto'];

	//////////////////////////////////////////////////////////////////////////////////////
	// Cancelar //////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $_POST['cancelar'] )
	{
		header( 'Location: produtos.php' );
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
			if ( $result = mysql_query( "Select produtos.id From produtos Where produtos.codigo = '$codigo' AND produtos.id <> '$id_produto'" ) )
			{
				if ( mysql_num_rows( $result ) == 0 )
				{
					if ( $result = mysql_query( "update produtos set codigo='$codigo', descricao='$descricao', custo='$custo', venda='$venda', estoque='$estoque', id_fornecedor='$id_fornecedor', alterado=now() where (id='$id_produto')" ) )
					{
						$_SESSION['msg']	=	'Produto alterado com sucesso!';
						header( 'Location: produtos.php' );
					}
					else
					{
						$msg	=	'Erro ao salvar alterações!';
					}
				}
				else
				{
					$msg	=	'Um produto com este código já está cadastrado!';
				}
			}
			else
			{
				$msg	=	'Erro ao verificar o código do produto!';
			}
		}
	}
	else
	{
		if ( $result = mysql_query( "Select produtos.codigo, produtos.descricao, produtos.custo, produtos.venda, produtos.estoque, produtos.id_fornecedor From produtos Where produtos.id = '$id_produto'" ) )
		{
			$codigo			=	mysql_result( $result, 0, 'codigo' );
			$descricao		=	mysql_result( $result, 0, 'descricao' );
			$custo			=	mysql_result( $result, 0, 'custo' );
			$venda			=	mysql_result( $result, 0, 'venda' );
			$estoque		=	mysql_result( $result, 0, 'estoque' );
			$id_fornecedor	=	mysql_result( $result, 0, 'id_fornecedor' );
		}
		else
		{
			$msg	=	'Erro ao recuperar dados do produto!';
		}
	}

	//////////////////////////////////////////////////////////////////////////////////////
	// Incluído/Alterado /////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $result = mysql_query( "Select produtos.incluido, produtos.alterado From produtos Where produtos.id = '$id_produto'" ) )
	{
		$tpl->assign( 'incluido', formata_data( mysql_result( $result, 0, 'incluido' ) ) );
		$tpl->assign( 'alterado', formata_data( mysql_result( $result, 0, 'alterado' ) ) );
	}
	else
	{
		$msg	=	'Erro ao recuperar dados de inclusão/alteração!';
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

	$tpl->assign( 'conteudo', 'produtos_editar.html' );
	$tpl->display( 'layout.html' );
?>