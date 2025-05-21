<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Us - KolXi</title>
  <!-- normalized all element  -->
    <link rel="stylesheet" href="css/normalized.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/kolchi.css">
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="shortcut icon" href="imgs/logo.svg" type="image/x-icon">
  <link rel="stylesheet" href="css/contact.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <header class="header">
    <div class="container">
        <div class="logo">
            <a href="./index.php"><img src="./imgs/KOlش.svg" alt="logo" class="logo-img"></a>
        </div>
    </div>
    </header>
  <div class="contact-container">
    <div class="contact-header">
      <h1>Need Help?</h1>
      <p>We'd love to hear from you. Whether it's a question, feedback or just a hello 👋</p>
    </div>

    <div class="contact-wrapper">
      <div class="contact-info">
        <h2>Contact Information</h2>
        <p><i class="fas fa-map-marker-alt"></i> 123 KolXi Street, Rabat, Morocco</p>
        <p><i class="fas fa-phone"></i> +212 6 00 00 00 00</p>
        <p><i class="fas fa-envelope"></i> support@kolxi.com</p>

        <div class="contact-map">
          <iframe src="https://maps.google.com/maps?q=Rabat&t=&z=13&ie=UTF8&iwloc=&output=embed"
            width="100%" height="200" style="border:0;" allowfullscreen loading="lazy"></iframe>
        </div>
      </div>

      <div class="contact-form">
        <form action="send_message.php" method="POST">
          <label for="name">Full Name</label>
          <input type="text" name="name" id="name" required>

          <label for="email">Email</label>
          <input type="email" name="email" id="email" required>

          <label for="message">Message</label>
          <textarea name="message" id="message" rows="5" required></textarea>

          <button type="submit">Send Message</button>
        </form>
      </div>
    </div>
  </div>
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <img src="imgs/logo.svg" alt="logo" class="logo-img">
                </div>
                <div class="footer-links">
                    <ul>
                        <li><a href="./index.php">Home</a></li>
                        <li><a href="./about.php">About</a></li>
                        <li><a href="./contact.php">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-socials">
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 KolXi. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
