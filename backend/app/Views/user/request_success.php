<!-- Include HEAD -->
<?= $this->include('components/head') ?>
<!-- Include HEADER -->
<?= $this->include('components/header') ?>

<main style="background-color: #f9f9f9; min-height: 80vh; display: flex; align-items: center; justify-content: center; padding: 20px;">
    <div style="text-align: center; background: white; padding: 50px; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); max-width: 500px; width: 100%;">

        <!-- Success Icon -->
        <div style="font-size: 60px; color: #28a745; margin-bottom: 20px;">
            <i class="fas fa-check-circle"></i>
        </div>

        <h1 style="font-family: 'Tajawal', sans-serif; color: #333; margin-top: 0; font-size: 32px;">Request Sent!</h1>

        <p style="color: #666; margin-bottom: 30px; line-height: 1.6; font-size: 16px;">
            The seller has received your purchase request. <br>
            They will review the details and contact you shortly via email or phone regarding payment and shipping arrangements.
        </p>

        <div style="display: flex; gap: 15px; justify-content: center;">
            <a href="<?= base_url('shop') ?>" class="btn btn-primary" style="padding: 12px 30px; font-size: 16px;">
                Continue Shopping
            </a>

            <!-- Optional: View Requests History if you implement that later -->
            <!-- <a href="<?= base_url('account/requests') ?>" class="btn btn-secondary">View My Requests</a> -->
        </div>
    </div>
</main>

<!-- Include FOOTER -->
<?= $this->include('components/footer') ?>