<?php helper('form'); ?>
<!-- Include HEAD (Opens Body) -->
<?= $this->include('components/head') ?>

<!-- Include HEADER -->
<?= $this->include('components/header') ?>

<main style="background-color: #f9f9f9; min-height: 100vh; padding: 40px 0;">

    <div class="container" style="max-width: 800px; margin: 0 auto; padding: 0 20px;">

        <!-- Breadcrumb / Back Link -->
        <div style="margin-bottom: 20px;">
            <a href="<?= base_url('shop') ?>" style="text-decoration: none; color: #702524; font-weight: 600;">
                &larr; Back to Catalog
            </a>
        </div>

        <div style="background: #fff; border-radius: 16px; padding: 40px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); border: 1px solid rgba(112, 37, 36, 0.1);">

            <h1 style="font-family: 'Tajawal', sans-serif; color: #702524; margin-bottom: 10px;">Sell Your Console</h1>
            <p style="color: #666; margin-bottom: 30px;">Fill out the details below to list your item on RetroCrypt.</p>

            <!-- Validation Errors -->
            <?php if (session()->has('errors')): ?>
                <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                    <ul style="margin: 0; padding-left: 20px;">
                        <?php foreach (session('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Form Start -->
            <?= form_open_multipart('shop/store') ?>

            <!-- Product Name -->
            <div style="margin-bottom: 20px;">
                <label for="name" style="display: block; font-weight: 600; margin-bottom: 8px; color: #333;">Product Name</label>
                <input type="text" name="name" id="name" value="<?= old('name') ?>" required
                    placeholder="e.g. Nintendo GameBoy Color - Teal"
                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 16px;">
            </div>

            <!-- Grid for Category & Brand -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label for="category" style="display: block; font-weight: 600; margin-bottom: 8px; color: #333;">Category</label>
                    <select name="category" id="category" required
                        style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 16px; background: #fff;">
                        <option value="" disabled selected>Select...</option>
                        <option value="Console" <?= old('category') == 'Console' ? 'selected' : '' ?>>Console</option>
                        <option value="Handheld" <?= old('category') == 'Handheld' ? 'selected' : '' ?>>Handheld</option>
                        <option value="Camera" <?= old('category') == 'Camera' ? 'selected' : '' ?>>Camera</option>
                        <option value="MP3 Player" <?= old('category') == 'MP3 Player' ? 'selected' : '' ?>>MP3 Player</option>
                        <option value="Accessory" <?= old('category') == 'Accessory' ? 'selected' : '' ?>>Accessory</option>
                    </select>
                </div>
                <div>
                    <label for="brand" style="display: block; font-weight: 600; margin-bottom: 8px; color: #333;">Brand</label>
                    <input type="text" name="brand" id="brand" value="<?= old('brand') ?>"
                        placeholder="e.g. Nintendo, Sony"
                        style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 16px;">
                </div>
            </div>

            <!-- Grid for Condition, Price, Stock -->
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label for="condition" style="display: block; font-weight: 600; margin-bottom: 8px; color: #333;">Condition</label>
                    <select name="condition" id="condition" required
                        style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 16px; background: #fff;">
                        <option value="Used" <?= old('condition') == 'Used' ? 'selected' : '' ?>>Used</option>
                        <option value="Mint" <?= old('condition') == 'Mint' ? 'selected' : '' ?>>Mint</option>
                        <option value="Refurbished" <?= old('condition') == 'Refurbished' ? 'selected' : '' ?>>Refurbished</option>
                        <option value="For Parts" <?= old('condition') == 'For Parts' ? 'selected' : '' ?>>For Parts</option>
                    </select>
                </div>
                <div>
                    <label for="price" style="display: block; font-weight: 600; margin-bottom: 8px; color: #333;">Price (PHP)</label>
                    <input type="number" name="price" id="price" step="0.01" value="<?= old('price') ?>" required
                        placeholder="0.00"
                        style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 16px;">
                </div>
                <div>
                    <label for="stock" style="display: block; font-weight: 600; margin-bottom: 8px; color: #333;">Stock</label>
                    <input type="number" name="stock" id="stock" value="<?= old('stock', 1) ?>" required min="1"
                        style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 16px;">
                </div>
            </div>

            <!-- Description (Updated Label) -->
            <div style="margin-bottom: 20px;">
                <label for="description" style="display: block; font-weight: 600; margin-bottom: 8px; color: #333;">Description</label>
                <textarea name="description" id="description" rows="5" required
                    placeholder="Describe the item condition and history..."
                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 16px; font-family: inherit; resize: vertical;"><?= old('description') ?></textarea>
            </div>

            <!-- NEW: Inclusions Field (Matches Database Column) -->
            <div style="margin-bottom: 20px;">
                <label for="inclusions" style="display: block; font-weight: 600; margin-bottom: 8px; color: #333;">Inclusions (What's in the box?)</label>
                <textarea name="inclusions" id="inclusions" rows="3"
                    placeholder="e.g. Original Box, Charger, 4GB SD Card, Stylus..."
                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 16px; font-family: inherit; resize: vertical;"><?= old('inclusions') ?></textarea>
            </div>

            <!-- Image Upload -->
            <div style="margin-bottom: 30px;">
                <label for="main_image" style="display: block; font-weight: 600; margin-bottom: 8px; color: #333;">Product Image</label>
                <div style="border: 2px dashed #ddd; padding: 20px; border-radius: 8px; text-align: center; background: #fafafa;">
                    <input type="file" name="main_image" id="main_image" accept="image/*" required
                        style="display: block; width: 100%; margin: 0 auto;">
                    <p style="margin-top: 10px; font-size: 13px; color: #888;">Max file size: 2MB. Supported formats: JPG, PNG.</p>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 15px; font-size: 18px;">
                List Item for Sale
            </button>

            <?= form_close() ?>
        </div>
    </div>

</main>

<!-- Include FOOTER (Closes Body) -->
<?= $this->include('components/footer') ?>