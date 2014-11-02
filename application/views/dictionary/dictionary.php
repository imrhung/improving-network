<div class="row main-content">
    <div class="col-md-12" style="border-bottom: solid #D1D2D4 1px;">
        <h2><b>THE DICTIONARY</b></h2>
    </div>
    <div class="col-md-3" id="dictionary-add">
        <p>Fill in the fields below to add a word to the dictionary</p>
        
        <form role="form" id="word-form" onsubmit="return false;">
            <fieldset>
                <div class="col-md-12 text-right" >
                    <button type="reset" id="reset" name="reset" class="btn btn-default btn-xs">Reset</button>
                </div>
                <input type="text" hidden="hidden" id="word-id">
                <!-- File Button --> 
                <div class="form-group">
                    <div class="col-md-12 upload" id="drop-image">
                        
                        <div class="col-xs-9" style="padding-left: 0px;">
                            
                            <a href="#" class="btn btn-success btn-sm" role="button">Add Image</a>
                            <span style="color: #888; font-size: 10px;">or Drop here</span>
                            <input id="image" name="userfile" class="form-control" type="file">
                        </div>
                        <div class="col-xs-3 form-thumbnail">
                            <img class="img-thumbnail" id="image-word" src="">
                        </div>
                    </div>
                </div>
                

                <!-- Text input-->
                <div class="form-group">
                    <div class="col-md-12">
                        <input id="word" name="word" type="text" placeholder="Add a Word" class="form-control input-md" required="">

                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <div class="col-md-12">
                        <textarea class="form-control" id="sentence" name="sentence" rows="2" placeholder="Add a Sentence"></textarea>
                    </div>
                </div>

                <!-- File Button --> 
                <div class="form-group">
                    <div class="col-md-12 upload" id="drop-sound">
                        <div class="col-xs-9" style="padding-left: 0px;">
                            
                            <a href="#" class="btn btn-success btn-sm" role="button">Add Sound</a>
                            <span style="color: #888; font-size: 10px;">or Drop here</span>
                            <input id="sound" name="userfile" class="form-control" type="file">
                        </div>
                        <div class="col-xs-3 text-center" style="padding-right: 0px; padding-top: 6px;">
                            <a href="javascript:void(0)" onclick="playSoundForm(this);">
                                <span class="fa "></span>
                                <span class="sound-url" id="sound-word" hidden="hidden"></span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- File Button --> 
                <div class="form-group">
                    <div class="col-md-12 upload" id="drop-example">
                        <div class="col-xs-9" style="padding-left: 0px;">
                            
                            <a href="#" class="btn btn-success btn-sm" role="button">Sound Ex</a>
                            <span style="color: #888; font-size: 10px;">or Drop here</span>
                            <input id="example-sound" name="userfile" class="form-control" type="file">
                        </div>
                        <div class="col-xs-3 text-center" style="padding-right: 0px; padding-top: 6px;">
                            <a href="javascript:void(0)" onclick="playSoundForm(this);">
                                <span class="fa "></span>
                                <span class="sound-url" id="sound-example" hidden="hidden"></span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <div class="col-md-12">
                        <textarea class="form-control" id="definition" name="definition" rows="2" placeholder="Definition"></textarea>
                    </div>
                </div>

                <!-- Select Basic -->
                <div class="form-group">
                    <div class="col-md-12">
                        <select id="part-of-speech" name="part-of-speech" class="form-control">
                            <option value="0">Part of speech</option>
                            <option value="1">noun</option>
                            <option value="2">pronoun</option>
                            <option value="3">adjective </option>
                            <option value="4">determiner </option>
                            <option value="5">verb </option>
                            <option value="6">adverb </option>
                            <option value="7">preposition </option>
                            <option value="8">conjuction </option>
                            <option value="9">interjection </option>
                            <option value="10">expression </option>
                            <option value="11">proper noun </option>
                        </select>
                    </div>
                </div>

                <!-- Select Basic -->
                <div class="form-group">
                    <div class="col-md-12">
                        <select id="difficulty" name="difficulty" class="form-control">
                            <option value="0">Difficulty</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3 </option>
                            <option value="4">4 </option>
                            <option value="5">5 </option>
                            <option value="6">6 </option>
                            <option value="7">7 </option>
                            <option value="8">8 </option>
                            <option value="9">9 </option>
                            <option value="10">10 </option>
                        </select>
                    </div>
                </div>

                <!-- Select Basic 
                <div class="form-group">
                    <div class="col-md-12">
                        <select id="language" name="language" class="form-control">
                            <option value="1">Language</option>
                            <option value="2">Option two</option>
                        </select>
                    </div>
                </div> -->

                <!-- Button -->
                <div class="form-group">
                    <div class="col-md-12">
                        <button id="submit" name="submit" class="btn btn-primary btn-block">Add a new word</button>
                    </div>
                </div>

            </fieldset>
        </form>

    </div>
    <div class="col-md-9">
        <div id="dictionary"></div>
        <span id="sound-speak"></span>
    </div>
</div>