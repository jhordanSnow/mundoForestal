function caca(){
  var valuePrint = $("#valor_add").val();
  var idChar = $("#characteristic_id").val();
  var textChar = $("#characteristic_id option:selected").text();;

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



var finalFiles = [];
$(function () {
    var inputLocalFont = document.getElementById("uploadFiles");
    inputLocalFont.addEventListener("change", previewImages, false);

    function previewImages() {
        var fileList = this.files;

        var anyWindow = window.URL || window.webkitURL;

        for (var i = 0; i < fileList.length; i++) {
            var objectUrl = anyWindow.createObjectURL(fileList[i]);
            finalFiles.push(fileList[i].name);
            var index = finalFiles.indexOf(fileList[i].name);

            var content = "<div class='col-md-3' style='overflow: hidden; height: 250px;margin-bottom:10px;' id='image_" + index +"'>";
            content += "<a class='fa fa-remove btn btn-danger' style='float:right;position: absolute;' OnClick='deleteImage(this)' index-element='" + index+"'></a>";
            content += "<img class='img-responsive img-rounded' src='" + objectUrl + "' />";
            content += "</div>";

            $('#contentImages').append(content);
            window.URL.revokeObjectURL(fileList[i]);
        }

        $(inputLocalFont).hide();
        inputLocalFont = $('<input type="file" id="uploadFiles" class="pull-right" accept=".jpg,.jpeg,.png" name="Photo[]" value="" multiple="">').appendTo("#filecontainer").get(0);
        inputLocalFont.addEventListener("change", previewImages, false);
        $("#uploadFilesNames").val(finalFiles);
    }
});

function deleteImage(object) {
    var index = $(object).attr("index-element");
    $("#image_" + index + "").remove();
    delete finalFiles[index];
    $("#uploadFilesNames").val(finalFiles);
}
