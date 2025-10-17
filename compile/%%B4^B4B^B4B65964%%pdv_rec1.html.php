<?php /* Smarty version 2.6.22, created on 2011-12-02 18:46:11
         compiled from pdv_rec1.html */ ?>
<link href="../style_pdv.css" rel="stylesheet" type="text/css" />

<?php echo '
<script src="../shortcut.js" type="text/javascript"></script>
<script>
shortcut.add( "ESC",
	function() {
		document.location = \'pdv.php\';
	}
)
shortcut.add( "ENTER",
	function() {
		document.form1.submit();
	}
)
shortcut.add( "F2",
	function() {
		document.form1.q.focus();
	}
)
</script>
'; ?>

<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="descricao_titulo">Nome do Cliente:</td>
    <td class="descricao_titulo"><input name="q" type="text" class="descricao" id="q" style="width: 250px" value="<?php echo $this->_tpl_vars['q']; ?>
" /></td>
  </tr>
</table>
<table border="0" align="center" cellpadding="2" cellspacing="0">
  <tr>
    <td><select name="codp" size="15" class="select_pesquisa" id="codp">
        <option value="0" style="background: #000000; color: #FFFFFF">NOME&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </option>
        <?php echo $this->_tpl_vars['codp']; ?>

      </select></td>
  </tr>
  <tr>
    <td align="right"><input name="pesquisar" type="hidden" id="pesquisar" value="true" />
      <input type="submit" name="pesquisar" id="pesquisar" value="Pesquisar" /></td>
  </tr>
</table>
<?php if ($this->_tpl_vars['msg']): ?>
<div class="descricao"><?php echo $this->_tpl_vars['msg']; ?>
</div>
<?php endif; ?>