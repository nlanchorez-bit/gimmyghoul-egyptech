<!-- Include HEAD -->
<?= $this->include('components/head') ?>
<!-- Include HEADER -->
<?= $this->include('components/header') ?>

<main style="background-color: #f9f9f9; min-height: 100vh; padding: 40px 0;">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">

        <div style="margin-bottom: 30px;">
            <h1 style="font-family: 'Tajawal', sans-serif; color: #702524; margin: 0;">Manage Requests</h1>
            <p style="color: #666; margin-top: 5px;">Approve or Decline customer orders.</p>
        </div>

        <!-- Alerts -->
        <?php if (session()->has('message')): ?>
            <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
                <?= session('message') ?>
            </div>
        <?php endif; ?>

        <div style="background: white; border-radius: 16px; border: 1px solid #ddd; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
            <table style="width: 100%; border-collapse: collapse;">
                <thead style="background: #f8f9fa; border-bottom: 1px solid #ddd;">
                    <tr>
                        <th style="padding: 15px; text-align: left; color: #555;">Order Info</th>
                        <th style="padding: 15px; text-align: left; color: #555;">Customer</th>
                        <th style="padding: 15px; text-align: left; color: #555;">Status</th>
                        <th style="padding: 15px; text-align: right; color: #555;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($requests)): ?>
                        <tr>
                            <td colspan="4" style="padding: 30px; text-align: center; color: #999;">No requests found.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($requests as $req): ?>
                            <tr style="border-bottom: 1px solid #eee;">
                                <!-- Product Info -->
                                <td style="padding: 20px 15px;">
                                    <div style="font-weight: bold; color: #702524;"><?= esc($req['product_name']) ?></div>
                                    <div style="font-size: 13px; color: #666;">Qty: <?= esc($req['quantity']) ?></div>
                                    <div style="font-size: 12px; color: #999;">
                                        <?= date('M d, Y h:i A', strtotime($req['created_at'])) ?>
                                    </div>
                                </td>

                                <!-- Customer Info -->
                                <td style="padding: 20px 15px;">
                                    <strong><?= esc($req['first_name'] . ' ' . $req['last_name']) ?></strong><br>
                                    <a href="mailto:<?= esc($req['email']) ?>" style="color: #666; font-size: 13px; text-decoration: none;"><?= esc($req['email']) ?></a><br>
                                    <span style="color: #666; font-size: 13px;"><?= esc($req['phone']) ?></span>
                                    <?php if ($req['additional_requests']): ?>
                                        <div style="background: #fff5e6; padding: 5px; margin-top: 5px; font-size: 12px; border-radius: 4px; color: #702524;">
                                            Note: <?= esc($req['additional_requests']) ?>
                                        </div>
                                    <?php endif; ?>
                                </td>

                                <!-- Status -->
                                <td style="padding: 20px 15px;">
                                    <?php
                                    $colors = [
                                        'pending' => '#ffc107',
                                        'approved' => '#28a745',
                                        'cancelled' => '#dc3545'
                                    ];
                                    $bg = $colors[$req['status']] ?? '#666';
                                    ?>
                                    <span style="background: <?= $bg ?>; color: white; padding: 4px 10px; border-radius: 50px; font-size: 12px; font-weight: bold; text-transform: uppercase;">
                                        <?= esc($req['status']) ?>
                                    </span>
                                </td>

                                <!-- Actions -->
                                <td style="padding: 20px 15px; text-align: right;">
                                    <?php if ($req['status'] === 'pending'): ?>
                                        <a href="<?= base_url('admin/requests/approve/' . $req['id']) ?>"
                                            class="btn btn-primary"
                                            style="font-size: 12px; padding: 6px 12px; margin-right: 5px;">
                                            Approve
                                        </a>
                                        <a href="<?= base_url('admin/requests/delete/' . $req['id']) ?>"
                                            class="btn btn-secondary"
                                            style="font-size: 12px; padding: 6px 12px; background: white; border: 1px solid #dc3545; color: #dc3545;"
                                            onclick="return confirm('Decline this order?');">
                                            Decline
                                        </a>
                                    <?php else: ?>
                                        <span style="color: #aaa; font-size: 13px;">No actions</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?= $this->include('components/footer') ?>