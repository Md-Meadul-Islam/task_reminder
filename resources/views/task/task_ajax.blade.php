<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
 </script>
 <script>
    $(document).ready(function () {
        let state ={
            isAllDay:false,
            dayAdded:false,
        }
        $(document).on('click', '#alldays', function () {
            if(!state.isAllDay){
                $.ajax({
                    url: "{{ route('alldays') }}",
                    method: 'GET',
                    success: function (res) {
                        $('.taskindex').html(res);
                        state.isAllDay = true;
                        state.dayAdded = false;
                    },
                    error: function (xhr) {
                        console.log(xhr);
                    }
                });
            }      
        }); 
        $(document).on('click', '.addday', function () {
            if(!state.dayAdded){
                $.ajax({
                    url: "{{route('addday')}}",
                    method: "GET",
                    success: function (res) {
                        $('.taskindex').html(res);
                        state.dayAdded = true;
                        state.isAllDay = false;
                    },
                });
            }
        });
        $(document).on('click', '#saveDayBtn', function () {
            let nextDate = null;
            let dayName= $('#dayname').val();
            let Repeat = $('#repeat').val();
            let Status = $('#status').val();
            let startDate = $('#startdate').val();
            if(!dayName){
                sessionStorage.setItem('error', 'Please Select Task Category Name !');
            }else{
            let selectedDays = Array.from($('input[name="week_day"]:checked')).map(function (checkbox) {  return checkbox.value; });
            let date = new Date(startDate);
            let weekdays = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
            
            if(Repeat == 'once'){
                nextDate = startDate;
            }else if(Repeat == 'every day'){
                nextDate = startDate;
            }else if(Repeat == 'every week'){            
                if (selectedDays.includes(weekdays[date.getDay()])) {
                    nextDate = startDate;
                } else{
                    for (let i = 0; i < 7; i++) {
                        let addedDate = new Date(date.setDate(date.getDate() + 1));     
                        let dayIndex = addedDate.getDay();
                        if (selectedDays.includes(weekdays[dayIndex])) {
                            nextDate = addedDate.toISOString().split('T')[0];
                            break;
                        }
                    }
                }
            }else if(Repeat == 'every fortnight'){
                date.setDate(date.getDate() + 15);
                nextDate = formatDate(date);               
            }else if(Repeat == 'every month'){
                date.setMonth(date.getMonth() + 1);
                nextDate = formatDate(date);
            }else if(Repeat == 'every 3 month'){
                date.setMonth(date.getMonth() + 3);
                nextDate = formatDate(date);
            }else if(Repeat == 'every 6 month'){
                date.setMonth(date.getMonth() + 6);
                nextDate = formatDate(date);
            }else if(Repeat == 'every year'){
                date.setFullYear(date.getFullYear() + 1);
                nextDate = formatDate(date);
            }
            // $.ajax({
            //     url: "{{ route('day.store')}}",
            //     method: "POST",
            //     data:{
            //         dayname: dayName,
            //         selecteddays: selectedDays,
            //         repeat: Repeat,
            //         startdate: startDate,
            //         nextdate: nextDate,
            //         status: Status                  
            //     },
            //     success:function(res){
            //         $('.taskindex').html(res);
            //         console.log(res);
            //     },error:function(xhr){
            //         console.log(xhr);
            //     }
            // })
        }
        function formatDate(date) {
            return date.toISOString().split('T')[0];
        }
        });
    });      
 </script>