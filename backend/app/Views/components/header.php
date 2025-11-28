<!-- Header -->
<header class="header" style="display:flex; align-items:center; justify-content:space-between; padding:0.5rem 2rem;">
    <nav class="nav-menu" style="display:flex; gap:1.5rem;">
        <a href="<?= site_url('/') ?>" class="nav-item" style="text-decoration: none;">Home</a>
        <a href="<?= site_url('shop') ?>" class="nav-item" style="text-decoration: none;">Store</a>
        <a href="<?= site_url('support') ?>" class="nav-item" style="text-decoration: none;">Support</a>
        <a href="<?= site_url('about-us') ?>" class="nav-item" style="text-decoration: none;">About Us</a>
    </nav>

    <!-- User area pushed to upper right -->
    <div style="display:flex; gap:0.75rem; align-items:center; margin-left:auto;">
        <?php if (session()->has('user')): ?>
            <?php
            $user = session()->get('user');
            // Determine display name and avatar from session data
            $displayName = $user['first_name'] ?? $user['username'] ?? 'Pharaoh User';
            $userEmail = $user['email'] ?? 'user@retrocrypt.com';
            // Check for profile_image or avatar key
            $profileImg = $user['profile_image'] ?? $user['avatar'] ?? null;
            ?>

            <!-- Logged-in state with Profile Dropdown -->
            <div style="position: relative;">
                <!-- Profile Button -->
                <button
                    id="profileButton"
                    type="button"
                    style="display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; background-color: transparent; border: 2px solid #C4B454; border-radius: 4px; color: #8B4513; cursor: pointer; transition: all 0.2s;">

                    <!-- Avatar Container (Small) -->
                    <div style="width: 32px; height: 32px; background-color: #C4B454; border-radius: 50%; border: 2px solid #8B4513; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                        <?php if ($profileImg): ?>
                            <img src="<?= esc($profileImg) ?>" alt="Profile" style="width: 100%; height: 100%; object-fit: cover;">
                        <?php else: ?>
                            <span style="font-size: 18px;">𓀀</span>
                        <?php endif; ?>
                    </div>

                    <span><?= esc($displayName) ?></span>
                    <svg id="dropdownArrow" style="width: 16px; height: 16px; transition: transform 0.2s;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div
                    id="profileDropdown"
                    style="display: none; position: absolute; right: 0; margin-top: 0.5rem; width: 288px; background-color: #F5E6D3; border: 3px solid #C4B454; border-radius: 4px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 1000;">
                    <!-- Decorative Egyptian border top -->
                    <div style="height: 8px; background: repeating-linear-gradient(90deg, #C4B454 0px, #C4B454 10px, #8B7355 10px, #8B7355 20px);"></div>

                    <!-- Profile Info -->
                    <div style="padding: 1rem; border-bottom: 2px solid #C4B454;">
                        <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem;">
                            <!-- Avatar Container (Large) -->
                            <div style="width: 48px; height: 48px; background-color: #C4B454; border-radius: 50%; border: 3px solid #8B4513; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                                <?php if ($profileImg): ?>
                                    <img src="<?= esc($profileImg) ?>" alt="Profile" style="width: 100%; height: 100%; object-fit: cover;">
                                <?php else: ?>
                                    <span style="font-size: 24px;">𓀀</span>
                                <?php endif; ?>
                            </div>

                            <div style="overflow: hidden;">
                                <div style="color: #8B4513; font-weight: 500; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= esc($displayName) ?></div>
                                <div style="color: #8B7355; font-size: 14px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= esc($userEmail) ?></div>
                            </div>
                        </div>

                        <!-- Egyptian decorative elements -->
                        <div style="display: flex; justify-content: center; gap: 0.5rem; font-size: 20px; color: #C4B454;">
                            <span>𓆣</span>
                            <span>𓁿</span>
                            <span>𓆣</span>
                        </div>
                    </div>

                    <!-- Menu Items -->
                    <div style="padding: 0.5rem 0;">
                        <a
                            href="<?= site_url('profile') ?>"
                            class="dropdown-item"
                            style="display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 1rem; color: #8B4513; text-decoration: none; transition: background-color 0.15s;"
                            onmouseover="this.style.backgroundColor='#E8D7C3'"
                            onmouseout="this.style.backgroundColor='transparent'">
                            <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>View Profile</span>
                        </a>
                    </div>

                    <!-- Decorative divider -->
                    <div style="height: 4px; margin: 0 1rem; background: repeating-linear-gradient(90deg, #C4B454 0px, #C4B454 5px, transparent 5px, transparent 10px);"></div>

                    <!-- Logout Button -->
                    <div style="padding: 0.5rem;">
                        <form action="<?= site_url('logout') ?>" method="post" style="margin: 0;">
                            <?= csrf_field() ?>
                            <button
                                type="submit"
                                style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 0.5rem; padding: 0.5rem 1rem; background-color: #C4B454; color: #2C1810; border: 2px solid #8B7355; border-radius: 4px; cursor: pointer; transition: all 0.15s;"
                                onmouseover="this.style.backgroundColor='#B5A54A'; this.style.transform='translateY(-1px)';"
                                onmouseout="this.style.backgroundColor='#C4B454'; this.style.transform='translateY(0)';">
                                <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>

                    <!-- Decorative Egyptian border bottom -->
                    <div style="height: 8px; background: repeating-linear-gradient(90deg, #C4B454 0px, #C4B454 10px, #8B7355 10px, #8B7355 20px);"></div>
                </div>
            </div>

            <script>
                // Toggle dropdown
                document.getElementById('profileButton').addEventListener('click', function(e) {
                    e.stopPropagation();
                    const dropdown = document.getElementById('profileDropdown');
                    const arrow = document.getElementById('dropdownArrow');
                    const isOpen = dropdown.style.display === 'block';

                    dropdown.style.display = isOpen ? 'none' : 'block';
                    arrow.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
                    this.style.boxShadow = isOpen ? 'none' : '0 0 0 2px #8B7355';
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    const dropdown = document.getElementById('profileDropdown');
                    const button = document.getElementById('profileButton');
                    const arrow = document.getElementById('dropdownArrow');

                    if (dropdown && !button.contains(e.target) && !dropdown.contains(e.target)) {
                        dropdown.style.display = 'none';
                        arrow.style.transform = 'rotate(0deg)';
                        button.style.boxShadow = 'none';
                    }
                });
            </script>
        <?php else: ?>
            <!-- Sign Up Button as a Link -->
            <a href="<?= site_url('signup') ?>" class="signup-btn" style="text-decoration: none;">Sign Up</a>
        <?php endif; ?>
    </div>
</header>