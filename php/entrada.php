<?php
session_start();
include('../config.php');
valida();
$tpl->assign('menu', gera_menu($_SESSION['user_id']));

//////////////////////////////////////////////////////////////////////////////////////
$msg	=	$_SESSION['msg'];
$_SESSION['msg']	=	false;

// ADICIONAR NF //////////////////////////////////////////////////////////////////////
if ($_POST['adicionar']){
	header('Location: entrada_adicionar.php');
}

// LISTA  ////////////////////////////////////////////////////////////////////////////
if ($result = mysql_query("SELECT entrada1.id, entrada1.nfnro, fornecedores.fornecedor 
							FROM entrada1, fornecedores 
							WHERE entrada1.id_fornecedor =  fornecedores.id 
							ORDER BY entrada1.id DESC")){
	for ($i = 0; $i < mysql_num_rows($result); $i++){
		$id_entrada	=	mysql_result($result, $i, 'id');
		$nfnro		=	mysql_result($result, $i, 'nfnro');
		$fornecedor	=	mysql_result($result, $i, 'fornecedor');
		$linhas	.=	'<tr>
        <td align="right" class="lista_linhas">' . ($i + 1) . '</td>
        <td class="lista_linhas"><a href="entrada2.php?id_entrada=' . $id_entrada . '" class="lista_link">' . $nfnro . '</a></td>
        <td class="lista_linhas"><a href="entrada2.php?id_entrada=' . $id_entrada . '" class="lista_link">' . $fornecedor . '</a></td></tr>';
	}
	$tpl->assign('linhas', $linhas);
	$tpl->assign('total', mysql_num_rows($result));
}else{
	$msg	=	'Erro ao obter registros.';
}

//////////////////////////////////////////////////////////////////////////////////////
$tpl->assign('msg', $msg);
$tpl->assign('body', $body);

//////////////////////////////////////////////////////////////////////////////////////
$tpl->assign('conteudo', 'entrada.html');
$tpl->display('layout.html');

?>