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
              .bg-breadcrumb {
  position: relative;
  overflow: hidden;
  background: linear-gradient(rgba(1, 94, 201, 0.616), rgba(0, 0, 0, 0.2)),
  url(../assets/img/baptismal2.jpg);
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
         p{
    color:#3b3b3b; text-align: justify; text-justify: inter-word; font-size: 15px; line-height: 1.6; margin-top: 10px; margin-left: 10px;
}


        .gallery {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-top: 2rem;
            margin-bottom: 3rem;
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
        .schedule {
float:left;       
margin-LEFT:20px;  

            padding: 10px;
            color: #3b3b3b;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 12PX;
            transition: background-color 0.3s ease;
        }
       
        .schedule:hover{
            color:wheat!important;
        }
       i{
            font-size:7px;
            margin-right:15px;
            color:black;
        }
    
.mass-schedule {
    width: 45%;
    border-collapse: collapse;
    background-color: #f2f5f9;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
    margin: 20px 0;
}

.mass-schedule th {
    background-color: #003366;
   
    padding: 12px;
    font-size: 1.1em;
    
}

.mass-schedule td, 
.mass-schedule th {
    border: 1px solid gray;
    padding: 10px;
    color: #3b3b3b;

}

.mass-schedule tbody tr:nth-child(even) {
    background-color:#f2f5f9;
}



.mass-schedule th[colspan="2"] {
    background-color: #f2f5f9;
    font-weight: bold;
    color: #3b3b3b;

}
.tableflex{
    display: flex;
    justify-content: space-between;
}
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
                <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">EUCHARISTIC MASSES</h4>
                <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">About Us</a></li>
                    <li class="breadcrumb-item active text-primary">Eucharistic</li>
                </ol>    
            </div>
        </div>
        <!-- Header End -->
<!-- Service Start -->

<div class="container-fluid service py-5"style="padding-bottom:0!important;" >
  
        <div class="container py-5" style="padding-top:0!important;padding-bottom:0!important;">
        
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s">

          <div class="gallery">
            
          <img src="assets/img/faq.png" alt="Etymology Image" class="float-right"> 
          <img src="assets/img/faq.png" alt="Etymology Image" class="float-right">
          <img src="assets/img/faq.png" alt="Etymology Image" class="float-right">
          <img src="assets/img/faq.png" alt="Etymology Image" class="float-right">
          </div>
            <P>The Catholic Church, as an esteemed institution, upholds the tradition of conducting Eucharistic celebrations on a daily basis, viewing it as the central and most fundamental service within its faith. This profound ritual assumes a pivotal role in all church activities and events, serving as the focal point of Catholic religious practices.
</P>
            <P>In Catholic theology, the Mass or Eucharist is revered as "the source and summit of the Christian life," and it serves as the cornerstone to which all other sacraments are oriented. Masses are convened with multifaceted purposes: they are a means to proclaim and internalize the teachings of God, a vehicle for seeking forgiveness for sins, a commemoration of the sacrifice of Jesus Christ, most notably during the Holy Week observances, and an opportunity to partake in the communion with Christ.
</P>
<p>The scheduling of Masses typically adheres to specific times during the week, with a primary focus on Sundays and the special Holy Celebrations designated within the Catholic Church calendar. These Masses are conducted in the Filipino language, making them accessible and relatable to the local congregation. In addition to the celebration of the Holy Mass, the church organizes novenas, recitations of the Rosary, holy hours, and vigils, all dedicated to honoring particular saints and fortifying the faith of the congregation.</p>
<p>To inform the faithful of the Mass schedule during these significant holy celebrations, announcements are made in the weeks leading up to the events, both within the church during regular Masses and through the church's official website. This ensures that the congregation is well-prepared and can actively participate in these spiritually enriching occasions.</p>
<div class="tableflex"> 
<table class="mass-schedule">
        <thead>
        <tr>
        <th colspan="4" style="font-weight: bold;  color: white!important;">NOVENA MASS</th>
    </tr>
            <tr>
                <th colspan="2">MORNING</th>
                <th colspan="2">AFTERNOON</th>
            </tr>
            <tr>
                <th style="background:#f2f5f9;color: #3b3b3b;">TIME</th>
                <th style="background:#f2f5f9;color: #3b3b3b;">LANGUAGE</th>
                <th style="background:#f2f5f9;color: #3b3b3b;">TIME</th>
                <th style="background:#f2f5f9;color: #3b3b3b;">LANGUAGE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>7:00 AM</td>
                <td>Cebuano</td>
                <td>1:00 PM</td>
                <td>Cebuano</td>
                
            </tr>
            <tr>
                <td>8:30 AM</td>
                <td>English</td>
                <td>2:30 PM</td>
                <td>English</td>
            </tr>
            <tr>
                <td>10:00 AM</td>
                <td>English</td>
                <td>3:00 PM</td>
                <td>English</td>
            </tr>
            <tr>
                <td>11:00 AM</td>
                <td>English</td>
                <td>4:00 PM</td>
                <td>English</td>
            </tr>
          
        </tbody>
    </table>
    <table class="mass-schedule">
        <thead>
        <tr>
        <th colspan="4" style="font-weight: bold;  color: white!important;">SUNDAYS & HOLY DAYS OF OBLIGATION
</th>
    </tr>
            <tr>
                <th colspan="2">MORNING</th>
                <th colspan="2">AFTERNOON</th>
            </tr>
            <tr>
                <th style="background:#f2f5f9;color: #3b3b3b;">TIME</th>
                <th style="background:#f2f5f9;color: #3b3b3b;">LANGUAGE</th>
                <th style="background:#f2f5f9;color: #3b3b3b;">TIME</th>
                <th style="background:#f2f5f9;color: #3b3b3b;">LANGUAGE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>7:00 AM</td>
                <td>Cebuano</td>
                <td>1:00 PM</td>
                <td>Cebuano</td>
                
            </tr>
            <tr>
                <td>8:30 AM</td>
                <td>English</td>
                <td>2:30 PM</td>
                <td>English</td>
            </tr>
            <tr>
                <td>10:00 AM</td>
                <td>English</td>
                <td>3:00 PM</td>
                <td>English</td>
            </tr>
            <tr>
                <td>11:00 AM</td>
                <td>English</td>
                <td>4:00 PM</td>
                <td>English</td>
            </tr>
          
        </tbody>
    </table>
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