
 $(function() {
     
    /**
     * Event
     */ 
     $('#datetimepicker_dt').datetimepicker({
      language: 'en',
      pick12HourFormat: true,
      pickDate: true,
      pickTime: true
    });
    
    
    $('.trigger_event').click(function(){
        var urlAjax;
        $t = $(this);
        urlAjax = ($t.data('url').replace('__IDE__',$t.data('ide')));
        
        $.ajax({
            url: urlAjax,
            type: 'html',
            success: function(response){
                $('.optviewer').remove();
                $t.parent().append('<div class="optviewer">'+response+'</div>');
            }
        });
        
    });
    
    
  });