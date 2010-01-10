<?php /* Smarty version 2.6.26, created on 2010-01-09 21:47:31
         compiled from title/show.html */ ?>
<div class="buttons">
<a href="<?php echo $this->_tpl_vars['URL']; ?>
/<?php echo $this->_tpl_vars['pageUri']; ?>
/@edit?revision=<?php echo $this->_tpl_vars['titleContent']['_id']; ?>
">Duzenle</a>
<a href="<?php echo $this->_tpl_vars['URL']; ?>
/<?php echo $this->_tpl_vars['pageUri']; ?>
/@history">Geçmiş</a>
</div>

<div class="content">
    <?php if (! $this->_tpl_vars['titleContent']): ?>
        <a href="<?php echo $this->_tpl_vars['URL']; ?>
/<?php echo $this->_tpl_vars['pageUri']; ?>
/@edit">Bu sayfayı oluştur</a>
    <?php else: ?>
        <?php echo $this->_tpl_vars['titleContent']['content']; ?>

    <?php endif; ?>
</div>