<?php /* Smarty version 2.6.22, created on 2016-05-02 05:36:49
         compiled from pdv_layout.html */ ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php echo '
<link href="../style_pdv.css" rel="stylesheet" type="text/css">
'; ?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SisCom2</title>
</head>
<body <?php echo $this->_tpl_vars['body']; ?>
>
<form name="form1" method="post" action="">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" height="100%">
    <tr>
      <td colspan="2"><table width="100%" border="0" cellpadding="10" cellspacing="0" bgcolor="#90EE90" style="filter: alpha:">
          <tr>
            <td><span class="style2">Rose Conveni&ecirc;ncia e Cafeteria</span></td>
            <td align="right" class="style2">CAIXA</td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td height="100%" colspan="2" valign="top" style="padding: 10px"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['conteudo'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
    </tr>
    <tr>
      <td bgcolor="#90EE90" style="padding: 10px">Usu&aacute;rio: <?php echo $this->_tpl_vars['usuario']; ?>
</td>
      <td align="right" bgcolor="#90EE90" style="padding: 10px">SisCom2 - v20090217b - Rose</td>
    </tr>
  </table>
</form>
</body>
</html>