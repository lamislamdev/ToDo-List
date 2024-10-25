<script setup>
import Nav from "@/Component/Nav.vue";
import {Link} from "@inertiajs/vue3";
</script>

<template>

    <Nav/>

 <div class="grid justify-center items-center h-[60vh]">
    <div >
        <h1 class="text-center mt-10 text-blue-50 font-bold text-2xl">Welcome to ToDO list </h1>
     <p class="text-gray-200 text-justify mt-3 px-10 md:px-24">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat perferendis vitae optio, commodi sequi praesentium dolor maxime recusandae veritatis dolores velit provident culpa illum et ullam? Animi doloremque ad odit.</p>
     <div class="flex justify-center items-center ">
         <Link type="button" class="text-white mt-8 w-32 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" href="/login-x">Get started</Link>
     </div>
    </div>

 </div>


</template>

<style scoped>

</style>
