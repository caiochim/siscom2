<?php /* Smarty version 2.6.22, created on 2011-11-25 01:41:34
         compiled from relCaixa.html */ ?>

<form id="form1" name="form1" method="post" action="">
<div class="cabecalho1">Relat&oacute;rios - Fechamento de Caixa</div>
<div class="cabecalho2">&nbsp;</div>
<?php if ($this->_tpl_vars['msg']): ?>
<div class="msg"><?php echo $this->_tpl_vars['msg']; ?>
</div>
<?php endif; ?>
<div style="padding: 15px">Informe a data desejada:<br />
<br />
<?php echo $this->_tpl_vars['select_data']; ?>
 <input type="submit" name="gerar_relatorio"
	id="gerar_relatorio" value="Gerar relat&oacute;rio" /></div>
<?php if ($this->_tpl_vars['linhas']): ?>
<hr />
<div style="padding: 15px">Data: <?php echo $this->_tpl_vars['data']; ?>

<table border="0" align="center" cellpadding="3" cellspacing="1">
	<tr>
		<td class="lista_cabecalho">Usu&aacute;rio</td>
		<td class="lista_cabecalho">Subtotal (R$)</td>
		<td class="lista_cabecalho">Recargas (R$)</td>
	</tr>
	<?php echo $this->_tpl_vars['linhas']; ?>

	<tr>
		<td align="right" class="lista_linhas"><strong>TOTAL:</strong></td>
		<td align="right" class="lista_linhas"><strong><?php echo $this->_tpl_vars['total']; ?>
</strong></td>
		<td align="right" class="lista_linhas">&nbsp;</td>
	</tr>
</table>
</div>
<?php endif; ?>
<div class="rodape1">&nbsp;</div>
</form>