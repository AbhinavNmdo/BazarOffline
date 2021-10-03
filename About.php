<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Chettan+2:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<style>
* {
    font-family: 'Baloo Chettan 2', cursive;
    scroll-behavior: smooth;
}
.block{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background-color: rgb(235, 235, 235);
    padding: 1.5rem;
    border-radius: 30px;
}
.para{
  text-align: justify;
}
</style>

<body>
    <?php
        require "views/_navbar.php"
  ?>
    <div class="container my-4 parent">
        <div class="block" data-aos="zoom-in">
            <h3 align="center" class="mb-4">हमारा उद्देश्य</h3>
            <p align="center" class="para">फैशन गलियों, भीड़ भरे बाज़ार और चौक बाज़ारों वाले छोटे बड़े सभी दुकानदारों को भी
                खुशी मिलना चाहिए। और यह खुशी उन्हें ग्राहकों की बढ़ती संख्या से मिलती है। मुद्दा यह नहीं है कि ग्राहक
                किसकी दुकान पर जाता है, बल्कि यह है कि उसे ऑनलाइन मार्किट से खींचकर पारंपरिक बाजार में कैसे लाया जाए।
                इसलिए हमारा उद्देश्य है ऑनलाइन बाजार के शौकीनों को ऑनलाइन तरीके से ही ऑफलाइन बाजार याने पारंपरिक बाजार
                में लेकर आना।
            </p>
            <p align="center" class="para">तो जुड़ जाइये हमारे साथ, और हम मिलकर प्रयास करते है, ग्राहकों को जोड़ने का। हम
                आपको देते है ऑनलाइन ग्राहकों तक पहुचने का रास्ता।जहाँ से उन्हें अपनी दुकानों तक लाना है।
            </p>
        </div>
    </div>

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-wrap -m-4">
            <div class="lg:w-1/3 lg:mb-0 mb-6 p-4" data-aos="zoom-in">
                <div class="h-full text-center">
                <img alt="testimonial" class="w-40 h-40 mb-8 object-cover object-center rounded-full inline-block border-2 border-gray-200 bg-gray-100 leading-relaxed" src="./Images/photo_2021-07-22_16-24-47.jpg">
                <p class="leading-relaxed"></p>
                <span class="inline-block h-1 w-10 rounded bg-indigo-500 mt-6 mb-4"></span>
                <h2 class="text-gray-900 font-medium title-font tracking-wider text-sm">Abhishek Namdeo</h2>
                <p class="text-gray-500">Co-Founder</p>
                </div>
            </div>
            <div class="lg:w-1/3 lg:mb-0 mb-6 p-4" data-aos="zoom-in">
                <div class="h-full text-center">
                <img alt="testimonial" class="w-40 h-40 mb-8 object-cover object-center rounded-full inline-block border-2 border-gray-200 bg-gray-100" src="./Images/photo_2021-07-22_17-20-42.jpg"></p>
                <span class="inline-block h-1 w-10 rounded bg-indigo-500 mt-6 mb-4"></span>
                <h2 class="text-gray-900 font-medium title-font tracking-wider text-sm">Deepak Sehgal</h2>
                <p class="text-gray-500">Co-Founder</p>
                </div>
            </div>
            <div class="lg:w-1/3 lg:mb-0 p-4" data-aos="zoom-in">
                <div class="h-full text-center">
                <img alt="testimonial" class="w-40 h-40 mb-8 object-cover object-center rounded-full inline-block border-2 border-gray-200 bg-gray-100" src="./Images/photo_2021-07-22_17-23-42.jpg">
                <p class="leading-relaxed"></p>
                <span class="inline-block h-1 w-10 rounded bg-indigo-500 mt-6 mb-4"></span>
                <h2 class="text-gray-900 font-medium title-font tracking-wider text-sm">Abhinav Namdeo</h2>
                <p class="text-gray-500">Lead Developer</p>
                </div>
            </div>
            </div>
        </div>
    </section>
    <?php
          require "views/_footer.php"
      ?>
</body>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
  AOS.init();
</script>

</html>