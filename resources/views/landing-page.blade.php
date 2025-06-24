@extends('layouts.app')

@section('title', 'Fore Coffee - Your Daily Cup of Joy')

@section('content')
<!-- HERO SECTION -->
<section class="text-center px-8 py-24 bg-green-50">
  <h2 class="text-4xl md:text-5xl font-bold text-green-700 mb-4">Your Daily Cup of Joy</h2>
  <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
    Enjoy sustainable, freshly brewed coffee delivered with care. From farm to cup, Fore Coffee brings the best to your day.
  </p>
  <a href="#menu" class="bg-green-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-green-700 transition">Explore Menu</a>
</section>

<!-- FEATURES SECTION -->
<section id="about" class="px-8 py-20 max-w-6xl mx-auto">
  <div class="grid md:grid-cols-3 gap-12 text-center">
    <div>
      <img src="https://img.icons8.com/ios-filled/100/26e07f/coffee-to-go.png" class="mx-auto mb-4" />
      <h3 class="text-xl font-semibold mb-2">Freshly Brewed</h3>
      <p class="text-gray-600">Only the best beans, roasted and brewed with precision every day.</p>
    </div>
    <div>
      <img src="https://img.icons8.com/ios-filled/100/26e07f/leaf.png" class="mx-auto mb-4" />
      <h3 class="text-xl font-semibold mb-2">Sustainable</h3>
      <p class="text-gray-600">We’re committed to eco-friendly sourcing and packaging.</p>
    </div>
    <div>
      <img src="https://img.icons8.com/ios-filled/100/26e07f/delivery.png" class="mx-auto mb-4" />
      <h3 class="text-xl font-semibold mb-2">Delivered to You</h3>
      <p class="text-gray-600">Order via app and get your favorite coffee wherever you are.</p>
    </div>
  </div>
</section>

<!-- MENU SECTION -->
<section id="menu" class="px-8 py-20 bg-green-50">
  <h2 class="text-3xl font-bold text-center text-green-700 mb-12">Our Favorites</h2>
  <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
    <div class="bg-white p-6 rounded-lg shadow text-center">
      <img src="https://source.unsplash.com/300x200/?coffee" class="rounded mb-4 w-full object-cover" />
      <h3 class="font-semibold text-lg">Signature Latte</h3>
      <p class="text-sm text-gray-500">Silky milk with our house blend espresso.</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow text-center">
      <img src="https://source.unsplash.com/300x200/?iced-coffee" class="rounded mb-4 w-full object-cover" />
      <h3 class="font-semibold text-lg">Cold Brew</h3>
      <p class="text-sm text-gray-500">Smooth and refreshing with natural sweetness.</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow text-center">
      <img src="https://source.unsplash.com/300x200/?matcha" class="rounded mb-4 w-full object-cover" />
      <h3 class="font-semibold text-lg">Matcha Latte</h3>
      <p class="text-sm text-gray-500">Premium Japanese matcha with oat milk.</p>
    </div>
  </div>
</section>

<!-- LOCATION SECTION -->
<section id="location" class="px-8 py-20">
  <h2 class="text-3xl font-bold text-center text-green-700 mb-8">Find Us</h2>
  <p class="text-center text-gray-600 mb-8">We are available in over 100 outlets across Indonesia!</p>
  <div class="text-center">
    <iframe class="w-full h-64 md:w-3/4 md:h-96 mx-auto rounded-lg shadow"
      src="https://www.google.com/maps/embed?pb=!1m18!..." allowfullscreen="" loading="lazy"></iframe>
  </div>
</section>
@endsection
