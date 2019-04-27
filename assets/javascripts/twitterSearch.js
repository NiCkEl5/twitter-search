$( document ).ready(function() {
  $('#inputSearch').keyup(function(){
      if($.trim($("#inputSearch").val()).length > 0){
        $("#buttonSearch").removeAttr("disabled");
      }else{
        $("#buttonSearch").attr("disabled", "disabled");
      }
    })
});
