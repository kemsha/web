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
               <div class="card" style="background-color:`+data[i].color+`">
                 <img class="card-img-top" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22286%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20286%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_17ff3c8cf14%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A14pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_17ff3c8cf14%22%3E%3Crect%20width%3D%22286%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22107.19140625%22%20y%3D%2296.3%22%3E286x180%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Card image cap">
                 <div class="card-body">
                   <h5 class="card-title">`+ data[i].name +`</h5>
                   <p class="card-text">`+ data[i].description +`</p>
                   <div class="btn-group" role="group">
                     <button type="button" class="btn btn-primary event-button" onclick="EventService.get(`+data[i].id+`)">Edit</button>
                     <button type="button" class="btn btn-success event-button" onclick="TodoService.list_by_event_id(`+data[i].id+`)">Manage</button>
                     <button type="button" class="btn btn-danger event-button" onclick="EventService.delete(`+data[i].id+`)">Delete</button>
                     <button type="button" class="btn btn-warning event-button" onclick="EventService.share(`+data[i].id+`)">Share</button>
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
           $('#addEventForm input[name="description"]').val(data.description);
           $('#addEventForm input[name="created"]').val(data.created);
           $('#addEventForm input[name="color"]').val(data.color);

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

    choose_color: function(color){
      $('#addEventForm input[name="color"]').val(color);
    },

    share: function(id){
      $('#shareEventForm input[name="event_id"]').val(id);
      $('#shareModal').modal('show');
    },

    share_event : function(){
      var event_id = $('#shareEventForm input[name="event_id"]').val();
      var recipient = $('#shareEventForm input[name="recipient"]').val();

      $.ajax({
        url: 'rest/events/'+event_id+'/share',
        type: 'POST',
        beforeSend: function(xhr){
          xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
        },
        data: JSON.stringify({email: recipient}),
        contentType: "application/json",
        dataType: "json",
        success: function(result) {
            $("#shareModal").modal("hide");
            toastr.success("Event shared!");
        }
      });

    }


}
