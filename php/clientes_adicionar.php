<?php	session_start();
	include( '../config.php' );
	valida();
	$tpl->assign( 'menu', gera_menu( $_SESSION['user_id'] ) );

	/************************************************************************************/
	$body	=	'onLoad="document.form1.nome.focus()"';

	//////////////////////////////////////////////////////////////////////////////////////
	// CANCELAR //////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $_POST['cancelar'] )
	{
		header( 'Location: clientes.php' );
	}

	//////////////////////////////////////////////////////////////////////////////////////
	// SALVAR ////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $_POST['salvar'] )
	{
		$nome			=	addslashes( strtoupper( trim( $_POST['nome'] ) ) );
		$endereco		=	addslashes( strtoupper( trim( $_POST['endereco'] ) ) );
		$bairro			=	addslashes( strtoupper( trim( $_POST['bairro'] ) ) );
		$cidade			=	addslashes( strtoupper( trim( $_POST['cidade'] ) ) );
		$estado			=	$_POST['estado'];
		$cep			=	addslashes( strtoupper( trim( $_POST['cep'] ) ) );
		$ddd			=	addslashes( strtoupper( trim( $_POST['ddd'] ) ) );
		$fone			=	addslashes( strtoupper( trim( $_POST['fone'] ) ) );
		$observacoes	=	addslashes( strtoupper( trim( $_POST['observacoes'] ) ) );
		
		$telefone	=	$ddd . $fone;

		if ( !$nome )
		{
			$msg	=	'Informe o nome do cliente!';
		}
		else
		{
			if ( mysql_query( "insert into clientes (`status`, nome, endereco, bairro, cidade, estado, cep, telefone, observacoes) VALUES ('A', '$nome', '$endereco', '$bairro', '$cidade', '$estado', '$cep', '$telefone', '$observacoes')" ) )
			{
				$_SESSION['msg']	=	'Cliente cadastrado com sucesso!';
				header( 'Location: clientes.php' );
			}
			else
			{
				$msg	=	'Erro ao adicionar dados!';
			}
		}
	}

	//////////////////////////////////////////////////////////////////////////////////////
	// DADOS PRE-DEFINIDOS ///////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( !$cidade ) $cidade = 'RIO GRANDE';
	if ( !$estado ) $estado = 'RS';
	if ( !$cep ) $cep = '96200000';
	if ( !$ddd ) $ddd = '53';

	$tpl->assign( 'nome', $nome );
	$tpl->assign( 'endereco', $endereco );
	$tpl->assign( 'bairro', $bairro );
	$tpl->assign( 'cidade', $cidade );
	$tpl->assign( 'estado', select_estados( $estado ) );
	$tpl->assign( 'cep', $cep );
	$tpl->assign( 'ddd', $ddd );
	$tpl->assign( 'fone', $fone );
	$tpl->assign( 'observacoes', $observacoes );
	
	//////////////////////////////////////////////////////////////////////////////////////
	
	$tpl->assign( 'body', $body );
	$tpl->assign( 'msg', $msg );

	/************************************************************************************/

	$tpl->assign( 'conteudo', 'clientes_adicionar.html' );
	$tpl->display( 'layout.html' );
?>