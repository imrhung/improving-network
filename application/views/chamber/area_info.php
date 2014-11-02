<h1>Area Information</h1>
<p></p>

<form class="form-horizontal" onsubmit="return false;">
    <fieldset>

        <!-- Form Name -->
        <legend>Update the information</legend>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-3 control-label" for="phone">Phone Number</label>  
            <div class="col-md-4">
                <input id="phone" name="phone" type="text" placeholder="" class="form-control input-md" required="">

            </div>
        </div>

        <!-- File Button --> 
        <div class="form-group">
            <label class="col-md-3 control-label" for="userfile">Header Photo</label>
            <div class="col-md-4">
                <input id="userfile" name="userfile" class="form-control input-file" type="file" data-url="api/file/jqfupload">
                <img id="header-photo" src="" class="img-responsive img-center img-thumbnail" alt="Your header image">
            </div>
        </div>
        
        <!-- Textarea -->
        <div class="form-group">
            <label class="col-md-3 control-label" for="description">Description</label>
            <div class="col-md-4">                     
                <textarea class="form-control" id="description" name="description" rows="12"></textarea>
            </div>
        </div>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-3 control-label" for="update"></label>
            <div class="col-md-4">
                <button id="update" name="update" class="btn btn-success btn-block" data-loading-text="Saving...">Update</button>
            </div>
        </div>

    </fieldset>
</form>
