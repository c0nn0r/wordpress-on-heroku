<?php $opacityRange = range(5,100,5); ?>
<h3><?php _e('Slider settings', 'GPB'); ?></h3>
<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" id="GPB_settings">
    <table width="100%" class="options" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td class="catLeft"><?php _e('Position:', 'GPB'); ?></td>
                <td class="inputTD">
                    <select name="position" id="position" onchange="GPB_selectPosition()">
                        <option <?php if ($position == 'left') echo 'selected="selected"'; ?> value="left"><?php _e('left', 'GPB'); ?></option>
                        <option <?php if ($position == 'right') echo 'selected="selected"'; ?> value="right"><?php _e('right', 'GPB'); ?></option>
                        <option <?php if ($position == 'top') echo 'selected="selected"'; ?> value="top"><?php _e('top', 'GPB'); ?></option>
                        <option <?php if ($position == 'bottom') echo 'selected="selected"'; ?> value="bottom"><?php _e('bottom', 'GPB'); ?></option>
                    </select>
                </td>
                <td class="extra small"><?php _e('Position of slider', 'GPB'); ?></td>
            </tr>
            <tr>
                <td class="catLeft"><?php _e('Top position:', 'GPB'); ?></td>
                <td class="inputTD_small"><input id="topPosition" type="text" name="top_position" value="<?php echo $top_position; ?>" /></td>
                <td class="extra small"><?php _e('Number of pixels from the top edge (Works only at left or right position)', 'GPB'); ?></td>
            </tr>
            <tr>
                <td class="catLeft"><?php _e('Left position:', 'GPB'); ?></td>
                <td class="inputTD_small"><input readonly="readonly" type="text" id="leftPosition" name="left_position" value="<?php echo $left_position; ?>" /></td>
                <td class="extra small"><?php _e('Number of pixels from the left edge (Works only at top or bottom position)', 'GPB'); ?></td>
            </tr>
            <tr>
                <td class="catLeft"><?php _e('Logo position:', 'GPB'); ?></td>
                <td class="inputTD_small"><input type="text" id="leftPosition" name="logo_position" value="<?php echo $logo_position; ?>" /></td>
                <td class="extra small"><?php _e('Logo position in px', 'GPB'); ?></td>
            </tr>            
            <tr>
                <td class="catLeft"><?php _e('Action:', 'GPB'); ?></td>
                <td class="inputTD">
                    <select name="action">
                        <option <?php if ($action == 'hover') echo 'selected="selected"'; ?> value="hover"><?php _e('hover', 'GPB'); ?></option>
                        <option <?php if ($action == 'click') echo 'selected="selected"'; ?> value="click"><?php _e('click', 'GPB'); ?></option>
                    </select>
                </td>
                <td class="extra small"><?php _e('Slider action after hover or click', 'GPB'); ?></td>
            </tr>
            <tr>
                <td class="catLeft"><?php _e('Open time:', 'GPB'); ?></td>
                <td class="inputTD_small"><input type="text" name="open_time" value="<?php echo $open_time; ?>" /></td>
                <td class="extra small"><?php _e('Slider opening time in ms.', 'GPB'); ?></td>
            </tr>
            <tr>
                <td class="catLeft"><?php _e('Close time:', 'GPB'); ?></td>
                <td class="inputTD_small"><input type="text" name="close_time" value="<?php echo $close_time; ?>" /></td>
                <td class="extra small"><?php _e('Slider closing time in ms.', 'GPB'); ?></td>
            </tr>
            
            <tr>
                <td class="catLeft"><?php _e('Start opacity:', 'GPB'); ?></td>
                <td class="inputTD">
                    <select name="start_opacity">
                        <?php foreach ($opacityRange as $k => $oValue): ?>
                        <option <?php if ($start_opacity == $oValue) echo 'selected="selected"'; ?> value="<?php echo $oValue; ?>"><?php echo $oValue; ?>%</option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td class="extra small"><?php _e('Start opacity of "Google Plus Badge" box', 'GPB'); ?></td>
            </tr>
            
            <tr>
                <td class="catLeft"><?php _e('Open opacity:', 'GPB'); ?></td>
                <td class="inputTD">
                    <select name="open_opacity">
                        <?php foreach ($opacityRange as $k => $oValue): ?>
                        <option <?php if ($open_opacity == $oValue) echo 'selected="selected"'; ?> value="<?php echo $oValue; ?>"><?php echo $oValue; ?>%</option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td class="extra small"><?php _e('Open opacity of "Google Plus Badge" box', 'GPB'); ?></td>
            </tr>
            
            <tr>
                <td class="catLeft"><?php _e('Close opacity:', 'GPB'); ?></td>
                <td class="inputTD">
                    <select name="close_opacity">
                        <?php foreach ($opacityRange as $k => $oValue): ?>
                        <option <?php if ($close_opacity == $oValue) echo 'selected="selected"'; ?> value="<?php echo $oValue; ?>"><?php echo $oValue; ?>%</option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td class="extra small"><?php _e('Close opacity of "Google Plus Badge" box', 'GPB'); ?></td>
            </tr>
            
            <tr>
                <td class="catLeft"><?php _e('Icon:', 'GPB'); ?></td>
                <td class="inputTD">
                    <table>
                        <tbody>
                        <?php if (is_array($GPB_IconsArray) && count($GPB_IconsArray) > 1): ?>
                            <?php $i = 0; foreach ($GPB_IconsArray as $k => $fIcon):
                                $i++;
                                $checked = ($icon == $fIcon) ? 'checked="checked"' : '';
                             ?>
                            <tr>
                                <td><input <?php echo $checked; ?> type="radio" name="icon" id="icon<?php echo $i;?>" value="<?php echo $fIcon; ?>" /></td>
                                <td style="background-color:#CCC;"><label for="icon<?php echo $i; ?>"><img src="<?php echo GPB_IMAGE_URL . $fIcon; ?>" alt="<?php echo $fIcon; ?>" /></label></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </td>
                <td class="extra small"><?php _e('Slider icon', 'GPB'); ?></td>
            </tr>
            
            <tr>
                <td class="catLeft"><?php _e('Border color:', 'GPB'); ?></td>
                <td class="inputTD_small"><input style="width:75px;" id="border_color" type="text" name="border_color" value="<?php echo $border_color; ?>" /></td>
                <td class="extra small"><?php _e('Border color', 'GPB'); ?></td>
            </tr>
            
            <tr>
                <td class="catLeft"></td>
                <td colspan="2">
                    <input type="hidden" name="GPB_action" value="slider">
                    <input type="submit" id="SNGPsubmit-icon" name="GPB_submit" class="button-primary" value="<?php _e('Save settings', 'GPB'); ?>" />
                </td>
            </tr>
        </tbody>
    </table>
</form>