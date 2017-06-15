<form>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="title-p-2">Coca Cola needs additional information in order to contact you.</h2>
                <p class="offset-bottom-primary hint">This information will be available only to the company and will not be publicly shared.</p>            
                <div class="contact-form-block">
                    <div class="xlarge-6 tablet-9 medium-12 item-field">
                        <label for="ComplaintForm_full_name">Full Name</label>            
                        <input name="ComplaintForm[full_name]" id="ComplaintForm_full_name" type="text" maxlength="255">            
                    </div>        
                </div>
                <div class="xlarge-6 tablet-9 medium-12 item-field">
                    <label for="ComplaintForm_personal_email">Your Email</label>            
                    <input name="ComplaintForm[personal_email]" id="ComplaintForm_personal_email" type="email" maxlength="100">            
                </div>        
                <div class="xlarge-6 tablet-9 medium-12 item-field mb0px">
                    <label for="ComplaintForm_personal_phone">Personal Phone</label>            
                    <input name="ComplaintForm[personal_phone]" id="ComplaintForm_personal_phone" type="tel">
                </div>            
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mood-reasons-list">
                    <div class="icon lnr-sad"></div>
                    <label>I am unhappy because of</label>
                    <span id="ComplaintForm_pissedReasonTemp">
                        <div class="radio-item">
                            <input class="radio-btns vertical unhappy"  id="ComplaintForm_pissedReasonTemp_0" value="Poor customer service" type="radio" name="ComplaintForm[pissedReasonTemp]">
                            <label for="ComplaintForm_pissedReasonTemp_0">Poor customer service</label>
                        </div>
                        <div class="radio-item">
                            <input class="radio-btns vertical unhappy"  id="ComplaintForm_pissedReasonTemp_1" value="Bad quality" type="radio" name="ComplaintForm[pissedReasonTemp]">
                            <label for="ComplaintForm_pissedReasonTemp_1">Bad quality</label>
                        </div>
                        <div class="radio-item">
                            <input class="radio-btns vertical unhappy"  id="ComplaintForm_pissedReasonTemp_2" value="Problem with delivery" type="radio" name="ComplaintForm[pissedReasonTemp]">
                            <label for="ComplaintForm_pissedReasonTemp_2">Problem with delivery</label>
                        </div>
                        <div class="radio-item">
                            <input class="radio-btns vertical unhappy"  id="ComplaintForm_pissedReasonTemp_3" value="Order processing issue" type="radio" name="ComplaintForm[pissedReasonTemp]">
                            <label for="ComplaintForm_pissedReasonTemp_3">Order processing issue</label>
                        </div>
                        <div class="radio-item">
                            <input class="radio-btns vertical unhappy"  id="ComplaintForm_pissedReasonTemp_4" value="Pricing issue" type="radio" name="ComplaintForm[pissedReasonTemp]">
                            <label for="ComplaintForm_pissedReasonTemp_4">Pricing issue</label>
                        </div>
                        <div class="radio-item">
                            <input class="radio-btns vertical unhappy"  id="ComplaintForm_pissedReasonTemp_5" value="Warranty issue" type="radio" name="ComplaintForm[pissedReasonTemp]">
                            <label for="ComplaintForm_pissedReasonTemp_5">Warranty issue</label>
                        </div>
                        <div class="radio-item">
                            <input class="radio-btns vertical unhappy"  id="ComplaintForm_pissedReasonTemp_6" value="Damaged or defective" type="radio" name="ComplaintForm[pissedReasonTemp]">
                            <label for="ComplaintForm_pissedReasonTemp_6">Damaged or defective</label>
                        </div>
                        <div class="radio-item">
                            <input class="radio-btns vertical unhappy"  id="ComplaintForm_pissedReasonTemp_7" value="Problems with payment" type="radio" name="ComplaintForm[pissedReasonTemp]">
                            <label for="ComplaintForm_pissedReasonTemp_7">Problems with payment</label>
                        </div>
                        <div class="radio-item">
                            <input class="radio-btns vertical unhappy"  id="ComplaintForm_pissedReasonTemp_8" value="Not as described" type="radio" name="ComplaintForm[pissedReasonTemp]">
                            <label for="ComplaintForm_pissedReasonTemp_8">Not as described</label>
                        </div>
                        <div class="radio-item">
                            <input class="radio-btns vertical unhappy"  id="ComplaintForm_pissedReasonTemp_9" value="Return, Exchange or Cancellation Policy" type="radio" name="ComplaintForm[pissedReasonTemp]">
                            <label for="ComplaintForm_pissedReasonTemp_9">Return, Exchange or Cancellation Policy</label>
                        </div>
                        <div class="radio-item">
                            <input class="radio-btns vertical unhappy"  id="ComplaintForm_pissedReasonTemp_10" value="Other issue" type="radio" name="ComplaintForm[pissedReasonTemp]">
                            <label for="ComplaintForm_pissedReasonTemp_10">Other issue</label>
                        </div>
                        <div class="radio-item">
                            <input type="text" name="ComplaintForm[pissedReasonTemp]" class="unhappy-other-reason">
                        </div>
                    </span>               
                </div>
            </div>
            <div class="col-md-6">
                <div class="mood-reasons-list">
                    <div class="icon lnr-smile"></div>
                    <label>I am happy because of</label>
                    <span id="ComplaintForm_pleasedReasonTemp">
                        <div class="radio-item">
                            <input class="radio-btns vertical happy" data-mood="3" id="ComplaintForm_pleasedReasonTemp_0" value="Good customer service" type="radio" name="ComplaintForm[pleasedReasonTemp]">
                            <label for="ComplaintForm_pleasedReasonTemp_0">Good customer service</label>
                        </div>
                        <div class="radio-item">
                            <input class="radio-btns vertical happy" data-mood="3" id="ComplaintForm_pleasedReasonTemp_1" value="Good quality" type="radio" name="ComplaintForm[pleasedReasonTemp]">
                            <label for="ComplaintForm_pleasedReasonTemp_1">Good quality</label>
                        </div>
                        <div class="radio-item">
                            <input class="radio-btns vertical happy" data-mood="3" id="ComplaintForm_pleasedReasonTemp_2" value="On time delivery" type="radio" name="ComplaintForm[pleasedReasonTemp]">
                            <label for="ComplaintForm_pleasedReasonTemp_2">On time delivery</label>
                        </div>
                        <div class="radio-item">
                            <input class="radio-btns vertical happy" data-mood="3" id="ComplaintForm_pleasedReasonTemp_3" value="Fast order processing" type="radio" name="ComplaintForm[pleasedReasonTemp]">
                            <label for="ComplaintForm_pleasedReasonTemp_3">Fast order processing</label>
                        </div>
                        <div class="radio-item">
                            <input class="radio-btns vertical happy" data-mood="3" id="ComplaintForm_pleasedReasonTemp_4" value="Fair pricing" type="radio" name="ComplaintForm[pleasedReasonTemp]">
                            <label for="ComplaintForm_pleasedReasonTemp_4">Fair pricing</label>
                        </div>
                        <div class="radio-item">
                            <input class="radio-btns vertical happy" data-mood="3" id="ComplaintForm_pleasedReasonTemp_5" value="Reliable warranty" type="radio" name="ComplaintForm[pleasedReasonTemp]">
                            <label for="ComplaintForm_pleasedReasonTemp_5">Reliable warranty</label>
                        </div>
                        <div class="radio-item">
                            <input class="radio-btns vertical happy" data-mood="3" id="ComplaintForm_pleasedReasonTemp_6" value="Happy for another reason" type="radio" name="ComplaintForm[pleasedReasonTemp]">
                            <label for="ComplaintForm_pleasedReasonTemp_6">Happy for another reason</label>
                        </div>
                        <div class="radio-item">
                            <input type="text" name="ComplaintForm[pleasedReasonTemp]" class="happy-other-reason">
                        </div>
                    </span>                
                </div>
            </div>
        </div>
        <div class="row">
            <div class="xlarge-4 medium-5 small-12 item-field">
                <label for="ValueOfYourLoss">Value of your loss, $</label>
                <input name="ComplaintForm[monetary_value]" id="ComplaintForm_monetary_value" type="text" maxlength="6">                            
                <span class="hint">Only numbers, e.g. 11 or 5000.</span>
            </div>
        </div>
        <div class="row">
            <div class="radio-item">
                <input class="radio-btns" value="Full Refund" type="radio" name="ComplaintForm[wanted_solution]">
                <label>Full Refund</label>
            </div>
            <div class="radio-item">
                <input class="radio-btns" value="Price reduction" type="radio" name="ComplaintForm[wanted_solution]">
                <label>Price reduction</label>
            </div>
            <div class="radio-item">
                <input class="radio-btns" value="Delivery product or service ordered" type="radio" name="ComplaintForm[wanted_solution]">
                <label>Delivery product or service ordered</label>
            </div>
            <div class="radio-item">
                <input class="radio-btns" value="Let the company propose a solution" type="radio" name="ComplaintForm[wanted_solution]">
                <label>Let the company propose a solution</label>
            </div>
            <div class="radio-item">
                <input class="radio-btns" value="Other solution" type="radio" name="ComplaintForm[wanted_solution]">
                <label>Other solution</label>
            </div>
            <div class="radio-item">
                <input class="radio-btns" value="" type="radio" name="ComplaintForm[wanted_solution]">
                <input name="ComplaintForm[wanted_solution]" type="text" maxlength="255">
            </div>
        </div>
        <div class="row">
            <input type="submit" value="Proceed">
        </div>
    </div>
</form>