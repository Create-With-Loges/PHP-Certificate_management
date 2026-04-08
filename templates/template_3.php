<div class="certificate-container" style="border: 10px double #3498db;">
    <!-- Abstract Shapes -->
    <div class="shape" style="width: 150px; height: 150px; border: 5px solid #3498db; transform: rotate(45deg); top: -75px; left: -75px;"></div>
    <div class="shape" style="width: 150px; height: 150px; border: 5px solid #3498db; transform: rotate(45deg); bottom: -75px; right: -75px;"></div>
    
    <div class="cert-content">
        <h1 class="cert-title" style="color: #2980b9;">Certificate of Participation</h1>
        <p class="cert-subtitle">This is to certify that</p>
        
        <div class="cert-name"><?php echo htmlspecialchars($cert['name']); ?></div>
        
        <div class="cert-body">
            <p>Student of <?php echo htmlspecialchars($cert['class']); ?>, <?php echo htmlspecialchars($cert['department']); ?></p>
            <p>Has actively participated in the event</p>
            <p class="cert-event"><?php echo htmlspecialchars($cert['event_name']); ?></p>
            <p><?php echo htmlspecialchars($cert['event_description']); ?></p>
        </div>
        
        <div class="cert-footer">
            <div class="signature">
                <div class="signature-line"></div>
                <strong>Organizer</strong>
            </div>
            <div class="signature">
                <div class="signature-line"></div>
                <strong>HOD</strong>
            </div>
        </div>
        
        <p style="margin-top: 30px; font-size: 14px; color: #777;">Given on: <?php echo htmlspecialchars($cert['issue_date']); ?></p>
    </div>
</div>
