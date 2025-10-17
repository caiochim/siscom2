<pre>
<?php
	session_start();
	
	function gera_dv( $x )
	{
		$soma	+=	( $x[0] * 5 );
		$soma	+=	( $x[1] * 4 );
		$soma	+=	( $x[2] * 3 );
		$soma	+=	( $x[3] * 2 );
		$soma	+=	( $x[4] * 9 );
		$soma	+=	( $x[5] * 8 );
		$soma	+=	( $x[6] * 7 );
		$soma	+=	( $x[7] * 6 );
		$soma	+=	( $x[8] * 5 );
		$soma	+=	( $x[9] * 4 );
		$soma	+=	( $x[10] * 3 );
		$soma	+=	( $x[11] * 2 );
//		$soma	+=	( $x[1] * 6 );
//		$soma	+=	( $x[2] * 5 );
//		$soma	+=	( $x[3] * 4 );
//		$soma	+=	( $x[4] * 3 );
//		$soma	+=	( $x[5] * 2 );
		
		$dv	=	( $soma % 11 );
		$dv	=	$dv < 2 ? 0 : 11 - $dv;
		
		return $dv;
	}

	function gera_cartao()
	{
		for ( $i = 1; $i < 101; $i++ )
		{
			$x	=	$i;
			
			while ( strlen( $x ) < 12 )
			{
				$x	=	'0' . $x;
			}
			
			echo gera_dv( $x ) . $x . '
';
		}
	}
	
	gera_cartao();
?>
</pre>