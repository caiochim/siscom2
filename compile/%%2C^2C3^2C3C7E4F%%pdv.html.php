<?php /* Smarty version 2.6.22, created on 2011-11-25 01:41:24
         compiled from pdv.html */ ?>
<?php echo '
<script src="../shortcut.js" type="text/javascript"></script>
<script>
shortcut.add( "ESC",
	function() {
		if ( confirm( \'Tem certeza que deseja cancelar a venda?\' ) )
		{
			document.location = \'?esc=true\';
		}
	}
)
shortcut.add( "Up",
	function() {
		document.form1.qtde.value = (document.form1.qtde.value * 1) + 1;
	}
)
shortcut.add( "Down",
	function() {
		if ( document.form1.qtde.value > 1 )
		{
			document.form1.qtde.value = (document.form1.qtde.value * 1) - 1;
		}
	}
)
shortcut.add( "F2",
	function() {
		document.location = \'pdv3.php\';
	}
)
shortcut.add( "F7",
	function() {
		document.location = \'pdv2.php\';
	}
)
shortcut.add( "F8",
	function() {
		document.location = \'pdv_rec1.php\';
	},{
		\'type\':\'keydown\',
		\'propagate\':false,
		\'target\':document
	}
);
</script>
'; ?>

<div class="descricao"><?php echo $this->_tpl_vars['descricao']; ?>
&nbsp;</div>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top"><div>&nbsp;</div>
      <div class="descricao_titulo">C&oacute;digo do produto:</div>
      <div>
        <input name="codigo" type="text" class="descricao" id="codigo" value="<?php echo $this->_tpl_vars['codigo']; ?>
" style="width: 250px">
      </div>
      <div>&nbsp;</div>
      <div class="descricao_titulo">Quantidade:</div>
      <div>
        <input name="qtde" type="text" class="descricao" id="qtde" value="1" style="width: 250px; text-align: right">
      </div>
      <div>&nbsp;</div>
      <div class="descricao_titulo">Pre&ccedil;o unit&aacute;rio:</div>
      <div>
        <input name="preco_unitario" type="text" class="descricao" id="preco_unitario" value="<?php echo $this->_tpl_vars['preco_unitario']; ?>
" style="width: 250px; text-align: right">
      </div>
      <div>&nbsp;</div>
      <div class="descricao_titulo">Subtotal:</div>
      <div>
        <input name="subtotal" type="text" class="descricao" id="subtotal" value="<?php echo $this->_tpl_vars['subtotal']; ?>
" style="width: 250px; text-align: right">
      </div>
      <div>&nbsp;</div>
      <div>
        <input type="submit" name="adicionar_produto" id="adicionar_produto" value="ADICIONAR PRODUTO" style="width: 250px">
        <br>
        <input type="submit" name="cancela_item" id="cancela_item" value="CANCELAR &Iacute;TENS" style="width: 250px">
        <br />
      [F2] - PESQUISAR PRODUTO<br />
      [F7] - CONCLUIR VENDA<br />
      [F8] - RECEBER CONTA CLIENTE</div></td>
    <td valign="top"><div>&nbsp;</div>
      <table border="0" cellpadding="3" cellspacing="1">
        <tr>
          <td class="cabecalho">&nbsp;</td>
          <td class="cabecalho">C&oacute;digo</td>
          <td class="cabecalho">Descri&ccedil;&atilde;o</td>
          <td class="cabecalho">Pre&ccedil;o</td>
          <td class="cabecalho">Qtde</td>
          <td class="cabecalho">Subtotal</td>
        </tr>
        <!--<tr>
                  <td class="linhas"><input name="id_item()" type="checkbox" id="id_item()" value="id_item"></td>
                  <td class="linhas">codigo</td>
                  <td class="linhas">descricao</td>
                  <td align="right" class="linhas">preco</td>
                  <td align="right" class="linhas">qtde</td>
                  <td align="right" class="linhas">subtotal</td>
                </tr>-->
        <?php echo $this->_tpl_vars['lista']; ?>

      </table></td>
  </tr>
</table>