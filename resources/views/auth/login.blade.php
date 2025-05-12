<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion - Plateforme</title>
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body class="login-page">

  <!-- TITRE -->
  <h1 class="page-title">Connexion à la Plateforme</h1>

  <!-- FORMULAIRE -->
  <div class="login-container">
    <img src="{{ asset('images/logo-ministere.png') }}" alt="Logo Ministère" class="logo-ministere">

    <h2>CONNEXION</h2>
    <p>Entrez vos identifiants pour vous connecter à la plateforme</p>

    <form method="POST" action="{{ route('login') }}">
      @csrf
      <input type="text" name="email" placeholder="Adresse email" required>
      <input type="password" name="password" placeholder="Mot de passe" required>

      <div class="options">
        <input type="checkbox" id="remember" name="remember">
        <label for="remember">Se souvenir de moi</label>
      </div>

      <button type="submit">SE CONNECTER</button>
      <a href="#" class="forgot-password">🔒 Mot de passe oublié ?</a>
      @if ($errors->any())
    <div style="color: red; margin-top: 1rem;">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

    </form>
  </div>

</body>
</html>
