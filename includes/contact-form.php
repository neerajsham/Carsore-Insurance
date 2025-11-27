<!-- Contact Form Popup HTML -->
<!-- Ye code apne main page ki body tag ke andar, closing </body> se pehle paste karein -->

<!-- Popup Overlay -->
<div id="contactNSFormPopup" class="contactNSFormOverlay">
    <div class="contactNSFormContainer">
        <button class="contactNSFormClose" onclick="closeContactForm()">&times;</button>
        <h2 class="contactNSFormTitle">Contact Us</h2>
        
        <form id="contactNSForm" action="process-contact.php" method="POST">
            <!-- Full Name -->
            <div class="contactNSFormGroup">
                <label for="contactNSFullName">Full Name *</label>
                <input type="text" id="contactNSFullName" name="full_name" class="contactNSFormInput" required>
            </div>
            
            <!-- Email -->
            <div class="contactNSFormGroup">
                <label for="contactNSEmail">Email *</label>
                <input type="email" id="contactNSEmail" name="email" class="contactNSFormInput" required>
            </div>
            
            <!-- Phone Number -->
            <div class="contactNSFormGroup">
                <label for="contactNSPhone">Phone Number *</label>
                <input type="tel" id="contactNSPhone" name="phone" class="contactNSFormInput" required>
            </div>
            
            <!-- Insurance Type -->
            <div class="contactNSFormGroup">
                <label for="contactNSInsurance">Insurance Type *</label>
                <select id="contactNSInsurance" name="insurance_type" class="contactNSFormSelect" required>
                    <option value="">Select Insurance Type</option>
                    <option value="STP">STP</option>
                    <option value="CTP">CTP</option>
                    <option value="Others">Others</option>
                </select>
            </div>
            
            <!-- Message -->
            <div class="contactNSFormGroup">
                <label for="contactNSMessage">Message *</label>
                <textarea id="contactNSMessage" name="message" class="contactNSFormTextarea" rows="5" required></textarea>
            </div>
            
            <!-- Submit Button -->
            <button type="submit" class="contactNSFormSubmitBtn">Submit</button>
            
            <!-- Success/Error Message -->
            <div id="contactNSFormResponse" class="contactNSFormResponse"></div>
        </form>
    </div>
</div>

