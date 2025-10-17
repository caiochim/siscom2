<?php /* Smarty version 2.6.22, created on 2011-12-15 22:33:53
         compiled from relFatPeriodo.html */ ?>
<link href="../style.css" rel="stylesheet" type="text/css" />
<form id="form1" name="form1" method="post" action="">
  <div class="cabecalho1">Relat&oacute;rios - Faturamento por Per&iacute;odo</div>
  <div class="cabecalho2"> &nbsp;</div>
  <?php if ($this->_tpl_vars['msg']): ?>
  <div class="msg"><?php echo $this->_tpl_vars['msg']; ?>
</div>
  <?php endif; ?>
  <div style="padding: 15px">Informe o per&iacute;odo desejado:<br />
    <br />
    De: <?php echo $this->_tpl_vars['select_inicio']; ?>
 | At&eacute;: <?php echo $this->_tpl_vars['select_fim']; ?>

    <input type="submit" name="gerar_relatorio" id="gerar_relatorio" value="Gerar relat&oacute;rio" />
</div>
  <?php if ($this->_tpl_vars['avista']): ?>
  <hr />
  <div style="padding: 15px"> Per&iacute;odo: de <?php echo $this->_tpl_vars['inicio']; ?>
 at&eacute; <?php echo $this->_tpl_vars['fim']; ?>
 <br />
      <br />
    <table border="0" align="center" cellpadding="2" cellspacing="0">
      <tr>
        <td>Venda a vista:</td>
        <td align="right">R$<?php echo $this->_tpl_vars['avista']; ?>
</td>
      </tr>
      <tr>
        <td>Venda a prazo:</td>
        <td align="right">R$<?php echo $this->_tpl_vars['aprazo']; ?>
</td>
      </tr>
      <tr>
        <td>Recebimento de contas:</td>
        <td align="right">R$<?php echo $this->_tpl_vars['contas']; ?>
</td>
      </tr>
    </table>
  </div>
  <?php endif; ?>
  <div class="rodape1">&nbsp;</div>
</form>