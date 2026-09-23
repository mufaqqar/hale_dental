<?php
/** Template Name: Free Dental Assessment */
get_header(); ?>

<section class="bg-[#f5f5f5] pt-32 px-4 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-[1250px] rounded-[28px] bg-white p-4 sm:p-5">
        <div class="relative min-h-[370px] overflow-hidden rounded-[18px] bg-[#f7f7f7]">
            <div class="absolute right-[18%] top-[-80px] h-[300px] w-[300px] rounded-full bg-[#dce5ff] opacity-80 blur-[90px]"></div>
            <div class="relative z-10 flex min-h-[370px] flex-col items-center justify-center px-6 text-center">
                <h1 class="text-3xl tracking-[-1.5px] text-coff_black sm:text-4xl md:text-5xl">
                    FREE ONLINE DENTAL ASSESSMENT
                </h1>
            </div>
        </div>
    </div>
</section>

<main class="assessment-page bg-[#f5f5f5]">

    <!-- =====================================
         ASSESSMENT FORM SECTION
    ====================================== -->
    <section class="mx-auto max-w-[900px] px-4 sm:px-6 py-10">
        <div class="rounded-2xl bg-white p-4 shadow-sm sm:p-8">

            <p class="mb-8 text-center text-secondaryLight sm:text-[15px]">
                Please complete the form below to receive a complimentary initial dental assessment based on the information and photographs you provide.
            </p>

            <form id="assessment-form" action="#" method="post" enctype="multipart/form-data" class="space-y-6">

                <!-- =================================
                     PATIENT INFORMATION
                ================================== -->
                <div>
                    <h2 class="mb-4 flex items-center gap-2 text-xl   text-coff_black">
                        <span class="flex h-7 w-7 items-center justify-center rounded-full bg-primary text-xs font-bold text-white">1</span>
                        Patient Information
                    </h2>

                    <!-- Full Name -->
                    <div class="mb-4">
                        <label for="assessment_name" class="mb-1 block text-sm font-medium text-coff_black">
                            Full Name<span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="assessment_name" name="fullname" placeholder="Enter your full name" required
                            class="h-[44px] w-full rounded-lg border border-gray-200 bg-[#fafafa] px-4 text-[14px] text-coff_black outline-none transition focus:border-primary focus:bg-white">
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="assessment_email" class="mb-1 block text-sm font-medium text-coff_black">
                            Email Address<span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="assessment_email" name="email" placeholder="Enter your email address" required
                            class="h-[44px] w-full rounded-lg border border-gray-200 bg-[#fafafa] px-4 text-[14px] text-coff_black outline-none transition focus:border-primary focus:bg-white">
                    </div>

                    <!-- Phone / WhatsApp -->
                    <div>
                        <label for="assessment_phone" class="mb-1 block text-sm font-medium text-coff_black">
                            Phone / WhatsApp Number<span class="text-red-500">*</span>
                        </label>
                        <input type="tel" id="assessment_phone" name="phone" placeholder="Enter your phone or WhatsApp number" required
                            class="h-[44px] w-full rounded-lg border border-gray-200 bg-[#fafafa] px-4 text-[14px] text-coff_black outline-none transition focus:border-primary focus:bg-white">
                    </div>
                </div>

                <!-- =================================
                     DENTAL INFORMATION
                ================================== -->
                <div>
                    <h2 class="mb-4 flex items-center gap-2 text-xl   text-coff_black">
                        <span class="flex h-7 w-7 items-center justify-center rounded-full bg-primary text-xs font-bold text-white">2</span>
                        Dental Information
                    </h2>

                    <!-- Upload Dental Photos -->
                    <div>
                        <label for="assessment_photos" class="mb-1 block text-sm font-medium text-coff_black">
                            Upload Dental Photos<span class="text-red-500">*</span>
                        </label>
                        <p class="mb-3 text-[13px] text-secondaryLight">
                            Please upload clear photographs of your teeth and mouth.
                        </p>

                        <label for="assessment_photos"
                            class="flex min-h-[140px] cursor-pointer flex-col items-center justify-center gap-3 rounded-xl border-2 border-dashed border-gray-300 bg-[#fafafa] p-6 text-center transition hover:border-primary hover:bg-primary/5">
                            <span class="flex h-12 w-12 items-center justify-center rounded-full bg-primary/10">
                                <i class="fa-solid fa-camera text-xl text-primary"></i>
                            </span>
                            <span id="assessment_upload_label" class="text-sm text-secondaryLight">Upload Photos</span>
                            <span class="text-xs text-gray-400">JPG, PNG, WEBP — up to 5MB each</span>
                            <input type="file" id="assessment_photos" name="photos[]" accept="image/*" multiple
                                class="hidden" required>
                        </label>

                        <!-- Queue preview -->
                        <div id="assessment_photo_queue" class="mt-3 hidden">
                            <p class="mb-2 text-xs   uppercase tracking-wide text-secondaryLight">Selected photos</p>
                            <ul id="assessment_photo_list" class="grid grid-cols-2 gap-2 sm:grid-cols-3"></ul>
                        </div>

                        <div class="mt-3 flex items-start gap-2 rounded-lg bg-yellow-50 p-3">
                            <i class="fa-solid fa-circle-info mt-0.5 text-sm text-amber-500"></i>
                            <p class="text-xs leading-5 text-amber-800">
                                Dental photographs are required for the free initial assessment.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Submit -->
                <div>
                    <button type="submit"
                        class="w-full rounded-xl bg-gradient-to-r from-primary to-secondary py-4 text-[15px] font-bold text-white transition hover:opacity-90">
                        Submit for Free Assessment
                    </button>
                    <p id="assessment_form_msg" class="mt-3 hidden text-center text-sm font-medium"></p>
                </div>

            </form>

        </div>
    </section>

</main>

<?php get_footer(); ?>