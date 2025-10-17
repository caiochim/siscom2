<?php /* Smarty version 2.6.22, created on 2012-01-07 13:50:18
         compiled from clientes_historico.html */ ?>
<link href="../style.css" rel="stylesheet" type="text/css">
<form id="form1" name="form1" method="post" action="">
<div class="cabecalho1">Clientes - Hist&oacute;rico de Compras</div>
<div class="cabecalho2"><!--    <input type="submit" name="salvar" id="salvar" value="Salvar" />
    <input type="submit" name="cancelar" id="cancelar" value="Cancelar" />
--></div>
<?php if ($this->_tpl_vars['msg']): ?>
<div class="msg"><?php echo $this->_tpl_vars['msg']; ?>
</div>
<?php endif; ?>
<div style="padding: 15px"> Cliente: <?php echo $this->_tpl_vars['cliente']; ?>
 <br />
Saldo atual: R$ <?php echo $this->_tpl_vars['saldo']; ?>
 <br />
  <br />
  <table border="0" cellpadding="2" cellspacing="1">
  <tr>
    <td colspan="5" class="lista_cabecalho">Data</td>
	  </tr>
  <tr>
    <td class="lista_cabecalho">C&oacute;digo</td>
		  <td class="lista_cabecalho">Descri&ccedil;&atilde;o</td>
		  <td class="lista_cabecalho">Qtde</td>
		  <td class="lista_cabecalho">Unit&aacute;rio</td>
		  <td class="lista_cabecalho">Subtotal</td>
	  </tr>
  <!--	<tr>
		<td colspan="5" class="lista_linhas"><strong>&raquo;
		data &laquo;</strong></td>
	</tr>
	<tr>
		<td class="lista_linhas">cod</td>
		<td class="lista_linhas">desc</td>
		<td class="lista_linhas">qtde</td>
		<td class="lista_linhas">unit</td>
		<td class="lista_linhas">subt</td>
	</tr>
-->	<?php echo $this->_tpl_vars['linhas']; ?>

  </table>
</div><div class="rodape1">&nbsp;</div>
</form>