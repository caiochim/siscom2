<?php /* Smarty version 2.6.22, created on 2011-11-30 17:27:57
         compiled from produtos_editar.html */ ?>
<link href="../style.css" rel="stylesheet" type="text/css">
<form id="form1" name="form1" method="post" action="">
  <div class="cabecalho1">Produtos</div>
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
        <td>C&oacute;digo:
          <input name="codigo" type="text" id="codigo" value="<?php echo $this->_tpl_vars['codigo']; ?>
" style="width: 200px" disabled="disabled" />
          <input name="codigo" type="hidden" id="codigo" value="<?php echo $this->_tpl_vars['codigo']; ?>
" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Descri&ccedil;&atilde;o:</td>
      </tr>
      <tr>
        <td><input name="descricao" type="text" id="descricao" value="<?php echo $this->_tpl_vars['descricao']; ?>
" style="width: 400px" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td style="padding: 0px"><table border="0" cellpadding="2" cellspacing="0">
            <tr>
              <td>Pre&ccedil;o Custo:</td>
              <td width="20">&nbsp;</td>
              <td>Pre&ccedil;o Venda:</td>
              <td width="20">&nbsp;</td>
              <td>Estoque Atual:</td>
            </tr>
            <tr>
              <td><input name="custo" type="text" id="custo" style="width: 100px; text-align: right" value="<?php echo $this->_tpl_vars['custo']; ?>
" /></td>
              <td>&nbsp;</td>
              <td><input name="venda" type="text" id="venda" style="width: 100px; text-align: right" value="<?php echo $this->_tpl_vars['venda']; ?>
" /></td>
              <td>&nbsp;</td>
              <td><input name="estoque" type="text" id="estoque" style="width: 100px; text-align: right" value="<?php echo $this->_tpl_vars['estoque']; ?>
" /></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Fornecedor:</td>
      </tr>
      <tr>
        <td><select name="id_fornecedor" id="id_fornecedor" style="width: 400px">
            <option value="0">-- SELECIONE O FORNECEDOR --</option>
          
<?php echo $this->_tpl_vars['fornecedores']; ?>
          
          
        </select></td>
      </tr>
    </table>
  </div>
  <div class="rodape1">Inclu&iacute;do em: <?php echo $this->_tpl_vars['incluido']; ?>
 | Alterado em: <?php echo $this->_tpl_vars['alterado']; ?>
</div>
</form>