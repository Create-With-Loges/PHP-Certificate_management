<div class="certificate-container" style="border: 10px solid #95a5a6;">
    <!-- Abstract Shapes -->
    <div class="shape" style="width: 100%; height: 20px; background: #95a5a6; top: 20px; left: 0;"></div>
    <div class="shape" style="width: 100%; height: 20px; background: #95a5a6; bottom: 20px; left: 0;"></div>
    
    <div class="cert-content">
        <h1 class="cert-title" style="color: #7f8c8d;">Certificate of Appreciation</h1>
        <p class="cert-subtitle">Awarded to</p>
        
        <div class="cert-name"><?php echo htmlspecialchars($cert['name']); ?></div>
        
        <div class="cert-body">
            <p>Roll No: <?php echo htmlspecialchars($cert['roll_number']); ?> | Department: <?php echo htmlspecialchars($cert['department']); ?></p>
            <p>For securing the <strong>RUNNER UP</strong> position in</p>
            <p class="cert-event"><?php echo htmlspecialchars($cert['event_name']); ?></p>
            <p><?php echo htmlspecialchars($cert['event_description']); ?></p>
        </div>
        
        <div class="cert-footer">
            <div class="signature">
                <div class="signature-line"></div>
                <strong>Event Head</strong>
            </div>
            <div class="signature">
                <div class="signature-line"></div>
                <strong>Director</strong>
            </div>
        </div>
        
        <p style="margin-top: 30px; font-size: 14px; color: #777;">Date: <?php echo htmlspecialchars($cert['issue_date']); ?></p>
    </div>
</div>
