<h1>Documentation</h1>
<div id="ckeditor_filter">
<?php if(isset($message)): ?>
    <div id="documentation_message">
        <p><?php echo $message; ?></p>
    </div>
<?php endif; ?>
    <h3>CKEditor</h3>
    <p>You can customize it by editing <code>'<?php echo PLUGINS_ROOT.DS; ?>ckeditor/scripts/config.js'</code>, which has a few comments that may be helpful.</p>
    <p>The default editor stylesheet can be found in <code>'<?php echo PLUGINS_ROOT.DS; ?>ckeditor/scripts/editor.css'</code></p>

    <h3>Filemanager</h3>
    <p>The filemanager configuration (editable by user) is stored in db, so go to the <a href="<?php echo get_url('plugin/ckeditor/settings'); ?>" title="CKEditor plugin settings" target="_self">settings</a> screen.</p>

</div>