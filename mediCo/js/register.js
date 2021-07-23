console.log("linked");

//jquery styling
$(function(){

    $(".secondStep").hide();
    $(".thirdStep").hide();

 $(".nextStep").on("click", function(){
    $('.firstStep').hide();
    $('.circle1').css("opacity", "0.7");
    $('.describe1').css("opacity", "0.7");
    
    $('.circle2').css("opacity", "1");
    $('.describe2').css("opacity", "1");
    $(".secondStep").fadeIn();
 });

 $(".nextUp2").on("click", function(){
    $('.secondStep').hide();

    $('.circle2').css("opacity", "0.7");
    $('.describe2').css("opacity", "0.7");
    
    $('.circle3').css("opacity", "1");
    $('.describe3').css("opacity", "1");
    $(".thirdStep").fadeIn();
 });

});