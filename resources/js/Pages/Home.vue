<template>
    <Head>
        <title>{{ $page.props.title }} - My awesome app</title>
    </Head>
    <main class="border shadow-lg rounded flex flex-col relative max-w-[36em]">
        <section class="absolute top-0 bottom-0 -right-[40vw] w-[40vw]">
            <div class="whitespace-pre font-mono bg-gray-200 p-4">
                {{ JSON.stringify(data, null, 4) }}
            </div>
        </section>
        <!-- Header -->
        <header class="px-5 pt-8 sticky top-0 shadow flex flex-col bg-white z-10">
            <h1 class="text-3xl pb-4">Property Information</h1>
            <div class="h-[2px] flex bg-gray-200">
                <div class="bg-red-500 w-[12%]"></div>
            </div>
            <article class="grid grid-cols-[1fr,1fr] py-6 gap-x-5">
                <img src="../../../resources/image/installment.svg" alt="installment-img"
                     class="max-w-[100%] row-span-3"/>
                <h1 class="text-lg text-[#009fd9] text-center">Is eligibility?</h1>
                <div class="flex justify-center gap-4">
                    <div class="flex flex-col">
                        <label class="text-red-500 text-base">{{ summary_status }}</label>
                        <!--                        <div class="text-base">{{ summary_status }}</div>-->
                    </div>
                    <!--                    <div class="flex flex-col">-->
                    <!--                        <label class="text-gray-300 text-base">Tenure</label>-->
                    <!--                        <div class="text-base">0 Years</div>-->
                    <!--                    </div>-->
                </div>
            </article>
        </header>
        <form action="post" @submit.prevent="submit">
            <!-- Property Type Section -->
            <section class="flex flex-col px-5 pt-8 gap-2">
                <p class="text-gray-700 py-2">Great! Tell us about the property you are looking for to calculate the
                    approximate amount you can borrow {{ summary_status }}</p>
                <label class="text-sm text-gray-700">Property type</label>
                <article class="flex flex-col md:grid grid-cols-[1fr,1fr,1fr] gap-x-5 gap-y-3">
                    <div class="radio-container checked flex items-center gap-2 border rounded px-4 py-2 flex-1">
                        <input id="apartment" type="radio" value="apartment" name="property_type"
                               v-model="form.property_type"
                               class="w-4 h-4 accent-[#ed1b34] bg-gray-100 border-gray-300 checked:bg-green-500">
                        <label for="apartment" class="grow">Apartment</label>
                    </div>
                    <div class="radio-container flex items-center gap-2 border rounded px-4 py-2 flex-1">
                        <input id="mini-condo" type="radio" value="mini-condo" name="property_type"
                               v-model="form.property_type"
                               class="w-4 h-4 accent-[#ed1b34] border-gray-100 checked:hover:bg-emerald-400 checked:active:bg-emerald-400">
                        <label for="mini-condo-radio" class="grow">Mini-Condo</label>
                    </div>
                    <div class="radio-container flex items-center gap-2 border rounded px-4 py-2 flex-1">
                        <input id="condo" type="radio" value="condo" name="property_type" v-model="form.property_type"
                               class="w-4 h-4 accent-[#ed1b34] bg-gray-100 border-gray-300">
                        <label for="condo-radio" class="grow">Condo</label>
                    </div>
                    <!--                    <div class="col-span-3 block md:flex">-->
                    <div class="radio-container flex items-center gap-2 border rounded px-4 py-2 flex-1">
                        <input id="land" type="radio" value="land" name="property_type" v-model="form.property_type"
                               class="w-4 h-4 accent-[#ed1b34] bg-gray-100 border-gray-300">
                        <label for="land-building-radio" class="grow">Land</label>
                    </div>
                    <div class="radio-container flex items-center gap-2 border rounded px-4 py-2 flex-1">
                        <input id="private_house" type="radio" value="private_house" name="property_type"
                               v-model="form.property_type"
                               class="w-4 h-4 accent-[#ed1b34] bg-gray-100 border-gray-300">
                        <label for="condo-radio" class="grow">Private House</label>
                    </div>
                    <div class="radio-container flex items-center gap-2 border rounded px-4 py-2 flex-1">
                        <input id="shop" type="radio" value="shop" name="property_type" v-model="form.property_type"
                               class="w-4 h-4 accent-[#ed1b34] bg-gray-100 border-gray-300">
                        <label for="condo-radio" class="grow">Shop</label>
                    </div>
                    <div class="radio-container flex items-center gap-2 border rounded px-4 py-2 flex-1">
                        <input id="zone_land" type="radio" value="zone_land" name="property_type"
                               v-model="form.property_type"
                               class="w-4 h-4 accent-[#ed1b34] bg-gray-100 border-gray-300">
                        <label for="condo-radio" class="grow">Zone Land</label>
                    </div>
                    <!--                    </div>-->
                </article>
            </section>
            <!-- Property Value Section -->
            <section class="flex flex-col px-5 pt-8 gap-2">
                <label class="text-sm text-gray-700">Property value</label>
                <div class="relative">
                    <input type="number" id="property_value" name="property_value" v-model="form.property_value"
                           class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 px-3"
                           placeholder="Enter property value">
                    <div
                        class="absolute top-[2px] right-[2px] bottom-[2px] rounded-lg px-3 flex justify-center items-center backdrop-blur-lg text-gray-400">
                        MMK
                    </div>
                </div>
<!--                <div class="text-[#00a9e1] text-sm hidden">Minimum property value for Apartment should be 20,000,000-->
<!--                </div>-->
            </section>

            <!-- Downpayment Section -->
            <section class="flex flex-col px-5 pt-8 gap-2">
                <label class="text-sm text-gray-700">Initial down payment</label>
                <h1 class="text-2xl">0 MMK</h1>
                <article class="flex flex-col md:grid grid-cols-[1fr,1fr,1fr] gap-x-5 gap-y-3">
                    <div class="radio-container checked flex items-center gap-2 border rounded px-4 py-2 flex-1">
                        <input id="downpayment-30-radio" type="radio" value="" name="downpayment_percent"
                               class="w-4 h-4 accent-[#ed1b34] bg-gray-100 border-gray-300">
                        <label for="downpayment-30-radio" class="grow">30%</label>
                    </div>
                    <div class="radio-container flex items-center gap-2 border rounded px-4 py-2 flex-1">
                        <input id="downpayment-40-radio" type="radio" value="" name="downpayment_percent"
                               class="w-4 h-4 accent-[#ed1b34] bg-gray-100 border-gray-300">
                        <label for="downpayment-40-radio" class="grow">40%</label>
                    </div>
                    <div class="radio-container flex items-center gap-2 border rounded px-4 py-2 flex-1">
                        <input id="downpayment-50-radio" type="radio" value="" name="downpayment_percent"
                               class="w-4 h-4 accent-[#ed1b34] bg-gray-100 border-gray-300">
                        <label for="downpayment-50-radio" class="grow">50%</label>
                    </div>
                    <div class="radio-container flex items-center gap-2 border rounded px-4 py-2">
                        <input id="downpayment-other-radio" type="radio" value="" name="downpayment_percent"
                               class="w-4 h-4 accent-[#ed1b34] bg-gray-100 border-gray-300">
                        <label for="downpayment-other-radio" class="grow">Other</label>
                    </div>
                </article>
                <div class="flex items-center gap-2 hidden">
                    <article class="flex border rounded-md">
                        <button class="flex-1 px-4 py-1 text-2xl text-gray-600 duration-200 active:bg-[#f0f0f0]">-
                        </button>
                        <div class="flex-1 text-center border-x px-4 py-1 cursor-default flex items-center">0</div>
                        <button class="flex-1 px-4 py-1 text-2xl text-gray-600 duration-200 active:bg-[#f0f0f0]">+
                        </button>
                    </article>
                </div>
            </section>

            <!-- Tenure Section -->
            <section class="flex flex-col px-5 pt-8 gap-2">
                <label class="text-sm text-gray-700">Tenure</label>
                <article class="flex flex-col md:grid grid-cols-[1fr,1fr,1fr] gap-x-5 gap-y-3">
                    <div class="radio-container checked flex items-center gap-2 border rounded px-4 py-2 flex-1">
                        <input id="tenure-3yr-radio" type="radio" value="3" name="tenure" v-model="form.tenure"
                               class="w-4 h-4 accent-[#ed1b34] bg-gray-100 border-gray-300">
                        <label for="tenure-3yr-radio" class="grow">3</label>
                    </div>
                    <div class="radio-container flex items-center gap-2 border rounded px-4 py-2 flex-1">
                        <input id="tenure-5yr-radio" type="radio" value="6" name="tenure" v-model="form.tenure"
                               class="w-4 h-4 accent-[#ed1b34] bg-gray-100 border-gray-300">
                        <label for="tenure-5yr-radio" class="grow">6</label>
                    </div>
                    <div class="radio-container flex items-center gap-2 border rounded px-4 py-2 flex-1">
                        <input id="tenure-10yr-radio" type="radio" value="9" name="tenure" v-model="form.tenure"
                               class="w-4 h-4 accent-[#ed1b34] bg-gray-100 border-gray-300">
                        <label for="tenure-10yr-radio" class="grow">9</label>
                    </div>
                    <div class="radio-container flex items-center gap-2 border rounded px-4 py-2">
                        <input id="tenure-other-radio" type="radio" value="12" name="tenure" v-model="form.tenure"
                               class="w-4 h-4 accent-[#ed1b34] bg-gray-100 border-gray-300">
                        <label for="tenure-other-radio" class="grow">12</label>
                    </div>
                </article>
                <div class="flex items-center gap-2 hidden">
                    <article class="flex border rounded-md">
                        <button class="flex-1 px-4 py-1 text-2xl text-gray-600 duration-200 active:bg-[#f0f0f0]">-
                        </button>
                        <div class="flex-1 text-center border-x px-4 py-1 cursor-default flex items-center">0</div>
                        <button class="flex-1 px-4 py-1 text-2xl text-gray-600 duration-200 active:bg-[#f0f0f0]">+
                        </button>
                    </article>
                    <label class="text-lg">Years</label>
                </div>
            </section>
            <a href="https://prodhomeloanstorage.blob.core.windows.net/hl-terms-and-conditions/StandardHomeLoanT&C.pdf"
               class="mx-5 my-8 underline">By clicking Next, you agree to our term and condition</a>

            <button type="submit"
                    class="mx-5 mb-8 px-5 py-3 rounded bg-[#ed1b34] text-white duration-200 active:ring-2 active:ring-[#ed1b34aa] disabled:bg-gray-300 disabled:text-gray-500 disabled:active:ring-0">
                Check
            </button>
        </form>
    </main>
</template>
<script>
import {inject, reactive} from "vue";
import {Inertia} from "@inertiajs/inertia";
import {usePage, useForm} from "@inertiajs/inertia-vue3";
import {ref} from 'vue'

export default {
    props: {
        property_value: Number,
        property_type: String,
        tenure: String,
        data: Object,
        summary_status: Object,
    },
    setup() {
        const form = useForm({
            property_value: null,
            property_type: null,
            tenure: null,
            _token: usePage().props.value.csrf_token
        });

        function submit() {
            form.post('/home', {
                onError: (data) => {
                    console.log("Error!");
                },
                onSuccess: (data) => {
                    console.log(data);
                },
            });


        }

        return {
            form, submit
        }
    }

}
</script>
