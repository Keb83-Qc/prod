<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Message; // <--- INDISPENSABLE pour la messagerie
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Affiche la page de connexion
     */
    public function showLogin()
    {
        // Assurez-vous que le fichier resources/views/login.blade.php existe
        return view('auth.login');
    }

    /**
     * Gère la connexion
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Redirection vers le dashboard admin Filament
            return redirect()->intended('/admin');
        }

        return back()->withErrors([
            'email' => 'Les identifiants ne correspondent pas.',
        ]);
    }

    /**
     * Gère l'inscription AJAX et envoie le message interne
     */
    public function registerAjax(Request $request)
    {
        // 1. Validation
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string',
        ]);

        try {
            // --- GESTION DE LA POSITION (OPTIONNEL) ---
            $lastPosition = User::max('position');
            $newPosition = $lastPosition ? $lastPosition + 1 : 1;
            // ------------------------------------------

            // 2. CRÉATION DU CANDIDAT
            $password = Str::random(12);

            $newUser = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($password),
                'role_id' => 6, // ID 5 = Candidat
                'position' => $newPosition,
            ]);

            // 3. ENVOI DU MESSAGE AUX SUPER ADMINS ET ADMINS

            // 👇 C'EST ICI QUE ÇA CHANGE 👇

            // Liste des IDs de rôles qui doivent recevoir la notif
            // 1 = Super Admin, 3 = Admin (Adaptez selon vos vrais IDs dans la table 'roles')
            $targetRoleIds = [1, 2];

            // On récupère TOUS les utilisateurs qui ont ces rôles
            $recipients = User::whereIn('role_id', $targetRoleIds)->get();

            // On envoie un message individuel à CHACUN d'eux
            foreach ($recipients as $recipient) {
                Message::create([
                    'sender_id' => $newUser->id,
                    'receiver_id' => $recipient->id, // L'ID de l'admin en cours dans la boucle
                    'subject' => 'Nouvelle inscription : ' . $newUser->first_name . ' ' . $newUser->last_name,
                    'body' => "Une nouvelle demande d'inscription a été reçue.<br><br>" .
                        "<strong>Nom :</strong> {$newUser->last_name}<br>" .
                        "<strong>Prénom :</strong> {$newUser->first_name}<br>" .
                        "<strong>Email :</strong> {$newUser->email}<br>" .
                        "<strong>Téléphone :</strong> {$newUser->phone}<br><br>" .
                        "Merci de valider ou refuser ce compte ci-dessous.",
                    'is_read' => false,
                    'created_at' => now(),

                    // On inclut les données pour les boutons Valider/Refuser
                    'data' => [
                        'action_type' => 'registration_request',
                        'applicant_id' => $newUser->id
                    ],
                ]);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur technique : ' . $e->getMessage()
            ], 500);
        }
    }
}
