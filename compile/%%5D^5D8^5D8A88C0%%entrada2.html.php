<?php /* Smarty version 2.6.22, created on 2016-05-02 18:28:23
         compiled from entrada2.html */ ?>
<link href="../style.css" rel="stylesheet" type="text/css">
<div class="cabecalho1">Entrada de Produtos</div>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <form id="form1" name="form1" method="post" action="">
    <tr>
      <td><div class="cabecalho2">
          <input type="submit" name="salvar" id="salvar" value="Salvar" />
          <input type="submit" name="cancelar" id="cancelar" value="Cancelar" />
        </div></td>
    </tr>
  </form>
</table>
<?php if ($this->_tpl_vars['msg']): ?>
<div class="msg"><?php echo $this->_tpl_vars['msg']; ?>
</div>
<?php endif; ?>
<div style="padding: 15px">
  <table border="0" cellpadding="2" cellspacing="0">
    <tr>
      <td>Fornecedor:</td>
    </tr>
    <tr>
      <td bgcolor="#DDDDDD"> <?php echo $this->_tpl_vars['fornecedor']; ?>
</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td style="padding: 0px"><table border="0" cellpadding="2" cellspacing="0">
          <tr>
            <td>Nota Fiscal N&ordm;:</td>
            <td width="20">&nbsp;</td>
            <td>Data de Emiss&atilde;o:</td>
            <td width="20">&nbsp;</td>
            <td>Valor total da nota:</td>
          </tr>
          <tr>
            <td align="center" bgcolor="#DDDDDD"> <?php echo $this->_tpl_vars['nfnro']; ?>
 </td>
            <td>&nbsp;</td>
            <td align="center" bgcolor="#DDDDDD"><?php echo $this->_tpl_vars['data_emissao']; ?>
</td>
            <td>&nbsp;</td>
            <td align="center" bgcolor="#DDDDDD">R$<?php echo $this->_tpl_vars['total_nota']; ?>
</td>
          </tr>
        </table></td>
    </tr>
  </table>
</div>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <form id="form2" name="form1" method="post" action="">
    <tr>
      <td><div class="cabecalho2"> <?php if ($this->_tpl_vars['id_produto']): ?>
          <input type="submit" name="adicionar" id="adicionar" value="Adicionar" />
          <?php else: ?>
          <input type="submit" name="avancar" id="avancar" value="Avan&ccedil;ar" />
          <?php endif; ?>
          <input type="submit" name="excluir" id="excluir" value="Excluir" />
          &nbsp;</div></td>
    </tr>
    <tr>
      <td style="padding: 15px"><?php if ($this->_tpl_vars['id_produto']): ?>
        <table border="0" cellpadding="2" cellspacing="1">
          <tr>
            <td>C&oacute;digo:</td>
            <td width="10">&nbsp;</td>
            <td>Descri&ccedil;&atilde;o:</td>
            <td width="10">&nbsp;</td>
            <td>Qtde:</td>
            <td width="10">&nbsp;</td>
            <td>Custo:</td>
          </tr>
          <tr>
            <td bgcolor="#DDDDDD"><input name="id_fornecedor" type="hidden" id="id_fornecedor" value="<?php echo $this->_tpl_vars['id_fornecedor']; ?>
" />
              <input name="id_produto" type="hidden" id="id_produto" value="<?php echo $this->_tpl_vars['id_produto']; ?>
" />
              <input name="codigo" type="hidden" id="codigo" value="<?php echo $this->_tpl_vars['codigo']; ?>
" />
              <?php echo $this->_tpl_vars['codigo']; ?>
</td>
            <td>&nbsp;</td>
            <td bgcolor="#DDDDDD"><input name="descricao" type="hidden" id="descricao" value="<?php echo $this->_tpl_vars['descricao']; ?>
" />
              <?php echo $this->_tpl_vars['descricao']; ?>
</td>
            <td>&nbsp;</td>
            <td><input name="qtde" type="text" id="qtde" style="width: 50px; text-align: right" value="<?php echo $this->_tpl_vars['qtde']; ?>
" /></td>
            <td>&nbsp;</td>
            <td><input name="custo" type="text" id="custo" style="width: 80px; text-align: right" value="<?php echo $this->_tpl_vars['custo']; ?>
" />
              <input name="venda" type="hidden" id="venda" value="<?php echo $this->_tpl_vars['venda']; ?>
" /></td>
          </tr>
        </table>
        <?php else: ?>C&oacute;digo do produto:
        <input type="text" name="iCodigo" id="iCodigo" style="width: 150px" />
        <?php endif; ?></td>
    </tr>
    <tr>
      <td class="cabecalho2">Total: R$<?php echo $this->_tpl_vars['total']; ?>
</td>
    </tr>
    <tr>
      <td style="padding: 15px"><table border="0" cellpadding="2" cellspacing="1">
          <tr>
            <td class="lista_cabecalho">&nbsp;</td>
            <td class="lista_cabecalho">C&oacute;digo</td>
            <td class="lista_cabecalho">Descri&ccedil;&atilde;o</td>
            <td class="lista_cabecalho">Qtde</td>
            <td class="lista_cabecalho">Unit&aacute;rio</td>
            <td class="lista_cabecalho">Subtotal</td>
            <td class="lista_cabecalho">Estoque</td>
          </tr>
<!--          <tr>
            <td class="lista_linhas"><input name="lid" type="checkbox" id="lid" value="$lid" /></td>
            <td class="lista_linhas">codigo</td>
            <td class="lista_linhas">descricao</td>
            <td align="right" class="lista_linhas">qtde</td>
            <td align="right" class="lista_linhas">unitario</td>
            <td align="right" class="lista_linhas">subtotal</td>
            <td align="right" class="lista_linhas">estoque</td>
          </tr>
--><?php echo $this->_tpl_vars['lista']; ?>
        </table></td>
    </tr>
  </form>
</table>
<div class="rodape1">&nbsp;</div>