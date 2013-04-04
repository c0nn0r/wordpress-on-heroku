<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" id="SNGP_settings">
    <table width="100%" class="options">
        <tbody>
            <tr>
                <td class="catLeft"><?php _e('Page ID:', 'GPB'); ?></td>
                <td colspan="2">
                    <label for="pageID" style="float:left;margin-right:10px;line-height:23px">https://plus.google.com/</label>
                    <input type="text" style="float:left;width:200px;" id="pageID" name="pageID" value="<?php echo $pageID; ?>" />
                    <div style="clear:both"></div>
                </td>
            </tr>
            <tr>
                <td class="catLeft" colspan="2"></td>
                <td class="extra small"><?php _e('e.g. <i>116820438831110052424</i>', 'GPB'); ?></td>
            </tr>
            <tr>
                <td class="catLeft"><?php _e('Size:', 'GPB'); ?></td>
                <td class="inputTD">
                    <select name="badge_size">
                        <option <?php if ($badge_size == 'badge') echo 'selected="selected"'; ?> value="badge"><?php _e('Normal', 'GPB'); ?></option>
                        <option <?php if ($badge_size == 'smallbadge') echo 'selected="selected"'; ?> value="smallbadge"><?php _e('Small', 'GPB'); ?></option>
                    </select>
                </td>
                <td class="extra small"><?php _e('Determines the badge size.', 'GPB'); ?></td>                
            </tr>
            <tr>
                <td class="catLeft"><?php _e('Language:', 'GPB'); ?></td>
                <td class="inputTD">
                    <select name="badge_lang">
                    <?php foreach ($availableLanguages as $langCode => $langName): ?>
                        <option <?php if ($badge_lang == $langCode) echo 'selected="selected"'; ?> value="<?php echo $langCode; ?>"><?php echo $langName; ?></option>
                    <?php endforeach; ?>
                    </select>
                </td>
                <td class="extra small"><?php _e('Badge language.', 'GPB'); ?></td>                
            </tr>
            
            
            <tr>
                <td class="catLeft"><input type="hidden" name="GPB_action" value="primary" /></td>
                <td><input type="submit" id="SNGPsubmit" name="GPB_submit" class="button-primary" value="<?php _e('Save settings', 'GPB'); ?>" /></td>
            </tr>
        </tbody>
    </table>
</form>