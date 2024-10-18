document.addEventListener('DOMContentLoaded', function () {
    const taskIndex = document.querySelector('.taskindex');
    // view full task body
    const viewMoreBtns = document.querySelectorAll('.viewmore');
    viewMoreBtns.forEach(function (viewMore) {
        viewMore.addEventListener('click', function () {
            const shortText = this.parentElement;
            const fullTask = shortText.querySelector('.fullTask');
            const content = fullTask.innerText;
            shortText.innerHTML = content;
        });
    });
    //get selected days
    // var selectedDays = [];
    // function updateSelectedDays() {
    //     selectedDays = Array.from(document.querySelectorAll('input[name="week_day"]:checked')).map(function (checkbox) {
    //         return checkbox.value;
    //     });
    //     document.querySelector('#week_days').value = selectedDays;
    //     // console.log(selectedDays);
    // }
    // taskIndex.addEventListener('change', function (e) {
    //     if (e.target && e.target.name === 'week_day') {
    //         updateSelectedDays();
    //     }
    // });
});

