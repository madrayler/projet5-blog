/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css');



// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
 var $ = require('jquery');

 global.$ = global.jQuery = $;

 $(document).ready(function(){
  $('.articles p').css({"height":0});

  $(".articles .anime ").bind("mouseover",function(){
  	$("p",this).stop(true).animate({"height":"50px"},300);
  }).bind("mouseout",function(){
  	$("p",this).stop(true).animate({"height":0},300);
  })
});

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
