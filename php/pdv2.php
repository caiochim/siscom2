<?php	
	session_start();
	include( '../config.php' );
	valida();

	/************************************************************************************/
	$body		=	'onLoad="document.form1.dinheiro.focus()"';
	$id_user	=	$_SESSION['user_id'];
	$id_cliente	=	$_SESSION['id_cliente'];

	// ESC ///////////////////////////////////////////////////////////////////////////////
	if ( $_GET['esc'] ){
		$_SESSION['id_cliente']	=	false;
		header( 'Location: pdv.php' );
	}

	// CLIENTE ///////////////////////////////////////////////////////////////////////////
	if ( $_SESSION['id_cliente'] === 0 ){
		$cliente	=	'GERAL';
	}else{
		if ($result = mysql_query( "Select clientes.nome From clientes Where clientes.id = '$id_cliente'" ) ){
			if ( mysql_num_rows( $result ) == 1 ){
				$cliente	=	mysql_result( $result, 0, 'nome' );
			}else{
				$msg	=	'Erro ao obter nome do cliente!';
			}
		}else{
			$msg	=	'Erro ao buscar nome do cliente!';
		}
	}
	$tpl->assign( 'cliente', $cliente );

	// Valor total da compra /////////////////////////////////////////////////////////////
	if ( $result = mysql_query( "Select Sum(vendas2.subtotal) AS total From vendas2 Where vendas2.id_venda = '0' and vendas2.id_user = '$id_user'" )){
		$total	=	mysql_result( $result, 0, 'total' );
		$tpl->assign( 'total', number_format( $total, 2, ',', '.' ) );
	}else{
		$msg	=	'ERRO AO OBTER VALOR DA COMPRA!';
	}

	// Calculo do troco //////////////////////////////////////////////////////////////////
	if ($_POST['finaliza_venda']){
		$dinheiro	=	str_replace( ',', '.', str_replace( '.', '', trim( $_POST['dinheiro'] ) ) );
		if ($dinheiro >= $total){
			$troco	=	($dinheiro - $total);
			$tpl->assign('stg', true);
			$body	=	'onLoad="if (confirm(\'Concluir venda?\')) { document.location = \'pdv2.php?x=true\'; } else { document.form1.dinheiro.focus(); }"';
		}else{
			$msg	=	'VALOR DO PAGAMENTO INFERIOR AO TOTAL DA COMPRA!';
		}
	}

	// Finaliza a compra e retorna a tela de venda ///////////////////////////////////////
	if ( $_GET['x'] ){
		if ( $id_cliente === 0 ) $pago = 'S'; else $pago = 'N';
		if ( mysql_query( "insert into vendas1 (datahora, total, id_cliente, pago) VALUES (now(), '$total', '$id_cliente', '$pago')")){
			if ( $result = mysql_query( "Select vendas1.id From vendas1 Order By vendas1.id Desc Limit 1" ) ){
				$id_venda	=	mysql_result( $result, 0, 'id' );
				if ( mysql_query( "update vendas2 set id_venda='$id_venda' where (id_venda='0' and id_user='$id_user')" ) )	{
					$_SESSION['id_cliente']	= false;
					header( 'Location: pdv.php' );
				}else{
					$msg	=	'ERRO AO REGISTRAR ÍTENS DA COMPRA!';
				}
			}else{
				$msg	=	'ERRO AO OBTER CÓDIGO DA COMPRA!';
			}
		}else{
			$msg	=	'ERRO AO REGISTRAR A COMPRA!';
		}
	}

	//////////////////////////////////////////////////////////////////////////////////////
	if ( !$dinheiro ) { 
		$dinheiro = $total; 
	}

	$tpl->assign( 'dinheiro', number_format( $dinheiro, 2, ',', '.' ) );
	$tpl->assign( 'troco', number_format( $troco, 2, ',', '.' ) );
	$tpl->assign( 'msg', $msg );
	$tpl->assign( 'body', $body );
	$tpl->assign( 'usuario', $_SESSION['user_nome'] );
	$tpl->assign( 'conteudo', 'pdv2.html' );
	$tpl->display( 'pdv_layout.html' );
?>
