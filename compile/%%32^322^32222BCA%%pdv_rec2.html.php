<?php /* Smarty version 2.6.22, created on 2011-12-29 18:20:48
         compiled from pdv_rec2.html */ ?>
<link href="../style_pdv.css" rel="stylesheet" type="text/css" />

<?php echo '
<script src="../shortcut.js" type="text/javascript"></script>
<script>
shortcut.add( "ESC",
	function() {
		document.location = \'pdv2.php?esc=true\';
	}
)
shortcut.add( "F2",
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
          <td class="descricao_titulo">Cliente:</td>
          <td><input name="cliente" type="text" class="descricao" id="cliente" style="width: 200px" value="<?php echo $this->_tpl_vars['cliente']; ?>
" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td class="descricao_titulo">Saldo:</td>
          <td><input name="saldo" type="text" class="descricao" id="saldo" style="width: 200px; text-align: right" value="<?php echo $this->_tpl_vars['saldo']; ?>
" /></td>
          <td><?php if ($this->_tpl_vars['tag'] == 'D'): ?><span class="debito">D&Eacute;BITO</span><?php elseif ($this->_tpl_vars['tag'] == 'C'): ?><span class="credito">CR&Eacute;DITO</span><?php endif; ?></td>
        </tr>
        <tr>
          <td class="descricao_titulo">Valor pago:</td>
          <td><input name="valor" type="text" class="descricao" id="valor" style="width: 200px; text-align: right" value="<?php echo $this->_tpl_vars['valor']; ?>
" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" align="right"><input name="concluir" type="submit" id="concluir" onclick="return confirm('CONFIRMA O RECEBIMENTO DA CONTA?')" value="CONCLUIR" /></td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
<?php if ($this->_tpl_vars['msg']): ?>
<div class="descricao"><?php echo $this->_tpl_vars['msg']; ?>
</div>
<?php endif; ?>