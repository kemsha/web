var EventService = {
    init: function(){
      $('#addEventForm').validate({
        submitHandler: function(form) {
          var entity = Object.fromEntries((new FormData(form)).entries());
          if (!isNaN(entity.id)){
            // update method
            var id = entity.id;
            delete entity.id;
            EventService.update(id, entity);
          }else{
            // add method
            EventService.add(entity);
          }
        }
      });
      EventService.list();
    },

    list: function(){
      $.ajax({
         url: "rest/events",
         type: "GET",
         beforeSend: function(xhr){
           xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
         },
         success: function(data) {
           $("#event-list").html("");
           var html = "";
           for(let i = 0; i < data.length; i++){
             html += `
             <div class="col-lg-3">
               <div class="card">
                 <img class="card-img-top" src="https://www.noise11.com/wp/wp-content/uploads/2014/02/Eminem-photo-by-Jeremy-Deputat.jpg" alt="Card image cap">
                 <div class="card-body">
                   <h5 class="card-title">`+ data[i].event_name +`</h5>
                   <p class="card-text">`+ data[i].event_date +`</p>
                   <div class="btn-group" role="group">
                     <button type="button" class="btn btn-primary event-button" onclick="EventService.get(`+data[i].id+`)">Edit</button>
                     <button type="button" class="btn btn-success event-button" onclick="TodoService.list_by_event_id(`+data[i].id+`)">Manage</button>
                     <button type="button" class="btn btn-danger event-button" onclick="EventService.delete(`+data[i].id+`)">Delete</button>
                   </div>
                 </div>
               </div>
             </div>
             `;
           }
           $("#event-list").html(html);
         },
         error: function(XMLHttpRequest, textStatus, errorThrown) {
           toastr.error(XMLHttpRequest.responseJSON.message);
           UserService.logout();
         }
      });
    },

    get: function(id){
      $('.event-button').attr('disabled', true);

      $.ajax({
         url: 'rest/events/'+id,
         type: "GET",
         beforeSend: function(xhr){
           xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
         },
         success: function(data) {
           $('#addEventForm input[name="id"]').val(data.id);
           $('#addEventForm input[name="name"]').val(data.name);
           $('#addEventForm input[name="venue_name"]').val(data.venue_name);
           $('#addEventForm input[name="created"]').val(data.created);

           $('.event-button').attr('disabled', false);
           $('#addEventModal').modal("show");
         },
         error: function(XMLHttpRequest, textStatus, errorThrown) {
           toastr.error(XMLHttpRequest.responseJSON.message);
           $('.event-button').attr('disabled', false);
         }});
    },

    add: function(event){
      $.ajax({
        url: 'rest/events',
        type: 'POST',
        beforeSend: function(xhr){
          xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
        },
        data: JSON.stringify(event),
        contentType: "application/json",
        dataType: "json",
        success: function(result) {
            $("#event-list").html('<div class="spinner-border" role="status"> <span class="sr-only"></span>  </div>');
            EventService.list(); // perf optimization
            $("#addEventModal").modal("hide");
            toastr.success("Event added!");
        }
      });
    },

    update: function(id, entity){
      $.ajax({
        url: 'rest/events/'+id,
        type: 'PUT',
        beforeSend: function(xhr){
          xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
        },
        data: JSON.stringify(entity),
        contentType: "application/json",
        dataType: "json",
        success: function(result) {
            $("#event-list").html('<div class="spinner-border" role="status"> <span class="sr-only"></span>  </div>');
            EventService.list(); // perf optimization
            $("#addEventModal").modal("hide");
            toastr.success("Event updated!");
        }
      });
    },

    delete: function(id){
      $('.event-button').attr('disabled', true);
      $.ajax({
        url: 'rest/events/'+id,
        beforeSend: function(xhr){
          xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
        },
        type: 'DELETE',
        success: function(result) {
            $("#event-list").html('<div class="spinner-border" role="status"> <span class="sr-only"></span>  </div>');
            EventService.list();
            toastr.success("Event deleted!");
        }
      });
    },

}
