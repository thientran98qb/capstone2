@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/contract.css')}}">
@endsection
@section('main')
<div id="main">
    <!--contact section start-->
    <div class="contact-section">
        <div class="contact-info">
            <div><i class="fas fa-map-marker-alt"></i>254 Nguyen Van Linh, Da Nang</div>
            <div><i class="fas fa-envelope"></i>hoainam@email.com</div>
            <div><i class="fas fa-phone"></i>+1234555555</div>
            <div><i class="fas fa-clock"></i>Mon - Fri 8:00 AM to 5:00 PM</div>
        </div>
        <div class="contact-form">
            <h2>Contact Us</h2>
            <form class="contact" action="" method="post">
              <input type="text" name="name" class="text-box" placeholder="Your Name" required>
              <input type="email" name="email" class="text-box" placeholder="Your Email" required>
              <textarea name="message" id="" cols="30" rows="5" placeholder="Your message" required></textarea>
              <input type="submit" name="submit" class="send-btn" value="Send">
            </form>
        </div>
    </div>
    <!--contact section end-->
</div>
@endsection

