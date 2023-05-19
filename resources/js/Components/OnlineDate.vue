<template>
<div class="flex justify-center mt-3 ">
                            <div class="bg-white w-[200px] rounded-md shadow-lg">
                                <div class="flex justify-center  items-center h-[60px] font-medium primary-background secondary-color text-lg rounded-t-md">
                                    Online <div class="ml-1  w-3 h-3 rounded-full bg-green-800"></div>
                                </div>
                                <div class="">
                                    <div>
                                        <table class="w-full text-[12px] mx-3 my-2">
                                            <tr>
                                                <td>hari online</td>
                                                <td>: {{ currentDate }}</td>
                                            </tr>
                                            <tr>
                                                <td>waktu online</td>
                                                <td>: {{ currentTime }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
</template>

<script>

export default {
  data() {
    return {
      currentDate: '',
      currentTime: ''
    };
  },
  mounted() {
    this.getCurrentDateTime();
  },
  methods: {
    getCurrentDateTime() {
      const currentDateTime = new Date();
      this.currentDate = currentDateTime.toDateString();
      this.currentTime = currentDateTime.toLocaleTimeString();
    }
  }
};
</script>