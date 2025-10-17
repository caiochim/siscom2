<?php /* Smarty version 2.6.22, created on 2011-11-25 01:43:38
         compiled from usuarios_senha.html */ ?>
<link href="../style.css" rel="stylesheet" type="text/css">
<form id="form1" name="form1" method="post" action="">
  <div class="cabecalho1">Usu&aacute;rios - Troca da senha</div>
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
        <td>Nome:</td>
        <td><?php echo $this->_tpl_vars['nome']; ?>
</td>
      </tr>
      <tr>
        <td>Usu&aacute;rio:</td>
        <td><?php echo $this->_tpl_vars['user']; ?>
</td>
      </tr>
    </table>
    <br />
    <table border="0" cellpadding="2" cellspacing="0">
      <tr>
        <td>Nova senha:</td>
        <td><input name="senha1" type="password" id="senha1" value="<?php echo $this->_tpl_vars['senha1']; ?>
" /></td>
      </tr>
      <tr>
        <td>Repita a nova senha:</td>
        <td><input name="senha2" type="password" id="senha2" value="<?php echo $this->_tpl_vars['senha2']; ?>
" /></td>
      </tr>
    </table>
  </div>
  <div class="rodape1">&nbsp;</div>
</form>