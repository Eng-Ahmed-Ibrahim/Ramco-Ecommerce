<!-- reminder -->


@if(isset($reminders))
@foreach($reminders as $reminder)

<div class="modal" tabindex="-1" id="reminder-{{$reminder->id}}" style="display: block; background:#0000004d;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{__('messages.Daily_reminder')}} - {{$reminder->date}}</h5>
        <button type="button"   onclick="document.getElementById('reminder-{{$reminder->id}}').style.display='none'" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>{{$reminder->title}}</p>
        @php
            $time = \Carbon\Carbon::createFromFormat('H:i', $reminder->time)->format('g:i A');
        @endphp
        <strong>{{$time}}</strong>
      </div>
      <div class="modal-footer">
          <button type="button" onclick="confrimReminder('{{$reminder->id}}')" class="btn btn-primary">{{__('messages.Confirm')}}</button>
        <button type="button" onclick="remindLater('{{$reminder->id}}')" class="btn btn-secondary" data-bs-dismiss="modal">{{__('messages.Remind_me_later')}}</button>
      </div>
    </div>
  </div>
</div>
@endforeach
@endif
<!-- end reminder -->

<script>
            function confrimReminder(reminder_id){
                console.log(reminder_id);
                $.ajax({
                    url: "{{ route('admin.confrim_reminder') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        reminder_id: reminder_id,
                    },
                    success: function(response) {
                        document.getElementById("reminder-"+reminder_id).style.display="none"
                        alert('{{__("messages.Success")}}');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
            function remindLater(reminder_id){
                console.log(reminder_id);
                $.ajax({
                    url: "{{ route('admin.remind_later') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        reminder_id: reminder_id,
                    },
                    success: function(response) {
                        document.getElementById("reminder-"+reminder_id).style.display="none"
                        alert('Success');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

    </script>