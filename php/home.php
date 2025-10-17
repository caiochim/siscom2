<?php
	session_start();
	include('../config.php');
	valida(); //Valida a Sessão
	$tpl->assign('menu', gera_menu($_SESSION['user_id']));
	$msg	=	'Seja bem vindo ao SisCom2!';

	// Totalizadores /////////////////////////////////////////////////////////////////////
	$ontem	=	date( 'Y' . '-' . 'm' . '-' . 'd', strtotime( '-1 day' ) );
	$hoje	=	date( 'Y' . '-' . 'm' . '-' . 'd' );
	$mes	=	date( 'm' );
	$ano	=	date("Y");

	// ontem //
	if ($result = mysql_query("Select Sum(vendas1.total) AS ontem From vendas1 Where date(vendas1.datahora) = '$ontem'")){
		$tpl->assign('ontem', number_format(mysql_result($result, 0, 'ontem' ), 2, ',', '.'));
	}else{
		$msg	=	'Erro no totalizador "ontem"!';
	}

	// hoje //
	if ($result = mysql_query("Select Sum(vendas1.total) AS hoje From vendas1 Where date(vendas1.datahora) = '$hoje'")){
		$tpl->assign('hoje', number_format(mysql_result( $result, 0, 'hoje' ), 2, ',', '.'));
	}else{
		$msg	=	'Erro no totalizador "hoje"!';
	}

	// este mês //
	if ($result = mysql_query("Select Sum(vendas1.total) AS mes From vendas1 Where month(vendas1.datahora) = '$mes' and year(vendas1.datahora) = '$ano'")){
		$tpl->assign('mes', number_format(mysql_result($result, 0, 'mes' ), 2, ',', '.'));
	}else{
		$msg	=	'Erro no totalizador "este mês"!';
	}

	$tpl->assign('msg', $msg);

	$tpl->assign('conteudo', 'home.html');
	$tpl->display('layout.html');
?>