<?php	session_start();
include( '../config.php' );
valida();
$tpl->assign( 'menu', gera_menu( $_SESSION['user_id'] ) );

/************************************************************************************/
$body	=	'onLoad="document.form1.nome.focus()"';

$id_cliente	=	$_GET['id_cliente'];
$tpl->assign('id_cliente', $id_cliente);

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
	$status			=	$_POST['status'];
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
		if ( mysql_query( "update clientes set `status`='$status', nome='$nome', endereco='$endereco', bairro='$bairro', cidade='$cidade', estado='$estado', cep='$cep', telefone='$telefone', observacoes='$observacoes' where (id='$id_cliente')" ) )
		{
			$_SESSION['msg']	=	'Cliente alterado com sucesso!';
			header( 'Location: clientes.php' );
		}
		else
		{
			$msg	=	'Erro ao alterar dados!';
		}
	}
}
else
//////////////////////////////////////////////////////////////////////////////////////
// DADOS DO CLIENTE //////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
{
	if ( $result = mysql_query( "Select clientes.`status`, clientes.nome, clientes.endereco, clientes.bairro, clientes.cidade, clientes.estado, clientes.cep, clientes.telefone, clientes.observacoes From clientes Where clientes.id = '$id_cliente'" ) )
	{
		if ( mysql_num_rows( $result ) == 1 )
		{
			$status			=	mysql_result( $result, 0, 'status' );
			$nome			=	mysql_result( $result, 0, 'nome' );
			$endereco		=	mysql_result( $result, 0, 'endereco' );
			$bairro			=	mysql_result( $result, 0, 'bairro' );
			$cidade			=	mysql_result( $result, 0, 'cidade' );
			$estado			=	mysql_result( $result, 0, 'estado' );
			$cep			=	mysql_result( $result, 0, 'cep' );
			$telefone		=	mysql_result( $result, 0, 'telefone' );
			$observacoes	=	mysql_result( $result, 0, 'observacoes' );

			$ddd	=	substr( $telefone, 0, 2 );
			$fone	=	substr( $telefone, 2, 8 );
		}
		else
		{
			$msg	=	'Erro ao recuperar dados do cliente!';
		}
	}
	else
	{
		$msg	=	'Erro ao consultar banco de dados!';
	}
}

//////////////////////////////////////////////////////////////////////////////////////

$tpl->assign( 'status', $status );
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

$tpl->assign( 'conteudo', 'clientes_editar.html' );
$tpl->display( 'layout.html' );
?>