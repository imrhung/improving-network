<h1>Member</h1>
<p></p>

<form class="form-horizontal" onsubmit="return false;" id="member_form">
    <fieldset>

        <!-- Form Name -->
        <legend></legend>

        <!-- Business ID -->
        <input type="hidden" id="id" name="id" value="<?php echo $memberId?>">

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="business_name">Business Name</label>  
            <div class="col-md-6">
                <input id="business_name" name="business_name" type="text" placeholder="" class="form-control input-md" required="">

            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="first_name">First Name</label>  
            <div class="col-md-6">
                <input id="first_name" name="first_name" type="text" placeholder="" class="form-control input-md" required="">

            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="last_name">Last Name</label>  
            <div class="col-md-6">
                <input id="last_name" name="last_name" type="text" placeholder="" class="form-control input-md">

            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="mail_address">Mail Address</label>  
            <div class="col-md-6">
                <input id="mail_address" name="mail_address" type="text" placeholder="" class="form-control input-md" required="">

            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="city"></label>  
            <div class="col-md-6">
                <div class="col-sm-8" style="padding-left: 0px;">
                    <input id="city" name="city" type="text" placeholder="City" class="form-control input-md" required="">
                </div>
                <div class="col-sm-4" style="padding-right: 0px;">
                    <select id="state" name="state" size="1" class="form-control">
                        <option value="AK">AK</option>

                        <option value="AL">AL</option>
                        <option value="AR">AR</option>
                        <option value="AZ">AZ</option>
                        <option value="CA">CA</option>

                        <option value="CO">CO</option>
                        <option value="CT">CT</option>
                        <option value="DC">DC</option>
                        <option value="DE">DE</option>

                        <option value="FL">FL</option>
                        <option value="GA">GA</option>
                        <option value="HI">HI</option>
                        <option value="IA">IA</option>

                        <option value="ID">ID</option>
                        <option value="IL">IL</option>
                        <option value="IN">IN</option>
                        <option value="KS">KS</option>

                        <option value="KY">KY</option>
                        <option value="LA">LA</option>
                        <option value="MA">MA</option>
                        <option value="MD">MD</option>

                        <option value="ME">ME</option>
                        <option value="MI">MI</option>
                        <option value="MN">MN</option>
                        <option value="MO">MO</option>

                        <option value="MS">MS</option>
                        <option value="MT">MT</option>
                        <option value="NC">NC</option>
                        <option value="ND">ND</option>

                        <option value="NE">NE</option>
                        <option value="NH">NH</option>
                        <option value="NJ">NJ</option>
                        <option value="NM">NM</option>

                        <option value="NV">NV</option>
                        <option value="NY">NY</option>
                        <option value="OH">OH</option>
                        <option value="OK">OK</option>

                        <option value="OR">OR</option>
                        <option value="PA">PA</option>
                        <option value="RI">RI</option>
                        <option value="SC">SC</option>

                        <option value="SD">SD</option>
                        <option value="TN">TN</option>
                        <option value="TX">TX</option>
                        <option value="UT">UT</option>

                        <option value="VA">VA</option>
                        <option value="VT">VT</option>
                        <option value="WA">WA</option>
                        <option value="WI">WI</option>

                        <option value="WV">WV</option>
                        <option value="WY">WY</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="email">E-mail</label>  
            <div class="col-md-6">
                <input id="email" name="email" type="text" placeholder="someone@somesite.com" class="form-control input-md" required="">

            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="phone">Phone Number</label>  
            <div class="col-md-6">
                <input id="phone" name="phone" type="text" placeholder="" class="form-control input-md">

            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="website">Website</label>  
            <div class="col-md-6">
                <input id="website" name="website" type="text" placeholder="http://www.website.com" class="form-control input-md">

            </div>
        </div>

        <!-- Multiple Radios (inline) -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="new">New or Renew Member</label>
            <div class="col-md-6"> 
                <label class="radio-inline" for="new-0">
                    <input type="radio" name="new" id="new-0" value="0" checked="checked">
                    New
                </label> 
                <label class="radio-inline" for="new-1">
                    <input type="radio" name="new" id="new-1" value="1">
                    Renew
                </label>
            </div>
        </div>

        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="membership">Yearly Membership</label>
            <div class="col-md-6">
                <select id="membership" name="membership" class="form-control">
                    <option value="0">Yearly Membership Categories</option>
                    <option value="1">10 or Less Employees $115</option>
                    <option value="2">11-25 Employees $140</option>
                    <option value="3">26 or More Employees $200</option>
                    <option value="4">Associate (Church/School/Civic Organization) $55</option>
                    <option value="5">Patron (Individual with Personal Interest in TR) $50</option>
                    <option value="6">Ex-Officio (Elected Official Representing TR) $0</option>
                </select>
            </div>
        </div>

        <!-- Textarea -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="mem2mem">Member to Member Description</label>
            <div class="col-md-6">                     
                <textarea class="form-control" id="mem2mem" name="mem2mem" rows="4"></textarea>
            </div>
        </div>

        <!-- File Button --> 
        <div class="form-group">
            <label class="col-md-4 control-label" for="userfile">Member to Member Discount</label>
            <div class="col-md-6">
                <input id="userfile" name="userfile" class="input-file form-control" type="file">
            </div>
        </div>

        <!-- Multiple Checkboxes -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="prepay">Pre-Pay Meals</label>
            <div class="col-md-6">
                <div class="checkbox">
                    <label for="prepay-0">
                        <input type="checkbox" name="prepay" id="prepay" value="1">
                        Prepaid Meals ($80 for 8 Day Meetings)
                    </label>
                </div>
            </div>
        </div>

        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="category">Business Category</label>
            <div class="col-md-6" id="category">
                
            </div>
        </div>

        <!-- Textarea -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="description">Business Description</label>
            <div class="col-md-6">                     
                <textarea class="form-control" id="description" name="description" placeholder="Brief Description of Your Products or Services"  rows="5"></textarea>
            </div>
        </div>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="submit"></label>
            <div class="col-md-6">
                <button id="submit" name="submit" class="btn btn-success btn-block"  data-loading-text="Saving...">Submit</button>
            </div>
        </div>

    </fieldset>
</form>
