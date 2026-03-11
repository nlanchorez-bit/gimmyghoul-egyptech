<!-- Include HEAD -->
<?= $this->include('components/head') ?>
<!-- Include HEADER -->
<?= $this->include('components/header') ?>

<main style="background-color: #f9f9f9; min-height: 100vh; padding: 40px 0;">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <h1 style="font-family: 'Tajawal', sans-serif; color: #702524; margin-bottom: 20px;">My Orders</h1>

        <?php if (empty($requests)): ?>
            <p style="color: #666;">You haven't placed any orders yet. <a href="<?= base_url('shop') ?>" style="color: #702524;">Start shopping</a>.</p>
        <?php else: ?>
            <div style="background: white; border-radius: 16px; border: 1px solid #ddd; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead style="background: #f8f9fa; border-bottom: 1px solid #ddd;">
                        <tr>
                            <th style="padding: 15px; text-align: left; color: #555;">Product</th>
                            <th style="padding: 15px; text-align: left; color: #555;">Quantity</th>
                            <th style="padding: 15px; text-align: left; color: #555;">Status</th>
                            <th style="padding: 15px; text-align: left; color: #555;">Ordered</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($requests as $req): ?>
                            <tr style="border-bottom: 1px solid #eee;">
                                <td style="padding: 20px 15px; display: flex; align-items: center; gap: 10px;">
                                    <?php
                                        $img = !empty($req['main_image'])
                                            ? base_url('uploads/products/' . $req['main_image'])
                                            : 'https://via.placeholder.com/60';
                                    ?>
                                    <img src="<?= $img ?>" alt="" style="width:60px; height:60px; object-fit:cover; border-radius:8px; border:1px solid #ddd;">
                                    <span style="font-weight: bold; color: #702524;"><?= esc($req['product_name'] ?? '-') ?></span>
                                </td>
                                <td style="padding: 20px 15px;"><?= esc($req['quantity']) ?></td>
                                <td style="padding: 20px 15px;">
                                    <?php
                                    $colors = [
                                        'pending'   => '#ffc107',
                                        'approved'  => '#28a745',
                                        'cancelled' => '#dc3545',
                                    ];
                                    $bg = $colors[$req['status']] ?? '#666';
                                    ?>
                                    <span style="background: <?= $bg ?>; color: white; padding: 4px 10px; border-radius: 50px; font-size: 12px; font-weight: bold; text-transform: uppercase;">
                                        <?= esc($req['status']) ?>
                                    </span>
                                </td>
                                <td style="padding: 20px 15px; color: #999; font-size: 13px;">
                                    <?= date('M d, Y', strtotime($req['created_at'])) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</main>

<!-- Include FOOTER -->
<?= $this->include('components/footer') ?>
