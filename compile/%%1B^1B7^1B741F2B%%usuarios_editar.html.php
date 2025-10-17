<?php /* Smarty version 2.6.22, created on 2011-11-25 01:43:20
         compiled from usuarios_editar.html */ ?>
<link href="../style.css" rel="stylesheet" type="text/css">
<form id="form1" name="form1" method="post" action="">
  <div class="cabecalho1">Usu&aacute;rios</div>
  <div class="cabecalho2">
    <input type="submit" name="salvar" id="salvar" value="Salvar" />
    <input type="submit" name="cancelar" id="cancelar" value="Cancelar" />
    <input type="submit" name="excluir" id="excluir" value="Excluir" />
  </div>
  <?php if ($this->_tpl_vars['msg']): ?>
  <div class="msg"><?php echo $this->_tpl_vars['msg']; ?>
</div>
  <?php endif; ?>
  <div style="padding: 15px">
    <table border="0" cellpadding="2" cellspacing="0">
      <tr>
        <td align="right"><input type="submit" name="senha" id="senha" value="Trocar senha" /></td>
      </tr>
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
        <td>Home:</td>
      </tr>
      <tr>
        <td><select name="home" id="home" style="width: 400px">
          <option value="0">-- SELECIONE A P&Aacute;GINA INICIAL --</option>
          
<?php echo $this->_tpl_vars['select_area']; ?>
          
          </select>        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Permiss&otilde;es:</td>
      </tr>
      <!--<tr>
        <td><input name="permissoes[]" type="checkbox" id="permissoes[]" value="<?php echo $this->_tpl_vars['id_area']; ?>
" checked="checked" />
          Home</td>
      </tr>-->
      <?php echo $this->_tpl_vars['check_permissoes']; ?>

    </table>
  </div>
  <div class="rodape1">&nbsp;</div>
</form>