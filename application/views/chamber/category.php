<!-- Headline -->
<h1><b>Chamber Category</b></h1>
<p>You can add or remove category.</p>
<p>You can only remove category with no member. To remove that category, please change these member to other category first.</p>

<div class="col-md-6">
    <table class="table table-striped table-bordered table-condensed" id="category-table">
        <thead>
            <tr>
                <th>Category</th>
                <th class="cell-center">Actions</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
    <form class="form-horizontal" onsubmit="createCategory();
                    return false;">
        <fieldset>

            <!-- Form Name -->
            <legend>Add a new Category</legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-5 control-label" for="category">Category Name</label>  
                <div class="col-md-7">
                    <input id="category" name="category" type="text" placeholder="Enter a new Category" class="form-control input-md" required="">

                </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-5 control-label" for="submit"></label>
                <div class="col-md-7">
                    <button id="submit" name="submit" class="btn btn-success btn-block" data-loading-text="Saving...">Add Category</button>
                </div>
            </div>

        </fieldset>
    </form>
</div>

