$(document).ready(function(){
  $(".articles").mouseenter(function(){
    $("p").hide();
  });
  $(".articles").mouseleave(function(){
    $("p").show();
  });
});