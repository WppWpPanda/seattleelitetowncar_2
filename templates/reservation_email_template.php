<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f2f2f2; }
        .section-title { font-size: 18px; margin: 20px 0 10px; color: #333; }
    </style>
</head>
<body>
<h1>New Reservation Request</h1>
<p>Submitted on: <?php echo$orderData['timestamp'] ?></p>

<div class="section-title">Passenger Information</div>
<table>
    <tr><th>Name</th><td><?php echo$orderData['passenger']['name'] ?></td></tr>
    <tr><th>Company</th><td><?php echo$orderData['passenger']['company'] ?: 'N/A' ?></td></tr>
    <tr><th>Address</th><td><?php echo$orderData['passenger']['address'] ?></td></tr>
    <tr><th>Email</th><td><?php echo$orderData['passenger']['email'] ?></td></tr>
    <tr><th>Mobile Phone</th><td><?php echo$orderData['passenger']['mobile_phone'] ?></td></tr>
    <tr><th>Daytime Phone</th><td><?php echo$orderData['passenger']['daytime_phone'] ?: 'N/A' ?></td></tr>
</table>

<div class="section-title">Ride Details</div>
<table>
    <tr><th>Vehicle Type</th><td><?php echo$orderData['ride']['vehicle'] ?></td></tr>
    <tr><th>Service Type</th><td><?php echo$orderData['ride']['service'] ?></td></tr>
    <tr><th>Date/Time</th><td><?php echo$orderData['ride']['date'] ?> at <?php echo$orderData['ride']['time'] ?></td></tr>
    <tr><th>Passengers</th><td><?php echo$orderData['ride']['passengers'] ?></td></tr>
    <tr><th>Bags</th><td><?php echo$orderData['ride']['bags'] ?></td></tr>
</table>

<div class="section-title">Pickup Information</div>
<table>
    <tr><th>Type</th><td><?php echo ucfirst($orderData['ride']['pickup_type']) ?></td></tr>
    <?php foreach ($orderData['ride']['pickup_details'] as $key => $value): ?>
        <tr><th><?php echo ucfirst(str_replace('_', ' ', $key)) ?></th><td><?php echo $value ?></td></tr>
    <?php endforeach; ?>
</table>

<div class="section-title">Destination Information</div>
<table>
    <tr><th>Type</th><td><?php echo ucfirst($orderData['ride']['destination_type']) ?></td></tr>
    <?php foreach ($orderData['ride']['destination_details'] as $key => $value): ?>
        <tr><th><?php echo ucfirst(str_replace('_', ' ', $key)) ?></th><td><?php echo $value ?></td></tr>
    <?php endforeach; ?>
</table>

<div class="section-title">Payment Information</div>
<table>
    <tr><th>Method</th><td><?php echo ucfirst(str_replace('_', ' ',$orderData['payment']['method'])) ?></td></tr>
    <?php if ($orderData['payment']['method'] === 'credit_card'): ?>
        <?php foreach ($orderData['payment']['details'] as $key => $value): ?>
            <?php if (!empty($value)): ?>
                <tr><th><?php echo ucfirst(str_replace('_', ' ', $key)) ?></th><td><?php echo $value ?></td></tr>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</table>

<?php if (!empty($orderData['additional_info'])): ?>
    <div class="section-title">Additional Information</div>
    <p><?php echo$orderData['additional_info'] ?></p>
<?php endif; ?>

<p><small>IP Address: <?php echo$orderData['ip'] ?></small></p>
</body>
</html>