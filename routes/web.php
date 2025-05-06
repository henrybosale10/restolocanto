<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminNotifController;
use App\Http\Controllers\Admin\AvisCommentaireController;
use App\Http\Controllers\Admin\PlatClientController;
use App\Http\Controllers\Admin\PlatController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\UserClientAdminController;
use App\Http\Controllers\Admin\OrderAdminController;
use App\Http\Controllers\Admin\LivreurController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\MenuController;
use App\Http\Controllers\Frontend\ReservezController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Frontend\LivraisonController;
use App\Http\Controllers\Frontend\NotificationController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\UserGestionController;
use App\Http\Controllers\Frontend\WelcomeController;
use App\Http\Controllers\Frontend\Avis_CommentaController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Admin\ContactController as Contact;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\Admin\RépondreController;
use App\Http\Controllers\Auth\SocialAuthController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ----------- FRONTEND -----------





// Page d'accueil
Route::get('/', [WelcomeController::class, 'index'])->name('home');

Route::get('/home', function () {
    return redirect('/');
});


// Routes pour les catégories
Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/{plat}', [CategoryController::class, 'show'])->name('categories.show');
});

// Routes pour les menus
Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');
Route::get('/menu/search', [MenuController::class, 'search'])->name('menu.search');

// Route pour afficher le formulaire de contact
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Formulaire de réservation
Route::prefix('reservations')->group(function () {
    Route::get('/create', [ReservezController::class, 'create'])->name('reservations.create');
    Route::post('/store', [ReservezController::class, 'store'])->name('reservations.store');
});

Route::prefix('payment')->group(function () {
    // Afficher la page de checkout (GET)
    Route::get('/checkout/{order_id}', [PaymentController::class, 'showCheckout'])->name('checkout.show');

    // Traiter la soumission du formulaire de paiement (POST)
    Route::post('/checkout', [PaymentController::class, 'processCheckout'])->name('checkout.process');

    // Callback après paiement (POST, si c'est un retour d'API de paiement)
    Route::post('/callback', [PaymentController::class, 'callback'])->name('payment.callback');

    // Page de confirmation de succès (GET)
    Route::get('/success', [PaymentController::class, 'success'])->name('payment.success');
});

Route::middleware('auth')->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [UserController::class, 'showProfile'])->name('show');
    Route::get('/edit', [UserController::class, 'editProfile'])->name('edit');
    Route::put('/update', [UserController::class, 'updateProfile'])->name('update');
    Route::delete('/delete', [UserController::class, 'destroy'])->name('delete');
});

Route::middleware(['auth', 'verified'])->prefix('profil')->name('profil.')->group(function () {
    Route::get('/', [UserGestionController::class, 'detailProfil'])->name('detail');
    Route::get('/modifier', [UserGestionController::class, 'modifierForm'])->name('modifclient');
    Route::post('/modifier', [UserGestionController::class, 'modifier'])->name('modifier');
});

Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
Route::get('/user/profile', [UserController::class, 'updateProfile'])->name('user.profile');


// Routes pour les avis/commentaires
Route::prefix('avis')->group(function () {
    Route::get('/', [Avis_CommentaController::class, 'index'])->name('avis_commentaire.index');
    Route::get('/create', [Avis_CommentaController::class, 'create'])->name('avis_commentaire.create');
    Route::post('/store', [Avis_CommentaController::class, 'store'])->name('avis_commentaire.store');
    Route::get('/{id}/edit', [Avis_CommentaController::class, 'edit'])->name('avis_commentaire.edit');
    Route::put('/{id}/update', [Avis_CommentaController::class, 'update'])->name('avis_commentaire.update');
    Route::delete('/{id}/destroy', [Avis_CommentaController::class, 'destroy'])->name('avis_commentaire.destroy');
    Route::get('/avis/{id}', [Avis_CommentaController::class, 'show'])->name('avis.show');
    Route::post('/{id}/like', [Avis_CommentaController::class, 'like'])->name('avis_commentaire.like');
    Route::post('/{id}/dislike', [Avis_CommentaController::class, 'dislike'])->name('avis_commentaire.dislike');
});

// Routes de connexion Google
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserController::class, 'login']);
    Route::get('/google/redirect', [UserGestionController::class, 'redirectToGoogle'])->name('google.login');
    Route::get('/google/callback', [UserGestionController::class, 'handleGoogleCallback']);
});


// Routes sécurisées avec authentification
Route::middleware(['auth'])->group(function () {
    Route::get('/conversation', [ConversationController::class, 'index'])->name('conversation.index');
    Route::post('/conversation/send', [ConversationController::class, 'sendMessage'])->name('conversation.send');
    Route::delete('/conversation/{id}', [ConversationController::class, 'deleteMessage'])->name('conversation.delete');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notification}/mark-as-read', [NotificationController::class, 'markAsRead'])
         ->name('notifications.markAsRead');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');


    // Routes du panier
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::post('/add', [CartController::class, 'add'])->name('cart.add');
        Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
        Route::put('/update/{id}', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/clear', [CartController::class, 'clear'])->name('cart.clear');
    });

    // Routes pour les commandes
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/create', [OrderController::class, 'create'])->name('orders.create');
        Route::post('/', [OrderController::class, 'store'])->name('orders.store');
        Route::get('/{orderId}', [OrderController::class, 'show'])->name('orders.show');
        Route::put('/{orderId}', [OrderController::class, 'update'])->name('orders.update');
        Route::post('/confirm-order', [OrderController::class, 'confirmOrder']);
        Route::get('/thank-you/{orderId}', [OrderController::class, 'thankYou'])->name('thankyou.page');
        Route::get('/historique-commandes', [OrderController::class, 'index'])->name('historique.commandes');


    });

    // Routes frontend pour la livraison
    Route::prefix('frontend/livraisons')->group(function () {
        Route::get('/order/{orderId}/livraison', [LivraisonController::class, 'create'])->name('livraisons.create');
        Route::post('/order/{orderId}/livraison', [LivraisonController::class, 'store'])->name('livraisons.store');
        Route::get('/order/{orderId}/confirmation', [LivraisonController::class, 'confirmation'])->name('livraisons.confirmation');
        Route::get('/livraisons/confirmation/{orderId}', [LivraisonController::class, 'confirmation'])->name('livraisons.confirmation');
        Route::get('livraisons/details/{livraisonId}', [LivraisonController::class, 'show'])->name('livraisons.details');
    });



    Route::get('/thankyou', fn() => view('thankyou'))->name('thankyou');
});

// Routes d'inscription et de gestion de l'email
Route::get('inscription', [UserGestionController::class, 'inscriptionForm'])->name('inscription.form');
Route::post('inscription', [UserGestionController::class, 'inscription'])->name('inscription');
Route::get('connexion', [UserGestionController::class, 'connexionForm'])->name('connexion.form');
Route::post('connexion', [UserGestionController::class, 'connexion'])->name('connexion');
Route::post('deconnexion', [UserGestionController::class, 'deconnexion'])->name('deconnexion');

// Routes protégées pour les clients (email vérifié requis)
Route::middleware(['auth', 'verified'])->prefix('profil')->name('profil.')->group(function () {
    Route::get('/', [UserGestionController::class, 'detailProfil'])->name('detail');
    Route::get('/modifier', [UserGestionController::class, 'modifierForm'])->name('modifclient');
    Route::post('/modifier', [UserGestionController::class, 'modifier'])->name('modifier');
});

// ----------- ADMINISTRATION -----------

// Routes d'administration (authentification et rôle admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::resource('tables', TableController::class);
    Route::resource('plats', PlatController::class);
    Route::resource('platclients', PlatClientController::class); // Assurez-vous que cette route existe
    Route::resource('users', UserClientAdminController::class);
    Route::resource('livreurs', LivreurController::class);
    Route::resource('commandes', OrderAdminController::class);
    Route::resource('reservations', ReservationController::class);
    Route::resource('avis', AvisCommentaireController::class);
    Route::resource('notifications', AdminNotifController::class);
    Route::resource('clients', UserController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('avis_commentaires', AvisCommentaireController::class);
    Route::resource('admin/clients', UserClientAdminController::class);



});
// Gestion des notifications (admin)
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/{id}', [NotificationController::class, 'show'])->name('notifications.show');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
});
// Gestion des clients (administration)
Route::prefix('admin/clients')->name('admin.clients.')->group(function () {
    Route::get('/', [UserClientAdminController::class, 'index'])->name('index');  // Liste des clients
    Route::get('/create', [UserClientAdminController::class, 'create'])->name('create');  // Formulaire de création
    Route::post('/', [UserClientAdminController::class, 'store'])->name('store');  // Enregistrer un client
    Route::get('/{client}', [UserClientAdminController::class, 'show'])->name('show');  // Afficher un client
    Route::get('/{client}/edit', [UserClientAdminController::class, 'edit'])->name('edit');  // Formulaire de modification
    Route::put('/admin/clients/{client}', [UserClientAdminController::class, 'update'])->name('admin.clients.update');

    Route::delete('/{client}', [UserClientAdminController::class, 'destroy'])->name('destroy');  // Supprimer un client
});
// Gestion des commandes (administration)
Route::prefix('admin/orders')->name('admin.orders.')->group(function () {
    Route::get('/', [OrderAdminController::class, 'index'])->name('index');  // Liste des commandes
    Route::get('/create', [OrderAdminController::class, 'create'])->name('create');  // Formulaire de création
    Route::post('/', [OrderAdminController::class, 'store'])->name('store');  // Enregistrer une commande
    Route::get('/{order}', [OrderAdminController::class, 'show'])->name('show');  // Afficher une commande
    Route::put('/{order}', [OrderAdminController::class, 'update'])->name('update');  // Mettre à jour une commande
    Route::delete('/{order}', [OrderAdminController::class, 'destroy'])->name('destroy');  // Supprimer une commande
    Route::post('/{order}/update-status', [OrderAdminController::class, 'updateStatus'])->name('updateStatus');  // Mettre à jour le statut d'une commande
});
// Gestion des livraisons et assignation des livreurs
Route::prefix('admin/livraisons')->name('admin.livraisons.')->group(function () {
    Route::get('/', [OrderAdminController::class, 'indexLivraisons'])->name('index');  // Liste des livraisons
    Route::get('/{livraison}/edit', [OrderAdminController::class, 'editLivraison'])->name('edit');  // Formulaire d'édition d'une livraison
    Route::put('/{livraison}', [OrderAdminController::class, 'updateLivraison'])->name('update');  // Mettre à jour une livraison
    Route::post('/assigner', [OrderAdminController::class, 'assignLivreur'])->name('assign');  // Assigner un livreur à une livraison
});
// Gestion des réponses aux utilisateurs (admin)
Route::prefix('admin/repondre')->name('admin.repondre.')->group(function () {
    Route::get('/', [RépondreController::class, 'index'])->name('index');  // Liste des réponses
    Route::get('/{userId}', [RépondreController::class, 'show'])->name('show');  // Afficher une réponse
    Route::post('/{userId}/respond', [RépondreController::class, 'respond'])->name('respond');  // Répondre à un utilisateur
    Route::delete('/{id}', [RépondreController::class, 'destroy'])->name('destroy');  // Supprimer une réponse
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
});

Route::prefix('admin')->name('admin.')->group(function () {
    // Afficher toutes les notifications
    Route::get('/notifications', [AdminNotifController::class, 'index'])->name('notifications.index');

    // Afficher les détails d'une notification
    Route::get('/notifications/{id}', [AdminNotifController::class, 'show'])->name('notifications.show');

    // Supprimer une notification
    Route::delete('/notifications/{id}', [AdminNotifController::class, 'destroy'])->name('notifications.destroy');

    // Marquer toutes les notifications comme lues
    Route::post('/notifications/mark-all-read', [AdminNotifController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
});

Route::put('/admin/platclients/{platClient}', [PlatClientController::class, 'update'])->name('admin.platclients.update');

