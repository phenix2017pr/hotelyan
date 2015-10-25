var CKFilter = CKFilter || {
  scriptsPath : CKEDITOR.basePath.replace('/scripts/ckeditor/','/') + 'scripts/',
  addEditor : function(elId) {
    try { CKEDITOR.replace(elId, CKFilter.config ); }
    catch(err) { if (typeof(console) !== 'undefined') console.log(err.message); }
  },
  destroyEditor : function(elId) {
    var ck = CKEDITOR.instances[elId];
    if (ck) { ck.updateElement(); ck.destroy(true); }
  },
  getFilterPath : function() {
    return CKFilter.filterPath || CKEDITOR.basePath.replace('/scripts/ckeditor/','/');
  },
  getPluginsPath : function() {
    return CKFilter.wolfPluginsPath || CKFilter.scriptsPath + 'wolf_plugins/';
  },
  getPluginsRoute : function() {
    return CKFilter.wolfPluginsRoute || false;
  },
  getUserPath : function() {
    return CKFilter.wolfUserPath || CKFilter.scriptsPath + 'user/';
  },
  config : {}
};

(function() {
  // prevent creation of editor instances (textarea class="ckeditor")!
  CKEDITOR.replaceByClassEnabled = 0;
  // don't load default config script
  CKEDITOR.config.customConfig = '';
  // don't load default styles script
  CKEDITOR.config.stylesSet = '';
  // don't load default templates
  CKEDITOR.config.templates_files = [ ];
  // 'protect' php code
  CKEDITOR.config.protectedSource = [ /<\?[\s\S]*?\?>/g ];
})();

/* Wolf's filter switch */
$(function() {
  $('.filter-selector').live('wolfSwitchFilterIn', function(ev,f,el) {
    if(f=='ckeditor') { CKFilter.addEditor(el.attr('id')); }
  });
  $('.filter-selector').live('wolfSwitchFilterOut', function(ev,f,el) {
    if(f=='ckeditor') { CKFilter.destroyEditor(el.attr('id')); }
  });
});

/* customize indentation and tabs - http://docs.cksource.com/CKEditor_3.x/Howto/FCKeditor_HTML_Output */
CKEDITOR.on('instanceReady', function(ev) {
    var writer = ev.editor.dataProcessor.writer,
           dtd = CKEDITOR.dtd,
       indents = CKEDITOR.tools.extend( {}, dtd.$list, { table:1, div:1 } ),
       breaks  = CKEDITOR.tools.extend( {}, dtd.$block, dtd.$listItem, dtd.$tableContent );
    // Use 4 spaces instead of tab for indentation
    writer.indentationChars = '    ';
    // don't indent
    for (var tag in breaks)
        writer.setRules(tag, { indent: 0, breakBeforeOpen: 1, breakAfterOpen: 0, breakBeforeClose: 0, breakAfterClose: 1 });
    // break and indent
    for (var tag in indents)
        writer.setRules(indents[tag], { indent: 1, breakBeforeOpen: 1, breakAfterOpen: 0, breakBeforeClose: 0, breakAfterClose: 1 });
		
	var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
	if (isChrome) {
		for (var i in CKEDITOR.instances) {
			var editor = CKEDITOR.instances[i]; 
			
			editor.on('paste',function(e){
				e.stop();				
				var ele = $('<div />').html(e.data.html);
				$(ele).find("span").each(function() {
					$(this).removeAttr("style");
				});
				e.editor.insertHtml($(ele).html());
			}, editor.element.$);			
		}		
	}	
	
});

