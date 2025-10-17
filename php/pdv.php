<?php	
session_start();
include( '../config.php' );
valida();

$body	=	'onLoad="document.form1.codigo.focus()"';
$esc	=	$_GET['esc'];
$id_user	=	$_SESSION['user_id'];
if ($_POST['concluir_venda']){ 
	header('Location: pdv2.php'); 
}

if ($_SESSION['codp']){ 
	$tpl->assign('codigo', $_SESSION['codp']); 
	$_SESSION['codp'] = false; 
}

$descricao	=	$_SESSION['msg'];
$_SESSION['msg']	=	false;

// CLIENTE ///////////////////////////////////////////////////////////////////////////
if (!$_SESSION['id_cliente']) $_SESSION['id_cliente'] = 0;

// Cancela a venda ///////////////////////////////////////////////////////////////////
if ( $esc ){
	//	if (mysql_query( "delete from vendas2 where (id_venda='0' and id_user='$id_user')")){
	//		header('Location: ' . $_SESSION['user_home']);
	//	}else{
	//		$msg	=	'Erro ao processar cancelamento da venda!';
	//	}
	$erro	=	false;
	//	if ($result = mysql_query( "Select vendas2.codigo, vendas2.qtde From vendas2 Where vendas2.id_venda = '0' AND vendas2.id_user = '$id_user'" ) )
	if ($result = mysql_query("SELECT vendas2.codigo, vendas2.descricao, vendas2.unitario, vendas2.qtde, vendas2.subtotal From vendas2 Where vendas2.id_venda = '0' AND vendas2.id_user = '$id_user' ")){
		for ($i = 0; $i < mysql_num_rows($result); $i++){
			// INICIO - REGISTRA ESTORNO //
			$ecodigo	=	mysql_result($result, $i, 'codigo');
			$edescricao	=	mysql_result($result, $i, 'descricao');
			$eunitario	=	mysql_result($result, $i, 'unitario');
			$equantidade	=	mysql_result($result, $i, 'qtde');
			$esubtotal	=	mysql_result($result, $i, 'subtotal');
			mysql_query("INSERT INTO `estorno` (`codigo`, `descricao`, `quantidade`, `unitario`, `subtotal`, `id_user`, `datahora`) VALUES ('$ecodigo', '$edescricao', '$equantidade', '$eunitario', '$esubtotal', '$id_user', now())");
			// FIM - REGISTRA ESTORNO //

			$c_codigo	=	mysql_result($result, $i, 'codigo');
			$c_qtde		=	mysql_result($result, $i, 'qtde');

			if (!mysql_query("update produtos set estoque=(estoque + $c_qtde) where (codigo='$c_codigo')")){
				$erro		=	true;
				$descricao	=	'ERRO AO ATUALIZAR ESTOQUE PARA CANCELAMENTO DA VENDA!';
			}
		}
		if (!$erro){
			if (mysql_query("delete from vendas2 where (id_venda='0' and id_user='$id_user')")){
				header('Location: ' . $_SESSION['user_home']);
			}else{
				$descricao	=	'ERRO AO EXCLUIR ÍTENS DA LISTA PARA CANCELAMENTO DA VENDA!';
			}
		}
	}else{
		$descricao	=	'ERRO AO OBTER LISTA DE PRODUTOS PARA CANCELAMENTO DA VENDA!';
	}
}

// Adiciona produtos /////////////////////////////////////////////////////////////////
if ($_POST['adicionar_produto'])
{
	$codigo	=	$_POST['codigo'];
	$qtde	=	str_replace( ',', '.', str_replace( '.', '', trim( $_POST['qtde'])));
	if ( $result = mysql_query( "Select produtos.codigo, produtos.descricao, produtos.venda From produtos Where produtos.codigo = '$codigo'" ) ){
		if ( mysql_num_rows( $result ) == 1 ){
			$descricao	=	mysql_result( $result, 0, 'descricao' );
			$venda		=	mysql_result( $result, 0, 'venda' );
			$subtotal_item	=	( $qtde * $venda );

			$tpl->assign( 'preco_unitario', number_format( $venda, 2, ',', '.' ) );
			$tpl->assign( 'descricao', $descricao );

			if ( mysql_query( "insert into vendas2 (id_venda, codigo, descricao, unitario, qtde, subtotal, id_user) VALUES ('0', '$codigo', '$descricao', '$venda', '$qtde', '$subtotal_item', '$id_user')" )){
				$tpl->assign( 'preco_unitario', number_format( $venda, 2, ',', '.' ) );
				$tpl->assign( 'descricao', $descricao );
					
				if (!mysql_query( "update produtos set estoque=(estoque - $qtde) where (codigo='$codigo')" )){
					$descricao	=	'ERRO AO DAR BAIXA NO ESTOQUE!';
				}
			}else{
				$descricao	=	'ERRO AO REGISTRAR A VENDA DO ÍTEM!';
			}
		}else{
			$descricao	=	'PRODUTO NÃO CADASTRADO!';
		}
	}else{
		$descricao	=	'ERRO AO PROCURAR CÓDIGO NO BANCO DE DADOS!';
	}
}

// Cancelar ítens ////////////////////////////////////////////////////////////////////
if ( $_POST['cancela_item'] ){
	//
	//	$id_item	=	$_POST['id_item'];
	//	if ( count( $id_item ) > 0 ){
	//		for( $i = 0; $i < count( $id_item ); $i++ )	{
	//			if ( mysql_query( "delete from vendas2 where (id='$id_item[$i]')" ) ){
	//				$descricao	=	'ÍTENS CANCELADOS COM SUCESSO!';
	//			}else{
	//				$descricao	=	'ERRO AO CANCELAR ÍTEM!';
	//			}
	//		}
	//	}else{
	//		$descricao	=	'NENHUM ÍTEM SELECIONADO PARA CANCELAMENTO!';
	//
	$id_item	=	$_POST['id_item'];
	if (count($id_item) > 0){
		$erro	=	false;
		for ($i = 0; $i < count($id_item); $i++){
			if (!pdv_cancela_item($id_item[$i])){
				$erro	=	true;
			}
		}
		if (!$erro){
			$descricao	=	'ÍTENS CANCELADOS COM SUCESSO.';
		}else{
			$descricao	=	'ERRO AO CANCELAR ÍTENS.';
		}
	}else{
		$descricao	=	'NENHUM ÍTEM SELECIONADO PARA CANCELAMENTO.';
	}
}

// Lista produtos ////////////////////////////////////////////////////////////////////
if ($result = mysql_query("Select vendas2.id, vendas2.codigo, vendas2.descricao, vendas2.unitario, vendas2.qtde, vendas2.subtotal 
							From vendas2 
							Where vendas2.id_venda = '0' and vendas2.id_user = '$id_user' Order By vendas2.id Asc")){
							
	for ($i = 0; $i < mysql_num_rows($result); $i++){
		$lista	.=	'<tr>
					<td class="linhas"><input name="id_item[]" type="checkbox" id="id_item[]" value="' . mysql_result( $result, $i, 'id' ) . '"></td>
					<td class="linhas">' . mysql_result( $result, $i, 'codigo' ) . '</td>
					<td class="linhas">' . mysql_result( $result, $i, 'descricao' ) . '</td>
					<td align="right" class="linhas">' . number_format( mysql_result( $result, $i, 'unitario' ), 2, ',', '.' ) . '</td>
					<td align="right" class="linhas">' . number_format( mysql_result( $result, $i, 'qtde' ), 2, ',', '.' ) . '</td>
					<td align="right" class="linhas">' . number_format( mysql_result( $result, $i, 'subtotal' ), 2, ',', '.' ) . '</td>
					</tr>';
	}
	$tpl->assign('lista', $lista);
}else{
	$descricao	=	'ERRO AO GERAR LISTA DE PRODUTOS VENDIDOS!';
}

// Subtotal //////////////////////////////////////////////////////////////////////////
if ($result = mysql_query( "Select Sum(vendas2.subtotal) AS total From vendas2 Where vendas2.id_venda = '0' and vendas2.id_user = '$id_user'" )){
	$tpl->assign( 'subtotal', number_format( mysql_result($result, 0, 'total'), 2, ',', '.'));
}else{
	$descricao	=	'ERRO AO OBTER O SUBTOTAL!';
}

$tpl->assign('descricao', $descricao);
$tpl->assign('body', $body);
$tpl->assign('usuario', $_SESSION['user_nome']);
$tpl->assign('conteudo', 'pdv.html');
$tpl->display('pdv_layout.html');
?>