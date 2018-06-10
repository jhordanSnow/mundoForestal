$("#a-logout").click(function (){
  $("#btn-logout").click();
})

function showImage(obj){
  $('#map').hide();
  var img = $(obj);
  var modal = $(".modal");
  var modalImg = $("#modalContent");

  $('#modalMap').modal('show').find('#modalContent').html("<img src='"+img.attr('src')+"' />");
}
