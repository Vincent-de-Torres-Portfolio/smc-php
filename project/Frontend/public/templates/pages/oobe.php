<?php
//session_start();


//// Check if user is logged in and has a reset code in session
//if (!isset($_SESSION['user_logged_in']) || !isset($_SESSION['reset_code'])) {
//    header('Location: login.php');
//    exit();
//}


//
//$username = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
//$resetCode = $_SESSION['reset_code'];

//$username = "Vinny";
//$resetCode="5gVjdw";

?>
<style>
    #userSettingsForm {
        display: flex;
        flex-direction: column;
        align-items: stretch;
        padding: 50px;
    }

    #oobe > .container {
        display: flex;
        justify-content: flex-end;
        margin: 0 auto;
        flex-direction: row;
        height: 90vh;
        align-items: flex-end;
        gap: 20PX;
    }

    #oobe > .container:last-child {

    }
</style>
<main id="oobe">

    <div class="container">
        <form id="userSettingsForm" enctype="multipart/form-data" action="settings" method="get">
            <!-- Display Photo -->
            <div style="border-bottom: 1px solid #ccc; padding-bottom: 10px;">
                <label for="displayPhoto" style="cursor: pointer;">
                    <img id="displayPhotoPreview" src="public/assets/icons/default.svg" alt="Default Photo"
                         style="max-width: 50px; max-height: 50px;">
                </label>
                <input type="file" id="displayPhoto" name="displayPhoto" accept="image/*"
                       onchange="previewDisplayPhoto(this)" style="display: none;">
                <h1 class="title-small-text"><?php echo $_SESSION["username"]; ?></h1>

            </div>

            <p class="caption-text">User ID: <?php echo $_SESSION["user_id"]; ?></p>

            <!-- Settings and Save Buttons -->
            <a class="btn" href="index.php?action=signin">Save</a>
        </form>

        <script>
            // Function to trigger file input when image is clicked
            function previewDisplayPhoto(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#displayPhotoPreview').attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>

        <div>

            <div class="text-wrapper">
                <svg width="232" height="179" viewBox="0 0 232 159" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="33.4999" cy="63.5" r="28.229" transform="rotate(12.0495 33.4999 63.5)" fill="#FEFEFE"/>
                    <g filter="url(#filter0_d_381_129)">
                        <path d="M183.851 57.4933C184.328 89.2461 158.974 115.374 127.221 115.851C95.4684 116.328 69.341 90.9738 68.8639 59.2211C68.3868 27.4683 93.7407 1.34078 125.494 0.863683C157.246 0.386589 183.374 25.7405 183.851 57.4933Z"
                              fill="#FEFEFE"/>
                        <path d="M128.756 81.1407L117.864 81.3044L99.2327 54.0302L99.6466 81.5781L88.7544 81.7418L88.0834 37.0798L98.9755 36.9161L117.609 64.3176L117.193 36.6424L128.085 36.4788L128.756 81.1407Z"
                              fill="#E1AF00"/>
                        <path d="M128.756 81.1407L117.864 81.3044L99.2327 54.0302L99.6466 81.5781L88.7544 81.7418L88.0834 37.0798L98.9755 36.9161L117.609 64.3176L117.193 36.6424L128.085 36.4788L128.756 81.1407Z"
                              fill="#24292F"/>
                        <path d="M153.12 80.7746L143.806 67.233L135.986 81.0321L123.628 81.2178L137.619 58.2897L122.639 36.5606L135.315 36.3701L144.498 49.7229L152.194 36.1165L164.551 35.9309L150.685 58.6661L165.796 80.5842L153.12 80.7746Z"
                              fill="#E1AF00"/>
                    </g>
                    <circle cx="208.5" cy="43.5" r="23.5" fill="#FEFEFE"/>
                    <rect x="202.054" y="57.6782" width="19.2336" height="26.6789" rx="0.412896"
                          transform="rotate(-111.517 202.054 57.6782)" fill="#3C3838"/>
                    <rect x="200.917" y="54.7925" width="13.0292" height="26.6789"
                          transform="rotate(-111.517 200.917 54.7925)" fill="#0A0A0A" fill-opacity="0.54"/>
                    <rect x="213.038" y="50.0142" width="13.0292" height="4.34307"
                          transform="rotate(-111.517 213.038 50.0142)" fill="#0A0A0A" fill-opacity="0.54"/>
                    <rect x="222.273" y="46.373" width="13.0292" height="2.48176"
                          transform="rotate(-111.517 222.273 46.373)" fill="#0A0A0A" fill-opacity="0.54"/>
                    <rect x="205.534" y="52.9727" width="13.0292" height="3.72263"
                          transform="rotate(-111.517 205.534 52.9727)" fill="#0A0A0A" fill-opacity="0.54"/>
                    <rect x="222.834" y="49.4863" width="3.10219" height="1.86132"
                          transform="rotate(-111.517 222.834 49.4863)" fill="#D9D9D9"/>
                    <rect x="217.494" y="34.252" width="3.10219" height="1.86132"
                          transform="rotate(-111.517 217.494 34.252)" fill="#D9D9D9"/>
                    <rect x="218.793" y="51.0801" width="3.10219" height="1.86132"
                          transform="rotate(-111.517 218.793 51.0801)" fill="#D9D9D9"/>
                    <rect x="213.454" y="35.8447" width="3.10219" height="1.86132"
                          transform="rotate(-111.517 213.454 35.8447)" fill="#D9D9D9"/>
                    <rect x="214.753" y="52.6724" width="3.10219" height="1.86132"
                          transform="rotate(-111.517 214.753 52.6724)" fill="#D9D9D9"/>
                    <rect x="209.414" y="37.4375" width="3.10219" height="1.86132"
                          transform="rotate(-111.517 209.414 37.4375)" fill="#D9D9D9"/>
                    <rect x="210.712" y="54.2651" width="3.10219" height="1.86132"
                          transform="rotate(-111.517 210.712 54.2651)" fill="#D9D9D9"/>
                    <rect x="205.373" y="39.0308" width="3.10219" height="1.86132"
                          transform="rotate(-111.517 205.373 39.0308)" fill="#D9D9D9"/>
                    <rect x="206.672" y="55.8584" width="3.10219" height="1.86132"
                          transform="rotate(-111.517 206.672 55.8584)" fill="#D9D9D9"/>
                    <rect x="201.333" y="40.6235" width="3.10219" height="1.86132"
                          transform="rotate(-111.517 201.333 40.6235)" fill="#D9D9D9"/>
                    <rect x="202.632" y="57.4512" width="3.10219" height="1.86132"
                          transform="rotate(-111.517 202.632 57.4512)" fill="#D9D9D9"/>
                    <rect x="197.292" y="42.2168" width="3.10219" height="1.86132"
                          transform="rotate(-111.517 197.292 42.2168)" fill="#D9D9D9"/>
                    <path d="M20.6179 49.6759C21.0145 47.8825 22.7897 46.7502 24.5831 47.1467L50.5605 52.8907C52.3538 53.2872 53.4862 55.0625 53.0897 56.8558L47.3457 82.8332C46.9492 84.6266 45.1739 85.7589 43.3805 85.3624L17.4032 79.6184C15.6098 79.2219 14.4774 77.4466 14.874 75.6533L20.6179 49.6759Z"
                          fill="#BBD6F1"/>
                    <path d="M36.7166 64.8701C37.7392 63.9186 39.3978 64.2854 39.924 65.5793L46.192 80.992C46.7978 82.4816 45.483 84.0392 43.9129 83.692L25.463 79.6124C23.8929 79.2653 23.3573 77.2986 24.5347 76.2032L36.7166 64.8701Z"
                          fill="#83AACE" fill-opacity="0.82"/>
                    <path d="M28.8992 64.9143C29.9075 64.0516 31.4613 64.3952 32.0119 65.6025L38.1916 79.154C38.8746 80.6517 37.5526 82.2856 35.9453 81.9302L18.4485 78.0614C16.8412 77.7061 16.3313 75.6671 17.5821 74.597L28.8992 64.9143Z"
                          fill="#0075E1" fill-opacity="0.82"/>
                    <path d="M32.639 58.4646C32.2821 60.0786 30.6843 61.0977 29.0703 60.7408C27.4563 60.3839 26.4372 58.7862 26.794 57.1722C27.1509 55.5582 28.7487 54.539 30.3627 54.8959C31.9767 55.2528 32.9958 56.8505 32.639 58.4646Z"
                          fill="#E1AF00"/>
                    <g filter="url(#filter1_d_381_129)">
                        <circle cx="62.2328" cy="123.233" r="27.1344" transform="rotate(15 62.2328 123.233)"
                                fill="#FEFEFE"/>
                        <path d="M80.2611 119.009C81.5225 125.424 79.1243 131.709 74.5161 135.706C77.8202 132.708 80.0134 128.476 80.3388 123.672C80.8181 116.597 77.1142 110.204 71.3395 106.913C75.8087 109.323 79.205 113.638 80.2611 119.009ZM61.2842 140.309C64.234 140.509 67.0651 139.982 69.6022 138.881C77.3742 135.776 82.0868 127.49 80.4132 118.979C78.9121 111.346 72.7248 105.825 65.427 104.818C64.8612 104.724 64.2858 104.657 63.7019 104.618C53.846 103.95 45.315 111.399 44.6474 121.255C43.9798 131.111 51.4283 139.642 61.2842 140.309ZM64.3115 140.105C63.3253 140.205 62.3172 140.224 61.2947 140.155C51.5242 139.493 44.1401 131.036 44.802 121.265C45.3837 112.677 51.9888 105.932 60.2145 104.875C60.0014 104.909 59.788 104.947 59.5746 104.989C49.9569 106.881 43.6934 116.21 45.5847 125.828C47.337 134.739 55.4752 140.771 64.3115 140.105ZM69.5425 138.738C68.5416 139.137 67.4895 139.45 66.3934 139.666C56.8597 141.541 47.6114 135.332 45.7367 125.798C43.862 116.264 50.0708 107.016 59.6044 105.141C61.5708 104.755 63.525 104.712 65.4049 104.971C74.3102 106.443 80.8067 114.471 80.1842 123.662C79.7205 130.507 75.4301 136.182 69.5425 138.738ZM81.0094 118.86C83.0196 129.083 76.3621 138.999 66.1396 141.009C55.917 143.02 46.0004 136.362 43.9902 126.14C41.98 115.917 48.6375 106 58.86 103.99C69.0826 101.98 78.9992 108.637 81.0094 118.86ZM80.9242 123.713C80.2347 133.892 71.4237 141.585 61.2443 140.896C51.0649 140.206 43.3718 131.395 44.0613 121.216C44.7509 111.036 53.5619 103.343 63.7413 104.033C73.9207 104.722 81.6138 113.533 80.9242 123.713ZM61.2338 141.05C71.4986 141.746 80.3835 133.988 81.0788 123.723C81.7741 113.458 74.0166 104.574 63.7518 103.878C53.487 103.183 44.6021 110.941 43.9067 121.205C43.2114 131.47 50.969 140.355 61.2338 141.05ZM79.4436 123.612C78.8164 132.871 70.7606 139.867 61.4497 139.236C52.1387 138.605 45.1 130.588 45.7271 121.329C46.3543 112.07 54.4101 105.074 63.721 105.705C73.032 106.336 80.0708 114.353 79.4436 123.612ZM61.4392 139.391C70.8347 140.027 78.9651 132.968 79.5982 123.623C80.2312 114.278 73.127 106.187 63.7315 105.55C54.336 104.914 46.2056 111.973 45.5726 121.318C44.9395 130.663 52.0437 138.754 61.4392 139.391ZM72.5891 123.241C72.2146 128.768 67.3886 132.944 61.8085 132.566C56.2284 132.188 52.0096 127.4 52.384 121.872C52.7585 116.344 57.5845 112.168 63.1646 112.546C68.7447 112.924 72.9635 117.713 72.5891 123.241ZM61.798 132.721C67.4622 133.105 72.3633 128.866 72.7437 123.251C73.124 117.637 68.8393 112.775 63.1751 112.392C57.5109 112.008 52.6098 116.247 52.2294 121.862C51.8491 127.476 56.1338 132.337 61.798 132.721ZM76.6611 123.517C76.1343 131.294 69.3615 137.169 61.5327 136.639C53.7039 136.108 47.7854 129.373 48.3122 121.597C48.839 113.82 55.6117 107.945 63.4405 108.475C71.2693 109.005 77.1878 115.74 76.6611 123.517ZM61.5223 136.793C69.4355 137.329 76.283 131.391 76.8156 123.527C77.3483 115.664 71.3642 108.856 63.451 108.32C55.5377 107.784 48.6902 113.723 48.1576 121.586C47.625 129.449 53.609 136.257 61.5223 136.793ZM75.186 123.322C74.718 130.23 68.6976 135.449 61.7378 134.977C54.778 134.506 49.5163 128.523 49.9842 121.615C50.4521 114.708 56.4726 109.489 63.4324 109.96C70.3922 110.432 75.6539 116.415 75.186 123.322ZM61.7273 135.132C68.7714 135.609 74.8668 130.327 75.3405 123.333C75.8143 116.339 70.4869 110.283 63.4428 109.806C56.3987 109.329 50.3034 114.611 49.8296 121.605C49.3558 128.599 54.6832 134.655 61.7273 135.132ZM78.5182 123.549C77.9187 132.4 70.2989 139.091 61.4999 138.495C52.7009 137.899 46.0531 130.242 46.6527 121.391C47.2522 112.54 54.8719 105.848 63.671 106.444C72.47 107.041 79.1178 114.698 78.5182 123.549ZM61.4894 138.65C70.3747 139.252 78.0675 132.495 78.6728 123.56C79.2781 114.624 72.5667 106.892 63.6814 106.29C54.7962 105.688 47.1033 112.445 46.4981 121.38C45.8928 130.316 52.6042 138.048 61.4894 138.65Z"
                              fill="black" stroke="#0A0B0C" stroke-width="0.154938"/>
                        <path d="M66.9296 121.452C67.4511 124.104 65.7238 126.677 63.0716 127.198C60.4194 127.72 57.8466 125.993 57.3251 123.34C56.8035 120.688 58.5308 118.115 61.183 117.594C63.8352 117.072 66.408 118.8 66.9296 121.452Z"
                              fill="#E1AF00"/>
                        <path d="M63.3044 122.472C63.4227 123.074 63.0308 123.657 62.4291 123.776C61.8273 123.894 61.2436 123.502 61.1253 122.9C61.0069 122.299 61.3988 121.715 62.0006 121.597C62.6023 121.478 63.186 121.87 63.3044 122.472Z"
                              fill="white"/>
                    </g>
                    <defs>
                        <filter id="filter0_d_381_129" x="64.8572" y="0.856934" width="123" height="123"
                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                            <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                            <feColorMatrix in="SourceAlpha" type="matrix"
                                           values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                            <feOffset dy="4"/>
                            <feGaussianBlur stdDeviation="2"/>
                            <feComposite in2="hardAlpha" operator="out"/>
                            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                            <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_381_129"/>
                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_381_129" result="shape"/>
                        </filter>
                        <filter id="filter1_d_381_129" x="31.0918" y="96.0918" width="62.2822" height="62.2822"
                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                            <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                            <feColorMatrix in="SourceAlpha" type="matrix"
                                           values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                            <feOffset dy="4"/>
                            <feGaussianBlur stdDeviation="2"/>
                            <feComposite in2="hardAlpha" operator="out"/>
                            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                            <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_381_129"/>
                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_381_129" result="shape"/>
                        </filter>
                    </defs>
                </svg>

                <div class="title-large-text">
                    welcome <?php echo $_SESSION['user_first_name'] ?> !
                </div>


            </div>

            <div class="features-container">
                <div class="feature-wrapper">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path d="M21.75 21.5H2.25A1.75 1.75 0 0 1 .5 19.75V4.25c0-.966.784-1.75 1.75-1.75h19.5c.966 0 1.75.784 1.75 1.75v15.5a1.75 1.75 0 0 1-1.75 1.75ZM2.25 4a.25.25 0 0 0-.25.25v15.5c0 .138.112.25.25.25h3.178L14 10.977a1.749 1.749 0 0 1 2.506-.032L22 16.44V4.25a.25.25 0 0 0-.25-.25ZM22 19.75v-1.19l-6.555-6.554a.248.248 0 0 0-.18-.073.247.247 0 0 0-.178.077L7.497 20H21.75a.25.25 0 0 0 .25-.25ZM10.5 9.25a3.25 3.25 0 1 1-6.5 0 3.25 3.25 0 0 1 6.5 0Zm-1.5 0a1.75 1.75 0 1 0-3.501.001A1.75 1.75 0 0 0 9 9.25Z"></path>
                        </svg>

                    </div>

                    <div class="text-wrapper">

                        <div class="title-small-text">
                            Centralized Media Management
                        </div>
                        <p class="caption-text">

                            Discover the power of centralized media management, unlocking the full potential of your
                            digital collection with Nexus by your side
                        </p>
                    </div>

                </div>
                <div class="feature-wrapper">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path d="M3 3a2 2 0 0 1 2-2h9.982a2 2 0 0 1 1.414.586l4.018 4.018A2 2 0 0 1 21 7.018V21a2 2 0 0 1-2 2H4.75a.75.75 0 0 1 0-1.5H19a.5.5 0 0 0 .5-.5V8.5h-4a2 2 0 0 1-2-2v-4H5a.5.5 0 0 0-.5.5v6.25a.75.75 0 0 1-1.5 0Zm6.308 11.5-2.104-2.236a.751.751 0 0 1 .369-1.255.749.749 0 0 1 .723.227l3.294 3.5a.75.75 0 0 1 0 1.028l-3.294 3.5a.749.749 0 0 1-1.275-.293.751.751 0 0 1 .183-.735L9.308 16H4.09a2.59 2.59 0 0 0-2.59 2.59v3.16a.75.75 0 0 1-1.5 0v-3.16a4.09 4.09 0 0 1 4.09-4.09ZM15 2.5v4a.5.5 0 0 0 .5.5h4a.5.5 0 0 0-.146-.336l-4.018-4.018A.5.5 0 0 0 15 2.5Z"></path>
                        </svg>
                    </div>
                    <div class="text-wrapper">
                        <div class="title-small-text">
                            Organization with Ease
                        </div>
                        <p class="caption-text">
                            Nexus offers a revolutionary approach to media organization, providing intuitive tools that
                            streamline your library effortlessly.
                        </p>
                    </div>

                </div>
                <div class="feature-wrapper">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path d="M12 1.25c2.487 0 4.773.402 6.466 1.079.844.337 1.577.758 2.112 1.264.536.507.922 1.151.922 1.907v12.987l-.026.013h.026c0 .756-.386 1.4-.922 1.907-.535.506-1.268.927-2.112 1.264-1.693.677-3.979 1.079-6.466 1.079s-4.774-.402-6.466-1.079c-.844-.337-1.577-.758-2.112-1.264C2.886 19.9 2.5 19.256 2.5 18.5h.026l-.026-.013V5.5c0-.756.386-1.4.922-1.907.535-.506 1.268-.927 2.112-1.264C7.226 1.652 9.513 1.25 12 1.25ZM4 14.371v4.116l-.013.013H4c0 .211.103.487.453.817.351.332.898.666 1.638.962 1.475.589 3.564.971 5.909.971 2.345 0 4.434-.381 5.909-.971.739-.296 1.288-.63 1.638-.962.349-.33.453-.607.453-.817h.013L20 18.487v-4.116a7.85 7.85 0 0 1-1.534.8c-1.693.677-3.979 1.079-6.466 1.079s-4.774-.402-6.466-1.079a7.843 7.843 0 0 1-1.534-.8ZM20 12V7.871a7.85 7.85 0 0 1-1.534.8C16.773 9.348 14.487 9.75 12 9.75s-4.774-.402-6.466-1.079A7.85 7.85 0 0 1 4 7.871V12c0 .21.104.487.453.817.35.332.899.666 1.638.961 1.475.59 3.564.972 5.909.972 2.345 0 4.434-.382 5.909-.972.74-.295 1.287-.629 1.638-.96.35-.33.453-.607.453-.818ZM4 5.5c0 .211.103.487.453.817.351.332.898.666 1.638.962 1.475.589 3.564.971 5.909.971 2.345 0 4.434-.381 5.909-.971.739-.296 1.288-.63 1.638-.962.349-.33.453-.607.453-.817 0-.211-.103-.487-.453-.817-.351-.332-.898-.666-1.638-.962-1.475-.589-3.564-.971-5.909-.971-2.345 0-4.434.381-5.909.971-.739.296-1.288.63-1.638.962C4.104 5.013 4 5.29 4 5.5Z"></path>
                        </svg>
                    </div>
                    <div class="text-wrapper">
                        <div class="title-small-text">
                            Simple and Intuitive
                        </div>
                        <p class="caption-text">
                            "Elevate your media library experience to new heights as Nexus simplifies access and
                            organization across all your devices and platforms." </p>
                    </div>

                </div>
                <h1 class="title-large-text"><?php echo $_SESSION["reset_access_code"]; ?></h1>

                <div class="caption-text">

                    Thank you for registering. Please save the one-time reset code above
                </div>
                <button class="btn" onclick="printAndSave()">Print</button>
                <a class="btn" href="index.php?action=signin">Log In</a>
            </div>
        </div>


    </div>

</main>

<script>
    function printAndSave() {
        // Open the print dialog
        window.print();
    }
</script>

