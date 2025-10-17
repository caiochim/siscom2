<?php
session_start();
include('../config.php');
valida();
$tpl->assign('menu', gera_menu($_SESSION['user_id']));

// Select Data ///////////////////////////////////////////////////////////////////////
$tpl->assign('select_data', select_data(date('d'), date('m'), date('Y'), 2008));

// VERIFICA SE HÁ USUÁRIO COM CAIXA ABERTO ///////////////////////////////////////////
if ($result = mysql_query( "Select usuarios.nome From usuarios , vendas2 Where usuarios.id = vendas2.id_user AND vendas2.id_venda = '0' Group By vendas2.id_user Order By usuarios.nome Asc" ) ){
	if (mysql_num_rows( $result ) > 0 ){
		$msg	=	'ATENÇÃO: Existem usuários com vendas não finalizadas. (';
		for ($i = 0; $i < mysql_num_rows($result); $i++){
			$msg	.=	mysql_result($result, $i, 'nome');
			if ($i != (mysql_num_rows($result) - 1 )){
				$msg .= ', '; 
			}
		}
		$msg	.=	')';
	}
}else{
	$msg	=	'Erro ao verificar se há caixa aberto!';
}

// Gera Relatório ///////////////////////////////////////////////////////////////////////
if ( $_POST['gerar_relatorio'] ){
	$ano	=	$_POST['ano'];
	$mes	=	$_POST['mes'];
	$dia	=	$_POST['dia'];
	$data	=	$dia . '/' . $mes . '/' . $ano;
	$tpl->assign('data', $data);
	
	// TOTAL DO DIA ////////////////////////////////////////////////////////////////
	if ( $result =  mysql_query( "Select Sum(vendas1.total) AS total From vendas1 Where vendas1.datahora Like '$ano-$mes-$dia%' AND vendas1.pago = 'S'" ) ){
		$total	=	number_format( mysql_result( $result, 0, 'total' ), 2, ',', '.' );
		$tpl->assign( 'total', $total );
	}else{
		$msg	=	'Erro ao obter valor total do período!';
	}

	// RELATORIO PRINCIPAL /////////////////////////////////////////////////////////
	if ( $result = mysql_query( "Select usuarios.id, usuarios.nome, Sum(vendas2.subtotal) AS subtotal From usuarios, vendas1,	vendas2 Where usuarios.id = vendas2.id_user AND vendas1.id = vendas2.id_venda AND vendas1.datahora Like '$ano-$mes-$dia%' AND vendas1.pago = 'S' Group By vendas2.id_user Order By usuarios.nome Asc")){
		for ($i = 0; $i < mysql_num_rows($result); $i++){
			$id_usuario	=	mysql_result($result, $i, 'id');
			$usuario	=	mysql_result($result, $i, 'nome');
			$subtotal	=	number_format(mysql_result($result, $i, 'subtotal'), 2, ',', '.' );
			$result2	=	mysql_query("SELECT Sum(vendas2.subtotal) AS recarga FROM vendas1 , vendas2 WHERE vendas1.id = vendas2.id_venda AND vendas2.id_user = '$id_usuario' AND date(vendas1.datahora) = '$ano-$mes-$dia' AND vendas2.codigo = '2'");
			$recarga	=	number_format(mysql_result($result2, 0, 'recarga'), 2, ',', '.' );
			$linhas	.=	' <tr><td class="lista_linhas">' . $usuario . '</td>
			<td align="right" class="lista_linhas">' . $subtotal . '</td>
			<td align="right" class="lista_linhas">' . $recarga . '</td>
			</tr>';
			$tpl->assign('linhas', $linhas);
		}
	}else{
		$msg	=	'Erro ao gerar relatório!';
	}

	if (mysql_num_rows($result) == 0){ 
		$msg = 'Não existem vendas registradas para o dia ' . $data ; 
	}
}
$tpl->assign('msg', $msg);
$tpl->assign('conteudo', 'relCaixa.html');
$tpl->display('layout.html');
?>