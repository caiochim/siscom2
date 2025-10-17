<?php	session_start();
	include( '../config.php' );
	valida();

	/************************************************************************************/
	$body	=	'onLoad="document.form1.valor.focus()"';
	
	$id_user	=	$_SESSION['user_id'];
	$id_cliente	=	$_SESSION['id_cliente_rec'];

	//////////////////////////////////////////////////////////////////////////////////////
	// ESC ///////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $_GET['esc'] )
	{
		$_SESSION['id_cliente_rec']	=	false;
		header( 'Location: pdv_rec1.php' );
	}

	//////////////////////////////////////////////////////////////////////////////////////
	// CLIENTE ///////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $_SESSION['id_cliente_rec'] === 0 )
	{
		$cliente	=	'GERAL';
	}
	else
	{
		if ( $result = mysql_query( "Select clientes.nome From clientes Where clientes.id = '$id_cliente'" ) )
		{
			if ( mysql_num_rows( $result ) == 1 )
			{
				$cliente	=	mysql_result( $result, 0, 'nome' );
			}
			else
			{
				$msg	=	'Erro ao obter nome do cliente!';
			}
		}
		else
		{
			$msg	=	'Erro ao buscar nome do cliente!';
		}
	}
	$tpl->assign( 'cliente', $cliente );

	//////////////////////////////////////////////////////////////////////////////////////
	// SALDO DO CLIENTE //////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $result = mysql_query( "Select Sum(vendas1.total) AS saldo1 From vendas1 Where vendas1.id_cliente = '$id_cliente' AND vendas1.pago = 'N'" ) )
	{
		$saldo1	=	mysql_result( $result, 0, 'saldo1' );
	}
	else
	{
		$msg	=	'ERRO AO OBTER "saldo1"!';
	}

	if ( $result = mysql_query( "Select Sum(vendas1.total) AS saldo2 From vendas1 , vendas2 Where vendas1.id_cliente = '$id_cliente' AND vendas1.pago = 'S' AND vendas2.codigo = '9999999999999' AND vendas1.id = vendas2.id_venda" ) )
	{
		$saldo2	=	mysql_result( $result, 0, 'saldo2' );
	}
	else
	{
		$msg	=	'ERRO AO OBTER "saldo2"!';
	}
	
	$saldo	=	$saldo1 - $saldo2;
	if ( $saldo > 0 ) { $tag = 'D'; } elseif ( $saldo < 0 ) { $tag = 'C'; $saldo = ($saldo * (-1)); }
	$tpl->assign( 'saldo', number_format( $saldo, 2, ',', '.' ) );
	$tpl->assign( 'tag', $tag );

	//////////////////////////////////////////////////////////////////////////////////////
	// CONCLUI O REGISTRO DE PAGAMENTO ///////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $_POST['concluir'] )
	{
		$valor	=	str_replace( ',', '.', str_replace( '.', '', trim( $_POST['valor'] ) ) );
	
		if ( $valor > 0 )
		{
			if ( mysql_query( "insert into vendas1 (datahora, total, id_cliente) VALUES (now(), '$valor', '$id_cliente')" ) )
			{
				if ( $result = mysql_query( "Select vendas1.id From vendas1 Order By vendas1.id Desc Limit 1" ) )
				{
					$id_venda	=	mysql_result( $result, 0, 'id' );
					
					if ( mysql_query( "insert into vendas2 (id_venda, codigo, descricao, unitario, qtde, subtotal, id_user) VALUES ('$id_venda', '9999999999999', 'RECEBIMENTO DE CONTA', '$valor', '1', '$valor', '$id_user')" ) )
					{
						$_SESSION['msg']	=	'RECEBIMENTO DE CONTA REGISTRADO COM SUCESSO!';
						header( 'Location: pdv.php' );
					}
					else
					{
						$msg	=	'ERRO AO REGISTRAR "vendas2"!';
					}
				}
				else
				{
					$msg	=	'ERRO AO OBTER CÓDIGO DE VENDA!';
				}
			}
			else
			{
				$msg	=	'ERRO AO REGISTRAR "vendas1"!';
			}
		}
		else
		{
			$msg	=	'O VALOR PAGO DEVE SER MAIOR QUE ZERO!';
		}
	}

	//////////////////////////////////////////////////////////////////////////////////////
	$tpl->assign( 'saldo', number_format( $saldo, 2, ',', '.' ) );
	$tpl->assign( 'valor', number_format( $valor, 2, ',', '.' ) );
	
	$tpl->assign( 'msg', $msg );
	$tpl->assign( 'body', $body );
	
	$tpl->assign( 'usuario', $_SESSION['user_nome'] );

	/************************************************************************************/

	$tpl->assign( 'conteudo', 'pdv_rec2.html' );
	$tpl->display( 'pdv_layout.html' );
?>