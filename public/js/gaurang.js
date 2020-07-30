 function softDeleteRecord(id){
            $('#'+id+'').closest('tr').fadeOut();
            $.ajax({  
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            type: 'POST',  
            url: 'api/softdeleterecord',
            dataType:"json",
            data: {_token : $('meta[name="csrf-token"]').attr('content'),'id': id,},
            success: function(response) {
                console.log(response);
            }
        });
        }
    $(document).ready(function(){

       $(document).on("click", ".updateEntry", function () {
     var eventId = $(this).data('id');
     
             document.getElementById("updateForm").reset(); 
            $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
        });
           $.ajax({
              url: "/api/updaterecord",
              method: 'post',
              data: {_token : $('meta[name="csrf-token"]').attr('content'),'id': eventId,},
              success: function(response){
                  var responseObj = JSON.parse(response);
                    $(".updateAuthor").val(function() {
                        return this.value + responseObj.data.author;
                    });
                 
                     $(".updateTitle").val(function() {
                        return this.value + responseObj.data.title;
                    });
                    $(".updateBookId").val(function() {
                        return this.value + responseObj.data.id;
                    });
              }});
           
           
       });
  
   
   
 
       
        
            $('#addBook').click(function(e){
           e.preventDefault();
           /*Ajax Request Header setup*/
           $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
           $.ajax({
              url: "/api/addrecord",
              method: 'post',
              data: $('#insertForm').serialize(),
              success: function(response){
                  
                    document.getElementById("insertForm").reset(); 
                  location.reload();
              }});
           });
        
        
           $('#updateBook').click(function(e){
           e.preventDefault();
           /*Ajax Request Header setup*/
           $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
           $.ajax({
              url: "api/updatebook",
              method: 'post',
              data: $('#updateForm').serialize(),
              success: function(response){
                   console.log(response);
                    document.getElementById("updateForm").reset();
                  location.reload();

              }});
           });
        
        $('.deleteEntryPermanent').click(function(){
        var delId = this.id;
             $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
           $.ajax({
              url: "api/permanentdelete",
              method: 'post',
               data: {_token : $('meta[name="csrf-token"]').attr('content'),'id': delId,},
              success: function(response){
                   console.log(response);
                   
                  location.reload();

              }});
           });
        
        $('.restoreEntry').click(function(){
        var delId = this.id;
             $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
           $.ajax({
              url: "api/restore",
              method: 'post',
               data: {_token : $('meta[name="csrf-token"]').attr('content'),'id': delId,},
              success: function(response){
                   console.log(response);
                   location.reload();
                  

              }});
           });
      
       
        
    });