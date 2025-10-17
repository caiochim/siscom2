<?php	session_start();
	include( '../config.php' );
	valida();
	$tpl->assign( 'menu', gera_menu( $_SESSION['user_id'] ) );

	/************************************************************************************/
	$msg	=	$_SESSION['msg'];
	$_SESSION['msg']	=	false;
	
	$body		=	'onLoad="document.form1.nome.focus()"';
	$user_id	=	$_GET['id_user'];
	
	//////////////////////////////////////////////////////////////////////////////////////
	// Trocar senha //////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $_POST['senha'] )
	{
		$_SESSION['id_user_senha']	=	$user_id;
		header( 'Location: usuarios_senha.php' );
	}

	//////////////////////////////////////////////////////////////////////////////////////
	// Cancelar //////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $_POST['cancelar'] )
	{
		header( 'Location: usuarios.php' );
	}

	//////////////////////////////////////////////////////////////////////////////////////
	// Salvar ////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $_POST['salvar'] )
	{
		$nome		=	strtoupper( trim( $_POST['nome'] ) );
		$user		=	strtolower( trim( $_POST['user'] ) );
		$home		=	$_POST['home'];
		$permissoes	=	$_POST['permissoes'];
		
		if ( !$nome )
		{
			$msg	=	'Informe o nome do usuário!';
		}
		elseif ( !$user )
		{
			$msg	=	'Informe o login do usuário!';
			$body	=	'onLoad="document.form1.user.focus()"';
		}
		elseif ( !$home )
		{
			$msg	=	'Selecione a página inicial do usuário!';
			$body	=	'onLoad="document.form1.home.focus()"';
		}
		elseif ( count( $permissoes ) < 1 )
		{
			$msg	=	'Defina as permissões do usuário!';
		}
		else
		{
			if ( mysql_query( "update usuarios set nome='$nome', `user`='$user', home='$home' where (id='$user_id')" ) )
			{
				if ( mysql_query( "delete from permissoes where (id_user='$user_id')" ) )
				{
					for ( $i = 0; $i < count( $permissoes ); $i++ )
					{
						if ( mysql_query( "insert into permissoes (id_user, id_area) VALUES ('$user_id', '$permissoes[$i]')" ) )
						{
							$erro	=	false;
						}
						else
						{
							$erro	=	true;
						}
					}
					
					if ( !$erro )
					{
						$_SESSION['msg']	=	'Alterações salvas com sucesso!';
						header( 'Location: usuarios.php' );
					}
					else
					{
						$msg	=	'Erro ao gravar permissões!';
					}
				}
				else
				{
					$msg	=	'Erro ao resetar permissões do usuário!';
				}
			}
			else
			{
				$msg	=	'Erro ao salvar dados do usuário!';
			}
		}
	}

	//////////////////////////////////////////////////////////////////////////////////////
	// Dados para o form /////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $result = mysql_query( "Select usuarios.nome, usuarios.`user`, usuarios.home From usuarios Where usuarios.id = '$user_id'" ) )
	{
		$tpl->assign( 'nome', mysql_result( $result, 0, 'nome' ) );
		$tpl->assign( 'user', mysql_result( $result, 0, 'user' ) );
		$id_home	=	mysql_result( $result, 0, 'home' );
	}
	else
	{
		$msg	=	'Ocorreu um erro ao recuperar dados!';
	}
	
	//////////////////////////////////////////////////////////////////////////////////////
	// Select home ///////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $result = mysql_query( "Select areas.id, areas.area From areas Order By areas.area Asc" ) )
	{
		for ( $i = 0; $i < mysql_num_rows( $result ); $i++ )
		{
			$id_area	=	mysql_result( $result, $i, 'id' );
			$area		=	mysql_result( $result, $i, 'area' );
			
			if ( $id_area == $id_home ) { $a = ' selected="selected"'; } else { $a = ''; }
			
			$select_area	.=	'            <option value="' . $id_area . '"' . $a . '>' . $area . '</option>
';
		}
		
		$tpl->assign( 'select_area', $select_area );
	}
	else
	{
		$msg	=	'Erro gerando lista home!';
	}
	
	//////////////////////////////////////////////////////////////////////////////////////
	// Permissões ////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	if ( $result = mysql_query( "Select areas.id, areas.area From areas Order By areas.area Asc" ) )
	{
		for ( $i = 0; $i < mysql_num_rows( $result ); $i++ )
		{
			$id_area	=	mysql_result( $result, $i, 'id' );
			$area		=	mysql_result( $result, $i, 'area' );
			
			if ( $result2 = mysql_query( "Select permissoes.id From permissoes Where permissoes.id_user = '$user_id' AND permissoes.id_area = '$id_area'" ) )
			{
				if ( mysql_num_rows( $result2 ) == 1 ) { $a = ' checked="checked"'; } else { $a = ''; }
			}
			else
			{
				$msg	=	'Erro ao definir permissão!';
			}
			
			$check_permissoes	.=	'      <tr>
        <td><input name="permissoes[]" type="checkbox" id="permissoes[]" value="' . $id_area . '"' . $a . ' />
          ' . $area . '</td>
      </tr>
';
		}
		
		$tpl->assign( 'check_permissoes', $check_permissoes );
	}
	else
	{
		$msg	=	'Erro gerando lista de permissões!';
	}
	
	//////////////////////////////////////////////////////////////////////////////////////
	
	$tpl->assign( 'body', $body );
	$tpl->assign( 'msg', $msg );

	/************************************************************************************/

	$tpl->assign( 'conteudo', 'usuarios_editar.html' );
	$tpl->display( 'layout.html' );
?>