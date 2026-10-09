<div class="sm:max-w-[830px] w-full md:pr-8 rounded-[19px] bg-black/30 backdrop-blur-[10px] px-3 sm:px-5 py-6 md:py-10">
    <div class="pb-5 w-full flex flex-row justify-between items-center">
        <h2 class="md:text-[28px] md:leading-normal text-2xl text-white">
            Get Consultation</h2>
        <button type="button" class="text-white cursor-pointer" id="closeQuote_Popup">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <!-- Close -->
                <path id="closeIcon" stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    <form id="quote-form" class="grid w-full gap-2 items-center" enctype="multipart/form-data">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 w-full gap-2.5">
            <!-- Name -->
            <div>
                <label for="fullname" class="hidden">Name</label>
                <input class="hale_input" type="text" name="fullname" id="fullname" placeholder="Your Name" required />
            </div>

            <!-- Phone -->
            <div>
                <label for="phone" class="hidden">Phone Number</label>
                <input class="hale_input" type="tel" name="phone" id="phone" placeholder="Phone Number" />
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="hidden">Email Address</label>
                <input class="hale_input" type="email" name="email" id="email" placeholder="Email Address" required />
            </div>

            <!-- Select Treatment -->
            <div class="relative">
                <label for="treatment" class="hidden">Select Treatment</label>
                <select class="hale_input h-full" name="treatment" id="treatment" required>
                    <option value="" disabled selected>Select Treatment</option>
                    <?php
                    $treatments = get_posts(array(
                        'post_type' => 'treatments',
                        'posts_per_page' => -1,
                        'post_status' => 'publish',
                        'orderby' => 'menu_order',
                        'order' => 'ASC',
                    ));
                    foreach ($treatments as $treatment) {
                        echo '<option value="' . esc_attr($treatment->post_title) . '">' . esc_html($treatment->post_title) . '</option>';
                    }
                    ?>
                </select>
            </div>

            <!-- Message -->
            <textarea name="message" id="message" rows="1" placeholder="Describe Your Dental Concern" class="hale_input lg:col-span-4 md:col-span-3 sm:col-span-2"
                required></textarea>
        </div>

        <!-- Agree Checkbox -->
        <div class="grid gap-2">
            <div class="flex gap-2 my-3 col-span-5 items-center text-title_Clr">
                <input type="checkbox" id="agree" name="agree" class="p-2 w-4 h-4" required>
                <label for="agree" class="cursor-pointer text-sm">
                    I Agree that my data is <strong>collected and Stored.</strong>
                </label>
            </div>
        </div>

        <!-- Submit + File Upload -->
        <section class="flex items-center gap-2 justify-between">
            <div class="w-full">
                <button type="submit"
                    class="bg-secondary hover:bg-white sm:px-9 px-8 sm:py-3 py-1 sm:text-base text-sm font-medium text-white hover:text-secondary rounded-full border-2 border-secondary text-center max-w-[600px] w-full"
                    id="quote-submit">
                    SUBMIT
                </button>
            </div>
            <div>
                <input type="file" id="fileInput" name="file" style="display:none;">
                <button type="button" id="uploadBtn"
                    class="flex items-center text-nowrap whitespace-nowrap justify-center px-12 py-3 font-medium text-white bg-secondary hover:bg-primary rounded-full">
                    Attached File
                </button>
            </div>
        </section>
    </form>
</div>