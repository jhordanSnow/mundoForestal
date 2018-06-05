function caca(){
  var valuePrint = $("#valor_add").val();
  var idChar = $("#characteristic_id").val();
  var textChar = $("#characteristic_id option:selected").text();

  var toPrint = '<div class="row row-characteristic" id="characteristic_id_'+idChar+'">';
  toPrint += '<input type="hidden" id="characteristic_value_'+idChar+'" name="PlantCharacteristic[Value][]" value="'+valuePrint+'">'
  toPrint += '<input type="hidden" id="characteristic_value_desc_'+idChar+'" value="'+textChar+'">'
  toPrint += '<input type="hidden" name="PlantCharacteristic[IdCharacteristic][]" value="'+idChar+'">'
  toPrint += '<div class="col-md-11">'+textChar+': '+valuePrint+'</div>';
  toPrint += '<div class="col-md-1"><span class="glyphicon glyphicon-remove" onclick="removeOption('+idChar+')" aria-hidden="true"></span></div>';
  toPrint += '</div>';

  $("#panel-characteristics").append(toPrint);
  $("#valor_add").val("");
  $("#characteristic_id option:selected").remove();
  $("#characteristic_id").val(null).trigger("change");
}

function removeOption(idChar){
  var textChar = $("#characteristic_value_"+idChar).val();
  var textDescChar = $("#characteristic_value_desc_"+idChar).val();
  AddToSelect(textDescChar, idChar, false);
  $("#valor_add").val(textChar);
  $("#characteristic_id_" + idChar).remove();
}

function AddToSelect(text, id, selected){
  var newOption = new Option(text, id, selected, false);
  $("#characteristic_id").append(newOption);
  $("#characteristic_id").val(id).trigger("change");
}



$(function () {

    var poly;
    var map;

    function initMap() {
      map = new google.maps.Map(document.getElementById('map'), {
        zoom: 7,
        center: {lat: 41.879, lng: -87.624}
      });

      poly = new google.maps.Polyline({
        strokeColor: '#000000',
        strokeOpacity: 1.0,
        strokeWeight: 3
      });
      poly.setMap(map);

      map.addListener('click', addLatLng);
    }

    function addLatLng(event) {
      var path = poly.getPath();
      path.push(event.latLng);

      var marker = new google.maps.Marker({
        position: event.latLng,
        title: '#' + path.getLength(),
        map: map
      });
    }



    var inputLocalFont = document.getElementById("uploadFiles");
    if (inputLocalFont){
      inputLocalFont.addEventListener("change", previewImages, false);
    }

    var uploadAnswer = document.getElementById("uploadAnswer");
    if (uploadAnswer){
      uploadAnswer.addEventListener("change", previewAnswer, false);
    }

    function previewImages() {
        var fileList = this.files;
        var anyWindow = window.URL || window.webkitURL;

        for (var i = 0; i < fileList.length; i++) {
            var objectUrl = anyWindow.createObjectURL(fileList[i]);

            var content = "<div class='col-md-3' style='overflow: hidden; height: 250px;margin-bottom:10px;'>";
            content += "<a class='fa fa-remove btn btn-danger' style='float:right;position: absolute;' OnClick='deleteImage(this)' element-name='"+fileList[i].name+"'></a>";
            content += "<img class='img-responsive img-rounded' src='" + objectUrl + "' />";
            content += "</div>";

            $('#contentImages').append(content);
            var names = $("#uploadFilesNames").val();
            $("#uploadFilesNames").val(names+fileList[i].name+',')
            window.URL.revokeObjectURL(fileList[i]);
        }

        $(inputLocalFont).hide();
        inputLocalFont = $('<input type="file" id="uploadFiles" class="pull-right" accept=".jpg,.jpeg,.png" name="Photo[photos][]" value="" multiple="">').appendTo("#filecontainer").get(0);
        inputLocalFont.addEventListener("change", previewImages, false);
    }
    function previewAnswer(){
      var anyWindow = window.URL || window.webkitURL;
      var objectUrl = anyWindow.createObjectURL(this.files[0]);
      $("#imageTarget").attr('src',objectUrl);
    }
});

function deleteImage(object) {
    var name = $(object).attr("element-name");
    var names = $("#uploadFilesNames").val();
    names = names.replace(name+',','');
    $("#uploadFilesNames").val(names);
    $(object).parent().remove();
}
