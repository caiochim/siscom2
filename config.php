<?php
include 'function.php';

// Smarty ////////////////////////////////////////////////////////////////////////////
include( 'classes/Smarty/Smarty.class.php' );
$tpl	=	new Smarty;
$tpl->template_dir	=	dirname( __FILE__ ) . '/html';
$tpl->compile_dir	=	dirname( __FILE__ ) . '/compile';

// MySQL /////////////////////////////////////////////////////////////////////////////
mysql_connect('localhost', 'root', 'Sulfat01');
mysql_select_db('siscom2');

// Funções ///////////////////////////////////////////////////////////////////////////

// Valida a session //////////////////////////////////////////////////////////////////
function valida(){
	if ($_SESSION['id_session'] === session_id()){
		return true;
	}else{
		header('Location: index.php');
	}
}

// Valida a session para o MENU ////////////////////////////////////////////////////////
function valida_menu(){
	if ($_SESSION['id_session'] === session_id()){
		return true;
	}else{
		return false;
	}
}

// Formata a data (dd/mm/aaaa) ////////////////////////////////////////////////////////
function formata_data($x ){
	$ano	=	substr($x, 0, 4);
	$mes	=	substr($x, 5, 2);
	$dia	=	substr($x, 8, 2);
	return $dia . '/' . $mes . '/' . $ano;
}

// FORMATA DATA COM HORA /////////////////////////////////////////////////////////
function formata_data_hora($x){
	return date("d/m/Y H:i", strtotime($x));
}

// Pesquisa: formatacao da lista ///////////////////////////////////////////////////////
function pcodigo($x){
	$num	=	strlen($x);
	if ($num <= 20){
		for ($i = $num; $i < 20; $i++){
			$x	=	$x . '&nbsp;';
		}
	}else{
		$x	=	substr($x, 0, 20);
	}
	return $x;
}

function pdescricao($x){
	$num	=	strlen($x);
	if ($num <= 50){
		for ($i = $num; $i < 50; $i++){
			$x	=	$x . '&nbsp;';
		}
	}else{
		$x	=	substr($x, 0, 50);
	}
	return $x;
}

function ppreco($x){
	$x		=	number_format($x, 2, ',', '.');
	$num	=	strlen($x);

	if ($num <= 10){
		for ($i = $num; $i < 10; $i++){
			$x	= '&nbsp;' . $x;
		}
	}else{
		$x	=	substr($x, 0, 10);
	}
	return $x;
}

// Gera menu //////////////////////////////////////////////////////////////////////////
function gera_menu($id_user){
	$result	= mysql_query("Select areas.area, areas.arquivo From areas, permissoes Where permissoes.id_user = '$id_user' AND areas.id = permissoes.id_area Order By areas.id Asc");
	for ($i = 0; $i < mysql_num_rows($result); $i++){
		$area		=	mysql_result($result, $i, 'area');
		$arquivo	=	mysql_result($result, $i, 'arquivo');
		$menu	.=	' &raquo; <a href="' . $arquivo . '">' . $area . '</a><br><br>';
	}
	return $menu;
}

// Gera select mes/ano //////////////////////////////////////////////////////////////////////////
function select_mesAno($mes, $ano, $ano_inicial, $name){
	$y	.=	'<select name="mes_' . $name . '">';
	for ($i = 1; $i < 13; $i++){
		if ($i < 10){
			$i = 0 .$i;
		}
		if ($i == $mes){
			$a = ' selected="selected"';
		}else{
			$a = '';
		}
		$y	.=	'<option' . $a . '>' . $i . '</option>';
	}

	$y	.=	'</select>';

	$y	.=	'<select name="ano_' . $name . '">';
	for ($i = date('Y'); $i > $ano_inicial; $i--){
		if ($i == $ano){
			$a = ' selected="selected"';
		}else{
			$a = '';
		}
		$y	.=	'<option'.$a.'>'.$i.'</option>';
	}
	$y	.=	'</select>';
	return $y;
}

// Gera select dia/mes/ano (data) //////////////////////////////////////////////////////////////////////////
function select_data($dia, $mes, $ano, $ano_inicial, $name = false){
	if ($name){
		$name = '_' . $name;
	}
	$y	.=	'<select name="dia' . $name . '">';
	for ($i = 1; $i < 32; $i++){
		if ($i < 10){
			$i = 0 .$i;
	}
		if ($i == $dia){
			$a = ' selected="selected"';
		}else{
			$a = '';
		}
		$y	.=	'
	<option'.$a.'>'.$i.'</option>';
	}
	$y	.=	'</select>';
	$y	.=	'<select name="mes' . $name . '">';
	for ($i = 1; $i < 13; $i++){
		if ($i < 10){
			$i = 0 .$i;
		}
		if ($i == $mes){
			$a = ' selected="selected"';
		}else{
			$a = '';
		}
		$y	.=	'<option'.$a.'>'.$i.'</option>';
	}
	$y	.=	'</select>';
	$y	.=	'<select name="ano' . $name . '">';
	for ($i = date('Y'); $i > $ano_inicial; $i--){
		if ($i == $ano){
			$a = ' selected="selected"';
		}else{
			$a = '';
		}
		$y	.=	'<option'.$a.'>'.$i.'</option>';
	}
	$y	.=	'</select>';
	return $y;
}

// SELECT ESTADOS //////////////////////////////////////////////////////////////////////
function select_estados($x){
	$uf	=	array('AC', 'AL', 'AM', 'AP', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MG', 'MS', 'MT', 'PA', 'PB', 'PE', 'PI', 'PR', 'RJ', 'RN', 'RO', 'RR', 'RS', 'SC', 'SE', 'SP', 'TO');
	$y	=	'<select name="estado" id="estado">';

	for ($i = 0; $i < count($uf); $i++){
		if ($x == $uf[$i]){ 
			$a	=	'selected="selected"'; 
		}else{ 
			$a = false; 
		}
		$y	.=	'<option' . $a . '>' . $uf[$i] . '</option>';
	}
	$y	.=	'</select>';
	return $y;
}
?>
