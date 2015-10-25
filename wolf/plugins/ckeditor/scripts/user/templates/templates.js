// Register a template definition set named "custom".
CKEDITOR.addTemplates( 'custom',
{
	// The name of the subfolder that contains the preview images of the templates.
	imagesPath : CKFilter.getFilterPath() + 'scripts/user/templates/images/' ),
 
	// Template definitions.
	templates :
		[
			{
				title: 'My Template 1',
				image: 'template1.gif',
				description: 'Description of My Template 1.',
				html:
					'<div class="cabecera">' +
					'<div><img src="' + imagesPath + 'placeholder.jpg' + '"></div>' +
					'<p class="img-caption">Pie de imagen</p>' +
					'</div>'
			}
		]
});