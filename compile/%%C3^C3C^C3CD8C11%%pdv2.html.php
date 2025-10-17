<?php /* Smarty version 2.6.22, created on 2011-11-28 22:23:08
         compiled from pdv2.html */ ?>
<link href="../style_pdv.css" rel="stylesheet" type="text/css" />
<?php echo '
<script src="../shortcut.js" type="text/javascript"></script>
<script>
shortcut.add( "ESC",
	function() {
		document.location = \'pdv2.php?esc=true\';
	}
)
shortcut.add( "F8",
	function() {
		document.location = \'pdv_cliente.php\';
	}
)
</script>
'; ?>

<table border="0" align="center" cellpadding="2" cellspacing="0">
  <tr>
    <td valign="top"><table border="0" align="center" cellpadding="10" cellspacing="0">
      <tr>
        <td class="descricao_titulo">Total da compra:</td>
        <td><input name="total" type="text" class="descricao" id="total" style="width: 200px; text-align: right" value="<?php echo $this->_tpl_vars['total']; ?>
" /></td>
      </tr>
      <tr>
        <td class="descricao_titulo">Dinheiro:</td>
        <td><input name="dinheiro" type="text" class="descricao" id="dinheiro" style="width: 200px; text-align: right" value="<?php echo $this->_tpl_vars['dinheiro']; ?>
" /></td>
      </tr>
      <tr>
        <td class="descricao_titulo">Troco:</td>
        <td><input name="troco" type="text" class="descricao" id="troco" style="width: 200px; text-align: right" value="<?php echo $this->_tpl_vars['troco']; ?>
" /></td>
      </tr>
      <tr>
        <td colspan="2" align="right"><input type="submit" name="finaliza_venda" id="finaliza_venda" value="FINALIZAR VENDA" /></td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td valign="top"><table border="0" cellpadding="10" cellspacing="0">
      <tr>
        <td><span class="descricao_titulo">Cliente:</span><br /></td>
        <td>          <input name="cliente" type="text" class="descricao" id="cliente" value="<?php echo $this->_tpl_vars['cliente']; ?>
" />        </td>
        </tr>

    </table>      
    [F8] - ALTERAR CLIENTE</td>
  </tr>
</table>
<?php if ($this->_tpl_vars['msg']): ?>
<div class="descricao"><?php echo $this->_tpl_vars['msg']; ?>
</div>
<?php endif; ?>