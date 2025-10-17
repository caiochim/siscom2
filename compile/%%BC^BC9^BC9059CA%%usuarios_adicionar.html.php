<?php /* Smarty version 2.6.22, created on 2011-11-25 01:44:03
         compiled from usuarios_adicionar.html */ ?>
<link href="../style.css" rel="stylesheet" type="text/css">
<form id="form1" name="form1" method="post" action="">
  <div class="cabecalho1">Usu&aacute;rios</div>
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
      </tr>
      <tr>
        <td><input name="nome" type="text" id="nome" style="width: 400px" value="<?php echo $this->_tpl_vars['nome']; ?>
" maxlength="255" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Usu&aacute;rio:</td>
      </tr>
      <tr>
        <td><input name="user" type="text" id="user" style="width: 400px" value="<?php echo $this->_tpl_vars['user']; ?>
" maxlength="255" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td style="padding: 0px"><table border="0" cellpadding="2" cellspacing="0">
            <tr>
              <td>Digite a senha:</td>
              <td><input name="senha1" type="password" id="senha1" value="<?php echo $this->_tpl_vars['senha1']; ?>
" /></td>
            </tr>
            <tr>
              <td>Repita a senha:</td>
              <td><input name="senha2" type="password" id="senha2" value="<?php echo $this->_tpl_vars['senha2']; ?>
" /></td>
            </tr>
          </table></td>
      </tr>
    </table>
  </div>
  <div class="rodape1">&nbsp;</div>
</form>