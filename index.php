<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <script async src="https://kit.fontawesome.com/6cc05e1e8e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="resources/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <title>Z Krainy Narwi demo</title>
</head>

<body>
    <?php include 'components/navbar.php' ?>
    <!-- Slideshow -->
    <section id="slideshow">
        <div class="slide">
            <img src="images/labrador-main.jpg">
            <div class="capture-text"><a href="/labrador.html">Labrador Retriever</a></div>
        </div>
        <div class="slide">
            <img src="images/bichon-main.jpg">
            <div class="capture-text"><a href="#">Bichon Frise</a></div>
        </div>
        <div class="slide">
            <img src="images/lagotto-main.jpg">
            <div class="capture-text"><a href="#">Lagotto Romangolo</a></div>
        </div>
        <div class="slide">
            <img src="images/chiuahua-main.jpg">
            <div class="capture-text"><a href="#">Chiuahua</a></div>
        </div>
    </section>
    <!--Motto-->
    <section id="motto">
        <div class="motto-area">
            <div class="motto-text-area">
                <p class="motto-text">
                    "Jedynym całkowicie bezinteresownym przyjacielem,
                    którego można mieć na tym interesownym świecie, takim,
                    który nigdy Cię nie opuści, nigdy nie okaże się niewdzięcznym lub zdradzieckim, jest pies...
                    Pocałuje rękę, która nie będzie mogła mu dać jeść, wyliże rany odniesione w starciu z brutalnościa
                    świata...
                    Kiedy wszyscy inni przyjaciele odejdą, on pozostanie"
                </p>
                <span class="author">George G. Vest</span>
            </div>
            <div class="motto-img-area">
                <img class="motto-img" src="images/lagotto-main.jpg">
            </div>
        </div>
    </section>
    <!--About-->
    <section id="about">
        <div class="about-section">
            <div class="about-section-image">
                <img src="images/labrador-chocolate.jpg">
            </div>
            <div class="about-section-text">
                <p>
                    Hodowlę psów rasowych "Z Krainy Narwi" zapoczątkowała doskonała czekoladowa suczka rasy Labrador
                    Retriever
                    YES KANO TONGA Zandalle (SONIA) , która trafiła do nas w 1999 roku.
                    Sezon wystawowy w latach 2000-2001 był dla SONI pełen sukcesów.
                </p>
                <a class="more-link" href="/about.html">Czytaj więcej &gt;&gt;</a>
            </div>
        </div>
    </section>
    <?php include 'components/contact.php' ?>
    <?php include 'components/footer.php' ?>
</body>

</html>