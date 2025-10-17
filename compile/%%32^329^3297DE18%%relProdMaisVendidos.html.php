<?php /* Smarty version 2.6.22, created on 2011-12-21 10:28:25
         compiled from relProdMaisVendidos.html */ ?>
<form id="form1" name="form1" method="post" action="">
  <div class="cabecalho1">Relat&oacute;rios - Produtos Mais Vendidos</div>
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
    <br />
    <br />
    Ordenar por:
    <input name="ordem" type="radio" id="radio2" value="qtde" checked="checked" />
    Quantidade |
    <input name="ordem" type="radio" id="radio" value="subtotal" />
    Subtotal</div>
  <?php if ($this->_tpl_vars['linhas']): ?>
  <hr />
  <div style="padding: 15px">    Per&iacute;odo: de <?php echo $this->_tpl_vars['inicio']; ?>
 at&eacute; <?php echo $this->_tpl_vars['fim']; ?>
<br />
    <table border="0" cellpadding="3" cellspacing="1">
      <tr>
        <td class="lista_cabecalho">#</td>
        <td class="lista_cabecalho">C&oacute;digo</td>
        <td class="lista_cabecalho">Descri&ccedil;&atilde;o</td>
        <td class="lista_cabecalho">Qtde</td>
        <td class="lista_cabecalho">Subtotal (R$)</td>
      </tr>
      <!--      <tr>
        <td align="right" class="lista_linhas">n</td>
        <td class="lista_linhas">codigo</td>
        <td class="lista_linhas">descricao</td>
        <td align="right" class="lista_linhas">888</td>
        <td align="right" class="lista_linhas">R$888.888,88</td>
      </tr>
-->
      <?php echo $this->_tpl_vars['linhas']; ?>

    </table>
  </div>
  <?php endif; ?>
  <div class="rodape1">&nbsp;</div>
</form>