<?php	session_start();
	include( '../config.php' );
	valida();
	$tpl->assign( 'menu', gera_menu( $_SESSION['user_id'] ) );

	/************************************************************************************/
	$body	=	'onLoad="document.form1.id_fornecedor.focus()"';
	
	$dia	=	date( 'd' );
	$mes	=	date( 'm' );
	$ano	=	date( 'Y' );

	//////////////////////////////////////////////////////////////////////////////////////
	// Cancelar //////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $_POST['cancelar'] )
	{
		header( 'Location: entrada.php' );
	}

	//////////////////////////////////////////////////////////////////////////////////////
	// AVANÇAR ///////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $_POST['avancar'] )
	{
		$id_fornecedor	=	$_POST['id_fornecedor'];
		$nfnro			=	strtoupper( trim( $_POST['nfnro'] ) );
		$dia			=	$_POST['dia'];
		$mes			=	$_POST['mes'];
		$ano			=	$_POST['ano'];
		$total_nota		=	str_replace( ',', '.', str_replace( '.', '', trim( $_POST['total_nota'] ) ) );
		
		$data_emissao	=	$ano.'-'.$mes.'-'.$dia;

		if ( !$id_fornecedor )
		{
			$msg	=	'Selecione o fornecedor!';
		}
		elseif ( !$nfnro )
		{
			$msg	=	'Informe o número da nota fiscal!';
			$body	=	'onLoad="document.form1.nfnro.focus()"';
		}
		elseif ( !checkdate( $mes, $dia, $ano ) )
		{
			$msg	=	'Data inválida!';
			$body	=	'onLoad="document.form1.dia.focus()"';
		}
		elseif ( $total_nota <= 0 )
		{
			$msg	=	'Informe o valor total da nota!';
			$body	=	'onLoad="document.form1.total_nota.focus()"';
		}
		else
		{
			
			if ( mysql_query( "insert into entrada1 (id_fornecedor, nfnro, data_emissao, total_nota, data_lancamento) VALUES ('$id_fornecedor', '$nfnro', '$data_emissao', '$total_nota', now())" ) )
			{
				if ( $result = mysql_query( "Select entrada1.id From entrada1 Order By entrada1.id Desc Limit 1" ) )
				{
					$_SESSION['msg']	=	'Nota Fiscal cadastrada com sucesso!';

					$id_entrada	=	mysql_result( $result, 0, 'id' );
					header( 'Location: entrada2.php?id_entrada=' . $id_entrada );
				}
				else
				{
					$msg	=	'Erro ao obter código de entrada!';
				}
			}
			else
			{
				$msg	=	'Ocorreu um erro ao cadastrar a nota fiscal!';
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
	// SELECT DATA DE EMISSÃO ////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	$tpl->assign( 'data_emissao', select_data( $dia, $mes, $ano, 2008 ) );

	//////////////////////////////////////////////////////////////////////////////////////

	$tpl->assign( 'nfnro', $nfnro );
	$tpl->assign( 'total_nota', number_format( $total_nota, 2, ',', '.' ) );
	
	$tpl->assign( 'body', $body );
	$tpl->assign( 'msg', $msg );

	/************************************************************************************/

	$tpl->assign( 'conteudo', 'entrada_adicionar.html' );
	$tpl->display( 'layout.html' );
?>