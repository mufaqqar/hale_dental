<?php
/** Template Name: Detailed Online Dental Consultation */
get_header(); ?>

<section class="bg-[#f5f5f5] pt-32 px-4 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-[1250px] rounded-[28px] bg-white p-4 sm:p-5">
        <div class="relative min-h-[370px] overflow-hidden rounded-[18px] bg-[#f7f7f7]">
            <div class="absolute right-[18%] top-[-80px] h-[300px] w-[300px] rounded-full bg-[#dce5ff] opacity-80 blur-[90px]"></div>
            <div class="relative z-10 flex min-h-[370px] flex-col items-center justify-center px-6 text-center">
                <h1 class="text-3xl tracking-[-1.5px] text-coff_black sm:text-4xl md:text-5xl">
                    DETAILED ONLINE DENTAL CONSULTATION
                </h1>
                <p class="mt-4 text-lg font-semibold text-primary sm:text-xl">
                    Professional Dental Consultation — €50
                </p>
            </div>
        </div>
    </div>
</section>

<main class="consultation-page bg-[#f5f5f5]">

    <!-- =====================================
         CONSULTATION FORM SECTION
    ====================================== -->
    <section class="mx-auto max-w-[900px] px-4 sm:px-6 py-10">
        <div class="rounded-2xl bg-white p-4 shadow-sm sm:p-8">

            <p class="mb-8 text-center text-secondaryLight sm:text-[15px]">
                For patients who require a more comprehensive assessment, this consultation includes a detailed review of dental information and records.
            </p>

            <form id="consultation-form" action="#" method="post" enctype="multipart/form-data" class="space-y-8">

                <!-- =================================
                     PATIENT INFORMATION
                ================================== -->
                <div>
                    <h2 class="mb-4 flex items-center gap-2 text-xl font-semibold text-coff_black">
                        <span class="flex h-7 w-7 items-center justify-center rounded-full bg-primary text-xs font-bold text-white">1</span>
                        Patient Information
                    </h2>

                    <!-- Full Name -->
                    <div class="mb-4">
                        <label for="consultation_name" class="mb-1 block text-sm font-medium text-coff_black">
                            Full Name<span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="consultation_name" name="fullname" placeholder="Enter your full name" required
                            class="h-[44px] w-full rounded-lg border border-gray-200 bg-[#fafafa] px-4 text-[14px] text-coff_black outline-none transition focus:border-primary focus:bg-white">
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="consultation_email" class="mb-1 block text-sm font-medium text-coff_black">
                            Email Address<span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="consultation_email" name="email" placeholder="Enter your email address" required
                            class="h-[44px] w-full rounded-lg border border-gray-200 bg-[#fafafa] px-4 text-[14px] text-coff_black outline-none transition focus:border-primary focus:bg-white">
                    </div>

                    <!-- Phone / WhatsApp -->
                    <div class="mb-4">
                        <label for="consultation_phone" class="mb-1 block text-sm font-medium text-coff_black">
                            Phone / WhatsApp Number<span class="text-red-500">*</span>
                        </label>
                        <input type="tel" id="consultation_phone" name="phone" placeholder="Enter your phone or WhatsApp number" required
                            class="h-[44px] w-full rounded-lg border border-gray-200 bg-[#fafafa] px-4 text-[14px] text-coff_black outline-none transition focus:border-primary focus:bg-white">
                    </div>

                    <!-- Dental concern -->
                    <div>
                        <label for="consultation_concern" class="mb-1 block text-sm font-medium text-coff_black">
                            Describe Your Dental Concern<span class="text-red-500">*</span>
                        </label>
                        <textarea id="consultation_concern" name="concern" rows="4" required
                            placeholder="Please provide detailed information about your dental problem, symptoms, previous diagnosis, or treatment you are considering."
                            class="w-full rounded-lg border border-gray-200 bg-[#fafafa] px-4 py-3 text-[14px] text-coff_black outline-none transition focus:border-primary focus:bg-white"></textarea>
                    </div>
                </div>

                <!-- =================================
                     MEDICAL INFORMATION
                ================================== -->
                <div>
                    <h2 class="mb-4 flex items-center gap-2 text-xl font-semibold text-coff_black">
                        <span class="flex h-7 w-7 items-center justify-center rounded-full bg-primary text-xs font-bold text-white">2</span>
                        Medical Information
                    </h2>

                    <!-- Medical conditions -->
                    <div class="mb-4">
                        <label for="consultation_conditions" class="mb-1 block text-sm font-medium text-coff_black">
                            Medical Conditions<span class="text-red-500">*</span>
                        </label>
                        <textarea id="consultation_conditions" name="conditions" rows="3" required
                            placeholder="Please specify any medical conditions, allergies, or other relevant health concerns."
                            class="w-full rounded-lg border border-gray-200 bg-[#fafafa] px-4 py-3 text-[14px] text-coff_black outline-none transition focus:border-primary focus:bg-white"></textarea>
                    </div>

                    <!-- Current medications -->
                    <div>
                        <label for="consultation_medications" class="mb-1 block text-sm font-medium text-coff_black">
                            Current Medications<span class="text-red-500">*</span>
                        </label>
                        <textarea id="consultation_medications" name="medications" rows="3" required
                            placeholder="Please list all medications, vitamins, or supplements you currently take."
                            class="w-full rounded-lg border border-gray-200 bg-[#fafafa] px-4 py-3 text-[14px] text-coff_black outline-none transition focus:border-primary focus:bg-white"></textarea>
                    </div>
                </div>

                <!-- =================================
                     DENTAL RECORDS
                ================================== -->
                <div>
                    <h2 class="mb-4 flex items-center gap-2 text-xl font-semibold text-coff_black">
                        <span class="flex h-7 w-7 items-center justify-center rounded-full bg-primary text-xs font-bold text-white">3</span>
                        Dental Records
                    </h2>

                    <!-- Upload Dental Photos -->
                    <div class="mb-6">
                        <label for="consultation_photos" class="mb-1 block text-sm font-medium text-coff_black">
                            Upload Dental Photos<span class="text-red-500">*</span>
                        </label>
                        <p class="mb-3 text-[13px] text-secondaryLight">
                            Please upload clear photographs of your teeth and mouth.
                        </p>

                        <label for="consultation_photos"
                            class="flex min-h-[140px] cursor-pointer flex-col items-center justify-center gap-3 rounded-xl border-2 border-dashed border-gray-300 bg-[#fafafa] p-6 text-center transition hover:border-primary hover:bg-primary/5">
                            <span class="flex h-12 w-12 items-center justify-center rounded-full bg-primary/10">
                                <i class="fa-solid fa-camera text-xl text-primary"></i>
                            </span>
                            <span id="consultation_photo_label" class="text-sm text-secondaryLight">Upload Photos</span>
                            <span class="text-xs text-gray-400">JPG, PNG, WEBP — up to 5MB each</span>
                            <input type="file" id="consultation_photos" name="photos[]" accept="image/*" multiple
                                class="hidden" required>
                        </label>

                        <div id="consultation_photo_queue" class="mt-3 hidden">
                            <ul id="consultation_photo_list" class="grid grid-cols-2 gap-2 sm:grid-cols-3"></ul>
                        </div>
                    </div>

                    <!-- Dental X-rays / OPG -->
                    <div class="mb-6 rounded-xl border border-gray-200 p-4">
                        <p class="mb-2 block text-sm font-medium text-coff_black">
                            Dental X-rays / OPG
                        </p>
                        <p class="mb-3 text-[13px] text-secondaryLight">
                            Do you have a dental X-ray or OPG?
                        </p>

                        <div class="mb-3 flex gap-6">
                            <label class="flex cursor-pointer items-center gap-2 text-sm text-coff_black">
                                <input type="radio" name="has_xray" value="yes" class="h-4 w-4 accent-primary">
                                Yes
                            </label>
                            <label class="flex cursor-pointer items-center gap-2 text-sm text-coff_black">
                                <input type="radio" name="has_xray" value="no" class="h-4 w-4 accent-primary">
                                No
                            </label>
                        </div>

                        <div id="consultation_xray_upload" class="hidden">
                            <label for="consultation_xray"
                                class="flex min-h-[100px] cursor-pointer flex-col items-center justify-center gap-2 rounded-xl border-2 border-dashed border-gray-300 bg-[#fafafa] p-4 text-center transition hover:border-primary hover:bg-primary/5">
                                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-primary/10">
                                    <i class="fa-solid fa-x-ray text-lg text-primary"></i>
                                </span>
                                <span id="consultation_xray_label" class="text-sm text-secondaryLight">Upload X-ray / OPG</span>
                                <input type="file" id="consultation_xray" name="xray" accept="image/*,application/pdf"
                                    class="hidden">
                            </label>
                        </div>
                    </div>

                    <!-- CBCT Scan -->
                    <div class="rounded-xl border border-gray-200 p-4">
                        <p class="mb-2 block text-sm font-medium text-coff_black">
                            CBCT Scan
                        </p>
                        <p class="mb-3 text-[13px] text-secondaryLight">
                            Do you have a CBCT scan?
                        </p>

                        <div class="mb-3 flex gap-6">
                            <label class="flex cursor-pointer items-center gap-2 text-sm text-coff_black">
                                <input type="radio" name="has_cbct" value="yes" class="h-4 w-4 accent-primary">
                                Yes
                            </label>
                            <label class="flex cursor-pointer items-center gap-2 text-sm text-coff_black">
                                <input type="radio" name="has_cbct" value="no" class="h-4 w-4 accent-primary">
                                No
                            </label>
                        </div>

                        <div id="consultation_cbct_upload" class="hidden">
                            <label for="consultation_cbct"
                                class="flex min-h-[100px] cursor-pointer flex-col items-center justify-center gap-2 rounded-xl border-2 border-dashed border-gray-300 bg-[#fafafa] p-4 text-center transition hover:border-primary hover:bg-primary/5">
                                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-primary/10">
                                    <i class="fa-solid fa-brain text-lg text-primary"></i>
                                </span>
                                <span id="consultation_cbct_label" class="text-sm text-secondaryLight">Upload CBCT</span>
                                <input type="file" id="consultation_cbct" name="cbct" accept="image/*,application/pdf"
                                    class="hidden">
                            </label>
                        </div>
                    </div>
                </div>

                <!-- =================================
                     CONSENT
                ================================== -->
                <div>
                    <h2 class="mb-4 flex items-center gap-2 text-xl font-semibold text-coff_black">
                        <span class="flex h-7 w-7 items-center justify-center rounded-full bg-primary text-xs font-bold text-white">4</span>
                        Consent
                    </h2>

                    <div class="space-y-3">
                        <label class="flex cursor-pointer items-start gap-3 rounded-lg bg-[#fafafa] p-3">
                            <input type="checkbox" id="consultation_consent_accurate" name="consent_accurate" required
                                class="mt-[2px] h-4 w-4 accent-primary">
                            <span class="text-sm leading-5 text-coff_black">
                                I confirm that the information provided is accurate and agree to receive consultation-related information and follow-up communication from the clinic<span class="text-red-500">*</span>.
                            </span>
                        </label>

                        <label class="flex cursor-pointer items-start gap-3 rounded-lg bg-[#fafafa] p-3">
                            <input type="checkbox" id="consultation_consent_fee" name="consent_fee" required
                                class="mt-[2px] h-4 w-4 accent-primary">
                            <span class="text-sm leading-5 text-coff_black">
                                I understand that the <strong>€50 fee</strong> applies to the detailed online dental consultation<span class="text-red-500">*</span>.
                            </span>
                        </label>
                    </div>
                </div>

                <!-- Submit -->
                <div>
                    <button type="submit"
                        class="w-full rounded-xl bg-gradient-to-r from-primary to-secondary py-4 text-[15px] font-bold text-white transition hover:opacity-90">
                        PROCEED TO €50 CONSULTATION
                    </button>
                    <p id="consultation_form_msg" class="mt-3 hidden text-center text-sm font-medium"></p>
                </div>

            </form>

        </div>
    </section>

</main>

<?php get_footer(); ?>