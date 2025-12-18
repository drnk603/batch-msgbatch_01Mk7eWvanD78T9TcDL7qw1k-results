<!--?php
/**
 * RentaCar - Premium Car Rental Service Homepage
 * A comprehensive car rental platform with dynamic content management
 */

// Set environment
$_ENV['APP_ENV'] = 'production';

// Include required files
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/security.php';
require_once __DIR__ . '/includes/error_handler.php';
require_once __DIR__ . '/includes/functions.php';

// Brand constants
define('BRAND_NAME', 'RentaCar');
define('PRIMARY_DOMAIN', 'rentacar-luxury.com');
define('SUPPORT_EMAIL', 'info@' . PRIMARY_DOMAIN);
define('COMPANY_PHONE', '+1 (555) RENTCAR');
define('COMPANY_ADDRESS', '123 Premium Drive, Los Angeles, CA 90210');

// Set page variables for header
$page_title = BRAND_NAME . ' - Premium Luxury Car Rentals | Trusted & Reliable';
$page_description = 'Experience premium car rentals with ' . BRAND_NAME . '. Luxury vehicles, competitive rates, and exceptional service. Book your perfect ride today.';
$page_keywords = 'car rental, luxury cars, premium vehicles, car hire, rental service';
$page_author = BRAND_NAME;
$og_type = 'website';
$og_image = 'https://images.unsplash.com/photo-1449824913935-59a10b8d2000?w=1200&h=630&fit=crop';

// Generate schema markup for homepage
$schema_markup = json_encode([
    '@context' =-->
<html>
 <head>
  <link rel="stylesheet" href="style.css">
  <link rel="icon" type="image/png" href="/favicon.png">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
 </head>
 <body>
  'https://schema.org', '@type' =&gt; 'CarRental', 'name' =&gt; BRAND_NAME, 'description' =&gt; $page_description, 'url' =&gt; 'https://domain.com', 'logo' =&gt; 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=200&amp;h=50&amp;fit=crop', 'telephone' =&gt; COMPANY_PHONE, 'address' =&gt; [ '@type' =&gt; 'PostalAddress', 'streetAddress' =&gt; '123 Premium Drive', 'addressLocality' =&gt; 'Los Angeles', 'addressRegion' =&gt; 'CA', 'postalCode' =&gt; '90210', 'addressCountry' =&gt; 'US' ], 'sameAs' =&gt; [ 'https://facebook.com/rentacar', 'https://twitter.com/rentacar', 'https://instagram.com/rentacar' ] ]); // Fetch featured cars (simulated data) $featured_cars = [ [ 'id' =&gt; 1, 'name' =&gt; 'BMW X5 Premium', 'category' =&gt; 'luxury-suv', 'image' =&gt; 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=400&amp;h=300&amp;fit=crop', 'price' =&gt; 149, 'features' =&gt; ['GPS Navigation', 'Leather Seats', 'Premium Sound'] ], [ 'id' =&gt; 2, 'name' =&gt; 'Mercedes C-Class', 'category' =&gt; 'luxury-sedan', 'image' =&gt; 'https://images.unsplash.com/photo-1563720223185-11003d516935?w=400&amp;h=300&amp;fit=crop', 'price' =&gt; 119, 'features' =&gt; ['Automatic', 'Air Conditioning', 'Bluetooth'] ], [ 'id' =&gt; 3, 'name' =&gt; 'Tesla Model S', 'category' =&gt; 'electric-luxury', 'image' =&gt; 'https://images.unsplash.com/photo-1617788138017-80ad40651399?w=400&amp;h=300&amp;fit=crop', 'price' =&gt; 199, 'features' =&gt; ['Electric', 'Autopilot', 'Supercharging'] ] ]; // Customer testimonials $testimonials = [ [ 'name' =&gt; 'Sarah Johnson', 'rating' =&gt; 5, 'review' =&gt; 'Exceptional service! The BMW X5 was immaculate and the staff was incredibly professional.', 'location' =&gt; 'Beverly Hills' ], [ 'name' =&gt; 'Michael Chen', 'rating' =&gt; 5, 'review' =&gt; 'Perfect for our business trip. Reliable, clean, and great value for money.', 'location' =&gt; 'Downtown LA' ], [ 'name' =&gt; 'Emma Davis', 'rating' =&gt; 5, 'review' =&gt; 'The Tesla was amazing! Smooth booking process and excellent customer support.', 'location' =&gt; 'Santa Monica' ] ]; // Log page view if (isset($pdo)) { log_activity('homepage_view', [ 'user_agent' =&gt; $_SERVER['HTTP_USER_AGENT'] ?? 'unknown', 'referer' =&gt; $_SERVER['HTTP_REFERER'] ?? 'direct' ], $pdo); } // Include header include 'includes/header.php'; ?&gt;
  <div class="page-container">
   <!-- Hero Section -->
   <section class="hero py-4 py-md-5" style="scroll-margin-top: var(--nav-h);" data-aos="fade-up">
    <div class="container">
     <div class="row align-items-center">
      <div class="col-lg-6">
       <h1 class="hero-title display-4 fw-bold mb-4">Premium Car Rentals
        <br>
        <span class="text-primary">You Can Trust</span></h1>
       <p class="hero-description lead mb-4">Experience luxury and reliability with <!--?php echo htmlspecialchars(BRAND_NAME); ?-->. From business trips to weekend getaways, we have the perfect vehicle for every journey.</p>
       <div class="hero-actions d-flex flex-column flex-sm-row gap-3">
        <a href="#featured-cars" class="btn btn-primary btn-lg px-4 py-3"> Browse Our Fleet </a> <a href="#contact" class="btn btn-outline-primary btn-lg px-4 py-3"> Get Quote Now </a>
       </div>
       <div class="hero-stats mt-4 pt-3 border-top">
        <div class="row text-center">
         <div class="col-4">
          <div class="stat-number h4 fw-bold text-primary mb-1">500+</div>
          <div class="stat-label small text-muted">Premium Cars</div>
         </div>
         <div class="col-4">
          <div class="stat-number h4 fw-bold text-primary mb-1">10k+</div>
          <div class="stat-label small text-muted">Happy Customers</div>
         </div>
         <div class="col-4">
          <div class="stat-number h4 fw-bold text-primary mb-1">24/7</div>
          <div class="stat-label small text-muted">Support</div>
         </div>
        </div>
       </div>
      </div>
      <div class="col-lg-6">
       <div class="hero-image ratio ratio-16x9" data-aos="fade-left" data-aos-delay="200">
        <img src="https://images.unsplash.com/photo-1449824913935-59a10b8d2000?w=800&amp;h=600&amp;fit=crop" alt="Luxury car rental fleet" class="img-fluid rounded-3 shadow-lg" width="800" height="600" loading="lazy">
       </div>
      </div>
     </div>
    </div>
   </section>
   <!-- Quick Booking Form -->
   <section class="quick-booking bg-light py-4 py-md-5" data-aos="fade-up">
    <div class="container">
     <div class="row justify-content-center">
      <div class="col-lg-10">
       <div class="card shadow border-0">
        <div class="card-body p-4">
         <h2 class="card-title text-center mb-4">Quick Booking</h2>
         <form class="booking-form row g-3" method="GET" action="#contact" novalidate>
          <div class="col-md-6 col-lg-3">
           <label for="pickup-location" class="form-label fw-semibold">Pickup Location</label> <select id="pickup-location" name="pickup_location" class="form-select" required> <option value="">Select Location</option> <option value="lax">LAX Airport</option> <option value="downtown">Downtown LA</option> <option value="beverly-hills">Beverly Hills</option> <option value="santa-monica">Santa Monica</option> </select>
          </div>
          <div class="col-md-6 col-lg-3">
           <label for="pickup-date" class="form-label fw-semibold">Pickup Date</label> <input type="date" id="pickup-date" name="pickup_date" class="form-control" min="&lt;?php echo date('Y-m-d'); ?&gt;" required>
          </div>
          <div class="col-md-6 col-lg-3">
           <label for="return-date" class="form-label fw-semibold">Return Date</label> <input type="date" id="return-date" name="return_date" class="form-control" min="&lt;?php echo date('Y-m-d'); ?&gt;" required>
          </div>
          <div class="col-md-6 col-lg-3">
           <label for="car-type" class="form-label fw-semibold">Car Type</label> <select id="car-type" name="car_type" class="form-select"> <option value="">Any Type</option> <option value="economy">Economy</option> <option value="compact">Compact</option> <option value="luxury">Luxury</option> <option value="suv">SUV</option> </select>
          </div>
          <div class="col-12 text-center">
           <button type="submit" class="btn btn-primary btn-lg px-5">Check Availability</button>
          </div>
         </form>
        </div>
       </div>
      </div>
     </div>
    </div>
   </section>
   <!-- Featured Cars -->
   <section id="featured-cars" class="featured-cars py-4 py-md-5" style="scroll-margin-top: var(--nav-h);" data-aos="fade-up">
    <div class="container">
     <div class="text-center mb-5">
      <h2 class="section-title h1 fw-bold mb-3">Our Premium Fleet</h2>
      <p class="section-description lead text-muted mx-auto" style="max-width: 600px;">Choose from our carefully selected collection of luxury and premium vehicles, each maintained to the highest standards.</p>
     </div>
     <div class="row g-4">
      <!--?php foreach ($featured_cars as $index =-->
      $car): ?&gt;
      <div class="col-lg-4 col-md-6">
       <div class="car-card card h-100 border-0 shadow-sm" data-aos="fade-up" data-aos-delay="&lt;?php echo $index * 100; ?&gt;">
        <div class="car-image-wrapper position-relative">
         <div class="ratio ratio-4x3">
          <img src="&lt;?php echo htmlspecialchars($car['image']); ?&gt;" alt="&lt;?php echo htmlspecialchars($car['name']); ?&gt;" class="card-img-top" style="object-fit: cover;" width="400" height="300" loading="lazy">
         </div>
         <div class="car-price position-absolute top-0 end-0 m-3">
          <span class="badge bg-primary fs-6 px-3 py-2"> $<!--?php echo htmlspecialchars($car['price']); ?-->/day </span>
         </div>
        </div>
        <div class="card-body d-flex flex-column">
         <h3 class="car-name card-title h5 fw-bold mb-3"><!--?php echo htmlspecialchars($car['name']); ?--></h3>
         <ul class="car-features list-unstyled mb-4 flex-grow-1">
          <!--?php foreach ($car['features'] as $feature): ?-->
          <li class="feature-item d-flex align-items-center mb-2">
           <svg class="feature-icon me-2 text-success" width="16" height="16" fill="currentColor">
            <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
           </svg>
           <!--?php echo htmlspecialchars($feature); ?-->
          </li>
          <!--?php endforeach; ?-->
         </ul>
         <div class="car-actions mt-auto">
          <a href="#contact" class="btn btn-primary w-100"> Book Now </a>
         </div>
        </div>
       </div>
      </div>
      <!--?php endforeach; ?-->
     </div>
     <div class="text-center mt-5">
      <a href="#contact" class="btn btn-outline-primary btn-lg"> View Complete Fleet </a>
     </div>
    </div>
   </section>
   <!-- Why Choose Us -->
   <section class="why-choose-us bg-light py-4 py-md-5" data-aos="fade-up">
    <div class="container">
     <div class="text-center mb-5">
      <h2 class="section-title h1 fw-bold mb-3">Why Choose <!--?php echo htmlspecialchars(BRAND_NAME); ?-->?</h2>
      <p class="section-description lead text-muted mx-auto" style="max-width: 600px;">We're committed to providing exceptional service and maintaining the highest standards in car rentals.</p>
     </div>
     <div class="row g-4">
      <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="0">
       <div class="feature-card text-center p-4">
        <div class="feature-icon-wrapper mb-3">
         <div class="ratio ratio-1x1 mx-auto" style="width: 80px;">
          <svg class="feature-icon text-primary" fill="currentColor" viewBox="0 0 16 16">
           <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" /> <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.061L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
          </svg>
         </div>
        </div>
        <h3 class="feature-title h5 fw-bold mb-2">Trusted Service</h3>
        <p class="feature-description text-muted small">Over 15 years of reliable car rental service with thousands of satisfied customers.</p>
       </div>
      </div>
      <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
       <div class="feature-card text-center p-4">
        <div class="feature-icon-wrapper mb-3">
         <div class="ratio ratio-1x1 mx-auto" style="width: 80px;">
          <svg class="feature-icon text-primary" fill="currentColor" viewBox="0 0 16 16">
           <path d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
          </svg>
         </div>
        </div>
        <h3 class="feature-title h5 fw-bold mb-2">Premium Fleet</h3>
        <p class="feature-description text-muted small">Luxury vehicles from top brands, regularly maintained and thoroughly inspected.</p>
       </div>
      </div>
      <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
       <div class="feature-card text-center p-4">
        <div class="feature-icon-wrapper mb-3">
         <div class="ratio ratio-1x1 mx-auto" style="width: 80px;">
          <svg class="feature-icon text-primary" fill="currentColor" viewBox="0 0 16 16">
           <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm0-1A7 7 0 1 1 8 1a7 7 0 0 1 0 14z" /> <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
          </svg>
         </div>
        </div>
        <h3 class="feature-title h5 fw-bold mb-2">24/7 Support</h3>
        <p class="feature-description text-muted small">Round-the-clock customer support and roadside assistance for your peace of mind.</p>
       </div>
      </div>
      <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
       <div class="feature-card text-center p-4">
        <div class="feature-icon-wrapper mb-3">
         <div class="ratio ratio-1x1 mx-auto" style="width: 80px;">
          <svg class="feature-icon text-primary" fill="currentColor" viewBox="0 0 16 16">
           <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" /> <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
          </svg>
         </div>
        </div>
        <h3 class="feature-title h5 fw-bold mb-2">Personal Service</h3>
        <p class="feature-description text-muted small">Dedicated account managers and personalized service tailored to your needs.</p>
       </div>
      </div>
     </div>
    </div>
   </section>
   <!-- Customer Reviews -->
   <section class="customer-reviews py-4 py-md-5" data-aos="fade-up">
    <div class="container">
     <div class="text-center mb-5">
      <h2 class="section-title h1 fw-bold mb-3">What Our Customers Say</h2>
      <p class="section-description lead text-muted mx-auto" style="max-width: 600px;">Don't just take our word for it. Here's what our valued customers have to say about their experience.</p>
     </div>
     <div class="row g-4">
      <!--?php foreach ($testimonials as $index =-->
      $testimonial): ?&gt;
      <div class="col-lg-4" data-aos="fade-up" data-aos-delay="&lt;?php echo $index * 100; ?&gt;">
       <div class="testimonial-card card h-100 border-0 shadow-sm">
        <div class="card-body p-4">
         <div class="testimonial-rating mb-3">
          <!--?php for ($i = 1; $i <= 5; $i++): ?-->
          <span class="star &lt;?php echo $i &lt;= $testimonial['rating'] ? 'text-warning' : 'text-muted'; ?&gt;"> ★ </span> <!--?php endfor; ?-->
         </div>
         <blockquote class="testimonial-text mb-4">
          <p class="mb-0 fst-italic">"<!--?php echo htmlspecialchars($testimonial['review']); ?-->"</p>
         </blockquote>
         <footer class="testimonial-author d-flex align-items-center">
          <div class="author-avatar ratio ratio-1x1 rounded-circle overflow-hidden me-3" style="width: 50px;">
           <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?w=50&amp;h=50&amp;fit=crop&amp;crop=face" alt="&lt;?php echo htmlspecialchars($testimonial['name']); ?&gt;" class="img-fluid" style="object-fit: cover;" width="50" height="50" loading="lazy">
          </div>
          <div class="author-info">
           <div class="author-name fw-semibold">
            <!--?php echo htmlspecialchars($testimonial['name']); ?-->
           </div>
           <div class="author-location text-muted small">
            <!--?php echo htmlspecialchars($testimonial['location']); ?-->
           </div>
          </div>
         </footer>
        </div>
       </div>
      </div>
      <!--?php endforeach; ?-->
     </div>
    </div>
   </section>
   <!-- Contact Section -->
   <section id="contact" class="contact-section bg-light py-4 py-md-5" style="scroll-margin-top: var(--nav-h);" data-aos="fade-up">
    <div class="container">
     <div class="row">
      <div class="col-lg-6 mb-4 mb-lg-0">
       <div class="contact-info">
        <h2 class="section-title h1 fw-bold mb-4">Get In Touch</h2>
        <p class="lead text-muted mb-4">Ready to book your perfect car? Contact us today and let our team help you find the ideal vehicle for your needs.</p>
        <div class="contact-details">
         <div class="contact-item d-flex align-items-start mb-4">
          <div class="contact-icon me-3">
           <svg class="text-primary" width="24" height="24" fill="currentColor">
            <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z" />
           </svg>
          </div>
          <div class="contact-content">
           <h3 class="contact-title h6 fw-bold mb-1">Address</h3>
           <address class="contact-text text-muted mb-0"><!--?php echo htmlspecialchars(COMPANY_ADDRESS); ?--></address>
          </div>
         </div>
         <div class="contact-item d-flex align-items-start mb-4">
          <div class="contact-icon me-3">
           <svg class="text-primary" width="24" height="24" fill="currentColor">
            <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122L9.98 10.97a.678.678 0 0 1-.609-.115L6.114 8.598a.678.678 0 0 1-.115-.609l.435-1.805a.678.678 0 0 0-.122-.58L4.518 3.297a.678.678 0 0 0-.864-.197z" />
           </svg>
          </div>
          <div class="contact-content">
           <h3 class="contact-title h6 fw-bold mb-1">Phone</h3>
           <a href="tel:&lt;?php echo str_replace(['(', ')', ' ', '-'], '', COMPANY_PHONE); ?&gt;" class="contact-text text-decoration-none text-muted"> <!--?php echo htmlspecialchars(COMPANY_PHONE); ?--> </a>
          </div>
         </div>
         <div class="contact-item d-flex align-items-start mb-4">
          <div class="contact-icon me-3">
           <svg class="text-primary" width="24" height="24" fill="currentColor">
            <path d="M2 2A2 2 0 0 0 .05 3.555L8 8.414l7.95-4.859A2 2 0 0 0 14 2H2Zm-2 9.8V4.698l5.803 3.546L0 11.801Zm6.761-2.97-6.57 4.026A2 2 0 0 0 2 14h6.256A4.493 4.493 0 0 1 8 11.5a4.51 4.51 0 0 1 .776-2.52L8.761 8.83ZM16 4.698v4.1l-2.493 1.54A4.51 4.51 0 0 1 15 11.5c0-.137-.007-.273-.02-.408L16 10.296V4.698Z" />
           </svg>
          </div>
          <div class="contact-content">
           <h3 class="contact-title h6 fw-bold mb-1">Email</h3>
           <a href="mailto:&lt;?php echo htmlspecialchars(SUPPORT_EMAIL); ?&gt;" class="contact-text text-decoration-none text-muted"> <!--?php echo htmlspecialchars(SUPPORT_EMAIL); ?--> </a>
          </div>
         </div>
        </div>
        <div class="business-hours mt-4">
         <h3 class="h6 fw-bold mb-2">Business Hours</h3>
         <ul class="list-unstyled text-muted small">
          <li class="mb-1">Monday - Friday: 6:00 AM - 10:00 PM</li>
          <li class="mb-1">Saturday: 7:00 AM - 9:00 PM</li>
          <li class="mb-1">Sunday: 8:00 AM - 8:00 PM</li>
         </ul>
        </div>
       </div>
      </div>
      <div class="col-lg-6">
       <div class="contact-form-wrapper">
        <form class="contact-form" method="POST" action="thank_you.php" novalidate>
         <input type="hidden" name="csrf_token" value="&lt;?php echo htmlspecialchars(get_csrf_token()); ?&gt;"> <input type="hidden" name="form_type" value="contact">
         <div class="row g-3">
          <div class="col-md-6">
           <label for="first-name" class="form-label fw-semibold"> First Name <span class="text-danger">*</span> </label> <input type="text" id="first-name" name="first_name" class="form-control" required aria-required="true" minlength="2" maxlength="50" placeholder="John">
           <div class="invalid-feedback"></div>
          </div>
          <div class="col-md-6">
           <label for="last-name" class="form-label fw-semibold"> Last Name <span class="text-danger">*</span> </label> <input type="text" id="last-name" name="last_name" class="form-control" required aria-required="true" minlength="2" maxlength="50" placeholder="Doe">
           <div class="invalid-feedback"></div>
          </div>
         </div>
         <div class="mb-3">
          <label for="email" class="form-label fw-semibold"> Email Address <span class="text-danger">*</span> </label> <input type="email" id="email" name="email" class="form-control" required aria-required="true" maxlength="254" placeholder="info@domain.com">
          <div class="invalid-feedback"></div>
         </div>
         <div class="mb-3">
          <label for="phone" class="form-label fw-semibold">Phone Number</label> <input type="tel" id="phone" name="phone" class="form-control" maxlength="20" placeholder="+1 (555) 123-4567">
          <div class="invalid-feedback"></div>
         </div>
         <div class="mb-3">
          <label for="service-type" class="form-label fw-semibold"> Service Interest <span class="text-danger">*</span> </label> <select id="service-type" name="service_type" class="form-select" required> <option value="">Select a service</option> <option value="rental-inquiry">Car Rental Inquiry</option> <option value="long-term-lease">Long-term Lease</option> <option value="corporate-account">Corporate Account</option> <option value="support">Customer Support</option> <option value="feedback">Feedback</option> </select>
          <div class="invalid-feedback"></div>
         </div>
         <div class="mb-3">
          <label for="message" class="form-label fw-semibold"> Message <span class="text-danger">*</span> </label> <textarea id="message" name="message" class="form-control" rows="5" required aria-required="true" minlength="10" maxlength="1000" placeholder="Tell us about your car rental needs..."></textarea>
          <div class="invalid-feedback"></div>
          <div class="form-text">Minimum 10 characters required</div>
         </div>
         <div class="mb-4">
          <div class="form-check">
           <input type="checkbox" id="consent" name="consent" class="form-check-input" required aria-required="true"> <label for="consent" class="form-check-label small"> I agree to the processing of my personal data and accept the <a href="#privacy" class="text-primary text-decoration-none">Privacy Policy</a> and <a href="#terms" class="text-primary text-decoration-none">Terms of Service</a>. <span class="text-danger">*</span> </label>
           <div class="invalid-feedback"></div>
          </div>
         </div>
         <div class="d-grid gap-2 d-md-flex justify-content-md-start">
          <button type="submit" class="btn btn-primary btn-lg px-5">Send Message</button>
          <button type="reset" class="btn btn-outline-secondary btn-lg px-4">Clear Form</button>
         </div>
        </form>
       </div>
      </div>
     </div>
    </div>
   </section>
   <!-- Cookie Consent Banner -->
   <div id="cookie-banner" class="cookie-banner position-fixed bottom-0 start-0 end-0 bg-dark text-white p-3 d-none" role="alert" aria-label="Cookie consent banner">
    <div class="container">
     <div class="row align-items-center">
      <div class="col-lg-8">
       <p class="mb-0">We use cookies to enhance your browsing experience and provide personalized services. By continuing to use our website, you consent to our use of cookies. <a href="#privacy" class="text-primary text-decoration-none">Learn more</a></p>
      </div>
      <div class="col-lg-4 text-lg-end mt-2 mt-lg-0">
       <button id="accept-cookies" class="btn btn-primary btn-sm me-2">Accept</button>
       <button id="decline-cookies" class="btn btn-outline-light btn-sm">Decline</button>
      </div>
     </div>
    </div>
   </div>
  </div>
  <!--?php
// Include footer
include 'includes/footer.php';
?-->
  <footer class="testimonial-author d-flex align-items-center">
   <div class="author-avatar ratio ratio-1x1 rounded-circle overflow-hidden me-3" style="width: 50px;">
    <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?w=50&amp;h=50&amp;fit=crop&amp;crop=face" alt="&lt;?php echo htmlspecialchars($testimonial['name']); ?&gt;" class="img-fluid" style="object-fit: cover;" width="50" height="50" loading="lazy">
   </div>
   <div class="author-info">
    <div class="author-name fw-semibold">
     <!--?php echo htmlspecialchars($testimonial['name']); ?-->
    </div>
    <div class="author-location text-muted small">
     <!--?php echo htmlspecialchars($testimonial['location']); ?-->
    </div>
   </div>
  </footer>
  <script src="script.js" defer></script>
 </body>
</html>