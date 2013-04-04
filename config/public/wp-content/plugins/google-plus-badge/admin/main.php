<div class="wrap GPB">
    <div class="icon32" id="icon-options-general"><br></div>
    <h2><?php _e('Google Plus Badge options', 'GPB'); ?></h2>
    <?php if ($pageID == ''): ?>
    <div class="emptyPageID">
        <?php _e('You have to fill Google Page ID.', 'GPB'); ?>
    </div>
    <?php endif; ?>
        
    <div class="cLeft">
        <?php include_once 'left.php'; ?>
    </div>
    <div class="cRight">
        <?php include_once 'right.php'; ?>
    </div>
    <div style="clear:both;"></div>
</div>