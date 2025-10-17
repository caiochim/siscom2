<?php	session_start();
include( '../config.php' );
valida();

/************************************************************************************/
$body	=	'onLoad="document.form1.q.focus()"';

//////////////////////////////////////////////////////////////////////////////////////
// PESQUISA CLIENTE //////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
if ( $_POST['pesquisar'] && $_POST['q'] )
{
	$q	=	$_POST['q'];

	if ( $result = mysql_query( "Select clientes.id, clientes.nome From clientes Where clientes.nome Like '%$q%'" ) )
	{
		if ( mysql_num_rows( $result ) > 0 )
		{
			for ( $i = 0; $i < mysql_num_rows( $result ); $i++ )
			{
				$id_cliente	=	mysql_result( $result, $i, 'id' );
				$nome		=	mysql_result( $result, $i, 'nome' );

				$codp	.=	'        <option value="' . $id_cliente . '">' . pdescricao( $nome ) . '</option>
';
			}

			$body	=	'onLoad="document.form1.codp.focus()"';
			$tpl->assign( 'codp', $codp );
		}
		else
		{
			$msg	=	'NENHUM CLIENTE LOCALIZADO!';
		}
	}
	else
	{
		$msg	=	'ERRO AO PESQUISAR CLIENTE NO BANCO DE DADOS!';
	}
}
elseif ( $_POST['codp'] )
{
	$_SESSION['id_cliente_rec']	=	$_POST['codp'];
	header( 'Location: pdv_rec2.php' );
}

//////////////////////////////////////////////////////////////////////////////////////

$tpl->assign( 'msg', $msg );
$tpl->assign( 'body', $body );

$tpl->assign( 'usuario', $_SESSION['user_nome'] );

/************************************************************************************/

$tpl->assign( 'conteudo', 'pdv_rec1.html' );
$tpl->display( 'pdv_layout.html' );
?>