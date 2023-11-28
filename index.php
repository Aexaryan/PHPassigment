<?php 
include 'db_connect.php'; // Include the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Alexander Tech</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            margin: 0;
            font-size: 1.5em; /* Adjust size as needed */
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            background-color: #004766;
            color: white;
            margin-bottom: 40px;
        }
        .product-container {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
            padding: 20px;
            padding-bottom: 100px;
            background-color: rgb(255,255,255, 0.5)
        }
        .product {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        .product img {
            max-width: 50%;
            height: auto;
        }
        .button {
         padding: 10px 20px;
         color: white;
        background-color: #007bff; /* Bright blue, you can choose your color */
        text-decoration: none;
        border: none;
        border-radius: 4px;
        transition: background-color 0.3s, box-shadow 0.3s, transform 0.3s;
        margin-left: 10px; /* Spacing between buttons */
        font-weight: bold; /* Make text bold */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Subtle shadow for depth */
}

.button:hover, .button:focus {
    background-color: #0056b3; /* Darker shade on hover */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Larger shadow on hover for a "lifting" effect */
    transform: translateY(-2px); /* Slight lift on hover */
}

/* Slideshow container */
.slideshow-container {
    width: 100%; /* Set to full width */
    height: 50%;
    position: relative;
    margin: auto;
    overflow: hidden;
}

.mySlides img {
    width: 100%; /* Ensure images also cover full width */
    height: 50%; /* Maintain aspect ratio */
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  margin-top: -22px;
  padding: 16px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Caption text */
/* Style for text within each slide */
.text {
    position: absolute;
    bottom: 40px; /* Position from the bottom of the slide */
    left: 50%; /* Centering horizontally */
    transform: translateX(-50%); /* Adjust horizontal position to truly center */
    color: white; /* Text color */
    font-size: 20px; /* Font size */
    text-align: center; /* Align text to center */
    background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background for readability */
    padding: 10px 20px; /* Padding around the text */
    border-radius: 10px; /* Rounded corners for the background */
}

/* Optional: Style for number text */
.numbertext {
    position: absolute;
    top: 10px;
    left: 10px;
    color: white;
    background-color: rgba(0, 0, 0, 0.5);
    padding: 5px 10px;
    border-radius: 5px;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  animation-name: fade;
  animation-duration: 1.5s;
}

@keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}
    </style>
</head>
<body>
    <div class="header">
        <h1>Alexander Tech</h1>
        <div>
            <a href="index.php" class="button">Home</a>
            <a href="admin_login.php" class="button">Login</a>
            <a href="admin_register.php" class="button">Sign Up</a>
        </div>
    </div>
    <!-- Slideshow container -->
<div class="slideshow-container">

<!-- Full-width images with number and caption text -->
<div class="mySlides fade">
  <div class="numbertext">1 / 3</div>
  <img src="upload/slide1.jpeg" style="width:100%">
  <div class="text">Get a Qoute</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 3</div>
  <img src="upload/slide2.jpeg" style="width:100%">
  <div class="text">We design your website</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 3</div>
  <img src="upload/slide4.jpeg" style="width:100%">
  <div class="text">IT Solutions</div>
</div>

<!-- Next and previous buttons -->
<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>

<!-- The dots/circles -->
<div style="text-align:center">
<span class="dot" onclick="currentSlide(1)"></span>
<span class="dot" onclick="currentSlide(2)"></span>
<span class="dot" onclick="currentSlide(3)"></span>
</div>
    <?php include 'global_body.php'; ?>
    <div class="product-container">
        <?php
        $sql = "SELECT ProductID, Name, Description, Price, Image FROM Products";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='product'>";
                echo "<img src='upload/" . $row["Image"] . "' alt='" . $row["Name"] . "' />";
                echo "<h3>" . $row["Name"] . "</h3>";
                echo "<p>" . $row["Description"] . "</p>";
                echo "<p>$" . $row["Price"] . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No products found</p>";
        }
        ?>
    </div>

    <?php 
    $conn->close(); // Close the database connection
    ?>
<script>
var slideIndex = 0;
showSlides();

function plusSlides(n) {
  slideIndex += n;
  showSlides();
  resetTimer(); // Reset the timer on manual control
}

function currentSlide(n) {
  slideIndex = n;
  showSlides();
  resetTimer(); // Reset the timer on manual control
}

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");

  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) { slideIndex = 1 }

  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }

  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}

// Timer for the slideshow
var timer;
function setTimer() {
  timer = setInterval(function() {
    plusSlides(1);
  }, 3000); // Change slide every 3 seconds
}

function resetTimer() {
  clearInterval(timer);
  setTimer();
}

setTimer(); // Initialize the timer
</script>


</body>
<?php include 'footer.php'; ?>
</html>
