<?php	session_start();
include( '../config.php' );
valida();

/************************************************************************************/
$body	=	'onLoad="document.form1.q.focus()"';

//////////////////////////////////////////////////////////////////////////////////////
// Pesquisa produtos /////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
if ( $_POST['pesquisar'] && $_POST['q'] )
{
	$q	=	str_replace(' ', '%', $_POST['q']);

	if ( $result = mysql_query( "Select produtos.codigo, produtos.descricao, produtos.venda From produtos Where produtos.descricao Like '%$q%' Order By produtos.descricao Asc" ) )
	{
		if ( mysql_num_rows( $result ) > 0 )
		{
			for ( $i = 0; $i < mysql_num_rows( $result ); $i++ )
			{
				$codigo		=	mysql_result( $result, $i, 'codigo' );
				$descricao	=	mysql_result( $result, $i, 'descricao' );
				$preco		=	mysql_result( $result, $i, 'venda' );

				$codp	.=	'        <option value="' . $codigo . '">' . pcodigo( $codigo ) . ' | ' . pdescricao( $descricao ) . ' | ' . ppreco( $preco ) . '</option>
';
			}

			$body	=	'onLoad="document.form1.codp.focus()"';
			$tpl->assign( 'codp', $codp );
		}
		else
		{
			$msg	=	'NENHUM PRODUTO LOCALIZADO!';
		}
	}
	else
	{
		$msg	=	'ERRO AO PESQUISAR PRODUTO NO BANCO DE DADOS!';
	}
}
elseif ( $_POST['codp'] )
{
	$_SESSION['codp']	=	$_POST['codp'];
	header( 'Location: pdv.php' );
}

//////////////////////////////////////////////////////////////////////////////////////

$tpl->assign( 'msg', $msg );
$tpl->assign( 'body', $body );

$tpl->assign( 'usuario', $_SESSION['user_nome'] );

/************************************************************************************/

$tpl->assign( 'conteudo', 'pdv3.html' );
$tpl->display( 'pdv_layout.html' );
?>