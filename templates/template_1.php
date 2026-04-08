<div class="certificate-container" style="border: 10px solid #f1c40f;">
    <!-- Abstract Shapes -->
    <div class="shape circle" style="width: 300px; height: 300px; background: rgba(241, 196, 15, 0.1); top: -50px; left: -50px;"></div>
    <div class="shape circle" style="width: 200px; height: 200px; background: rgba(241, 196, 15, 0.2); bottom: -50px; right: -50px;"></div>
    
    <div class="cert-content">
        <h1 class="cert-title" style="color: #d35400;">Certificate of Achievement</h1>
        <p class="cert-subtitle">This certificate is proudly presented to</p>
        
        <div class="cert-name"><?php echo htmlspecialchars($cert['name']); ?></div>
        
        <div class="cert-body">
            <p>Roll No: <?php echo htmlspecialchars($cert['roll_number']); ?> | Class: <?php echo htmlspecialchars($cert['class']); ?></p>
            <p>For securing the <strong>WINNER</strong> position in the event</p>
            <p class="cert-event"><?php echo htmlspecialchars($cert['event_name']); ?></p>
            <p><?php echo htmlspecialchars($cert['event_description']); ?></p>
        </div>
        
        <div class="cert-footer">
            <div class="signature">
                <div class="signature-line"></div>
                <strong>Event Coordinator</strong>
            </div>
            <div class="signature">
                <div class="signature-line"></div>
                <strong>Principal</strong>
            </div>
        </div>
        
        <p style="margin-top: 30px; font-size: 14px; color: #777;">Issued on: <?php echo htmlspecialchars($cert['issue_date']); ?></p>
    </div>
</div>
