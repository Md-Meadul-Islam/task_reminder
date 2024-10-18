<div class="row g-0 d-flex bg-white my-1 mx-2">
    <h3 class="text-center text-secondary">Add New Day Category</h3>
    <div class="col-12 px-2">
        <div class="row d-flex">
            <div class="col-md-6 col-sm-12 py-1">
                <div class="input-group">
                    <span class="input-group-text" id="inputGroupPrepend">Day Name</span>
                    <input type="text" name="dayname" class="form-control" id="dayname" required>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 py-1">
                <div class="input-group">
                    <span class="input-group-text" id="inputGroupPrepend">Repeat</span>
                    <select name="repeat" id="repeat" class="form-select">
                        <option value="once">Once</option>
                        <option value="every day">Everyday</option>
                        <option value="every week">Every Week</option>
                        <option value="every fortnight">Every Fortnight</option>
                        <option value="every month">Every Month</option>
                        <option value="every 3 month">Every 3 Month</option>
                        <option value="every 6 month">Every 6 Month</option>
                        <option value="every year">Every Year</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 px-2 py-1">
        <div class="input-group btn-checkbox">
            <span class="input-group-text me-2" id="inputGroupPrepend">Week Days</span>
            <input type="checkbox" name="week_day" value="SUN" id="sunday">
            <label for="sunday" class="btn">SUN</label>
            <input type="checkbox" name="week_day" value="MON" id="monday">
            <label for="monday" class="btn">MON</label>
            <input type="checkbox" name="week_day" value="TUE" id="tuesday">
            <label for="tuesday" class="btn">TUE</label>
            <input type="checkbox" name="week_day" value="WED" id="wednesday">
            <label for="wednesday" class="btn">WED</label>
            <input type="checkbox" name="week_day" value="THU" id="thursday">
            <label for="thursday" class="btn">THU</label>
            <input type="checkbox" name="week_day" value="FRI" id="friday">
            <label for="friday" class="btn">FRI</label>
            <input type="checkbox" name="week_day" value="SAT" id="saturday">
            <label for="saturday" class="btn">SAT</label>
        </div>
    </div>
    <div class="col-12 px-2">
        <div class="row d-flex">
            <div class="col-md-6 col-sm-12 py-1">
                <div class="input-group">
                    <span class="input-group-text" id="inputGroupPrepend">Start Date</span>
                    <input type="date" name="startdate" class="form-control" id="startdate"value="{{ \Carbon\Carbon::now()->format('Y-m-d')}}" required>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 py-1">
                <div class="input-group">
                    <span class="input-group-text" id="inputGroupPrepend">Status</span>
                    <select name="status" id="status" class="form-select">
                        <option value="active">Active</option>
                        <option value="Paused">Paused</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 px-2 py-1 d-flex justify-content-center align-items-center">
        <a href="/" class="btn btn-secondary me-2">Back</a><a href="javascript:void(0)" class="btn btn-success" id="saveDayBtn">Save</a>
    </div>
</div>