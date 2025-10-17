<?php /* Smarty version 2.6.22, created on 2014-06-03 01:38:50
         compiled from layout.html */ ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<link href="../style.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SisCom2</title>
</head>
<body <?php echo $this->_tpl_vars['body']; ?>
>
<table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="background: #FFFFFF url(../logomarca.jpg) center no-repeat">
  <tr>
    <td colspan="2" align="center" class="border_bottom" style="padding: 5px"><strong>Rose Conveni&ecirc;ncia e Cafeteria<br>
      Sistema Comercial - SisCom2</strong></td>
  </tr>
  <tr>
    <td width="170" height="100%" valign="top" class="border_right" style="padding: 15px">
	<?php if (valida_menu ( )): ?><?php echo $this->_tpl_vars['menu']; ?>
&raquo; <a href="logout.php">Sair</a><?php endif; ?>&nbsp;</td>
    <td valign="top"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['conteudo'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
  </tr>
  <tr>
    <td colspan="2" align="center" class="border_top" style="padding: 5px">SisCom2 - v20090128b - <a href="http://">Rose</a></td>
  </tr>
</table>
</body>
</html>