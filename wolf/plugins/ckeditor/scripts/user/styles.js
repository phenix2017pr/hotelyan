/*
 * The set of styles for the Styles combo
 * StyleSets examples - elements attributes styles are declared in contentsCss stylesheets
 * http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.stylesSet.html
 */
CKEDITOR.stylesSet.add( 'mystyles',
[
    { name: 'Header block', element : 'div', attributes : { 'class' : 'header' } },
    { name: 'Intro paragraph', element : 'p', attributes : { 'class' : 'intro' } },
    { name: 'Img on left',   element : 'img', attributes : { 'class' : 'img-left' } },
    { name: 'Img centered',  element : 'img', attributes : { 'class' : 'img-center' } },
    { name: 'Img on right',  element : 'img', attributes : { 'class' : 'img-right' } }
]);