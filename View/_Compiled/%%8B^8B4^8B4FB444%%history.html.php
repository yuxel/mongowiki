<?php /* Smarty version 2.6.26, created on 2010-01-09 23:22:36
         compiled from title/history.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'title/history.html', 21, false),)), $this); ?>
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

    <?php if (! $this->_tpl_vars['history']): ?>
        <a href="<?php echo $this->_tpl_vars['URL']; ?>
/<?php echo $this->_tpl_vars['pageUri']; ?>
/@edit">Bu sayfayı oluştur</a>
    <?php else: ?>
        <table>
            <tr>
                <th>Değiştirme tarihi</th>
                <th>Son değiştiren</th>
                <th>Not</th>
                <th></th>
                <th></th>
            </tr>
        <?php $_from = $this->_tpl_vars['history']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
            <tr>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
                <td><?php echo $this->_tpl_vars['item']['author']; ?>
</td>
                <td><?php echo $this->_tpl_vars['item']['note']; ?>
</td>
                <td><a href="<?php echo $this->_tpl_vars['URL']; ?>
/<?php echo $this->_tpl_vars['pageUri']; ?>
/@show?revision=<?php echo $this->_tpl_vars['item']['_id']; ?>
">Görüntüle</a></td>
                <td><a href="<?php echo $this->_tpl_vars['URL']; ?>
/<?php echo $this->_tpl_vars['pageUri']; ?>
/@edit?revision=<?php echo $this->_tpl_vars['item']['_id']; ?>
">Değiştir</a></td>
            </tr>
        <?php endforeach; endif; unset($_from); ?>

        </table>
    <?php endif; ?>
</div>