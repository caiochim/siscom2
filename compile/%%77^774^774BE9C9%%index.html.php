<?php /* Smarty version 2.6.22, created on 2016-05-02 05:54:35
         compiled from index.html */ ?>
<link href="../style.css" rel="stylesheet" type="text/css">
<form name="form1" method="post" action="">
  <div class="cabecalho1">Autentica&ccedil;&atilde;o</div>
  <?php if ($this->_tpl_vars['msg']): ?>
  <div class="msg"><?php echo $this->_tpl_vars['msg']; ?>
</div>
  <?php endif; ?>
  <div align="center" style="padding: 15px">
    <table border="1" cellpadding="5" cellspacing="0" class="tb_pass">
      <tr>
        <td class="tb_pass">Usu&aacute;rio:</td>
        <td class="tb_pass"><input name="user" type="text" id="user" value="<?php echo $this->_tpl_vars['user']; ?>
"></td>
      </tr>
      <tr>
        <td class="tb_pass">Senha:</td>
        <td class="tb_pass"><input type="password" name="pass" id="pass"></td>
      </tr>
      <tr>
        <td colspan="2" align="right" class="td_pass"><input name="entrar" type="submit" id="entrar" value="Entrar"></td>
      </tr>
    </table>
  </div>
  <div class="rodape1">&nbsp;</div>
</form>