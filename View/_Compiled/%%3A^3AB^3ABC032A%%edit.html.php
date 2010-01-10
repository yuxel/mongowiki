<?php /* Smarty version 2.6.26, created on 2010-01-10 20:54:00
         compiled from title/edit.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'htmlspecialchars', 'title/edit.html', 11, false),)), $this); ?>
<div class="buttons">
<a href="<?php echo $this->_tpl_vars['URL']; ?>
/<?php echo $this->_tpl_vars['pageUri']; ?>
">Göster</a>
<a href="<?php echo $this->_tpl_vars['URL']; ?>
/<?php echo $this->_tpl_vars['pageUri']; ?>
/@history">Geçmiş</a>
</div>

<div class="content">
    
<form method="post" action="<?php echo $this->_tpl_vars['URL']; ?>
/<?php echo $this->_tpl_vars['pageUri']; ?>
/@save">
    <div>
        <input type="hidden" name="revision" />
        <textarea id="elm1" name="elm1" rows="70" cols="80" style="width: 100%; height:500px" class="tinymce"><?php echo htmlspecialchars($this->_tpl_vars['titleContent']['content']); ?>
</textarea>
        <input type="submit" value="Kaydet"/>
    </div>
</form>
</div>