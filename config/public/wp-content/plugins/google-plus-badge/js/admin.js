jQuery(document).ready(function(){
    jQuery("#border_color").ColorPicker({
        onSubmit: function (hsb, hex, rgb, el) {
            jQuery(el).val('#' + hex);
            jQuery(el).ColorPickerHide();
        },
        onChange: function (hsb, hex, rgb) {
            jQuery("#border_color").val('#' + hex);
            that.val("#" + hex);
        },
        onBeforeShow: function () {
            jQuery(this).ColorPickerSetColor(this.value);
        }
    }).bind('keyup', function () {
        jQuery(this).ColorPickerSetColor(this.value);
    });
});