<?php /* Smarty version 2.6.22, created on 2011-11-25 01:37:17
         compiled from home.html */ ?>
<link href="../style.css" rel="stylesheet" type="text/css">
<?php if ($this->_tpl_vars['msg']): ?><div class="msg"><?php echo $this->_tpl_vars['msg']; ?>
</div><?php endif; ?>
<br />
<table width="300" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td colspan="3" align="center" class="lista_cabecalho">Vendas</td>
  </tr>
  <tr>
    <td align="center" class="lista_cabecalho">Ontem</td>
    <td align="center" class="lista_cabecalho">Hoje</td>
    <td align="center" class="lista_cabecalho">Este m&ecirc;s</td>
  </tr>
  <tr>
    <td align="center" class="lista_linhas">R$<?php echo $this->_tpl_vars['ontem']; ?>
</td>
    <td align="center" class="lista_linhas">R$<?php echo $this->_tpl_vars['hoje']; ?>
</td>
    <td align="center" class="lista_linhas">R$<?php echo $this->_tpl_vars['mes']; ?>
</td>
  </tr>
</table>
<br />
<div class="rodape1">&nbsp;</div>