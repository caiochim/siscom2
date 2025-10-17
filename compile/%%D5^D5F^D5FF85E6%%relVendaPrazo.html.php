<?php /* Smarty version 2.6.22, created on 2011-11-25 01:41:37
         compiled from relVendaPrazo.html */ ?>
<link href="../style.css" rel="stylesheet" type="text/css" />
<form id="form1" name="form1" method="post" action="">
<div class="cabecalho1">Relat&oacute;rios - Vendas a Prazo</div>
<div class="cabecalho2">&nbsp;</div>
<?php if ($this->_tpl_vars['msg']): ?>
<div class="msg"><?php echo $this->_tpl_vars['msg']; ?>
</div>
<?php endif; ?>
<div style="padding: 15px">
<table border="0" cellpadding="2" cellspacing="1">
	<tr>
		<td class="lista_cabecalho">#</td>
		<td class="lista_cabecalho">Cliente</td>
		<td width="50" class="lista_cabecalho">&Uacute;ltima Compra</td>
		<td width="50" class="lista_cabecalho">&Uacute;ltimo Pagamento</td>
		<td class="lista_cabecalho">Saldo (R$)</td>
	</tr>
	<?php echo $this->_tpl_vars['linhas']; ?>

	<tr>
		<td colspan="4" align="right" class="lista_linhas"><strong>TOTAL:</strong></td>
		<?php echo $this->_tpl_vars['total']; ?>

	</tr>
</table>
</div>
</form>