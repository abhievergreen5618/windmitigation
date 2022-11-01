@push('header_extras')
<style>
  .popover-header
  {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .close-pop
  {
    font-size:35px;
  }
</style>
@endpush
@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ __('Job Calender') }}</h3>
        </div>
        <div class="card-body p-0" id="maincalender" data-id="{{(Auth::user()->hasRole('admin')) ? 'all' : encrypt(Auth::user()->id) }}">
        @role('admin')
            <div class="row">
                <div class="col-lg-6 offset-lg-6">
                    <div class="my-2 px-2 ml-auto">
                        <div class="d-flex justify-content-around align-items-center">
                            <label for="jobins">{{ __('Select Inspector') }}</label>
                            <div class="w-75">
                                <select class="form-control" name="jobins" id="jobins">
                                    <option value="all">All</option>
                                    @forelse($inslist as $key=>$value)
                                    <option value="{{encrypt($key)}}">{{__($value)}}</option>
                                    @empty
                                    <option value="">No Inspector Founded</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endrole
            <div id="calendar"></div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
@endsection

@push('footer_extras')
<script>
    $(function() {

        var currentoption = $("#maincalender").attr("data-id");

        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date()
        var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear()

        var Calendar = FullCalendar.Calendar;
        var calendarEl = document.getElementById('calendar');

        var calendar = new Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            dayMaxEvents: true,
            selectable: true,
            themeSystem: 'bootstrap',
            eventSources: function(info, successCallback, failureCallback) {
                let start = moment(info.start.valueOf()).format('YYYY-MM-DD');
                let end = moment(info.end.valueOf()).format('YYYY-MM-DD');
                let filter = currentoption;
                jQuery.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'admininspectorevents',
                    dataType: 'json',
                    data: {
                        'filter': filter,
                        'start': start,
                        'end': end,
                    },
                    success: function(doc) {
                        var events = [];
                        if (!!doc.events) {
                            $.map(doc.events, function(r) {
                                start = new Date(r.schedule_at + ' ' + r.schedule_time);
                                end = new Date(r.schedule_at + ' ' + r.schedule_time);
                                events.push({
                                    id: r.id,
                                    title: r.applicantname,
                                    start: start,
                                    end: end,
                                    extendedProps: {
                                        inspectorname: r.name,
                                        link: "<a href='"+r.link+"' target='blank'>View Request</a>",
                                    },
                                    description: "at " + r.address + "<br>" + r.city + ", " + r.state + ", " + r.zipcode,
                                });
                            });
                        }
                        successCallback(events);
                    }
                });
            },
            eventDidMount: function(info) {
                element = $(info.el);
                element.popover({
                    html: true,
                    title: "<h3>" + info.event.title + "</h3>"+ "<a class='ml-2 close close-pop'>&times;</a>",
                    content: info.event.extendedProps.description + "<br>" + "Inspector: " + info.event.extendedProps.inspectorname + "<br>" + info.event.extendedProps.link,
                });
            }
        });

        calendar.render();

        var jobins = $('#jobins').select2({
            placeholder: "Select",
        });

        jobins.on('select2:selecting', function(sel) {
            $(this).find("option[value=" + sel.params.args.data.id + "]").each(function(e) {
                element = $(this);
                var id = $(this).val();
                if (id.length) {
                    currentoption = id;
                    calendar.refetchEvents();
                }
            });
        });
        $(document).on('click','.close-pop',function(){
            var id = $(this).parent().parent().attr("id");
            $("[aria-describedby='"+id+"']").click();
            $(this).parent().parent().remove();
        });
    })
</script>
@endpush