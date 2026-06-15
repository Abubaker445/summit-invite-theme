<?php
/**
 * Summit Invite Child Theme — functions.php
 */

add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
});

add_shortcode( 'summit_invite', function() {
    ob_start();
    ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
    .si-wrap *, .si-wrap *::before, .si-wrap *::after { box-sizing: border-box; margin: 0; padding: 0; }
    .si-wrap {
        --ink: #0D0D0D; --ink-muted: #4A4A4A; --gold: #B8953F; --gold-light: #D4AF6A;
        --cream: #FAF8F4; --surface: #FFFFFF; --border: #E4E0D8;
        --error: #C0392B; --success: #1A6B3C; --radius: 6px;
        --ff-display: 'Cormorant Garamond', Georgia, serif;
        --ff-body: 'Inter', system-ui, sans-serif;
        font-family: var(--ff-body); color: var(--ink); background: var(--cream);
    }
    .si-hero {
        position: relative; min-height: 92vh; display: flex; align-items: center;
        justify-content: center; text-align: center; padding: 80px 24px 100px;
        overflow: hidden; background: #0D0D0D;
    }
    .si-hero::before {
        content: ''; position: absolute; inset: 0;
        background: radial-gradient(ellipse 70% 55% at 50% 40%, rgba(184,149,63,.18) 0%, transparent 70%);
        pointer-events: none;
    }
    .si-hero::after {
        content: ''; position: absolute; top: 0; left: 50%; transform: translateX(-50%);
        width: 1px; height: 72px; background: linear-gradient(to bottom, transparent, var(--gold));
    }
    .si-hero-inner { position: relative; max-width: 780px; width: 100%; }
    .si-eyebrow {
        font-size: 11px; font-weight: 500; letter-spacing: .2em; text-transform: uppercase;
        color: var(--gold); margin-bottom: 40px; display: flex; align-items: center;
        justify-content: center; gap: 12px;
    }
    .si-eyebrow span.line { display: inline-block; width: 40px; height: 1px; background: var(--gold); opacity: .5; }
    .si-event-name {
        font-family: var(--ff-display); font-size: clamp(42px, 8vw, 88px); font-weight: 300;
        color: #fff; line-height: 1.0; letter-spacing: -.01em; margin-bottom: 16px;
    }
    .si-event-name em { font-style: italic; color: var(--gold-light); }
    .si-event-year { font-size: 12px; letter-spacing: .25em; color: rgba(255,255,255,.35); text-transform: uppercase; margin-bottom: 56px; }
    .si-divider { width: 48px; height: 1px; background: var(--gold); margin: 0 auto 48px; opacity: .6; }
    .si-greeting {
        font-family: var(--ff-display); font-size: clamp(22px, 3.5vw, 34px); font-weight: 300;
        color: rgba(255,255,255,.75); line-height: 1.4; margin-bottom: 12px; font-style: italic;
    }
    .si-name {
        display: block; font-family: var(--ff-display); font-size: clamp(44px, 9vw, 96px);
        font-weight: 600; font-style: normal; color: #fff; line-height: 1.05;
        letter-spacing: -.02em; margin-top: 8px; margin-bottom: 32px;
    }
    .si-tagline {
        font-size: 15px; font-weight: 300; color: rgba(255,255,255,.45); line-height: 1.7;
        max-width: 480px; margin: 0 auto 56px;
    }
    .si-cta-arrow {
        display: inline-flex; flex-direction: column; align-items: center; gap: 8px;
        font-size: 10px; letter-spacing: .18em; text-transform: uppercase;
        color: rgba(255,255,255,.3); cursor: pointer; transition: color .2s;
        background: none; border: none;
    }
    .si-cta-arrow:hover { color: var(--gold); }
    .si-cta-arrow svg { width: 20px; height: 20px; }
    .si-form-section { background: var(--cream); padding: 100px 24px 120px; }
    .si-form-inner { max-width: 640px; margin: 0 auto; }
    .si-section-eyebrow {
        font-size: 11px; font-weight: 500; letter-spacing: .2em; text-transform: uppercase;
        color: var(--gold); margin-bottom: 16px; display: flex; align-items: center; gap: 12px;
    }
    .si-section-eyebrow span.line { display: inline-block; width: 32px; height: 1px; background: var(--gold); opacity: .5; }
    .si-section-title {
        font-family: var(--ff-display); font-size: clamp(32px, 5vw, 52px); font-weight: 300;
        color: var(--ink); line-height: 1.15; margin-bottom: 12px;
    }
    .si-section-title em { font-style: italic; color: var(--gold); }
    .si-section-sub { font-size: 14px; color: var(--ink-muted); line-height: 1.7; margin-bottom: 56px; font-weight: 300; }
    .si-form { display: flex; flex-direction: column; gap: 24px; }
    .si-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    @media (max-width: 540px) { .si-row { grid-template-columns: 1fr; } }
    .si-field { display: flex; flex-direction: column; gap: 6px; }
    .si-field label { font-size: 11px; font-weight: 500; letter-spacing: .12em; text-transform: uppercase; color: var(--ink-muted); }
    .si-field input, .si-field textarea {
        font-family: var(--ff-body); font-size: 15px; color: var(--ink); background: var(--surface);
        border: 1px solid var(--border); border-radius: var(--radius); padding: 14px 16px;
        width: 100%; outline: none; transition: border-color .2s, box-shadow .2s; -webkit-appearance: none;
    }
    .si-field input:focus, .si-field textarea:focus { border-color: var(--gold); box-shadow: 0 0 0 3px rgba(184,149,63,.12); }
    .si-field textarea { resize: vertical; min-height: 100px; }
    .si-field.has-error input, .si-field.has-error textarea { border-color: var(--error); box-shadow: 0 0 0 3px rgba(192,57,43,.1); }
    .si-field-error { font-size: 12px; color: var(--error); display: none; }
    .si-field.has-error .si-field-error { display: block; }
    .si-submit-wrap { margin-top: 8px; }
    .si-btn {
        font-family: var(--ff-body); font-size: 12px; font-weight: 500; letter-spacing: .18em;
        text-transform: uppercase; color: #0D0D0D; background: var(--gold); border: none;
        border-radius: var(--radius); padding: 18px 48px; cursor: pointer;
        transition: background .2s, opacity .2s, transform .1s;
        display: inline-flex; align-items: center; gap: 10px;
    }
    .si-btn:hover:not(:disabled) { background: var(--gold-light); transform: translateY(-1px); }
    .si-btn:disabled { opacity: .55; cursor: not-allowed; transform: none; }
    .si-spinner {
        display: none; width: 14px; height: 14px; border: 2px solid rgba(0,0,0,.2);
        border-top-color: #0D0D0D; border-radius: 50%; animation: si-spin .6s linear infinite;
    }
    .si-btn.loading .si-spinner { display: inline-block; }
    .si-btn.loading .si-btn-text { opacity: .6; }
    @keyframes si-spin { to { transform: rotate(360deg); } }
    .si-msg { padding: 16px 20px; border-radius: var(--radius); font-size: 14px; line-height: 1.6; display: none; margin-top: 24px; }
    .si-msg.success { background: #EBF5EF; border: 1px solid #A8D5B5; color: var(--success); display: block; }
    .si-msg.error-msg { background: #FDECEA; border: 1px solid #F0B0A8; color: var(--error); display: block; }
    .si-success-block { text-align: center; padding: 60px 24px; display: none; }
    .si-success-block.visible { display: block; }
    .si-success-icon { width: 64px; height: 64px; border-radius: 50%; background: #EBF5EF; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px; }
    .si-success-icon svg { width: 28px; height: 28px; color: var(--success); }
    .si-success-block h3 { font-family: var(--ff-display); font-size: 36px; font-weight: 300; color: var(--ink); margin-bottom: 12px; }
    .si-success-block p { font-size: 14px; color: var(--ink-muted); line-height: 1.7; }
    @media (max-width: 480px) {
        .si-hero { padding: 72px 20px 80px; min-height: 85vh; }
        .si-form-section { padding: 72px 20px 80px; }
        .si-btn { width: 100%; justify-content: center; }
    }
    </style>

    <div class="si-wrap">
        <section class="si-hero" id="si-hero">
            <div class="si-hero-inner">
                <p class="si-eyebrow"><span class="line"></span> Exclusive Delegate Invitation <span class="line"></span></p>
                <h1 class="si-event-name">Global<br><em>Leaders</em> Summit</h1>
                <p class="si-event-year">September 2025 &nbsp;&middot;&nbsp; Dubai, UAE</p>
                <div class="si-divider"></div>
                <p class="si-greeting" id="si-greeting-text">You are personally invited</p>
                <span class="si-name" id="si-delegate-name" style="display:none"></span>
                <p class="si-tagline" id="si-tagline">An invitation-only gathering of forward-thinking executives, policymakers, and innovators shaping the next decade.</p>
                <button class="si-cta-arrow" onclick="document.getElementById('si-register').scrollIntoView({behavior:'smooth'})">
                    Register below
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 5v14M5 12l7 7 7-7"/></svg>
                </button>
            </div>
        </section>

        <section class="si-form-section" id="si-register">
            <div class="si-form-inner">
                <p class="si-section-eyebrow"><span class="line"></span> Secure Your Place</p>
                <h2 class="si-section-title">Complete Your<br><em>Registration</em></h2>
                <p class="si-section-sub">All fields are required unless marked optional. Your details are kept strictly confidential.</p>

                <div class="si-success-block" id="si-success">
                    <div class="si-success-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5"/></svg>
                    </div>
                    <h3>Registration Confirmed</h3>
                    <p>Thank you. Your registration has been received and a confirmation will be sent to your email shortly.</p>
                </div>

                <form class="si-form" id="si-reg-form" novalidate>
                    <?php wp_nonce_field( 'si_form_nonce', 'si_nonce' ); ?>
                    <div class="si-row">
                        <div class="si-field" id="field-name">
                            <label for="si-full-name">Full Name</label>
                            <input type="text" id="si-full-name" name="full_name" value="" placeholder="Jane Smith" autocomplete="name">
                            <span class="si-field-error">Please enter your full name.</span>
                        </div>
                        <div class="si-field" id="field-email">
                            <label for="si-email">Email Address</label>
                            <input type="email" id="si-email" name="email" placeholder="jane@example.com" autocomplete="email">
                            <span class="si-field-error">Please enter a valid email.</span>
                        </div>
                    </div>
                    <div class="si-row">
                        <div class="si-field" id="field-phone">
                            <label for="si-phone">Phone Number</label>
                            <input type="tel" id="si-phone" name="phone" placeholder="+1 555 000 0000" autocomplete="tel">
                            <span class="si-field-error">Please enter your phone number.</span>
                        </div>
                        <div class="si-field" id="field-org">
                            <label for="si-org">Organization</label>
                            <input type="text" id="si-org" name="organization" placeholder="Acme Corp" autocomplete="organization">
                            <span class="si-field-error">Please enter your organization.</span>
                        </div>
                    </div>
                    <div class="si-field" id="field-title">
                        <label for="si-job-title">Job Title</label>
                        <input type="text" id="si-job-title" name="job_title" placeholder="Chief Executive Officer" autocomplete="organization-title">
                        <span class="si-field-error">Please enter your job title.</span>
                    </div>
                    <div class="si-field" id="field-requests">
                        <label for="si-requests">Special Requests <span style="font-weight:300;text-transform:none;letter-spacing:0">(optional)</span></label>
                        <textarea id="si-requests" name="special_requests" placeholder="Dietary requirements, accessibility needs, or any other requests..."></textarea>
                    </div>
                    <div class="si-submit-wrap">
                        <button type="submit" class="si-btn" id="si-submit-btn">
                            <span class="si-btn-text">Confirm Registration</span>
                            <span class="si-spinner"></span>
                        </button>
                    </div>
                    <div class="si-msg" id="si-form-msg"></div>
                </form>
            </div>
        </section>
    </div>

    <script>
    (function () {
        // ── Read name from URL using JavaScript ──
        var urlParams = new URLSearchParams(window.location.search);
        var name = urlParams.get('name') || '';

        if (name !== '') {
            // Sanitize: strip any HTML tags
            var safeName = name.replace(/<[^>]*>/g, '').trim();

            // Update hero
            document.getElementById('si-greeting-text').textContent = 'You are personally invited,';
            var nameEl = document.getElementById('si-delegate-name');
            nameEl.textContent = safeName;
            nameEl.style.display = 'block';
            document.getElementById('si-tagline').textContent = 'Your seat at the table has been reserved. We look forward to welcoming you to this invitation-only gathering of global changemakers.';

            // Pre-fill form
            document.getElementById('si-full-name').value = safeName;
        }

        // ── Form validation & submit ──
        var form    = document.getElementById('si-reg-form');
        var btn     = document.getElementById('si-submit-btn');
        var msgBox  = document.getElementById('si-form-msg');
        var success = document.getElementById('si-success');

        var fields = {
            'field-name':  { id: 'si-full-name', test: function(v){ return v.trim().length > 1; } },
            'field-email': { id: 'si-email',      test: function(v){ return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v.trim()); } },
            'field-phone': { id: 'si-phone',      test: function(v){ return v.trim().length > 5; } },
            'field-org':   { id: 'si-org',        test: function(v){ return v.trim().length > 0; } },
            'field-title': { id: 'si-job-title',  test: function(v){ return v.trim().length > 0; } }
        };

        function validate() {
            var ok = true;
            for (var id in fields) {
                var cfg   = fields[id];
                var wrap  = document.getElementById(id);
                var input = document.getElementById(cfg.id);
                if (!cfg.test(input.value)) { wrap.classList.add('has-error'); ok = false; }
                else { wrap.classList.remove('has-error'); }
            }
            return ok;
        }

        for (var id in fields) {
            (function(fid, cfg){
                document.getElementById(cfg.id).addEventListener('input', function(){
                    if (cfg.test(this.value)) document.getElementById(fid).classList.remove('has-error');
                });
            })(id, fields[id]);
        }

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            msgBox.className = 'si-msg';
            msgBox.textContent = '';
            if (!validate()) return;
            btn.disabled = true;
            btn.classList.add('loading');
            var data = new FormData(form);
            data.append('action',   'si_submit_form');
            data.append('si_nonce', document.getElementById('si_nonce').value);
            fetch('<?php echo esc_url( admin_url("admin-ajax.php") ); ?>', { method: 'POST', body: data })
            .then(function(r){ return r.json(); })
            .then(function(res){
                btn.disabled = false;
                btn.classList.remove('loading');
                if (res.success) { form.style.display = 'none'; success.classList.add('visible'); }
                else { msgBox.textContent = res.data || 'Something went wrong.'; msgBox.className = 'si-msg error-msg'; }
            })
            .catch(function(){
                btn.disabled = false;
                btn.classList.remove('loading');
                msgBox.textContent = 'A network error occurred. Please try again.';
                msgBox.className = 'si-msg error-msg';
            });
        });
    })();
    </script>
    <?php
    return ob_get_clean();
});

// AJAX handlers
add_action( 'wp_ajax_si_submit_form',        'si_handle_form_submit' );
add_action( 'wp_ajax_nopriv_si_submit_form', 'si_handle_form_submit' );

function si_handle_form_submit() {
    if ( ! isset( $_POST['si_nonce'] ) ||
         ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['si_nonce'] ) ), 'si_form_nonce' ) ) {
        wp_send_json_error( 'Security check failed. Please refresh and try again.' );
    }

    $full_name    = sanitize_text_field( wp_unslash( isset( $_POST['full_name'] )        ? $_POST['full_name']        : '' ) );
    $email        = sanitize_email(      wp_unslash( isset( $_POST['email'] )            ? $_POST['email']            : '' ) );
    $phone        = sanitize_text_field( wp_unslash( isset( $_POST['phone'] )            ? $_POST['phone']            : '' ) );
    $organization = sanitize_text_field( wp_unslash( isset( $_POST['organization'] )     ? $_POST['organization']     : '' ) );
    $job_title    = sanitize_text_field( wp_unslash( isset( $_POST['job_title'] )        ? $_POST['job_title']        : '' ) );
    $requests     = sanitize_textarea_field( wp_unslash( isset( $_POST['special_requests'] ) ? $_POST['special_requests'] : '' ) );

    $errors = array();
    if ( strlen( $full_name ) < 2 ) $errors[] = 'Full name is required.';
    if ( ! is_email( $email ) )     $errors[] = 'A valid email is required.';
    if ( strlen( $phone ) < 6 )     $errors[] = 'Phone number is required.';
    if ( $organization === '' )     $errors[] = 'Organization is required.';
    if ( $job_title === '' )        $errors[] = 'Job title is required.';

    if ( ! empty( $errors ) ) {
        wp_send_json_error( implode( ' ', $errors ) );
    }

    $sheets_result = si_send_to_google_sheets( array(
        'date'         => current_time( 'Y-m-d H:i:s' ),
        'full_name'    => $full_name,
        'email'        => $email,
        'phone'        => $phone,
        'organization' => $organization,
        'job_title'    => $job_title,
        'requests'     => $requests,
    ) );

    if ( is_wp_error( $sheets_result ) ) {
        error_log( '[Summit Invite] Google Sheets error: ' . $sheets_result->get_error_message() );
        $fallback   = get_option( 'si_failed_submissions', array() );
        $fallback[] = array(
            'full_name'    => $full_name,
            'email'        => $email,
            'phone'        => $phone,
            'organization' => $organization,
            'job_title'    => $job_title,
            'requests'     => $requests,
        );
        update_option( 'si_failed_submissions', $fallback, false );
    }

    wp_send_json_success( 'registered' );
}

function si_send_to_google_sheets( array $row ) {
    $url = defined( 'SI_GOOGLE_SCRIPT_URL' ) ? SI_GOOGLE_SCRIPT_URL : '';
    if ( empty( $url ) ) return new WP_Error( 'no_url', 'Google Script URL not configured.' );

    $response = wp_remote_post( $url, array(
        'timeout' => 15,
        'headers' => array( 'Content-Type' => 'application/json' ),
        'body'    => wp_json_encode( $row ),
    ) );

    if ( is_wp_error( $response ) ) return $response;

    $code = wp_remote_retrieve_response_code( $response );
    if ( $code < 200 || $code >= 300 ) return new WP_Error( 'bad_response', 'HTTP ' . $code );

    return true;
}
