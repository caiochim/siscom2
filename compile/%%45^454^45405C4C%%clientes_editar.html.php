<?php /* Smarty version 2.6.22, created on 2012-01-07 13:50:13
         compiled from clientes_editar.html */ ?>
<link href="../style.css" rel="stylesheet" type="text/css">
<form id="form1" name="form1" method="post" action="">
  <div class="cabecalho1">Clientes</div>
  <div class="cabecalho2">
    <input type="submit" name="salvar" id="salvar" value="Salvar" />
    <input type="submit" name="cancelar" id="cancelar" value="Cancelar" />
  </div>
  <?php if ($this->_tpl_vars['msg']): ?>
  <div class="msg"><?php echo $this->_tpl_vars['msg']; ?>
</div>
  <?php endif; ?>
  <div style="padding: 15px">    [ <a href="clientes_historico.php?id_cliente=<?php echo $this->_tpl_vars['id_cliente']; ?>
">hist&oacute;rico do cliente</a> ] <br />
    <br />
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
        <td>Status:</td>
      </tr>
      <tr>
        <td><input name="status" type="radio" id="radio" value="A"<?php if ($this->_tpl_vars['status'] == 'A'): ?> checked="checked"<?php endif; ?> />
          ATIVO &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="status" id="radio2" value="I"<?php if ($this->_tpl_vars['status'] == 'I'): ?> checked="checked"<?php endif; ?> />
          INATIVO</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Endere&ccedil;o:</td>
      </tr>
      <tr>
        <td><input name="endereco" type="text" id="endereco" style="width: 400px" value="<?php echo $this->_tpl_vars['endereco']; ?>
" maxlength="255" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Bairro:</td>
      </tr>
      <tr>
        <td><input name="bairro" type="text" id="bairro" style="width: 400px" value="<?php echo $this->_tpl_vars['bairro']; ?>
" maxlength="255" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Cidade:</td>
      </tr>
      <tr>
        <td><input name="cidade" type="text" id="cidade" style="width: 400px" value="<?php echo $this->_tpl_vars['cidade']; ?>
" maxlength="255" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td style="padding: 0px"><table border="0" cellpadding="2" cellspacing="0">
          <tr>
            <td>Estado:</td>
            <td width="10">&nbsp;</td>
            <td>CEP:</td>
            <td width="10">&nbsp;</td>
            <td>Telefone:</td>
            </tr>
          <tr>
            <td><?php echo $this->_tpl_vars['estado']; ?>
            </td>
            <td>&nbsp;</td>
            <td><input name="cep" type="text" id="cep" style="width: 65px" value="<?php echo $this->_tpl_vars['cep']; ?>
" maxlength="8" /></td>
            <td>&nbsp;</td>
            <td><input name="ddd" type="text" id="ddd" style="width: 25px" value="<?php echo $this->_tpl_vars['ddd']; ?>
" maxlength="2" />
              <input name="fone" type="text" id="fone" style="width: 65px" value="<?php echo $this->_tpl_vars['fone']; ?>
" maxlength="8" /></td>
            </tr>

        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Observa&ccedil;&otilde;es:</td>
      </tr>
      <tr>
        <td><textarea name="observacoes" id="observacoes" style="width: 400px; height: 50px"><?php echo $this->_tpl_vars['observacoes']; ?>
</textarea></td>
      </tr>
    </table>
  </div>
  <div class="rodape1">&nbsp;</div>
</form>