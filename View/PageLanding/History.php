<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>ARGAO CHURCH MANAGEMENT SYSTEM</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="keywords" />
    <meta content="" name="description" />
    <link rel="icon" href="../assets/img/mainlogo.jpg" type="image/x-icon"
    />

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Inter:slnt,wght@-10..0,100..900&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link rel="stylesheet" href="lib/animate/animate.min.css"/>
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
        <style>
          body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container-fluid {
            padding: 20px;
        }

        .accordion {
          position: relative;

          background-color: #fff;
          color: #0066a8;
            cursor: pointer;
            padding: 1rem;
            border: none;
            text-align: left;
            outline: none;
            transition: 0.4s;
            width: 100%;
            border-radius: 0px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 1.2rem;
            border-bottom: 1px solid gray;
            transition: color 0.3s ease;
            overflow: hidden;

        }
/* Add a pseudo-element for the border-top transition */
.accordion::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background-color: #0066a8;
    transition: width 0.8s ease, left 0.8s ease;
}

/* Expand the pseudo-element on hover and set background to none */
.accordion:hover::before,
.accordion.active::before {
    width: 100%;
    left: 0;
    border-bottom: none;

}
        .accordion:hover {
          border-bottom: none;
          background: none;
        }
      
        .accordion:after {
            content: '\f078'; /* Font Awesome down arrow */
            font-family: 'Font Awesome 6 Free'; /* Font Awesome font family */
            font-weight: 900; /* Font Awesome icon weight */
            font-size: 20px;
            color: #0066a8;
            transition: transform 0.4s;
        }

        .accordion.active:after {
            content: '\f077'; /* Font Awesome up arrow */
            transform: rotate(180deg); /* Rotate the arrow */
        }

        .panel {
            padding: 15px 20px;
            background-color: #fff;
            border-radius: 8px;
            display: none;
            overflow: hidden;
            transition: max-height 0.2s ease-out;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            margin-top:-30px;
        }
        .panel img {
            width: 20%;
            border-radius: 5px;
            margin-bottom: 1rem;
        }
        .panel p {
          color:#3b3b3b;
                      line-height: 1.6;
            margin: 0;
            padding: 0.5rem 0;
            text-align: left; /* Ensure left alignment */
        }

        .container py-5 {
            padding: 30px;
        }

        .text-center h1 {
            color: #004b6d;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        .gallery {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-top: 2rem;
        }
        .gallery img {
            width: 40%;
            max-width: calc(25% - 1rem);
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        .back-button {
float:right;       
margin-right:110px;  
margin-top:20px;  

            padding: 0.5rem 1rem;
            background-color: #0066a8;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }
        .back-button:hover {
            background-color: #004a80;
        }
        P{
          color:#3b3b3b;
        }
        
/*** Single Page Hero Header Start ***/
.bg-breadcrumb {
  position: relative;
  overflow: hidden;
  background: linear-gradient(rgba(1, 94, 201, 0.616), rgba(0, 0, 0, 0.2)),
  url(../assets/img/historycover.jpeg);
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  padding: 60px 0 60px 0;
  transition: 0.5s;
}

.bg-breadcrumb .breadcrumb {
  position: relative;
}

.bg-breadcrumb .breadcrumb .breadcrumb-item a {
  color: var(--bs-white);
}

/*** Single Page Hero Header End ***/

    </style>
    </head>

    <body>
 <!-- Navbar & Hero Start -->
 <div class="container-fluid nav-bar px-0 px-lg-4 py-lg-0">
      <div class="container">
      <?php require_once 'navbar.php'?>

      </div>
    </div>
    <!-- Navbar & Hero End -->
      

        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">HISTORY</h4>
                <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">About Us</a></li>
                    <li class="breadcrumb-item active text-primary">History</li>
                </ol>    
            </div>
        </div>
        <!-- Header End -->
<!-- Service Start -->
<a href="history.php" class="back-button">Back</a>

<div class="container-fluid service py-5">
  
        <div class="container py-5" style="padding-top:0!important;">
        
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s">

          <div class="gallery">
            
          <img src="../assets/img/historycover.jpeg" alt="Etymology Image" class="float-right"> 
          <img src="../assets/img/history2.jpg" alt="Etymology Image" class="float-right">
          <img src="../assets/img/history3.jpg" alt="Etymology Image" class="float-right">
          <img src="../assets/img/history4.jpg" alt="Etymology Image" class="float-right">
          </div>
            <p class="mb-0" style="color:#3b3b3b; text-align: justify; text-justify: inter-word; font-size: 16px; line-height: 1.6; margin-top:10px; margin-left: 10px;">
                This overview explores the historical journey of the Archdiocesan Shrine of San Miguel Arcangel in Argao, Cebu, from its etymological roots and Spanish colonial origins to its role during the Philippine Revolution, American period, and World War II. It highlights the church's transformation and ongoing significance as a key religious and cultural landmark in the region.
            </p>
        </div>
            <div class="text-center mx-auto pb-5">
                <button class="accordion" style="font-weight:700;
">ETYMOLOGY</button>
                <div class="panel">
                    <p style=" font-size: 16px; line-height: 1.6; ">The name "Argao" is believed to be derived from the Spanish word "argayo," meaning "to be angry."               
According to local folklore, this name was given due to the frequent disputes or quarrels in the area. Another theory isAccording to local folklore, this name was given due to the frequent disputes or quarrels in the area. Another theory is that it might be derived from "Argao," a name of uncertain origin used in early Spanish documents.According to local folklore, this name was given due to the frequent disputes or quarrels in the area. Another theory is that it might be derived from "Argao," a name of uncertain origin used in early Spanish documents. that it might be derived from "Argao," a name of uncertain origin used in early Spanish documents.</p>
                </div>

                <button class="accordion" style="font-weight:700;">EARLY HISTORY</button>
                <div class="panel">
                    <p>During the Spanish colonization, the explorer Miguel López de Legazpi arrived in the Philippines in 1565, beginning the process of colonization. Catholic missionaries were crucial in spreading Christianity during this period. By 1581, Spanish missionaries established the town of Argao and founded the parish of San Miguel Arcangel, which became an important center for Christian faith in the region. The first church dedicated to San Miguel Arcangel was built in 1608, constructed from bamboo and nipa palm.</p> 
                    <br>
                    <p>In 1730, the church was rebuilt with more durable materials like coral stones and bricks. This new construction, overseen by Spanish friars, was designed to withstand the harsh weather conditions better than the original bamboo structure. This development marked a significant improvement in the church's resilience and continued importance to the community.</p>
                </div>

                <button class="accordion" style="font-weight:700;">THE REVOLUTION YEARS</button>
                <div class="panel">
                <p>During the Philippine Revolution from 1896 to 1898, the town of Argao and its parish church were deeply involved in the fight for independence from Spanish rule. The church served as a place of refuge and resistance for locals and revolutionary forces.</p> 
                    <br>
                    <p>In 1898, the church was damaged due to the conflict. Despite the turmoil, the local parishioners, together with the revolutionary forces, worked hard to maintain their control and protect their cultural and religious heritage during this turbulent time.</p>
                </div>

                <button class="accordion" style="font-weight:700;">THE AMERICAN PERIOD</button>
                <div class="panel">
                    <p>DDuring the Philippine Revolution from 1896 to 1898, the parish church in Argao played a significant role in the struggle for independence from Spanish rule, serving as a place of refuge and resistance. In 1898, the church was damaged by the conflict, but local parishioners and revolutionary forces worked to maintain control and protect their culture and religion amid the political upheaval.</p> 
                    <br>
                    <p>Under American rule from 1898 to 1946, the parish experienced changes in administration and governance, but the church remained a central institution in the community. In the 1920s and 1930s, significant renovations were made to accommodate a growing congregation, blending American and Spanish architectural styles. During World War II, from 1941 to 1945, the church suffered damage from bombings but continued to serve as a refuge during the Japanese occupation. After the war, efforts to restore and rebuild the church began in 1946, with support from the Archdiocese of Cebu.</p>
                </div>

                <button class="accordion" style="font-weight:700;">CONTEMPORARY PERIOD</button>
                <div class="panel">
                    <p>In the post-war years, starting in 1946, significant efforts were made to restore and rebuild the Archdiocesan Shrine of San Miguel Arcangel. The community, with support from the Archdiocese of Cebu, undertook the task of repairing the church, ensuring that its historical and spiritual heritage was preserved. These restoration efforts aimed to return the church to its former glory after the damage it sustained during World War II.</p> 
                    <br>
                    <p>During the 1950s through the 1970s, the church continued to play a central role in the community of Argao. It hosted various religious and cultural events, reflecting its importance in the lives of local parishioners. As the number of parishioners grew, the church expanded its facilities and services to accommodate the increasing demand, reinforcing its role as a hub for community life.</p>
                    <br><p>
                    In the modern era, from the 1990s to the present, the Archdiocesan Shrine of San Miguel Arcangel was officially recognized as a shrine, highlighting its historical and spiritual significance. The church has embraced modern technology and practices while maintaining its rich historical heritage. It continues to serve the Argao community by offering a wide range of religious, social, and educational programs, solidifying its position as a key historical and cultural landmark in Cebu.
                    </p>
                </div>
            </div>
        </div>
    </div>


    <?php require_once 'footer.php'?>



        <!-- Back to Top -->
        <a href="#" class="btn btn-primary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

        <script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }
</script>
        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/wow/wow.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/counterup/counterup.min.js"></script>
        <script src="lib/lightbox/js/lightbox.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>

</html>