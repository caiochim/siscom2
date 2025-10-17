<?php /* Smarty version 2.6.22, created on 2013-12-20 01:38:45
         compiled from fornecedores_adicionar.html */ ?>
<link href="../style.css" rel="stylesheet" type="text/css">
<form id="form1" name="form1" method="post" action="">
  <div class="cabecalho1">Fornecedores</div>
  <div class="cabecalho2">
    <input type="submit" name="salvar" id="salvar" value="Salvar" />
    <input type="submit" name="cancelar" id="cancelar" value="Cancelar" />
  </div>
  <?php if ($this->_tpl_vars['msg']): ?>
  <div class="msg"><?php echo $this->_tpl_vars['msg']; ?>
</div>
  <?php endif; ?>
  <div style="padding: 15px">
    <table border="0" cellpadding="2" cellspacing="0">
      <tr>
        <td>Nome/Raz&atilde;o Social:</td>
      </tr>
      <tr>
        <td><input name="fornecedor" type="text" id="fornecedor" style="width: 400px" value="<?php echo $this->_tpl_vars['fornecedor']; ?>
" maxlength="255" /></td>
      </tr>
    </table>
  </div>
  <div class="rodape1">&nbsp;</div>
</form>