<?php
session_start();
include( '../config.php' );
valida();
$tpl->assign( 'menu', gera_menu( $_SESSION['user_id'] ) );

/************************************************************************************/
if ( $result = mysql_query( "Select clientes.id, clientes.nome From clientes Order By clientes.nome Asc" ) )
{
	for ( $i = 0; $i < mysql_num_rows( $result ); $i++ )
	{
		$id_cliente	=	mysql_result( $result, $i, 'id' );
		$nome		=	mysql_result( $result, $i, 'nome' );
			
		if ( $result2 = mysql_query( "Select Sum(vendas1.total) as saldo1 From vendas1 Where vendas1.id_cliente = '$id_cliente' AND vendas1.pago = 'N'" ) )
		{
			$saldo1	=	mysql_result( $result2, 0, 'saldo1' );

			if ( $result3 = mysql_query( "Select Sum(vendas1.total) as saldo2 From vendas1 Where vendas1.id_cliente = '$id_cliente' AND vendas1.pago = 'S'" ) )
			{
				$saldo2	=	mysql_result( $result3, 0, 'saldo2' );
					
				$saldo	=	$saldo1 - $saldo2;
					
				$total	=	$total + $saldo;
					
				$estilo	=	false;
				$tag	=	false;
					
				if ( $saldo > 0 )
				{
					$estilo = ' style="color: red"';
					$tag = 'D';
				}
				elseif ( $saldo < 0 )
				{
					$estilo = ' style="color: blue"';
					$tag 	= 'C';
					$saldo	=	( $saldo * -1 );
				}

				// RETORNA DATA DA ÚLTIMA COMPRA ///////////////////////////////////////////////////////////////
				$r_ultima_compra	=	mysql_query("SELECT vendas1.datahora FROM vendas1 WHERE vendas1.id_cliente =  '$id_cliente' AND vendas1.pago =  'N' ORDER BY vendas1.datahora DESC LIMIT 1 ");
				if (mysql_num_rows($r_ultima_compra) > 0) {$ultima_compra	=	mysql_result($r_ultima_compra, 0, 'datahora');}
					
				// RETORNA DATA DO ÚLTIMO PAGAMENTO ///////////////////////////////////////////////////////////////
				$r_ultimo_pagamento	=	mysql_query("SELECT vendas1.datahora FROM vendas1 WHERE vendas1.id_cliente =  '$id_cliente' AND vendas1.pago =  'S' ORDER BY vendas1.datahora DESC LIMIT 1 ");
				if (mysql_num_rows($r_ultimo_pagamento) > 0) {$ultimo_pagamento	=	mysql_result($r_ultimo_pagamento, 0, 'datahora');}
					
				$linhas	.=	'      <tr>
        <td align="right" class="lista_linhas">' . ( $i + 1 ) . '</td>
        <td class="lista_linhas"><a href="clientes_editar.php?id_cliente='.$id_cliente.'" class="lista_link">' . $nome . '</a></td>
        <td align="center" class="lista_linhas" nowrap="nowrap">' . formata_data($ultima_compra) . '</td>
        <td align="center" class="lista_linhas" nowrap="nowrap">' . formata_data($ultimo_pagamento) . '</td>
        <td align="right" class="lista_linhas"' . $estilo . ' nowrap="nowrap">' . number_format( $saldo, 2, ',', '.' ) . $tag . '</td>
      </tr>
';

				$tpl->assign( 'linhas', $linhas );
			}
			else
			{
				$msg	=	'Erro ao obter saldo positivo do cliente #' . $id_cliente . '!';
			}
		}
		else
		{
			$msg	=	'Erro ao obter saldo negativo do cliente #' . $id_cliente . '!';
		}
	}

	$estilo	=	false;
	$tag	=	false;

	if ( $total > 0 )
	{
		$estilo = ' style="color: red"';
		$tag = 'D';
	}
	elseif ( $total < 0 )
	{
		$estilo = ' style="color: blue"';
		$tag 	= 'C';
		$total	=	( $total * -1 );
	}

	$tpl->assign( 'total', '<td align="right" class="lista_linhas"' . $estilo . '><strong>' . number_format( $total, 2, ',', '.' ) . $tag . '</strong></td>' );
}
else
{
	$msg	=	'Erro ao obter lista de clientes!';
}
/************************************************************************************/

$tpl->assign( 'msg', $msg );

/************************************************************************************/

$tpl->assign( 'conteudo', 'relVendaPrazo.html' );
$tpl->display( 'layout.html' );
?>