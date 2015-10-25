(function() {
    var pluginsPath = CKFilter.getPluginsPath(),
        pluginsRoute = CKFilter.wolfPluginsRoute || false;

    if(pluginsRoute) {
        CKEDITOR.plugins.addExternal('wolf_pages', pluginsPath + 'wolf_pages/', 'plugin.js');
        //CKEDITOR.plugins.addExternal('my_plugin', pluginsPath + 'my_plugin/', 'plugin.js');
    }
})();

CKEDITOR.tools.extend(CKFilter.config,
{
    extraPlugins : 'wolf_pages',
    entities : false,
    basicEntities : false,
    entities_additional : '',
    contentsCss : [ 'wolf/plugins/ckeditor/scripts/user/editor.css' ],
    toolbar : 'Editor',
    toolbarCanCollapse : 0, 
    startupOutlineBlocks : 0,
    toolbar_Editor :
    [
        [ 'Styles','Format' ],
        [ 'Bold','Italic','Underline','Blockquote','Strike','-','Subscript','Superscript' ],
        [ 'Div','NumberedList','BulletedList' ],
        [ 'RemoveFormat' ],
        [ 'Outdent','Indent' ],
        [ 'Link','Unlink','-','Image' ],
        [ 'Cut','Copy','Paste','PasteFromWord','-','Undo','Redo' ],
        [ 'SelectAll','-','Find','Replace' ],
        [ 'ShowBlocks','Maximize','Source' ]
    ],
    filebrowserWindowWidth : '60%',// or '640'
    filebrowserWindowHeight : '60%',
    stylesSet : 'mystyles:' + CKFilter.getUserPath() + 'styles.js',
    justifyClasses : [ 'left', 'centered', 'right', 'justify' ],
    /* Miscelaneous options */
    tabSpaces : 4,
    dialog_backgroundCoverOpacity : 0.75,
    dialog_backgroundCoverColor : '#2a2a2a',
    resize_dir : 'vertical',
    uiColor : '#f2f2f2',
    height : '360px'
});