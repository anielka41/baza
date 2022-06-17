require('trumbowyg');
const icons = require('trumbowyg/dist/ui/icons.svg').default;
jQuery.trumbowyg.svgPath = icons;
jQuery(".trumbowyg").trumbowyg();

require('jquery-word-and-character-counter-plugin/jquery.word-and-character-counter.min');

$('.trumbowyg-editor').counter({
    goal: 'sky',
    target: '.word-counter'
});