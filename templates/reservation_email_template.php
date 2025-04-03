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
<p>Submitted on: <?= $data['timestamp'] ?></p>

<div class="section-title">Passenger Information</div>
<table>
    <tr><th>Name</th><td><?= $data['passenger']['name'] ?></td></tr>
    <tr><th>Company</th><td><?= $data['passenger']['company'] ?: 'N/A' ?></td></tr>
    <tr><th>Address</th><td><?= $data['passenger']['address'] ?></td></tr>
    <tr><th>Email</th><td><?= $data['passenger']['email'] ?></td></tr>
    <tr><th>Mobile Phone</th><td><?= $data['passenger']['mobile_phone'] ?></td></tr>
    <tr><th>Daytime Phone</th><td><?= $data['passenger']['daytime_phone'] ?: 'N/A' ?></td></tr>
</table>

<div class="section-title">Ride Details</div>
<table>
    <tr><th>Vehicle Type</th><td><?= $data['ride']['vehicle'] ?></td></tr>
    <tr><th>Service Type</th><td><?= $data['ride']['service'] ?></td></tr>
    <tr><th>Date/Time</th><td><?= $data['ride']['date'] ?> at <?= $data['ride']['time'] ?></td></tr>
    <tr><th>Passengers</th><td><?= $data['ride']['passengers'] ?></td></tr>
    <tr><th>Bags</th><td><?= $data['ride']['bags'] ?></td></tr>
</table>

<div class="section-title">Pickup Information</div>
<table>
    <tr><th>Type</th><td><?= ucfirst($data['ride']['pickup_type']) ?></td></tr>
    <?php foreach ($data['ride']['pickup_details'] as $key => $value): ?>
        <tr><th><?= ucfirst(str_replace('_', ' ', $key)) ?></th><td><?= $value ?></td></tr>
    <?php endforeach; ?>
</table>

<div class="section-title">Destination Information</div>
<table>
    <tr><th>Type</th><td><?= ucfirst($data['ride']['destination_type']) ?></td></tr>
    <?php foreach ($data['ride']['destination_details'] as $key => $value): ?>
        <tr><th><?= ucfirst(str_replace('_', ' ', $key)) ?></th><td><?= $value ?></td></tr>
    <?php endforeach; ?>
</table>

<div class="section-title">Payment Information</div>
<table>
    <tr><th>Method</th><td><?= ucfirst(str_replace('_', ' ', $data['payment']['method'])) ?></td></tr>
    <?php if ($data['payment']['method'] === 'credit_card'): ?>
        <?php foreach ($data['payment']['details'] as $key => $value): ?>
            <?php if (!empty($value)): ?>
                <tr><th><?= ucfirst(str_replace('_', ' ', $key)) ?></th><td><?= $key === 'card_number' ? '•••• •••• •••• ' . substr($value, -4) : $value ?></td></tr>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</table>

<?php if (!empty($data['additional_info'])): ?>
    <div class="section-title">Additional Information</div>
    <p><?= $data['additional_info'] ?></p>
<?php endif; ?>

<p><small>IP Address: <?= $data['ip'] ?></small></p>
</body>
</html>