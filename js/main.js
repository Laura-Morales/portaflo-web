$(".btn-ocultar").click(function(){
	$(".amarillo").fadeOut(1000);
});
$(".btn-mostrar").click(function(){
	$(".amarillo").fadeIn(1000);
});

$(".btn-estirar").click(function(){
	$(".rojo").animate({height: "300px"});
 });
$(".btn-encoger").click(function(){
	$(".rojo").animate({height: "120px"});
 });