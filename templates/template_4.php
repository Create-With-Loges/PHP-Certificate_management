<div class="certificate-container" style="background: linear-gradient(135deg, #fff 80%, #e8f8f5 100%); border: 2px solid #1abc9c;">
    <!-- Abstract Shapes -->
    <div class="shape" style="width: 100%; height: 10px; background: #1abc9c; top: 50px; left: 0;"></div>
    <div class="shape circle" style="width: 100px; height: 100px; background: #1abc9c; top: 5px; left: 50%; transform: translateX(-50%);"></div>
    
    <div class="cert-content" style="margin-top: 40px;">
        <h1 class="cert-title" style="color: #16a085; font-family: 'Courier New', Courier, monospace;">CERTIFICATE</h1>
        <p class="cert-subtitle">OF EXCELLENCE</p>
        
        <div class="cert-name" style="border-bottom: none; text-decoration: underline;"><?php echo htmlspecialchars($cert['name']); ?></div>
        
        <div class="cert-body">
            <p>We hereby acknowledge the outstanding performance of the above named student from <?php echo htmlspecialchars($cert['department']); ?>.</p>
            <p>Event: <strong class="cert-event"><?php echo htmlspecialchars($cert['event_name']); ?></strong></p>
            <p>Category: <strong><?php echo htmlspecialchars($cert['category']); ?></strong></p>
        </div>
        
        <div class="cert-footer">
            <div class="signature">
                <div class="signature-line"></div>
                <strong>Signature</strong>
            </div>
        </div>
        
        <p style="margin-top: 30px; font-size: 14px; color: #777;"><?php echo htmlspecialchars($cert['issue_date']); ?></p>
    </div>
</div>
