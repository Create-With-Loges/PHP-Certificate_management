<div class="certificate-container" style="border: 5px solid #9b59b6; border-radius: 20px;">
    <!-- Abstract Shapes -->
    <div class="shape" style="width: 200px; height: 200px; border-right: 5px solid #9b59b6; border-bottom: 5px solid #9b59b6; bottom: 20px; right: 20px;"></div>
    <div class="shape" style="width: 200px; height: 200px; border-left: 5px solid #9b59b6; border-top: 5px solid #9b59b6; top: 20px; left: 20px;"></div>
    
    <div class="cert-content">
        <h1 class="cert-title" style="color: #8e44ad; font-family: 'Trebuchet MS', sans-serif;">Certificate</h1>
        <p class="cert-subtitle">PROUDLY PRESENTED TO</p>
        
        <div class="cert-name" style="color: #8e44ad; border-color: #8e44ad;"><?php echo htmlspecialchars($cert['name']); ?></div>
        
        <div class="cert-body">
            <p>For their valuable contribution and participation in</p>
            <p class="cert-event" style="font-size: 30px; color: #8e44ad;"><?php echo htmlspecialchars($cert['event_name']); ?></p>
            <p>Category: <?php echo htmlspecialchars($cert['category']); ?></p>
        </div>
        
        <div class="cert-footer">
            <div class="signature">
                <div class="signature-line" style="border-color: #8e44ad;"></div>
                <strong>Authority</strong>
            </div>
        </div>
        
        <p style="margin-top: 30px; font-size: 14px; color: #777;">Issued: <?php echo htmlspecialchars($cert['issue_date']); ?></p>
    </div>
</div>
