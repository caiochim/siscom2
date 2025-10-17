<?php /* Smarty version 2.6.22, created on 2011-11-25 01:41:21
         compiled from produtos.html */ ?>
<link href="../style.css" rel="stylesheet" type="text/css">
<form id="form1" name="form1" method="post" action="">
  <div class="cabecalho1">Produtos</div>
  <div class="cabecalho2">
    <input type="submit" name="adicionar" id="adicionar" value="Adicionar" />
  </div>
  <?php if ($this->_tpl_vars['msg']): ?>
  <div class="msg"><?php echo $this->_tpl_vars['msg']; ?>
</div>
  <?php endif; ?>
  <div style="padding: 15px" align="right">C&oacute;digo:
    <input name="q" type="text" id="q" value="<?php echo $this->_tpl_vars['q']; ?>
" />
  </div>
  <div style="padding: 15px">
    <div align="right">Registros: <?php echo $this->_tpl_vars['total']; ?>
 </div>
    <table border="0" cellpadding="2" cellspacing="1">
      <tr>
        <td class="lista_cabecalho">#</td>
        <td class="lista_cabecalho">C&oacute;digo</td>
        <td class="lista_cabecalho">Descri&ccedil;&atilde;o do produto</td>
        <td class="lista_cabecalho">Estoque</td>
      </tr>
      <?php echo $this->_tpl_vars['linhas']; ?>

    </table>
  </div>
  <div class="rodape1">&nbsp;</div>
</form>