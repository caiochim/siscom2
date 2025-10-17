<?php	session_start();
include( '../config.php' );
valida();
$tpl->assign( 'menu', gera_menu( $_SESSION['user_id'] ) );

/************************************************************************************/
$margem_lucro	=	1.4;
//echo '<pre>';
//print_r($_POST);
//echo '</pre>';
/************************************************************************************/
$msg	=	$_SESSION['msg'];
$_SESSION['msg']	=	false;

$body	=	'onLoad="document.form2.iCodigo.focus()"';

$id_entrada	=	$_GET['id_entrada'];

$dia	=	date( 'd' );
$mes	=	date( 'm' );
$ano	=	date( 'Y' );

/*
 * EXCLUIR
 * - exclui ítem da lista de entrada da nota fiscal
 */
if ($_POST['excluir'])
{
	if (count($_POST['lid']) > 0)
	{
		for ($i = 0; $i < count($_POST['lid']); $i++)
		{
			$id_item	=	$_POST['lid'][$i];
			nf_cancela_item($id_item);
		}
	}
	else
	{
		$msg	=	'Nenhum ítem foi selecionado.';
	}
}
//////////////////////////////////////////////////////////////////////////////////////
// Cancelar //////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
if ( $_POST['cancelar'] )
{
	header( 'Location: entrada.php' );
}

//////////////////////////////////////////////////////////////////////////////////////
// ADICIONAR /////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
if ( $_POST['adicionar'] )
{
	$_POST['iCodigo']	=	$_POST['codigo'];

	$qtde			=	str_replace( ',', '.', str_replace( '.', '', trim( $_POST['qtde'] ) ) );
	$custo			=	str_replace( ',', '.', str_replace( '.', '', trim( $_POST['custo'] ) ) );
	$venda			=	$_POST['venda'];
	$codigo			=	$_POST['codigo'];
	$descricao		=	$_POST['descricao'];
	$id_produto		=	$_POST['id_produto'];
	$id_fornecedor	=	$_POST['id_fornecedor'];

	if ( $qtde <= 0 )
	{
		$msg	=	'Informe a quantidade do produto!';
		$body	=	'onLoad="document.form2.qtde.focus()"';
	}
	elseif ( $custo <= 0 )
	{
		$msg	=	'Informe o preço de custo do produto!';
		$body	=	'onLoad="document.form2.custo.focus()"';
	}
	else
	{
		if ( $venda < ( $custo * $margem_lucro ) )
		{
			$msg	=	'Preço de venda abaixo da margem de lucro sugerida!<br />Preço de venda: R$' . number_format( $venda, 2, ',', '.' ) . ' | Preço sugerido: R$' . number_format( ( $custo * $margem_lucro ), 2, ',', '.' );
		}
			
		if ( mysql_query( "insert into entrada2 (id_entrada, codigo, descricao, qtde, custo) VALUES ('$id_entrada', '$codigo', '$descricao', '$qtde', '$custo')" ) )
		{
			if ( mysql_query( "update produtos set custo='$custo', estoque=estoque+$qtde, id_fornecedor='$id_fornecedor' where (id='$id_produto')" ) )
			{
				$_POST['iCodigo']	=	false;
			}
			else
			{
				$msg	=	'Erro ao atualizar dados do produto!';
			}
		}
		else
		{
			$msg	=	'Erro ao adicionar produto a nota!';
		}
	}

	$tpl->assign( 'qtde', number_format( $qtde, 2, ',', '.' ) );
	$tpl->assign( 'custo', number_format( $custo, 4, ',', '.' ) );
}

//////////////////////////////////////////////////////////////////////////////////////
// AVANÇAR ///////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
if ( $_POST['avancar'] || $_POST['iCodigo'] )
{
	$iCodigo	=	$_POST['iCodigo'];

	if ( $result = mysql_query( "Select produtos.id, produtos.codigo, produtos.descricao, produtos.custo, produtos.venda From produtos Where produtos.codigo = '$iCodigo'" ) )
	{
		if ( mysql_num_rows( $result ) > 0 )
		{
			$tpl->assign( 'id_produto', mysql_result( $result, 0, 'id' ) );
			$tpl->assign( 'codigo', mysql_result( $result, 0, 'codigo' ) );
			$tpl->assign( 'descricao', mysql_result( $result, 0, 'descricao' ) );
			if ( !$custo ) $tpl->assign( 'custo', number_format( mysql_result( $result, 0, 'custo' ), 4, ',', '.' ) );
			$tpl->assign( 'venda', mysql_result( $result, 0, 'venda' ) );
			if ( !$qtde ) $body	=	'onLoad="document.form2.qtde.focus()"';
		}
		else
		{
			$msg	=	'Produto não cadastrado!';
		}
	}
	else
	{
		$msg	=	'Erro ao localizar produto!';
	}
}

//////////////////////////////////////////////////////////////////////////////////////
// DADOS DA NOTA FISCAL //////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
if ( $result = mysql_query( "Select fornecedores.fornecedor, entrada1.nfnro, entrada1.data_emissao, entrada1.total_nota, fornecedores.id From entrada1 , fornecedores Where fornecedores.id = entrada1.id_fornecedor AND entrada1.id = '$id_entrada'" ) )
{
	$tpl->assign( 'fornecedor', mysql_result( $result, 0, 'fornecedor' ) );
	$tpl->assign( 'nfnro', mysql_result( $result, 0, 'nfnro' ) );
	$tpl->assign( 'data_emissao', formata_data( mysql_result( $result, 0, 'data_emissao' ) ) );
	$tpl->assign( 'total_nota', number_format( mysql_result( $result, 0, 'total_nota' ), 2, ',', '.' ) );
	$tpl->assign( 'id_fornecedor', mysql_result( $result, 0, 'id' ) );
}
else
{
	$msg	=	'Erro ao recuperar dados da nota!';
}

//////////////////////////////////////////////////////////////////////////////////////
// LISTA PRODUTOS DA NOTA ////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
if( $result = mysql_query( "Select entrada2.id, entrada2.codigo, entrada2.descricao, entrada2.qtde, entrada2.custo, produtos.estoque From entrada2 , produtos Where entrada2.id_entrada = '$id_entrada' AND entrada2.codigo = produtos.codigo Order By entrada2.id Desc" ) )
{
	for ( $i = 0; $i < mysql_num_rows( $result ); $i++ )
	{
		$lid		=	mysql_result( $result, $i, 'id' );
		$lCodigo	=	mysql_result( $result, $i, 'codigo' );
		$lDescricao	=	mysql_result( $result, $i, 'descricao' );
		$lQtde		=	mysql_result( $result, $i, 'qtde' );
		$lCusto		=	mysql_result( $result, $i, 'custo' );
		$lSubtotal	=	( $lQtde * $lCusto );
		$lEstoque	=	mysql_result( $result, $i, 'estoque' );
		$total		=	( $total + $lSubtotal );
			
		$lista	.=	'          <tr>
            <td class="lista_linhas"><input name="lid[]" type="checkbox" id="lid[]" value="' .$lid . '" /></td>
            <td class="lista_linhas">' . $lCodigo . '</td>
            <td class="lista_linhas">' . $lDescricao . '</td>
            <td align="right" class="lista_linhas">' . number_format( $lQtde, 2, ',', '.' ) . '</td>
            <td align="right" class="lista_linhas">' . number_format( $lCusto, 2, ',', '.' ) . '</td>
            <td align="right" class="lista_linhas">' . number_format( $lSubtotal, 2, ',', '.' ) . '</td>
            <td align="right" class="lista_linhas">' . number_format( $lEstoque, 2, ',', '.' ) . '</td>
          </tr>
';
	}
	$tpl->assign( 'lista', $lista );
	$tpl->assign( 'total', number_format( $total, 2, ',', '.' ) );
}
else
{
	$msg	=	'Erro ao obter lista de produtos da nota!';
}

//////////////////////////////////////////////////////////////////////////////////////

$tpl->assign( 'body', $body );
$tpl->assign( 'msg', $msg );

/************************************************************************************/

$tpl->assign( 'conteudo', 'entrada2.html' );
$tpl->display( 'layout.html' );
?>