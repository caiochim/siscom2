<?php
	session_start();
	
	/*****************************************************
	***** IMPORTAÇÃO DO BANCO DE DADOS DO SISTEMA-SC *****
	*****************************************************/
	mysql_connect( 'localhost', 'root', 'password' );
	mysql_select_db( 'siscom2' );
	
	if ( $result = mysql_query( "Select cadpro.PROCOD, cadpro.PRODES, cadpro.PROCUSTO, cadpro.PROPRECOVENDA, cadpro.PROESTATUAL, cadpro.DTINS, cadpro.DTUPD From cadpro" ) )
	{
		for ( $i = 0; $i < mysql_num_rows( $result ); $i++ )
		{
			$codigo	=	mysql_result( $result, $i, 'PROCOD' );
			$descricao	=	addslashes( mysql_result( $result, $i, 'PRODES' ) );
			$custo	=	mysql_result( $result, $i, 'PROCUSTO' );
			$venda	=	mysql_result( $result, $i, 'PROPRECOVENDA' );
			$estoque	=	mysql_result( $result, $i, 'PROESTATUAL' );
			$incluido	=	mysql_result( $result, $i, 'DTINS' );
			$alterado	=	mysql_result( $result, $i, 'DTUPD' );

			if ( mysql_query( "insert into produtos (codigo, descricao, custo, venda, estoque, incluido, alterado) VALUES ('$codigo', '$descricao', '$custo', '$venda', '$estoque', '$incluido', '$alterado')" ) )
			{
				$x++;
			}
			else
			{
				$erro	.=	'ERRO AO REGISTRAR DADOS NO DESTINO. CÓDIGO: ' . $codigo . '<br>';
			}
		}
		
		$erro	.=	'REGISTROS INSERIDOS: ' . $x;
	}
	else
	{
		$erro	.=	'ERRO AO BUSCAR DADOS NA ORIGEM';
	}
	
	echo $erro;
?>